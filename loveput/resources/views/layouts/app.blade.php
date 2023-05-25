<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="{{ asset('js/app.js') }}" defer></script>
    <script src="{{ asset('js/hamburger.js') }}"></script>
    <script src="{{ asset('js/ajaxlove.js') }}"></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <!-- CSS別窓 -->
    <link rel="stylesheet" href="{{ asset('css/hamburger.css') }}">
    <!-- フォントオーサム -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <style>
        /* ページネーションレイアウト */
        .pagination li a {
        color: white;
        background-color: pink;
        }

        .pagination .page-item.active .page-link {
            background-color: #22001c;
            color: #ffd400;
        }

        .pagination li a:hover {
            background-color: white;
            color: pink;
        }

        header {
            z-index: 1;
            background-color: #64e3dd80;
            width: 100%;
            height: 60px;
            position: fixed;
        }

        header ul {
            list-style: none;
            padding-top: 20px;
            font-size: 20px;
        }

        header li {
            display: inline-block;
        }

        header a {
            font-weight: bold;
            color: #c7005c;
            padding: 10px;
        }

        .main-content {
            
            padding-top: 95px;
        }
    </style>
    
</head>

<body class="main-body">
    <!-- ヘッダー -->
    <header>
        <ul>
            @if (Auth::check())
            <!-- トップページ -->
            <li>
                <a href="<?= route('home') ?>">Top</a>
            </li>
            <!-- マイページ -->
            <li>
                <a href="{{ route('user.show', ['id' => Auth::user()->id]) }}">マイルーム</a>
            </li>
            <!-- 新規投稿 -->
            <li>
                <a href="<?= route('post') ?>">新規投稿</a>
            </li>
            <!-- 新規投稿 -->
            <li>
                <a href="<?= route('posts.index') ?>">プレゼン一覧</a>
            </li>
            <!-- ログアウト -->
            <li>
                <a href="{{ route('logout') }}"
                    onclick="event.preventDefault();
                    document.getElementById('logout-form').submit();">
                    ログアウト
                    </a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST">
                    @csrf
                    </form>
            </li>
            @else
            <li>
            <a href="<?= route('register') ?>">新規会員登録</a>
            </li>
            <li>
                <a href="<?= route('login') ?>">ログイン</a>
            </li>
            @endif
        </ul>
    </header>
    <div id="app">
        <!-- ハンバーガーメニュー -->
        <div class="hamburger">
            <span></span>
            <span></span>
            <span></span>
        </div>
        <nav class="hamburger-menu">
        <ul>
            <!-- ログイン時 -->
            <?php if (Auth::check()) { ?>
            <li>
                <a href="<?= route('home') ?>">Top</a>
            </li>
            <li>
            <a href="{{ route('user.show', ['id' => Auth::user()->id]) }}">My Room</a>

            </li>
            <li>
                <a href="<?= route('post') ?>">Present</a>
            </li>
            <li>
                <a href="<?= route('posts.index') ?>">Index</a>
            </li>
            <li>
                <!-- GETをキャンセル(onclick="event.preventDefault();)してログアウト処理を実行する動作 -->
                <a href="{{ route('logout') }}"
                onclick="event.preventDefault();
                document.getElementById('logout-form').submit();">
                ログアウト
                </a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST">
                @csrf
                </form>
            </li>
            <!-- 非ログイン時 -->
            <?php } else { ?>
            <li>
            <a href="<?= route('register') ?>">新規会員登録</a>
            </li>
            <li>
                <a href="<?= route('login') ?>">ログイン</a>
            </li>
            <?php } ?>
        </ul>
        </nav>

        <main class="main-content">
            @yield('content')
        </main>
    </div>
</body>
</html>
