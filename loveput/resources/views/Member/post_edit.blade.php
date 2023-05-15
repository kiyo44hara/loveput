@extends('layouts.app')
@section('content')
<body>
    <link rel="stylesheet" href="{{ asset('css/posts.css') }}">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">Present Edit</div>

                        <div class="card-body">
                            @if (session('success'))
                                <div class="alert alert-success">
                                    {{ session('success') }}
                                </div>
                            @endif

                            <form method="POST" action="{{ route('posts.update', $post->id) }}" enctype="multipart/form-data">
                                @csrf
                                @method('PUT')

                                <div class="form-group">
                                    <label for="image">Images（ドラッグで選択すると、複数の画像投稿ができます。）</label></br>
                                    <input id="image1" type="file" class="{{ $errors->has('image') ? ' is-invalid' : '' }}" name="image[]" multiple>
                                    <input id="image2" type="file" class="{{ $errors->has('image') ? ' is-invalid' : '' }}" name="image[]" multiple>
                                    @if ($errors->has('image'))
                                        <span role="alert">
                                            <strong>{{ $errors->first('image') }}</strong>
                                        </span>
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
                                <form method="POST" action="{{ route('posts.destroy', ['id' => $post->id]) }}">
                                    {{ csrf_field() }}
                                    {{ method_field('DELETE') }}
                                    <!-- 削除ボタン -->
                                    <button type="submit" class="btn btn-danger" onclick="return confirm('本当に削除しますか？')">削除する</button>
                                </form>

                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
</body>
@endsection
