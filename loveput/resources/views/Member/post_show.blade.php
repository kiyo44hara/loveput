<!-- 投稿詳細 -->
@extends('layouts.app')
@section('content')
<body>
    <link rel="stylesheet" href="{{ asset('css/posts.css') }}">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <h3 class="card-header">{{ $post->title }}</h3>
                    @if($post->image_path)
                        @foreach(json_decode($post->image_path, true) as $imagePath)
                            <img src="{{ asset('storage/' . $imagePath) }}" alt="{{ $post->title }}" class="img-fluid">
                        @endforeach
                    @endif

                    <div class="card-body">
                        <p class="card-text" style="white-space: pre-line;">{{ $post->content }}</p>
                    </div>

                
                    <div class="card-footer">
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
                </div>
            </div>
        </div>
    </div>
</body>
@endsection
