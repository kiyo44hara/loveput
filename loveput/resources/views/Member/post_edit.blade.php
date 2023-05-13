@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Presemt Edit</div>

                    <div class="panel-body">
                        <!-- バリデーションエラー -->
                        @if (count($errors) > 0)
                            <div class="alert alert-danger">
                                <div>入力内容に誤りがあります。</div>
                                <div>
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                        @endif
                        <!-- 編集処理 -->
                        <form class="form-horizontal" role="form" method="POST" action="{{ route('posts.update', $post->id) }}">
                            {{ csrf_field() }}
                            {{ method_field('PUT') }}

                                <!-- タイトル -->
                                <label for="title" class="col-md-4 control-label">Title</label>

                                <div class="col-md-6">
                                    <input id="title" type="text" class="form-control" name="title" value="{{ old('title', $post->title) }}" required autofocus>
                                </div>
                                <!-- 内容 -->
                                <label for="content" class="col-md-4 control-label">Content</label>

                                <div class="col-md-6">
                                    <textarea id="content" class="form-control" name="content" required>{{ old('content', $post->content) }}</textarea>
                                </div>
                                <!-- 更新ボタン -->
                            <div class="form-group">
                                <div class="col-md-6 col-md-offset-4">
                                    <button type="submit" class="btn btn-primary">更新</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
