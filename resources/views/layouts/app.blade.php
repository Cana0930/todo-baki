<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- CSRF Token -->
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>藤堂刃物</title>
  <!-- Fonts -->
 
  <!-- Scripts -->
  @vite(['resources/sass/app.scss', 'resources/js/app.js'])
  {{-- FontAwesome --}}
  <link href="https://use.fontawesome.com/releases/v5.6.1/css/all.css" rel="stylesheet">
  <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>

<body>
<header>
    <div class="bg-light border-bottom mb-3">
        <nav class="navbar navbar-expand-lg navbar-light">
            <div class="container-fluid">
                <!-- ロゴ -->
                {{-- <a class="navbar-brand" href="#">
                  <img class="logo" src="{{ asset('img/logo.png') }}" alt="Logo">
                </a> --}}
                <a class="navbar-brand" href="/">
                    <img class="logo" src="{{ asset('img/logo.png') }}" alt="Logo">
                </a>
              
                <!-- タイトル -->
                <div class="apptitle">
                  <h3>バッキバキ</h3>
                </div>
              
                <!-- ハンバーガーメニュー -->
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarContent" aria-controls="navbarContent" aria-expanded="false" aria-label="Toggle navigation">
                  <span class="navbar-toggler-icon"></span>
                </button>
              </div>
            <!-- メニュー項目 -->
            <div class="collapse navbar-collapse" id="navbarContent">
              <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                @guest
                  <!-- ゲスト用リンク -->
                  <li class="nav-item">
                    <a class="nav-link dropdown-item" href="{{ route('login') }}">ログイン</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link dropdown-item" href="{{ route('register') }}">登録</a>
                  </li>
                @else
                  <!-- 認証済みユーザー用ドロップダウン -->
                  {{-- <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="userMenu" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        {{ Auth::user()->name }}
                    </a>
                
                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="userMenu"> --}}
                        <!-- ホームに戻るリンク -->
                        <li>
                            <a class="dropdown-item" href="{{ url('home') }}">マイページ</a>
                        </li>
                        <!-- ログアウトリンク -->
                        <li>
                            <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                                document.getElementById('logout-form').submit();">ログアウト</a>
                        </li>
                    </ul>
                
                    <!-- ログアウトフォーム -->
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                        @csrf
                    </form>
                </li>
                @endguest
              </ul>
            </div>
          </div>
        </nav>
    </div>    
</header>
     @yield('content')
<footer>
    Copyright &copy; 藤堂刃物 Inc.
  </footer>
</body>
</html>






