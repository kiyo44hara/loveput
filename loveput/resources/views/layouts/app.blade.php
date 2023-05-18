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

        /* ログイン画面、新規登録画面の案内（登録がお済でない方は…） */
        .auth-guide {
            text-align: right;
        }
    </style>
    
</head>

<body>
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


        <main class="py-4">
            @yield('content')
        </main>
    </div>
</body>
</html>
