<?php

namespace App\Http\Controllers\Member;

use Illuminate\Http\Request;
use App\Models\Member\Post;
use App\Models\Member\User;
use App\Http\Controllers\Controller;
use Validator;
use Illuminate\Support\Facades\Auth;

class PostsController extends Controller
{
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
            'content' => 'required|max: 5000',
            'image' => 'nullable|image|max:2048' // 2MB = 2048KB
        ]);

        // バリデーションエラー
        if ($validator->fails()) {
            return redirect()
                    ->back()
                    ->withInput()
                    ->withErrors($validator);
        }
        // 手順
        $posts = new Post;
        $posts->title = $request->title;
        $posts->content = $request->content;
        $posts->user_id = Auth::id();
        // 画像保存する場合
        if ($request->hasFile('images')) {
            $imagePaths = [];
            foreach($request->file('images') as $image) {
                $path = $image->store('public/images');
                $imagePaths[] = str_replace('public/', '', $path);
            }
            $posts->image_path = json_encode($imagePaths);
        }

        $posts->save();

        // 投稿成功リダイレクト先
        return redirect()
            ->route('posts.index')
            ->with('success', '投稿完了しました！あなたの好きが伝わりますように！');
    }

// 投稿一覧画面
    public function index()
    {
        $posts = Post::orderBy('created_at', 'desc')->get();

        return view('Member.post_index', compact('posts'));
    }

// 投稿詳細画面
    public function show($id)
    {
        $post = Post::findOrFail($id);

        return view('Member.post_show', compact('post'));
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
