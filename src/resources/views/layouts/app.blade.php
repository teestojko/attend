<!DOCTYPE html>
<html lang="ja">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="csrf-token" content="{{ csrf_token() }}">
            <title>
                Atte
            </title>
        <link rel="stylesheet" href="{{ asset('css/sanitize.css') }}">
        <link rel="stylesheet" href="{{ asset('css/common.css') }}">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
        <link rel="stylesheet" href="{{ mix('css/Sidebar.css') }}">
        @yield('css')
    </head>
    <body class="body">
        <header class="header">
            <div class="header__inner">
                <div class="header-utilities">
                    <p class="header__logo">
                        Atte
                    </p>
                </div>
            </div>
        </header>

        <div id="sidebar"></div>

        <main>
            @yield('content')
        </main>
        <footer class=footer>
            <small class=footer_item>
                Atte,inc.
            </small>
        </footer>
    </body>

    <div id="app"></div>

    <script src="{{ mix('js/app.js') }}"></script>

</html>
