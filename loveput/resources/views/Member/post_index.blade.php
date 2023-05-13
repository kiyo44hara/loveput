@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">投稿一覧</div>

                    <div class="panel-body">
                        @foreach ($posts as $post)
                            <div class="media">
                                <div class="media-body">
                                    <h4 class="media-heading"><a href="{{ route('posts.show', $post->id) }}">{{ $post->title }}</a></h4>
                                    <p>{{ $post->content }}</p>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection