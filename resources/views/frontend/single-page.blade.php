@extends('layouts.site')
@section('title', $page->title)
@section('content')
<section class="container mt-4">
    <div class="modern-title-section">
        <div class="title-content">
            <div class="title-icon-wrapper">
                <i class="fas fa-file-text title-icon"></i>
                <div class="icon-glow"></div>
            </div>
            <h1>{{ $page->title }}</h1>
            <p class="title-subtitle">{{ $page->description }}</p>
            <div class="title-decorative-line"></div>
        </div>
    </div>
    
    <div class="content-wrapper">
        <div class="content-card">
            <div class="content-header">
                <div class="content-meta">
                    <span class="content-date">
                        <i class="fas fa-calendar-alt"></i>
                        {{ $page->created_at->format('d/m/Y') }}
                    </span>
                    <span class="content-type">
                        <i class="fas fa-bookmark"></i>
                        Trang thông tin
                    </span>
                </div>
            </div>
            
            <div class="content-body">
                <div class="policy-detail">
                    {!! $page->detail !!}
                </div>
            </div>
            
            <div class="content-footer">
                <div class="back-navigation">
                    <a href="{{ route('site.home') }}" class="back-btn">
                        <i class="fas fa-home"></i>
                        <span>Quay lại trang chủ</span>
                    </a>
                    <a href="{{ route('site.post') }}" class="posts-btn">
                        <i class="fas fa-newspaper"></i>
                        <span>Xem bài viết</span>
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

<style>
.modern-title-section {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    border-radius: 25px;
    margin-bottom: 40px;
    overflow: hidden;
    position: relative;
    min-height: 280px;
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
    bottom: -50%;
    right: -50%;
    width: 200%;
    height: 200%;
    background: radial-gradient(circle, rgba(255, 255, 255, 0.1) 0%, transparent 70%);
    animation: float 25s ease-in-out infinite;
}

@keyframes float {
    0%, 100% { transform: translateX(0px) rotate(0deg); }
    50% { transform: translateX(-30px) rotate(180deg); }
}

.title-content {
    padding: 60px 40px;
    text-align: center;
    color: white;
    position: relative;
    z-index: 1;
    width: 100%;
}

.title-icon-wrapper {
    position: relative;
    display: inline-block;
    margin-bottom: 25px;
}

