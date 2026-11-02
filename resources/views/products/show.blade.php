@extends('layouts.app')

@section('title', $product->name)

@section('content')
<section class="section container">
    <div class="breadcrumbs"><a href="{{ route('home') }}">خانه</a> / <a href="{{ route('products.index') }}">محصولات</a> / {{ $product->name }}</div>
    <div class="detail-grid">
        <div class="detail-image">
            @if($product->image_url)
                <img src="{{ $product->image_url }}" alt="{{ $product->name }}">
            @else
                <div class="image-placeholder detail-placeholder"><span>INDO</span><small>PRODUCT</small></div>
            @endif
        </div>
        <div class="detail-info">
            <span class="product-category">{{ $product->category?->name }}</span>
            <h1>{{ $product->name }}</h1>
            <p class="detail-description">{{ $product->description ?: 'برای این محصول هنوز توضیحاتی ثبت نشده است.' }}</p>
            <div class="detail-price">{{ number_format((int) $product->price) }} <small>تومان</small></div>
            <p class="availability {{ $product->stock > 0 ? 'available' : 'unavailable' }}">
                {{ $product->stock > 0 ? 'موجود در انبار' : 'در حال حاضر ناموجود' }}
                @if($product->stock > 0) · {{ $product->stock }} عدد @endif
            </p>
            <a class="button button-primary" href="{{ route('products.index') }}">بازگشت به فروشگاه <span>←</span></a>
        </div>
    </div>
</section>
@endsection
