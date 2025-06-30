@extends('layouts.site')

@section('title', 'Bài viết theo chủ đề - ' . $row->name)

@section('content')
<section class="container mt-4">
    <div class="modern-title-section">
        <div class="title-content">
            <div class="title-icon-wrapper">
                <i class="fas fa-newspaper title-icon"></i>
                <div class="icon-glow"></div>
            </div>
            <h1>{{ $row->name }}</h1>
            <p class="title-subtitle">Khám phá những bài viết thú vị về {{ strtolower($row->name) }}</p>
            <div class="title-decorative-line"></div>
        </div>
    </div>
    
    <div class="row">
        <!-- Enhanced Sidebar -->
        <div class="col-md-3">
            <div class="modern-sidebar">
                <div class="sidebar-section">
                    <div class="sidebar-header">
                        <i class="fas fa-tags"></i>
                        <h3>Tất cả chủ đề</h3>
                    </div>
                    <div class="topic-list">
                        @foreach ($topic_list as $topic)
                            <a href="{{ route('site.post.topic', ['slug' => $topic->slug]) }}" 
                               class="topic-item {{ $topic->slug === $row->slug ? 'active' : '' }}">
                                <div class="topic-icon">
                                    <i class="fas fa-tag"></i>
                                </div>
                                <span class="topic-name">{{ $topic->name }}</span>
                                <i class="fas fa-chevron-right topic-arrow"></i>
                            </a>
                        @endforeach
                    </div>
                </div>
                
                <!-- Back to all posts -->
                <div class="sidebar-section">
                    <a href="{{ route('site.post') }}" class="back-to-posts-btn">
                        <i class="fas fa-arrow-left"></i>
                        <span>Xem tất cả bài viết</span>
                    </a>
                </div>
            </div>
        </div>
        <!-- Enhanced Main content -->
        <div class="col-md-9">
            <div class="posts-header">
                <div class="posts-count">
                    <i class="fas fa-file-alt"></i>
                    <span>{{ $post_list->total() }} bài viết trong chủ đề "{{ $row->name }}"</span>
                </div>
            </div>
            
            <div class="posts-grid">
                @forelse ($post_list as $post)
                    <div class="post-grid-item" data-aos="fade-up" data-aos-delay="{{ $loop->index * 100 }}">
                        <x-post-card :post="$post" />
                    </div>
                @empty
                    <div class="no-posts-found">
                        <i class="fas fa-search"></i>
                        <h3>Không tìm thấy bài viết</h3>
                        <p>Chưa có bài viết nào trong chủ đề "{{ $row->name }}"</p>
                        <a href="{{ route('site.post') }}" class="btn-back-posts">
                            <i class="fas fa-arrow-left"></i>
                            Xem tất cả bài viết
                        </a>
                    </div>
                @endforelse
            </div>
            
            @if($post_list->hasPages())
                <div class="modern-pagination">
                    <div class="pagination-info">
                        <span>Trang {{ $post_list->currentPage() }} / {{ $post_list->lastPage() }}</span>
                    </div>
                    {{ $post_list->links() }}
                </div>
            @endif
        </div>
    </div>
</section>
@endsection

<style>
.container > .row {
    align-items: start !important;
}

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
    left: -50%;
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

.topic-list {
    padding: 0;
}

.topic-item {
    display: flex;
    align-items: center;
    gap: 15px;
    padding: 18px 25px;
    color: #2d3436;
    text-decoration: none;
    transition: all 0.3s ease;
    border-bottom: 1px solid #f8f9fa;
    font-weight: 500;
    position: relative;
    overflow: hidden;
}

