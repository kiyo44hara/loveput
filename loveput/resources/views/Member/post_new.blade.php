@extends('layouts.app')
@section('content')
<body>
    <link rel="stylesheet" href="{{ asset('css/posts.css') }}">
        <div class="container">
            <div class="row">
                <div class="col-md-12 col-md-offset-2">
                    <div class="panel-heading">Present Time</div>
                    <div>感動した本、映画、愛する推しの事を、貴方の言葉で伝えて下さい</div>
                        <div class="panel-panel-default">
                            <!-- フラッシュメッセージ -->
                            <div class="panel-body">
                                @if (session('success'))
                                    <div class="alert alert-success">
                                        {{ session('success') }}
                                    </div>
                                @endif
                                <form method="POST" action="/posts" enctype="multipart/form-data">
                                    {{ csrf_field() }}
                                    <!-- 画像 -->
                                    <div class="form-group{{ $errors->has('image') ? ' has-error' : '' }}">
                                        <input id="image1" type="file" name="images[]" multiple>
                                        <input id="image2" type="file" name="images[]" multiple>
                                        @if ($errors->has('image'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('image') }}</strong>
                                            </span>
                                        @endif
                                    </div>

                                    <!-- タイトル -->
                                    <div class="form-group{{ $errors->has('title') ? ' has-error' : '' }}">
                                        <label for="title" class="col-md-12 control-label">Title</label>

                                        <div class="col-md-12">
                                            <input id="title" type="text" class="form-control" name="title" value="{{ old('title') }}" required autofocus>
                                    <!-- タイトルエラーメッセージ -->
                                            @if ($errors->has('title'))
                                                <span class="help-block">
                                                    <strong>{{ $errors->first('title') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div>
                                    
                                    <!-- 内容 -->
                                    <div class="form-group{{ $errors->has('content') ? ' has-error' : '' }}">
                                        <label for="content" class="col-md-4 control-label">Content</label>

                                        <div class="col-md-12">
                                            <textarea id="content" class="form-control" name="content" required>{{ old('content') }}</textarea>
                                    <!-- 内容エラーメッセージ -->
                                            @if ($errors->has('content'))
                                                <span class="help-block">
                                                    <strong>{{ $errors->first('content') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div>
                                    <!-- 投稿ボタン -->
                                    <div class="form-group">
                                        <div class="col-md-6 col-md-offset-4">
                                            <button type="submit" class="btn btn-primary">
                                                投稿する
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </body>
    @endsection

