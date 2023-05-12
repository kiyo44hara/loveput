<!-- 新規投稿画面 -->
@extends('layouts.app')
@section('content')
<div>Love present</div>
<!-- バリデーションエラー -->
@if (count($errors) > 0)
    <!-- フォームエラーリスト -->
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
    <!-- 投稿フォーム -->
        <form action="{{ url('posts') }}" method="POST" class="form-hrizontal">
            {{ csrf_field() }}
            <!-- 投稿タイトル -->
            <div>Title</div>
                <div>
                    <input type="text" name="title" class="form-control">
                </div>
                <!-- 投稿内容 -->
            <div>Present</div>
                <div>
                    <input type="text_area" name="content" class="form-control">
                </div>
            <!-- 投稿ボタン -->
            <div class="form-group">
                <button type="submit" class="btn btn-primary">Save</button>
            </div>
        </form>
@endsection