@extends('layouts.app')

@section('content')
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
                        <p class="card-text">{{ $post->content }}</p>
                    </div>
                
                    <div class="card-footer">
                        <small class="text-muted">{{ $post->created_at->diffForHumans() }}
                        <a href="{{ route('posts.edit', ['id' => $post->id]) }}" class="btn btn-primary">編集</a>
                        </small>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
