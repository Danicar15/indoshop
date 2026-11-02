@extends('layouts.app')

@section('title', 'محصولات')

@section('content')
<section class="page-banner">
    <div class="container"><span class="eyebrow">کالکشن ایندو</span><h1>همه محصولات</h1><p>محصول موردنظرت رو پیدا کن.</p></div>
</section>
<section class="section container">
    <div class="catalog-toolbar">
        <div class="filter-list">
            <a class="{{ !request('category') ? 'active' : '' }}" href="{{ route('products.index', request()->except('category', 'page')) }}">همه</a>
            @foreach($categories as $category)
                <a class="{{ request('category') === $category->slug ? 'active' : '' }}" href="{{ route('products.index', array_merge(request()->except('page'), ['category' => $category->slug])) }}">{{ $category->name }}</a>
            @endforeach
        </div>
        <span class="result-count">{{ $products->total() }} محصول</span>
    </div>
    <div class="product-grid">
        @forelse($products as $product)
            @include('partials.product-card', ['product' => $product])
        @empty
            <p class="empty-state">محصولی با این مشخصات پیدا نشد.</p>
        @endforelse
    </div>
    <div class="pagination-wrap">{{ $products->links() }}</div>
</section>
@endsection
