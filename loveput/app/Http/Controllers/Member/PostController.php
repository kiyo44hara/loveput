<?php

namespace App\Http\Controllers\Member;

use Illuminate\Http\Request;
use App\Models\Member\Post;
use App\Models\Member\User;
use App\Models\Member\Love;
use App\Http\Controllers\Controller;
use App\Repositories\LoveRepository;
use Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Pagination\Paginator;
use Google\Cloud\Language\V1\LanguageServiceClient;
use Google\Cloud\Language\V1\Document;
use Google\Cloud\Language\V1\Document\Type;


class PostController extends Controller
{
    protected $loveRepository;

    public function __construct(LoveRepository $loveRepository)
    {
        $this->loveRepository = $loveRepository;
    }

 // 新規投稿画面
    public function create()
    {
        $posts = Post::get();

        return view('Member.post_new',[
            'posts'=> $posts
        ]);
    }
// 新規投稿処理
    public function store(Request $request)
    {
        // バリデーション
        $validator = Validator::make($request->all(), [
            'title' => 'required|max:30',
            'content' => 'required|max:5000',
            'images.*' => 'nullable|image|max:2048' // 2MB = 2048KB
        ]);
        

        // バリデーションエラー
        if ($validator->fails()) {
            return redirect()
                    ->back()
                    ->withInput()
                    ->withErrors($validator);
        }

        // 自然言語処理（API）導入
        $client = new LanguageServiceClient(['keyFile' => '/var/www/loveput/sunny-shadow.json']);
        // APIに読み込ませるドキュメントの作成
        $document = new Document();
        $document->setContent($request->title . ' ' . $request->content);
        $document->setType(Type::PLAIN_TEXT);
        // 感情分析の実行
        $response = $client->analyzeSentiment($document);
        $sentiment = $response->getDocumentSentiment();
        $score = $sentiment->getScore();
        // スコアを数値として表示する。感情スコアと命名。
        $summary = $score;

        // 手順
        $posts = new Post;
        $posts->title = $request->title;
        $posts->content = $request->content;
        $posts->user_id = Auth::id();
        // 画像保存する場合
        if ($request->hasFile('images')) {
            if (count($request->file('images')) >= 5) {
                return redirect()
                    ->route('post')
                    ->with('false','投稿できる画像は4枚までです。');
            }
            $imagePaths = [];
            foreach($request->file('images') as $image) {
                $path = $image->store('public/images');
                $imagePaths[] = str_replace('public/', '', $path);
            }
            $posts->image_path = json_encode($imagePaths);
        }
        $posts->summary = $summary;

        $posts->save();

        // 投稿成功リダイレクト先
        return redirect()
            ->route('posts.index')
            ->with('success', '投稿完了しました！あなたの好きが伝わりますように！');
    }

// 投稿一覧画面
    public function index(Request $request)
    {
        $keyword = $request->input('keyword');
        $sort = $request->input('sort');

        $query = Post::query();
        // empty関数:意図しない値の混入を防ぐ
        if (!empty($keyword)) {
            $query->where(function ($q) use ($keyword) {
                $q->where('title', 'LIKE', "%{$keyword}%")
                    ->orWhere('content', 'LIKE', "%{$keyword}%");
            });
        }
        // ソート機能（感情スコアで振り分けられる）
        if ($sort == 'positive') {
            $query->where('summary', '>', 0)->orderBy('created_at', 'desc')->orderBy('summary');
        } elseif ($sort == 'negative') {
            $query->where('summary', '<=', 0)->orderBy('created_at', 'desc')->orderBy('summary');
        } else {
            $query->orderBy('created_at', 'desc');
        }

        $posts = $query->orderBy('created_at', 'desc')->paginate(12);
        return view('Member.post_index', ['posts' => $posts, 'keyword' => $keyword, 'sort' => $sort]);
    }




// 投稿詳細画面
    public function show($id)
    {
        $post = Post::findOrFail($id);
        $loveCount = $this->loveRepository->getLoveCount($id);

        return view('Member.post_show', compact('post', 'loveCount'));
    }

// 投稿編集機能
    public function edit($id)
    {

        $post = Post::find($id);
        // 他者の介入を防ぐ
        if ($post->user_id !== Auth::id()) {
            abort(403, 'Unathorized action.');
        }

        return view('Member.post_edit', [
            'post' => $post
        ]);
    }

    // 投稿更新機能
    public function update(Request $request, $id)
    {
        // バリデーション
        $validator = Validator::make($request->all(), [
            'title' => 'required|max:30',
            'content' => 'required|max:5000',
            'images.*' => 'image|mimes:jpeg,png,jpg,gif|max:2048' // 2MB = 2048KB
        ]);
        

        // バリデーションエラーの遷移先
        if ($validator->fails()) {
            return redirect()
                ->back()
                ->withInput()
                ->withErrors($validator);
        }

        // 更新処理
        $post = Post::findOrFail($id);
        $post->title = $request->title;
        $post->content = $request->content;

        // 画像の保存とパスの更新
        $imagePaths = [];
        if ($request->hasFile('images')) {
            if (count($request->file('images')) >= 5) {
                return redirect()
                    ->route('posts.edit', $post->id)
                    ->with('false','投稿できる画像は4枚までです。');
            }

            foreach ($request->file('images') as $image) {
                $path = $image->store('public/images');
                $imagePaths[] = str_replace('public/', '', $path);
            }
            $post->image_path = json_encode($imagePaths);
    }

    $post->save();

        // 更新成功リダイレクト先
        return redirect()
            ->route('posts.show', $post->id)
            ->with('success', '投稿を更新しました！');
    }


    // 投稿削除機能
    public function destroy(Request $request, $id)
    {
        // 削除処理
        $post = Post::findOrFail($id);
        $post->delete();

        if ($post->user_id !== Auth::id()) {
            abort(403, 'Unauthorized action.');
        }

        // 削除成功リダイレクト先
        return redirect()->route('posts.index')->with('success', '投稿削除完了しました！');
    }
}


// てすと