<!DOCTYPE html>
<html lang="fa" dir="rtl">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Indo Shop؛ خرید آنلاین کالای دیجیتال">
    <title>@yield('title', 'Indo Shop') | فروشگاه اینترنتی ایندو</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Vazirmatn:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link rel="stylesheet" href="{{ asset('css/auth.css') }}">
</head>
<body>
<header class="site-header">
    <div class="container nav-wrap">
        <a class="brand" href="{{ route('home') }}"><span class="brand-mark">i</span> Indo<span>Shop</span></a>
        <nav class="main-nav">
            <a href="{{ route('home') }}">خانه</a>
            <a href="{{ route('products.index') }}">همه محصولات</a>
        </nav>
        <form class="nav-search" action="{{ route('products.index') }}" method="GET">
            <input type="search" name="q" value="{{ request('q') }}" placeholder="دنبال چی می‌گردی؟">
            <button aria-label="جستجو">⌕</button>
        </form>
        <a class="login-link" href="{{ route('products.index') }}">مشاهده فروشگاه</a>
    </div>
</header>

<main>
    @yield('content')
</main>

<footer class="site-footer">
    <div class="container footer-inner">
        <a class="brand brand-light" href="{{ route('home') }}">Indo<span>Shop</span></a>
        <p>تجربه‌ای ساده و مطمئن برای خرید کالای دیجیتال</p>
        <small>© {{ now()->year }} Indo Shop</small>
    </div>
</footer>
</body>
</html>
