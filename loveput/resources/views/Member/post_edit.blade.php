@extends('layouts.app')
@section('content')
<body>
    <link rel="stylesheet" href="{{ asset('css/posts.css') }}">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">Present Edit</div>
                        <!-- エラーメッセージ(投稿画像数制限) -->
                        <div class="card-body">
                            @if (session('false'))
                                <div class="alert alert-success">
                                    {{ session('false') }}
                                </div>
                            @endif

                            <form method="POST" action="{{ route('posts.update', $post->id) }}" enctype="multipart/form-data">
                                @csrf
                                @method('PUT')

                                <!-- 画像 -->
                                <label for="title" class="col-md-12 control-label">【Images（ドラッグで選択すると、複数の画像投稿ができます。）】</label>
                                    <div class="form-group{{ $errors->has('images') ? ' has-error' : '' }}">
                                        <input id="image1" type="file" name="images[]" multiple>
                                        <input id="image2" type="file" name="images[]" multiple>
                                        @if ($errors->has('images.*'))
                                            <div class="help-block">
                                                @foreach ($errors->get('images.*') as $error)
                                                    <strong>{{ $error[0] }}</strong>
                                                @endforeach
                                            </div>
                                        @endif
                                    </div>

                                <div class="form-group">
                                    <label for="title">Title</label>
                                    <input id="title" type="text" class="form-control{{ $errors->has('title') ? ' is-invalid' : '' }}" name="title" value="{{ old('title') ?? $post->title }}" required autofocus>

                                    @if ($errors->has('title'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('title') }}</strong>
                                        </span>
                                    @endif
                                </div>

                                <div class="form-group">
                                    <label for="content">Content</label>
                                    <textarea id="content" class="form-control{{ $errors->has('content') ? ' is-invalid' : '' }}" name="content" required>{{ old('content') ?? $post->content }}</textarea>

                                    @if ($errors->has('content'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('content') }}</strong>
                                        </span>
                                    @endif
                                </div>

                                <div class="form-group">
                                    <button type="submit" class="btn btn-primary">Update</button>
                                </div>
                            </form>
                            <form method="POST" action="{{ route('posts.destroy', ['id' => $post->id]) }}">
                                    {{ csrf_field() }}
                                    {{ method_field('DELETE') }}
                                    <!-- 削除ボタン -->
                                    <button type="submit" class="btn btn-danger" onclick="return confirm('本当に削除しますか？')">Dlete</button>
                            </form>
                            <a href="{{ route('posts.show', $post->id) }}">戻る</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
</body>
@endsection