.title-icon {
    font-size: 4.5rem;
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
    width: 140px;
    height: 140px;
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
    font-size: 3.2rem;
    font-weight: 900;
    margin: 0 0 20px 0;
    letter-spacing: 2px;
    text-shadow: 0 4px 20px rgba(0, 0, 0, 0.3);
    background: linear-gradient(45deg, #ffffff, #f0f0f0);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    background-clip: text;
}

.title-subtitle {
    font-size: 1.3rem;
    opacity: 0.95;
    margin: 0 0 30px 0;
    font-weight: 400;
    max-width: 700px;
    margin-left: auto;
    margin-right: auto;
    line-height: 1.6;
}

.title-decorative-line {
    width: 120px;
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

.content-wrapper {
    max-width: 900px;
    margin: 0 auto;
}

.content-card {
    background: white;
    border-radius: 25px;
    box-shadow: 0 8px 40px rgba(0, 0, 0, 0.1);
    overflow: hidden;
    margin-bottom: 40px;
}

.content-header {
    background: linear-gradient(135deg, #f8f9fa, #e9ecef);
    padding: 25px 30px;
    border-bottom: 1px solid #f1f3f4;
}

.content-meta {
    display: flex;
    gap: 25px;
    align-items: center;
    flex-wrap: wrap;
}

.content-date,
.content-type {
    display: flex;
    align-items: center;
    gap: 8px;
    color: #636e72;
    font-weight: 600;
    font-size: 0.95rem;
}

.content-date i {
    color: #4facfe;
}

.content-type i {
    color: #00f2fe;
}

.content-body {
    padding: 40px 30px;
}

.policy-detail {
    font-size: 1.1rem;
    line-height: 1.8;
    color: #2d3436;
}

.policy-detail h1,
.policy-detail h2,
.policy-detail h3,
.policy-detail h4,
.policy-detail h5,
.policy-detail h6 {
    color: #2d3436;
    margin-top: 30px;
    margin-bottom: 15px;
    font-weight: 700;
}

.policy-detail h1 {
    font-size: 2.2rem;
    border-bottom: 3px solid #4facfe;
    padding-bottom: 10px;
}

.policy-detail h2 {
    font-size: 1.8rem;
    color: #4facfe;
}

.policy-detail h3 {
    font-size: 1.4rem;
    color: #00f2fe;
}

.policy-detail p {
    margin-bottom: 20px;
    text-align: justify;
}

.policy-detail ul,
.policy-detail ol {
    margin: 20px 0;
    padding-left: 30px;
}

.policy-detail li {
    margin-bottom: 10px;
    line-height: 1.7;
}

.policy-detail strong {
    color: #2d3436;
    font-weight: 700;
}

.policy-detail a {
    color: #4facfe;
    text-decoration: none;
    font-weight: 600;
    transition: color 0.3s ease;
}

.policy-detail a:hover {
    color: #00f2fe;
    text-decoration: underline;
}

.policy-detail blockquote {
    background: linear-gradient(135deg, #f8f9fa, #e9ecef);
    border-left: 4px solid #4facfe;
    padding: 20px 25px;
    margin: 25px 0;
    border-radius: 0 15px 15px 0;
    font-style: italic;
    color: #636e72;
}

.policy-detail table {
    width: 100%;
    border-collapse: collapse;
    margin: 25px 0;
    border-radius: 10px;
    overflow: hidden;
    box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
}

.policy-detail th,
.policy-detail td {
    padding: 15px;
    text-align: left;
    border-bottom: 1px solid #f1f3f4;
}

.policy-detail th {
    background: linear-gradient(135deg, #a18cd1, #8b7cc6);
    color: white;
    font-weight: 600;
}

.content-footer {
    background: linear-gradient(135deg, #f8f9fa, #e9ecef);
    padding: 30px;
    border-top: 1px solid #f1f3f4;
}

.back-navigation {
    display: flex;
    gap: 20px;
    justify-content: center;
    flex-wrap: wrap;
}

.back-btn,
.posts-btn {
    display: inline-flex;
    align-items: center;
    gap: 10px;
    padding: 15px 25px;
    border-radius: 25px;
    text-decoration: none;
    font-weight: 600;
    transition: all 0.3s ease;
    font-size: 1rem;
}

.back-btn {
    background: linear-gradient(135deg, #a18cd1, #8b7cc6);
    color: white;
    box-shadow: 0 4px 15px rgba(161, 140, 209, 0.3);
}

.posts-btn {
    background: linear-gradient(135deg, #667eea, #764ba2);
    color: white;
    box-shadow: 0 4px 15px rgba(102, 126, 234, 0.3);
}

.back-btn:hover,
.posts-btn:hover {
    transform: translateY(-3px);
    color: white;
}

.back-btn:hover {
    box-shadow: 0 8px 25px rgba(79, 172, 254, 0.4);
}

.posts-btn:hover {
    box-shadow: 0 8px 25px rgba(102, 126, 234, 0.4);
}

/* Responsive design */
@media (max-width: 768px) {
    .modern-title-section {
        min-height: 240px;
    }
    
    .title-content {
        padding: 40px 25px;
    }
    
    .title-content h1 {
        font-size: 2.4rem;
        letter-spacing: 1px;
    }
    
    .title-icon {
        font-size: 3.5rem;
    }
    
    .content-body {
        padding: 30px 20px;
    }
    
    .content-header {
        padding: 20px;
    }
    
    .content-footer {
        padding: 25px 20px;
    }
    
    .content-meta {
        flex-direction: column;
        gap: 15px;
        align-items: flex-start;
    }
    
    .back-navigation {
        flex-direction: column;
        align-items: center;
        gap: 15px;
    }
    
    .back-btn,
    .posts-btn {
        width: 100%;
        justify-content: center;
        max-width: 300px;
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
        font-size: 2rem;
    }
    
    .title-subtitle {
        font-size: 1.1rem;
    }
    
    .content-card {
        border-radius: 15px;
    }
    
    .policy-detail {
        font-size: 1rem;
    }
    
    .policy-detail h1 {
        font-size: 1.8rem;
    }
    
    .policy-detail h2 {
        font-size: 1.5rem;
    }
    
    .policy-detail h3 {
        font-size: 1.2rem;
    }
}
</style>
