@extends('layouts.site')
@section('title', 'Product')
@section('content')
<section class="container mt-4">
    <!-- Modern Title Section matching post page -->
    <div class="modern-title-section">
        <div class="title-content">
            <div class="title-icon-wrapper">
                <i class="fas fa-shopping-bag title-icon"></i>
                <div class="icon-glow"></div>
            </div>
            <h1>SẢN PHẨM</h1>
            <p class="title-subtitle">Khám phá bộ sưu tập hoa tươi đẹp nhất với chất lượng tuyệt vời</p>
            <div class="title-decorative-line"></div>
        </div>
    </div>
    
    <div class="row">
        <!-- Enhanced Sidebar matching post page -->
        <div class="col-md-3">
            <div class="modern-sidebar">
                <x-product-category-name />
                <x-product-brand />
                
                <!-- Newsletter Widget -->
                <div class="sidebar-section newsletter-widget">
                    <div class="newsletter-content">
                        <i class="fas fa-gift newsletter-icon"></i>
                        <h4>Ưu đãi đặc biệt</h4>
                        <p>Đăng ký nhận thông tin khuyến mãi mới nhất</p>
                        <div class="newsletter-form">
                            <input type="email" placeholder="Email của bạn..." class="newsletter-input">
                            <button class="newsletter-btn">
                                <i class="fas fa-paper-plane"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Enhanced Main content -->
        <div class="col-md-9">
            <!-- Products Header with view toggle and sort -->
            <div class="products-header">
                <div class="products-info">
                    <div class="products-count">
                        <i class="fas fa-box-open"></i>
                        <span>{{ $product_list->total() }} sản phẩm</span>
                    </div>
                    <div class="view-toggle-buttons">
                        <button class="view-btn active" id="toggleGridView">
                            <i class="fas fa-th-large"></i>
                            <span>Lưới</span>
                        </button>
                        <button class="view-btn" id="toggleListView">
                            <i class="fas fa-list"></i>
                            <span>Danh sách</span>
                        </button>
                    </div>
                </div>
                <div class="products-sort">
                    <form action="{{ route('site.product') }}" method="GET" id="sortForm">
                        @csrf
                        <select class="sort-select" id="sort" name="sort" onchange="document.getElementById('sortForm').submit();">
                            {!! $htmlSortOptions !!}
                        </select>
                    </form>
                </div>
            </div>

            <!-- Grid View Section -->
            <div class="row products-grid" id="gridViewSection">
                @foreach ($product_list as $product)
                    <div class="col-md-4 mb-4 product-grid-item" data-aos="fade-up" data-aos-delay="{{ $loop->index * 100 }}">
                        <x-product-card :product="$product" />
                    </div>
                @endforeach
            </div>

            <!-- List View Section -->
            <div class="products-list" id="listViewSection" style="display: none;">
                @foreach ($product_list as $product)
                    <div class="product-list-item" data-aos="fade-right" data-aos-delay="{{ $loop->index * 50 }}">
                        <div class="modern-list-item">
                            <div class="list-item-image">
                                <a href="{{ route('site.product.detail', ['slug' => $product->slug]) }}">
                                    <img src="{{ asset('images/products/' . $product->image) }}" alt="{{ $product->name }}" class="list-product-image">
                                </a>
                                @if ($product->pricesale > 0 && $product->pricesale < $product->price)
                                    <div class="list-discount-badge">
                                        -{{ number_format((($product->price - $product->pricesale) / $product->price) * 100) }}%
                                    </div>
                                @endif
                            </div>
                            <div class="list-item-info">
                                <h3 class="list-product-title">
                                    <a href="{{ route('site.product.detail', ['slug' => $product->slug]) }}">{{ $product->name }}</a>
                                </h3>
                                <p class="list-product-description">{{ Str::limit($product->description, 120) }}</p>
                                <div class="list-pricing">
                                    @if ($product->pricesale > 0 && $product->pricesale < $product->price)
                                        <span class="list-current-price">{{ number_format($product->pricesale) }}₫</span>
                                        <span class="list-original-price">{{ number_format($product->price) }}₫</span>
                                    @else
                                        <span class="list-current-price">{{ number_format($product->price) }}₫</span>
                                    @endif
                                </div>
                            </div>
                            <div class="list-item-actions">
                                <a href="{{ route('site.product.detail', ['slug' => $product->slug]) }}" class="list-view-btn">
                                    <i class="fas fa-eye"></i>
                                    <span>Xem chi tiết</span>
                                </a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <!-- Modern Pagination -->
            @if($product_list->hasPages())
                <div class="modern-pagination">
                    <div class="pagination-info">
                        <span>Trang {{ $product_list->currentPage() }} / {{ $product_list->lastPage() }}</span>
                    </div>
                    {{ $product_list->links() }}
                </div>
            @endif
        </div>
    </div>
