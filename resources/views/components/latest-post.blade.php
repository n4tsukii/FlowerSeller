<div class="latest-posts-section">
    <div class="container">
        <div class="section-header">
            <div class="section-title-wrapper">
                <i class="fas fa-newspaper section-icon"></i>
                <h2 class="section-title">Bài viết mới nhất</h2>
                <p class="section-subtitle">Cập nhật kiến thức và xu hướng mới về hoa tươi</p>
            </div>
        </div>
        
        <div class="posts-carousel">
            <div class="row">
                @foreach ($listpost as $post)
                    <div class="col-lg-3 col-md-6 mb-4">
                        <x-post-card :post="$post" />
                    </div>
                @endforeach
            </div>
        </div>
        
        <div class="section-footer">
            <a href="{{ route('site.post') }}" class="view-all-btn">
                <span>Xem tất cả bài viết</span>
                <i class="fas fa-arrow-right"></i>
            </a>
        </div>
    </div>
</div>

<style>
.latest-posts-section {
    background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
    padding: 80px 0;
    margin: 60px 0;
    position: relative;
    overflow: hidden;
}

.latest-posts-section::before {
    content: '';
    position: absolute;
    top: -50%;
    left: -50%;
    width: 200%;
    height: 200%;
    background: radial-gradient(circle, rgba(161, 140, 209, 0.05) 0%, transparent 70%);
    animation: float 20s ease-in-out infinite;
}

@keyframes float {
    0%, 100% { transform: translateY(0px) rotate(0deg); }
    50% { transform: translateY(-20px) rotate(180deg); }
}

.section-header {
    text-align: center;
    margin-bottom: 60px;
    position: relative;
    z-index: 1;
}

.section-title-wrapper {
    display: inline-block;
    position: relative;
}

.section-icon {
    font-size: 3rem;
    color: #a18cd1;
    margin-bottom: 20px;
    display: block;
    animation: pulse 2s infinite;
}

@keyframes pulse {
    0%, 100% { opacity: 1; }
    50% { opacity: 0.7; }
}

.section-title {
    font-size: 2.5rem;
    font-weight: 800;
    color: #2d3436;
    margin: 0 0 15px 0;
    letter-spacing: -0.5px;
    position: relative;
}

.section-title::after {
    content: '';
    position: absolute;
    bottom: -10px;
    left: 50%;
    transform: translateX(-50%);
    width: 80px;
    height: 4px;
    background: linear-gradient(135deg, #a18cd1, #8b7cc6);
    border-radius: 2px;
}

.section-subtitle {
    font-size: 1.1rem;
    color: #636e72;
    margin: 0;
    font-weight: 400;
    max-width: 500px;
    margin: 0 auto;
}

.posts-carousel {
    position: relative;
    z-index: 1;
    margin-bottom: 50px;
}

.section-footer {
    text-align: center;
    position: relative;
    z-index: 1;
}

.view-all-btn {
    display: inline-flex;
    align-items: center;
    gap: 12px;
    background: linear-gradient(135deg, #a18cd1, #8b7cc6);
    color: white;
    text-decoration: none;
    padding: 15px 30px;
    border-radius: 50px;
    font-weight: 600;
    font-size: 1rem;
    transition: all 0.3s ease;
    box-shadow: 0 4px 20px rgba(161, 140, 209, 0.3);
    position: relative;
    overflow: hidden;
}

.view-all-btn::before {
    content: '';
    position: absolute;
    top: 0;
    left: -100%;
    width: 100%;
    height: 100%;
    background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
    transition: left 0.5s ease;
}

.view-all-btn:hover::before {
    left: 100%;
}

.view-all-btn:hover {
    transform: translateY(-3px);
    box-shadow: 0 8px 30px rgba(161, 140, 209, 0.4);
    color: white;
}

.view-all-btn i {
    transition: transform 0.3s ease;
}

.view-all-btn:hover i {
    transform: translateX(5px);
}

/* Responsive design */
@media (max-width: 768px) {
    .latest-posts-section {
        padding: 60px 0;
        margin: 40px 0;
    }
    
    .section-header {
        margin-bottom: 40px;
    }
    
    .section-title {
        font-size: 2rem;
    }
    
    .section-icon {
        font-size: 2.5rem;
    }
    
    .section-subtitle {
        font-size: 1rem;
    }
}

@media (max-width: 576px) {
    .latest-posts-section {
        padding: 40px 0;
        margin: 30px 0;
    }
    
    .section-title {
        font-size: 1.8rem;
    }
    
    .view-all-btn {
        padding: 12px 25px;
        font-size: 0.9rem;
    }
}
</style>
 