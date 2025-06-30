@props(['product'])

<div class="modern-product-card">
    <div class="product-image-container">
        <a href="{{ route('site.product.detail', ['slug' => $product->slug]) }}">
            <img src="{{ asset('images/products/' . $product->image) }}" alt="{{ $product->name }}" class="product-image">
        </a>
        @if ($product->pricesale > 0 && $product->pricesale < $product->price)
            <div class="discount-badge">
                -{{ number_format((($product->price - $product->pricesale) / $product->price) * 100) }}%
            </div>
        @endif
    </div>
    
    <div class="product-info">
        <h3 class="product-title">
            <a href="{{ route('site.product.detail', ['slug' => $product->slug]) }}">{{ $product->name }}</a>
        </h3>
        
        @if($product->description)
            <p class="product-description">{{ Str::limit($product->description, 60) }}</p>
        @endif
        
        <div class="product-pricing">
            @if ($product->pricesale > 0 && $product->pricesale < $product->price)
                <div class="price-container">
                    <span class="current-price">{{ number_format($product->pricesale) }}₫</span>
                    <span class="original-price">{{ number_format($product->price) }}₫</span>
                </div>
            @else
                <div class="price-container">
                    <span class="current-price">{{ number_format($product->price) }}₫</span>
                </div>
            @endif
        </div>
        
        <button class="add-to-cart-btn" onclick="quickAddToCart({{ $product->id }})">
            <i class="fas fa-cart-plus me-2"></i>
            Thêm vào giỏ
        </button>
    </div>
</div>

<style>
.modern-product-card {
    background: #ffffff;
    border-radius: 20px;
    box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
    overflow: hidden;
    transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    position: relative;
    height: 100%;
    max-height: 420px;
    display: flex;
    flex-direction: column;
}

.modern-product-card:hover {
    transform: translateY(-8px);
    box-shadow: 0 12px 40px rgba(161, 140, 209, 0.15);
}

.product-image-container {
    position: relative;
    overflow: hidden;
    border-radius: 20px 20px 0 0;
    background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
}

.product-image {
    width: 100%;
    height: 220px;
    object-fit: cover;
    object-position: center;
    transition: transform 0.3s ease;
}

.modern-product-card:hover .product-image {
    transform: scale(1.05);
}

.discount-badge {
    position: absolute;
    top: 15px;
    left: 15px;
    background: linear-gradient(135deg, #ff6b6b, #ee5a52);
    color: white;
    padding: 8px 12px;
    border-radius: 20px;
    font-weight: 700;
    font-size: 0.85rem;
    box-shadow: 0 4px 12px rgba(238, 90, 82, 0.3);
    z-index: 2;
}

.product-info {
    padding: 20px 18px 18px;
    flex-grow: 1;
    display: flex;
    flex-direction: column;
}

.product-title {
    margin: 0 0 10px 0;
    font-size: 1.1rem;
    font-weight: 700;
    line-height: 1.3;
    min-height: 2.6rem; /* Reduced height */
    display: -webkit-box;
    -webkit-line-clamp: 2;
    -webkit-box-orient: vertical;
    overflow: hidden;
}

.product-title a {
    color: #2d3436;
    text-decoration: none;
    transition: color 0.3s ease;
}

.product-title a:hover {
    color: #a18cd1;
}

.product-description {
    color: #636e72;
    font-size: 0.9rem;
    line-height: 1.4;
    margin: 0 0 12px 0;
    min-height: 2.8rem; /* Reduced height */
    display: -webkit-box;
    -webkit-line-clamp: 2;
    -webkit-box-orient: vertical;
    overflow: hidden;
}

.product-pricing {
    margin-bottom: 15px;
}

.price-container {
    display: flex;
    align-items: center;
    gap: 10px;
    flex-wrap: wrap;
}

.current-price {
    font-size: 1.3rem;
    font-weight: 800;
    color: #00b894;
}

.original-price {
    font-size: 1rem;
    color: #b2bec3;
    text-decoration: line-through;
}

.add-to-cart-btn {
    background: linear-gradient(135deg, #a18cd1, #8b7cc6);
    color: white;
    border: none;
    padding: 12px 20px;
    border-radius: 25px;
    font-weight: 600;
    font-size: 0.95rem;
    cursor: pointer;
    transition: all 0.3s ease;
    width: 100%;
    margin-top: auto;
}

.add-to-cart-btn:hover {
    background: linear-gradient(135deg, #8b7cc6, #7b6eb8);
    transform: translateY(-2px);
    box-shadow: 0 6px 20px rgba(161, 140, 209, 0.3);
}

.add-to-cart-btn:active {
    transform: translateY(0);
}

/* Responsive adjustments */
@media (max-width: 768px) {
    .modern-product-card {
        min-height: 450px;
    }
    
    .product-image {
        height: 220px;
    }
    
    .product-info {
        padding: 20px 15px 15px;
    }
    
    .product-title {
        font-size: 1rem;
        min-height: 2.4rem;
    }
    
    .product-description {
        min-height: 2.7rem;
    }
    
    .current-price {
        font-size: 1.2rem;
    }
}

@media (max-width: 576px) {
    .modern-product-card {
        margin-bottom: 20px;
        min-height: 420px;
    }
    
    .product-image {
        height: 200px;
    }
    
    .product-title {
        min-height: 2.2rem;
    }
    
    .product-description {
        min-height: 2.5rem;
    }
}
</style>