</section>
@endsection

<style>
/* Modern Title Section - matching post page */
.modern-title-section {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    border-radius: 25px;
    margin-bottom: 40px;
    overflow: hidden;
    position: relative;
    min-height: 250px;
    display: flex;
    align-items: center;
}

.modern-title-section::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100"><defs><pattern id="grain" width="100" height="100" patternUnits="userSpaceOnUse"><circle cx="25" cy="25" r="1" fill="white" opacity="0.1"/><circle cx="75" cy="75" r="1" fill="white" opacity="0.1"/><circle cx="50" cy="10" r="0.5" fill="white" opacity="0.1"/></pattern></defs><rect width="100" height="100" fill="url(%23grain)"/></svg>');
    opacity: 0.3;
}

.modern-title-section::after {
    content: '';
    position: absolute;
    top: -50%;
    right: -50%;
    width: 200%;
    height: 200%;
    background: radial-gradient(circle, rgba(255, 255, 255, 0.1) 0%, transparent 70%);
    animation: float 20s ease-in-out infinite;
}

@keyframes float {
    0%, 100% { transform: translateY(0px) rotate(0deg); }
    50% { transform: translateY(-20px) rotate(180deg); }
}

.title-content {
    padding: 50px 40px;
    text-align: center;
    color: white;
    position: relative;
    z-index: 1;
    width: 100%;
}

.title-icon-wrapper {
    position: relative;
    display: inline-block;
    margin-bottom: 20px;
}

.title-icon {
    font-size: 4rem;
    opacity: 0.95;
    position: relative;
    z-index: 2;
    animation: pulse 3s ease-in-out infinite;
}

.icon-glow {
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    width: 120px;
    height: 120px;
    background: radial-gradient(circle, rgba(255, 255, 255, 0.2) 0%, transparent 70%);
    border-radius: 50%;
    animation: glow 4s ease-in-out infinite;
}

@keyframes pulse {
    0%, 100% { transform: scale(1); opacity: 0.95; }
    50% { transform: scale(1.05); opacity: 1; }
}

@keyframes glow {
    0%, 100% { transform: translate(-50%, -50%) scale(1); opacity: 0.5; }
    50% { transform: translate(-50%, -50%) scale(1.2); opacity: 0.8; }
}

.title-content h1 {
    font-size: 3rem;
    font-weight: 900;
    margin: 0 0 15px 0;
    letter-spacing: 2px;
    text-shadow: 0 4px 20px rgba(0, 0, 0, 0.3);
    background: linear-gradient(45deg, #ffffff, #f0f0f0);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    background-clip: text;
}

.title-subtitle {
    font-size: 1.2rem;
    opacity: 0.95;
    margin: 0 0 25px 0;
    font-weight: 400;
    max-width: 600px;
    margin-left: auto;
    margin-right: auto;
    line-height: 1.6;
}

.title-decorative-line {
    width: 100px;
    height: 4px;
    background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.8), transparent);
    margin: 0 auto;
    border-radius: 2px;
    animation: shimmer 3s ease-in-out infinite;
}

@keyframes shimmer {
    0%, 100% { opacity: 0.6; transform: scaleX(1); }
    50% { opacity: 1; transform: scaleX(1.2); }
}

/* Modern Sidebar - matching post page */
.modern-sidebar {
    position: sticky;
    top: 20px;
}

.sidebar-section {
    background: white;
    border-radius: 20px;
    box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
    overflow: hidden;
    margin-bottom: 30px;
}

.sidebar-header {
    background: linear-gradient(135deg, #a18cd1, #8b7cc6);
    color: white;
    padding: 25px;
    display: flex;
    align-items: center;
    gap: 15px;
    position: relative;
    overflow: hidden;
}

.sidebar-header::before {
    content: '';
    position: absolute;
    top: 0;
    left: -100%;
    width: 100%;
    height: 100%;
    background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.1), transparent);
    animation: slide 3s ease-in-out infinite;
}

