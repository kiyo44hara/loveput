<!-- 投稿一覧 -->
@extends('layouts.app')
@section('content')
<body>
    <link rel="stylesheet" href="{{ asset('css/posts.css') }}">
    <div class="container">
        <div class="row">
            <div class="col-md-12 col-md-offset-2">
                <!-- フラッシュメッセージ -->
                <div class="panel-body">
                    @if (session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif
                </div>
                <!-- ビュー名 -->
                <div class="panel-heading">present index</div>
                <div class="panel panel-default">
                    <!-- 検索画面 -->
                    <div class="search-area">
                        <form action="{{ route('posts.index') }}" method="GET">
                            <input type="text" name="keyword" value="{{ $keyword }}">
                            <input type="submit" value="検索">
                        </form>
                    </div>
                    <!-- ソート機能 -->
                    <div class="sort-area">
                        <form action="{{ route('posts.index') }}" method="GET">
                            <select name="sort">
                                <option value="positive" @if ($sort == 'positive') selected @endif>楽しい投稿を探す</option>
                                <option value="negative" @if ($sort == 'negative') selected @endif>哀しい投稿を探す</option>
                            </select>
                            <input type="submit" value="ソート">
                        </form>
                    </div>


                    <div class="panel-body">
                        <div class="row">
                            @foreach ($posts as $post)
                            <!-- カードの表示サイズ、数制限。4*3に調整 -->
                            <div class="col-md-4 mb-4">
                                <div class="card h-100">
                                    <div class="card-header">
                                        <!-- タイトルの文字数が超えた場合は、「…」と表示 -->
                                        <a href="{{ route('posts.show', $post->id) }}">{{ mb_strimwidth($post->title, 0, 30, "...") }}</a>
                                    </div>

                                    <div class="card-body">
                                    @if($post->image_path)
                                    <a href="{{ route('posts.show', $post->id) }}" >
                                        <img src="{{ asset('storage/' . json_decode($post->image_path, true)[0]) }}" alt="{{ $post->title }}" class="card-img-top">
                                    </a>
                                    @endif
                                        @if (mb_strlen($post->content) > 100)
                                            <div class="card-text">{{ mb_strimwidth($post->content, 0, 100, "...") }}</div>
                                            <a href="{{ route('posts.show', $post->id) }}" >もっと見る</a>
                                        @else
                                            <div class="card-text">{{ $post->content }}</div>
                                        @endif
                                    </div>
                                    <div class="card-footer">
                                        <small><a href="{{ route('user.show', $post->user->id) }}" >投稿者: {{ $post->user->name }}</a></small>
                                        <small>{{ $post->created_at->format('Y/m/d H:i') }}</small>
                                        <small>感情スコア:{{ $post->summary }}</small>
                                    </div>


                                </div>
                            </div>
                            @endforeach
                        </div>
                        <!-- ページネーション -->
                        {!! $posts->appends(request()->query())->render('pagination::bootstrap-4') !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
@endsection
