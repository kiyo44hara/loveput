@extends('layouts.app')
@section('content')
<body>
    <link rel="stylesheet" href="{{ asset('css/my-room.css') }}">
    <div class="container">
        <div class="row">
            <div class="col-md-4">
                <h2>{{ $user->name }}さんの </h2>
                <h2>My Room</h2>
                <hr>
                <div class="form-group">
                    <div>【メールアドレス】</div>
                    <div class="form-control-static">{{ $user->email }}</div>
                </div>
            </div>
            <div class="col-md-8">
                <h2>プレゼン一覧</h2>
                <hr>
                @if(count($posts) > 0)
                    <div class="row row-cols-1 row-cols-md-3 g-4">
                        @foreach($posts as $post)
                            <div class="col mb-3">
                                <div class="card h-100">
                                    @if($post->image_path)
                                        <img src="{{ asset('storage/' . json_decode($post->image_path, true)[0]) }}" alt="{{ $post->title }}" class="card-img-top">
                                    @else
                                        <div style="height: 200px; background-color: #eeeeee;">No image</div>
                                    @endif
                                    <div class="card-body">
                                        <h5 class="card-title">{{ $post->title }}</h5>
                                        <p class="card-text">{{ $post->description }}</p>
                                        <a href="{{ route('posts.show', $post->id) }}">詳細</a>
                                        @if(Auth::user()->id == $post->user_id)
                                            <a href="{{ route('posts.edit', ['id' => $post->id]) }}">編集</a>
                                        @endif
                                        <small>{{ $post->created_at->format('Y/m/d H:i') }}</small>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    <nav class="mt-4">
                        <ul class="pagination justify-content-center">
                            {{ $posts->links() }}
                        </ul>
                    </nav>
                @else
                    <p>{{ $user->name }}さんはまだ作品を投稿していません。</p>
                @endif
            </div>
        </div>
    </div>
</body>
@endsection