@keyframes slide {
    0% { left: -100%; }
    50% { left: 100%; }
    100% { left: 100%; }
}

.sidebar-header i {
    font-size: 1.4rem;
    position: relative;
    z-index: 1;
}

.sidebar-header h3 {
    margin: 0;
    font-size: 1.2rem;
    font-weight: 700;
    position: relative;
    z-index: 1;
}

.filter-content {
    padding: 25px;
}

/* Newsletter Widget */
.newsletter-widget {
    background: linear-gradient(135deg, #667eea, #764ba2);
    border: none;
    color: white;
}

.newsletter-content {
    padding: 30px 25px;
    text-align: center;
}

.newsletter-icon {
    font-size: 2.5rem;
    margin-bottom: 15px;
    opacity: 0.9;
    animation: bounce 2s ease-in-out infinite;
}

@keyframes bounce {
    0%, 100% { transform: translateY(0); }
    50% { transform: translateY(-10px); }
}

.newsletter-content h4 {
    font-size: 1.3rem;
    font-weight: 700;
    margin: 0 0 10px 0;
}

.newsletter-content p {
    font-size: 0.9rem;
    opacity: 0.9;
    margin: 0 0 20px 0;
    line-height: 1.5;
}

.newsletter-form {
    display: flex;
    gap: 10px;
    margin-top: 20px;
}

.newsletter-input {
    flex: 1;
    padding: 12px 15px;
    border: none;
    border-radius: 25px;
    font-size: 0.9rem;
    outline: none;
    background: rgba(255, 255, 255, 0.9);
    color: #333;
}

.newsletter-input::placeholder {
    color: #666;
}

.newsletter-btn {
    width: 45px;
    height: 45px;
    border: none;
    border-radius: 50%;
    background: rgba(255, 255, 255, 0.2);
    color: white;
    cursor: pointer;
    transition: all 0.3s ease;
    display: flex;
    align-items: center;
    justify-content: center;
}

.newsletter-btn:hover {
    background: rgba(255, 255, 255, 0.3);
    transform: scale(1.1);
}

/* Products Header */
.products-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    background: white;
    padding: 20px 25px;
    border-radius: 15px;
    box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
    margin-bottom: 30px;
    border-left: 4px solid #a18cd1;
    flex-wrap: wrap;
    gap: 20px;
}

.products-info {
    display: flex;
    align-items: center;
    gap: 25px;
    flex-wrap: wrap;
}

.products-count {
    display: flex;
    align-items: center;
    gap: 10px;
    color: #2d3436;
    font-weight: 600;
}

.products-count i {
    color: #a18cd1;
    font-size: 1.2rem;
}

/* View Toggle Buttons */
.view-toggle-buttons {
    display: flex;
    gap: 10px;
    align-items: center;
}

.view-btn {
    background: white;
    border: 2px solid #e0e0e0;
    border-radius: 12px;
    padding: 12px 20px;
    display: flex;
    align-items: center;
    gap: 8px;
    cursor: pointer;
    transition: all 0.3s ease;
    font-weight: 600;
    color: #636e72;
    font-size: 0.9rem;
}

.view-btn:hover {
    border-color: #a18cd1;
    color: #a18cd1;
    transform: translateY(-1px);
}

