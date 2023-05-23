<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Atte</title>
    <link rel="stylesheet" href="{{ asset('css/sanitize.css') }}">
    <link rel="stylesheet" href="{{ asset('css/common.css') }}">
    @yield('css')
</head>
<body>
    <header class="header">
        <div class="header__inner">
            <div class="header-utilities">
            <a class="header__logo" href="/">Atte</a>
            @yield('header__nav')
            </div>
        </div>
    </header>
    @yield('content')
</body>
<footer class="footer">
    <span class=footer__text>Atte,Inc.</span>
</footer>
</html>