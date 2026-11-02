@extends('layouts.app')

@section('title', 'خانه')

@section('content')
<section class="hero">
    <div class="container hero-grid">
        <div class="hero-copy">
            <span class="eyebrow"><span></span> انتخاب هوشمندانه، خرید مطمئن</span>
            <h1>تکنولوژی،<br><em>یک قدم</em> نزدیک‌تر.</h1>
            <p>از ابزارهای روزمره تا جدیدترین گجت‌ها؛ چیزی که دنبالش هستی همین‌جاست.</p>
            <a class="button button-primary" href="{{ route('products.index') }}">شروع خرید <span>←</span></a>
            <div class="hero-note"><b>●</b> تجربه خرید ساده و سریع</div>
        </div>
        <div class="hero-art">
            <div class="orbit orbit-one"></div><div class="orbit orbit-two"></div>
            <div class="hero-disc"><span>INDO<br><b>TECH</b></span></div>
            <div class="floating-chip chip-one">AUDIO</div>
            <div class="floating-chip chip-two">SMART LIFE</div>
            <div class="hero-caption">FIND YOUR NEXT<br><strong>FAVORITE</strong></div>
        </div>
    </div>
</section>

<section class="section container">
    <div class="section-heading">
        <div><span class="eyebrow">دسته‌بندی‌ها</span><h2>چی لازم داری؟</h2></div>
        <a class="text-link" href="{{ route('products.index') }}">همه محصولات <span>←</span></a>
    </div>
    <div class="category-grid">
        @forelse($categories as $category)
            <a class="category-card" href="{{ route('products.index', ['category' => $category->slug]) }}">
                <span class="category-symbol">{{ mb_substr($category->name, 0, 1) }}</span>
                <strong>{{ $category->name }}</strong>
                <small>{{ $category->products_count }} محصول</small>
                <span class="category-arrow">↙</span>
            </a>
        @empty
            <p class="empty-state">هنوز دسته‌بندی‌ای ثبت نشده است.</p>
        @endforelse
    </div>
</section>

<section class="section products-section">
    <div class="container">
        <div class="section-heading">
            <div><span class="eyebrow">تازه‌های فروشگاه</span><h2>محصولات منتخب</h2></div>
            <a class="text-link" href="{{ route('products.index') }}">مشاهده همه <span>←</span></a>
        </div>
        <div class="product-grid">
            @forelse($products as $product)
                @include('partials.product-card', ['product' => $product])
            @empty
                <p class="empty-state">هنوز محصولی ثبت نشده است. به‌زودی محصولات جدید اضافه می‌شوند.</p>
            @endforelse
        </div>
    </div>
</section>
@endsection
