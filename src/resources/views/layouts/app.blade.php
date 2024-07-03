<!DOCTYPE html>
<html lang="ja">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>
                Atte
            </title>
        <link rel="stylesheet" href="{{ asset('css/sanitize.css') }}">
        <link rel="stylesheet" href="{{ asset('css/common.css') }}">
        @yield('css')
    </head>
    <body class="body">
        <header class="header">
            <div class="header__inner">
                <div class="header-utilities">
                    <p class="header__logo">
                        Atte
                    </p>
                    <nav class="nav">
                        <ul class="header-nav">
                            @if (Auth::check())
                                <li class="header-nav__item">
                                    <a class="header-nav__link" href="/">
                                        ホーム
                                    </a>
                                </li>
                                <li class="header-nav__item">
                                    <a class="header-nav__link" href="/attendance">
                                        日付一覧
                                    </a>
                                </li>
                                <li class="header-nav__item">
                                    <a class="header-nav__link" href="{{ route('user.list', ['user' => Auth::id()]) }}">
                                        ユーザー一覧
                                    </a>
                                </li>
                                <li class="header-nav__item">
                                    <form class="form" action="/logout" method="post">
                                    @csrf
                                        <button class="header-nav__button">
                                            ログアウト
                                        </button>
                                    </form>
                                </li>
                            @endif
                        </ul>
                    </nav>
                </div>
            </div>
        </header>
        <main>
            @yield('content')
        </main>
        <footer class=footer>
            <small class=footer_item>
                Atte,inc.
            </small>
        </footer>
    </body>
</html>
