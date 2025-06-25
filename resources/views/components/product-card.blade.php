@props(['product'])

<div class="card product-card shadow-sm border-0">
    <a href="{{ route('site.product.detail', ['slug' => $product->slug]) }}">
        <img src="{{ asset('images/products/' . $product->image) }}" alt="{{ $product->name }}"
            class="card-img-top product-image">
    </a>
    <div class="card-body bg-light d-flex flex-column">
        <h5 class="product-name mb-1">
            <a href="{{ route('site.product.detail', ['slug' => $product->slug]) }}">{{ $product->name }}</a>
        </h5>
        <p class="text-muted mb-1" style="font-size: 0.95rem;">{{ $product->title }}</p>

        <div class="row align-items-center mb-1">
            @if ($product->pricesale > 0 && $product->pricesale < $product->price)
                <div class="col-8">
                    <span class="text-success fw-semibold" style="font-size: 1.05rem;">{{ number_format($product->pricesale) }}₫</span>
                    <del class="text-muted ms-1" style="font-size: 0.95rem;">{{ number_format($product->price) }}₫</del>
                </div>
                <div class="col-4 text-end">
                    <span class="badge bg-danger rounded-pill" style="font-size: 0.9rem;">
                        -{{ number_format((($product->price - $product->pricesale) / $product->price) * 100) }}%
                    </span>
                </div>
            @else
                <div class="col-12">
                    <span class="text-success fw-semibold" style="font-size: 1.05rem;">{{ number_format($product->price) }}₫</span>
                </div>
            @endif
        </div>
    </div>
</div>

<style>
    .product-card {
        border-radius: 18px;
        overflow: hidden;
        transition: all 0.25s ease-in-out;
        height: 100%;
    }

    .product-card:hover {
        box-shadow: 0 12px 28px rgba(0, 0, 0, 0.08), 0 4px 12px rgba(161, 140, 209, 0.2);
        transform: translateY(-4px);
    }

    .product-image {
        width: 100%;
        height: 200px;
        object-fit: cover;
        border-radius: 18px 18px 0 0;
    }

    .card-body {
        padding: 1.1rem 1.2rem;
        display: flex;
        flex-direction: column;
        justify-content: space-between;
    }

    .product-name a {
        color: #6c5ce7;
        font-weight: 700;
        font-size: 1.1rem;
        text-decoration: none;
        transition: color 0.2s;
    }

    .product-name a:hover {
        color: #341f97;
    }

    .badge.bg-danger {
        background-color: #e74c3c !important;
    }

    a {
        text-decoration: none !important;
    }
</style>
