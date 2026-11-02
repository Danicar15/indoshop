<article class="product-card">
    <a class="product-image" href="{{ route('products.show', $product->slug) }}">
        @if($product->image_url)
            <img src="{{ $product->image_url }}" alt="{{ $product->name }}" loading="lazy">
        @else
            <div class="image-placeholder"><span>INDO</span><small>PRODUCT</small></div>
        @endif
        @if($product->stock < 1)
            <span class="stock-badge">ناموجود</span>
        @endif
    </a>
    <div class="product-info">
        <span class="product-category">{{ $product->category?->name }}</span>
        <h3><a href="{{ route('products.show', $product->slug) }}">{{ $product->name }}</a></h3>
        <div class="product-bottom">
            <strong>{{ number_format((int) $product->price) }} <small>تومان</small></strong>
            <a class="arrow-link" href="{{ route('products.show', $product->slug) }}" aria-label="مشاهده محصول">←</a>
        </div>
    </div>
</article>