.view-btn.active {
    background: linear-gradient(135deg, #a18cd1, #8b7cc6);
    border-color: #a18cd1;
    color: white;
    box-shadow: 0 4px 15px rgba(161, 140, 209, 0.3);
}

.view-btn i {
    font-size: 1.1rem;
}

/* Products Sort */
.products-sort {
    position: relative;
}

.sort-select {
    background: linear-gradient(135deg, #a18cd1, #8b7cc6);
    color: white;
    border: none;
    padding: 10px 20px;
    border-radius: 20px;
    font-weight: 600;
    cursor: pointer;
    outline: none;
    appearance: none;
    padding-right: 35px;
}

.sort-select::-ms-expand {
    display: none;
}

.products-sort::after {
    content: '\f107';
    font-family: 'Font Awesome 5 Free';
    font-weight: 900;
    position: absolute;
    right: 12px;
    top: 50%;
    transform: translateY(-50%);
    color: white;
    pointer-events: none;
}

/* Grid Layout */
.products-grid {
    margin-bottom: 50px;
}

.products-grid .product-grid-item {
    display: flex;
    flex-direction: column;
    opacity: 0;
    animation: fadeInUp 0.6s ease forwards;
}

@keyframes fadeInUp {
    from {
        opacity: 0;
        transform: translateY(30px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

.products-grid .product-grid-item:nth-child(1) { animation-delay: 0.1s; }
.products-grid .product-grid-item:nth-child(2) { animation-delay: 0.2s; }
.products-grid .product-grid-item:nth-child(3) { animation-delay: 0.3s; }
.products-grid .product-grid-item:nth-child(4) { animation-delay: 0.4s; }
.products-grid .product-grid-item:nth-child(5) { animation-delay: 0.5s; }
.products-grid .product-grid-item:nth-child(6) { animation-delay: 0.6s; }

.products-grid .modern-product-card {
    height: 100%;
}

/* List View */
.products-list {
    display: flex;
    flex-direction: column;
    gap: 25px;
    margin-bottom: 50px;
}

.product-list-item {
    opacity: 0;
    animation: fadeInRight 0.6s ease forwards;
}

@keyframes fadeInRight {
    from {
        opacity: 0;
        transform: translateX(-30px);
    }
    to {
        opacity: 1;
        transform: translateX(0);
    }
}

.modern-list-item {
    display: flex;
    align-items: center;
    width: 100%;
    background: white;
    border-radius: 20px;
    box-shadow: 0 8px 25px rgba(0, 0, 0, 0.08);
    overflow: hidden;
    transition: all 0.3s ease;
    padding: 25px;
    gap: 25px;
}

.modern-list-item:hover {
    transform: translateY(-5px);
    box-shadow: 0 15px 35px rgba(161, 140, 209, 0.15);
}

.list-item-image {
    position: relative;
    flex-shrink: 0;
}

.list-product-image {
    width: 150px;
    height: 150px;
    object-fit: cover;
    border-radius: 15px;
    transition: transform 0.3s ease;
}

.modern-list-item:hover .list-product-image {
    transform: scale(1.05);
}

.list-discount-badge {
    position: absolute;
    top: 10px;
    left: 10px;
    background: linear-gradient(135deg, #ff6b6b, #ee5a52);
    color: white;
    padding: 6px 12px;
    border-radius: 15px;
    font-weight: 700;
    font-size: 0.8rem;
    box-shadow: 0 3px 10px rgba(238, 90, 82, 0.3);
}

.list-item-info {
    flex-grow: 1;
    padding-right: 20px;
}

.list-product-title {
    margin: 0 0 12px 0;
    font-size: 1.4rem;
    font-weight: 700;
    line-height: 1.4;
}

.list-product-title a {
    color: #2d3436;
    text-decoration: none;
    transition: color 0.3s ease;
}

.list-product-title a:hover {
    color: #a18cd1;
}

.list-product-description {
    color: #636e72;
    font-size: 1rem;
    line-height: 1.6;
    margin: 0 0 15px 0;
}

.list-pricing {
    display: flex;
    align-items: center;
    gap: 15px;
}

.list-current-price {
    font-size: 1.5rem;
    font-weight: 800;
    color: #00b894;
}

.list-original-price {
    font-size: 1.1rem;
    color: #b2bec3;
    text-decoration: line-through;
}

.list-item-actions {
    flex-shrink: 0;
}

.list-view-btn {
    background: linear-gradient(135deg, #a18cd1, #8b7cc6);
    color: white;
    border: none;
    padding: 15px 25px;
    border-radius: 25px;
    font-weight: 600;
    font-size: 1rem;
    cursor: pointer;
    transition: all 0.3s ease;
    display: flex;
    align-items: center;
    gap: 10px;
    text-decoration: none;
}

.list-view-btn:hover {
    background: linear-gradient(135deg, #8b7cc6, #7b6eb8);
    transform: translateY(-2px);
    box-shadow: 0 8px 25px rgba(161, 140, 209, 0.3);
    color: white;
}

.list-view-btn i {
    font-size: 1.1rem;
}

/* Modern Pagination - matching post page */
.modern-pagination {
    display: flex;
    flex-direction: column;
    align-items: center;
    margin-top: 50px;
    gap: 20px;
}

.pagination-info {
    background: linear-gradient(135deg, #f8f9fa, #e9ecef);
    padding: 12px 20px;
    border-radius: 20px;
    color: #636e72;
    font-weight: 600;
    font-size: 0.9rem;
    border: 2px solid rgba(161, 140, 209, 0.1);
}

.modern-pagination .pagination {
    border-radius: 25px;
    overflow: hidden;
    box-shadow: 0 6px 25px rgba(0, 0, 0, 0.1);
    background: white;
}

.modern-pagination .page-link {
    border: none;
    padding: 15px 22px;
    color: #636e72;
    background: white;
    font-weight: 600;
    transition: all 0.3s ease;
    position: relative;
    overflow: hidden;
}

.modern-pagination .page-link::before {
    content: '';
    position: absolute;
    top: 0;
    left: -100%;
    width: 100%;
    height: 100%;
    background: linear-gradient(135deg, #a18cd1, #8b7cc6);
    transition: left 0.3s ease;
    z-index: 0;
}

.modern-pagination .page-link:hover::before {
    left: 0;
}

.modern-pagination .page-link:hover {
    color: white;
    transform: translateY(-2px);
    z-index: 1;
    position: relative;
}

.modern-pagination .page-item.active .page-link {
    background: linear-gradient(135deg, #a18cd1, #8b7cc6);
    color: white;
    box-shadow: 0 6px 20px rgba(161, 140, 209, 0.4);
    transform: translateY(-2px);
}

.modern-pagination .page-item.active .page-link::before {
    left: 0;
}

/* Responsive Design */
@media (max-width: 768px) {
    .title-content {
        padding: 40px 25px;
    }
    
    .title-content h1 {
        font-size: 2.2rem;
        letter-spacing: 1px;
    }
    
    .title-icon {
        font-size: 3rem;
    }
    
    .products-grid {
        margin-bottom: 25px;
    }
    
    .products-header {
        flex-direction: column;
        gap: 15px;
        text-align: center;
    }
    
    .products-info {
        justify-content: center;
    }
    
    .modern-list-item {
        flex-direction: column;
        text-align: center;
        padding: 20px;
        gap: 20px;
    }

    .list-item-info {
        padding-right: 0;
    }

    .list-product-image {
        width: 120px;
        height: 120px;
    }
    
    .sidebar-section {
        margin-bottom: 20px;
    }
    
    .newsletter-form {
        flex-direction: column;
        gap: 15px;
    }
    
    .newsletter-btn {
        align-self: center;
    }
}

@media (max-width: 576px) {
    .modern-title-section {
        margin-bottom: 30px;
        min-height: 200px;
    }
    
    .title-content {
        padding: 30px 20px;
    }
    
    .title-content h1 {
        font-size: 1.8rem;
    }
    
    .title-subtitle {
        font-size: 1rem;
    }
    
    .products-grid {
        margin-bottom: 20px;
    }
    
    .products-header {
        padding: 15px 20px;
        margin-bottom: 20px;
    }
    
    .sidebar-header {
        padding: 20px;
    }
    
    .newsletter-content {
        padding: 25px 20px;
    }
    
    .view-toggle-buttons {
        gap: 8px;
    }
    
    .view-btn {
        padding: 10px 15px;
        font-size: 0.85rem;
    }
}
</style>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        const gridViewBtn = document.getElementById('toggleGridView');
        const listViewBtn = document.getElementById('toggleListView');
        const gridViewSection = document.getElementById('gridViewSection');
        const listViewSection = document.getElementById('listViewSection');

        // Set initial view mode from localStorage
        const initialView = localStorage.getItem('viewMode') || 'grid';
        if (initialView === 'list') {
            gridViewSection.style.display = 'none';
            listViewSection.style.display = 'flex';
            gridViewBtn.classList.remove('active');
            listViewBtn.classList.add('active');
        } else {
            gridViewSection.style.display = 'flex';
            listViewSection.style.display = 'none';
            gridViewBtn.classList.add('active');
            listViewBtn.classList.remove('active');
        }
        
        gridViewBtn.addEventListener('click', function() {
            console.log('Grid View button clicked');
            gridViewSection.style.display = 'flex';
            listViewSection.style.display = 'none';
            gridViewBtn.classList.add('active');
            listViewBtn.classList.remove('active');
            localStorage.setItem('viewMode', 'grid');
        });
        
        listViewBtn.addEventListener('click', function() {
            console.log('List View button clicked');
            gridViewSection.style.display = 'none';
            listViewSection.style.display = 'flex';
            listViewBtn.classList.add('active');
            gridViewBtn.classList.remove('active');
            localStorage.setItem('viewMode', 'list');
        });
    });
</script>
