<!-- 投稿詳細 -->
@extends('layouts.app')
@section('content')
<body>
    <link rel="stylesheet" href="{{ asset('css/posts.css') }}">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <!-- フラッシュメッセージ -->
                <div class="panel-body">
                    @if (session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif
                </div>
                <div class="card">
                    <!-- タイトル -->
                    <h3 class="card-header">{{ $post->title }}</h3>
                    <!-- 画像 -->
                    @if($post->image_path)
                        @foreach(json_decode($post->image_path, true) as $imagePath)
                            <img src="{{ asset('storage/' . $imagePath) }}" alt="{{ $post->title }}" class="img-fluid">
                        @endforeach
                    @endif

                    <div class="card-body">
                        <!-- 内容 -->
                        <p class="card-text" style="white-space: pre-line;">{{ $post->content }}</p>
                    </div>

                
                    <div class="card-footer">
                        <!-- 編集アイコン（他人には見えない） -->
                        @if(Auth::user()->id == $post->user_id)
                            <a href="{{ route('posts.edit', ['id' => $post->id]) }}" class="btn btn-primary">編集</a>
                        @endif
                        </small>
                        <small>投稿者: {{ $post->user->name }}</small>
                        <!-- 投稿日 -->
                        <small>{{ $post->created_at->format('Y/m/d H:i') }}</small>
                        <small>感情スコア:{{ $post->summary }}</small>
                        <!-- 投稿経過時間 -->
                        <small class="float-right">{{ $post->created_at->diffForHumans() }}
                    </div>
                    <div>@include('Member.love_button', ['post' => $post])</div>
                </div>
                <a href="{{ route('posts.index') }}">戻る</a>
            </div>
        </div>
    </div>
</body>
@endsection
