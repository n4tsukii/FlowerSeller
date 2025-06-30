<div class="new-products-section">
    <div class="container">
        <div class="section-header">
            <div class="section-title-wrapper">
                <i class="fas fa-seedling section-icon"></i>
                <h2 class="section-title">Sản phẩm mới</h2>
                <p class="section-subtitle">Khám phá những loài hoa tươi mới nhất được cập nhật hàng ngày</p>
            </div>
        </div>
        
        <div class="products-carousel">
            <div class="row">
                @foreach ($listproduct as $product)
                    <div class="col-lg-3 col-md-6 mb-4">
                        <x-product-card :product="$product" />
                    </div>
                @endforeach
            </div>
        </div>
        
        <div class="section-footer">
            <a href="{{ route('site.product') }}" class="view-all-products-btn">
                <span>Xem tất cả sản phẩm</span>
                <i class="fas fa-arrow-right"></i>
            </a>
        </div>
    </div>
</div>

<style>
.new-products-section {
    background: linear-gradient(135deg, #ffffff 0%, #f8f9fa 100%);
    padding: 80px 0;
    margin: 60px 0;
    position: relative;
    overflow: hidden;
}

.new-products-section::before {
    content: '';
    position: absolute;
    top: -50%;
    right: -50%;
    width: 200%;
    height: 200%;
    background: radial-gradient(circle, rgba(161, 140, 209, 0.03) 0%, transparent 70%);
    animation: floatReverse 25s ease-in-out infinite;
}

@keyframes floatReverse {
    0%, 100% { transform: translateX(0px) rotate(0deg); }
    50% { transform: translateX(20px) rotate(-180deg); }
}

.new-products-section .section-header {
    text-align: center;
    margin-bottom: 60px;
    position: relative;
    z-index: 1;
}

.new-products-section .section-title-wrapper {
    display: inline-block;
    position: relative;
}

.new-products-section .section-icon {
    font-size: 3rem;
    color: #00b894;
    margin-bottom: 20px;
    display: block;
    animation: grow 3s ease-in-out infinite;
}

@keyframes grow {
    0%, 100% { transform: scale(1); }
    50% { transform: scale(1.1); }
}

.new-products-section .section-title {
    font-size: 2.5rem;
    font-weight: 800;
    color: #2d3436;
    margin: 0 0 15px 0;
    letter-spacing: -0.5px;
    position: relative;
}

.new-products-section .section-title::after {
    content: '';
    position: absolute;
    bottom: -10px;
    left: 50%;
    transform: translateX(-50%);
    width: 80px;
    height: 4px;
    background: linear-gradient(135deg, #00b894, #00a085);
    border-radius: 2px;
}

.new-products-section .section-subtitle {
    font-size: 1.1rem;
    color: #636e72;
    margin: 0;
    font-weight: 400;
    max-width: 600px;
    margin: 0 auto;
}

.products-carousel {
    position: relative;
    z-index: 1;
    margin-bottom: 50px;
}

.new-products-section .section-footer {
    text-align: center;
    position: relative;
    z-index: 1;
}

.view-all-products-btn {
    display: inline-flex;
    align-items: center;
    gap: 12px;
    background: linear-gradient(135deg, #00b894, #00a085);
    color: white;
    text-decoration: none;
    padding: 15px 30px;
    border-radius: 50px;
    font-weight: 600;
    font-size: 1rem;
    transition: all 0.3s ease;
    box-shadow: 0 4px 20px rgba(0, 184, 148, 0.3);
    position: relative;
    overflow: hidden;
}

.view-all-products-btn::before {
    content: '';
    position: absolute;
    top: 0;
    left: -100%;
    width: 100%;
    height: 100%;
    background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
    transition: left 0.5s ease;
}

.view-all-products-btn:hover::before {
    left: 100%;
}

.view-all-products-btn:hover {
    transform: translateY(-3px);
    box-shadow: 0 8px 30px rgba(0, 184, 148, 0.4);
    color: white;
}

.view-all-products-btn i {
    transition: transform 0.3s ease;
}

.view-all-products-btn:hover i {
    transform: translateX(5px);
}

/* Responsive design */
@media (max-width: 768px) {
    .new-products-section {
        padding: 60px 0;
        margin: 40px 0;
    }
    
    .new-products-section .section-header {
        margin-bottom: 40px;
    }
    
    .new-products-section .section-title {
        font-size: 2rem;
    }
    
    .new-products-section .section-icon {
        font-size: 2.5rem;
    }
    
    .new-products-section .section-subtitle {
        font-size: 1rem;
    }
}

@media (max-width: 576px) {
    .new-products-section {
        padding: 40px 0;
        margin: 30px 0;
    }
    
    .new-products-section .section-title {
        font-size: 1.8rem;
    }
    
    .view-all-products-btn {
        padding: 12px 25px;
        font-size: 0.9rem;
    }
}
</style>