.topic-item::before {
    content: '';
    position: absolute;
    top: 0;
    left: -100%;
    width: 100%;
    height: 100%;
    background: linear-gradient(135deg, #f8f9fa, #e9ecef);
    transition: left 0.3s ease;
    z-index: 0;
}

.topic-item:hover::before,
.topic-item.active::before {
    left: 0;
}

.topic-item:last-child {
    border-bottom: none;
}

.topic-item:hover,
.topic-item.active {
    color: #f5576c;
    transform: translateX(5px);
}

.topic-item.active {
    background: linear-gradient(135deg, #a18cd110, #8b7cc610);
}

.topic-icon {
    width: 35px;
    height: 35px;
    background: linear-gradient(135deg, #a18cd1, #8b7cc6);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    color: white;
    font-size: 0.9rem;
    position: relative;
    z-index: 1;
    transition: transform 0.3s ease;
}

.topic-item:hover .topic-icon,
.topic-item.active .topic-icon {
    transform: scale(1.1);
}

.topic-name {
    flex-grow: 1;
    position: relative;
    z-index: 1;
    font-weight: 600;
}

.topic-arrow {
    color: #f5576c;
    font-size: 0.8rem;
    transition: transform 0.3s ease;
    position: relative;
    z-index: 1;
}

.topic-item:hover .topic-arrow,
.topic-item.active .topic-arrow {
    transform: translateX(5px);
}

.back-to-posts-btn {
    display: flex;
    align-items: center;
    gap: 12px;
    padding: 20px 25px;
    color: white;
    text-decoration: none;
    background: linear-gradient(135deg, #667eea, #764ba2);
    border-radius: 20px;
    font-weight: 600;
    transition: all 0.3s ease;
    margin: 0;
}

.back-to-posts-btn:hover {
    transform: translateY(-2px);
    box-shadow: 0 8px 25px rgba(102, 126, 234, 0.3);
    color: white;
}

.posts-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    background: white;
    padding: 20px 25px;
    border-radius: 15px;
    box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
    margin-bottom: 30px;
    border-left: 4px solid #f5576c;
}

.posts-count {
    display: flex;
    align-items: center;
    gap: 10px;
    color: #2d3436;
    font-weight: 600;
}

.posts-count i {
    color: #f5576c;
    font-size: 1.2rem;
}

.posts-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(320px, 1fr));
    gap: 35px;
    margin-bottom: 50px;
}

.posts-grid .post-grid-item {
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

.posts-grid .post-grid-item:nth-child(1) { animation-delay: 0.1s; }
.posts-grid .post-grid-item:nth-child(2) { animation-delay: 0.2s; }
.posts-grid .post-grid-item:nth-child(3) { animation-delay: 0.3s; }
.posts-grid .post-grid-item:nth-child(4) { animation-delay: 0.4s; }
.posts-grid .post-grid-item:nth-child(5) { animation-delay: 0.5s; }
.posts-grid .post-grid-item:nth-child(6) { animation-delay: 0.6s; }

.posts-grid .modern-post-card {
    height: 100%;
}

.no-posts-found {
    grid-column: 1 / -1;
    text-align: center;
    padding: 60px 20px;
    background: white;
    border-radius: 20px;
    box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
}

.no-posts-found i {
    font-size: 4rem;
    color: #f5576c;
    margin-bottom: 20px;
    opacity: 0.7;
}

.no-posts-found h3 {
    color: #2d3436;
    margin-bottom: 15px;
    font-size: 1.5rem;
}

.no-posts-found p {
    color: #636e72;
    margin-bottom: 30px;
    font-size: 1.1rem;
}

.btn-back-posts {
    display: inline-flex;
    align-items: center;
    gap: 10px;
    background: linear-gradient(135deg, #a18cd1, #8b7cc6);
    color: white;
    text-decoration: none;
    padding: 15px 30px;
    border-radius: 25px;
    font-weight: 600;
    transition: all 0.3s ease;
}

.btn-back-posts:hover {
    transform: translateY(-2px);
    box-shadow: 0 8px 25px rgba(245, 87, 108, 0.3);
    color: white;
}

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
    border: 2px solid rgba(245, 87, 108, 0.1);
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

/* Responsive design */
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
    
    .posts-grid {
        grid-template-columns: 1fr;
        gap: 25px;
    }
    
    .posts-header {
        flex-direction: column;
        gap: 15px;
        text-align: center;
    }
    
    .sidebar-section {
        margin-bottom: 20px;
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
    
    .posts-grid {
        grid-template-columns: 1fr;
        gap: 20px;
    }
    
    .posts-header {
        padding: 15px 20px;
        margin-bottom: 20px;
    }
    
    .sidebar-header {
        padding: 20px;
    }
    
    .topic-item {
        padding: 15px 20px;
    }
    
    .back-to-posts-btn {
        padding: 15px 20px;
    }
}
</style>
