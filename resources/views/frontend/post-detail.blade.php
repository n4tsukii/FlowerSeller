@extends('layouts.site')
@section('title', 'Chi tiết bài viết')
@section('content')
<section class="container mt-4">
    <div class="row justify-content-center">
        <div class="col-lg-10">
            <div class="post-detail-card row g-0 flex-md-row flex-column align-items-stretch">
                @if($post->image)
                <div class="col-md-5 post-image-side d-flex align-items-center justify-content-center">
                    <img class="post-main-image img-fluid rounded-start" src="{{ asset('images/posts/' . $post->image) }}" alt="{{ $post->title }}">
                </div>
                @endif
                <div class="col-md-7 post-content-side d-flex flex-column justify-content-center">
                    <div class="post-back-btn-wrapper mb-3">
                        <a href="{{ route('site.post') }}" class="back-btn">
                            <i class="fas fa-arrow-left"></i>
                            <span>Quay lại danh sách</span>
                        </a>
                    </div>
                    <div class="post-title-section">
                        <h1 class="post-title">{{ $post->title }}</h1>
                        <div class="post-meta mb-2">
                            <div class="meta-item">
                                <i class="fas fa-calendar-alt"></i>
                                <span>{{ $post->created_at->format('d/m/Y') }}</span>
                            </div>
                            @if($post->topic)
                            <div class="meta-item">
                                <i class="fas fa-tag"></i>
                                <a href="{{ route('site.post.topic', ['slug' => $post->topic->slug]) }}">{{ $post->topic->name }}</a>
                            </div>
                            @endif
                        </div>
                        <p class="post-description">{{ $post->description }}</p>
                    </div>
                    <div class="post-content-section flex-grow-1 d-flex flex-column justify-content-center">
                        <div class="content-body">
                            {!! $post->content !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @if($related_posts && $related_posts->count() > 0)
    <div class="related-posts-section mt-5">
        <div class="section-header">
            <div class="header-content">
                <div class="header-icon">
                    <i class="fas fa-newspaper"></i>
                </div>
                <h2>Bài viết liên quan</h2>
            </div>
        </div>
        <div class="row g-4">
            @foreach ($related_posts as $relatedPost)
            <div class="col-md-4">
                <x-post-card :post="$relatedPost" />
            </div>
            @endforeach
        </div>
    </div>
    @endif
</section>

<style>
/* Modern Title Section */
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
    font-size: 2.5rem;
    font-weight: 900;
    margin: 0 0 15px 0;
    letter-spacing: 1px;
    text-shadow: 0 4px 20px rgba(0, 0, 0, 0.3);
    background: linear-gradient(45deg, #ffffff, #f0f0f0);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    background-clip: text;
    line-height: 1.2;
}
.title-subtitle {
    font-size: 1.1rem;
    opacity: 0.95;
    margin: 0 0 25px 0;
    font-weight: 400;
    max-width: 700px;
    margin-left: auto;
    margin-right: auto;
    line-height: 1.6;
}
.title-decorative-line {
    width: 100px;
    height: 4px;
    background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.8), transparent);
    margin: 0 auto 25px auto;
    border-radius: 2px;
    animation: shimmer 3s ease-in-out infinite;
}
@keyframes shimmer {
    0%, 100% { opacity: 0.6; transform: scaleX(1); }
    50% { opacity: 1; transform: scaleX(1.2); }
}
.post-meta {
    display: flex;
    justify-content: center;
    gap: 30px;
    flex-wrap: wrap;
}
.meta-item {
    display: flex;
    align-items: center;
    gap: 8px;
    background: rgba(255, 255, 255, 0.1);
    padding: 8px 16px;
    border-radius: 20px;
    font-size: 0.9rem;
    font-weight: 500;
}
.meta-item i {
    font-size: 1rem;
}
/* Post Detail Card */
.post-detail-card {
    background: white;
    border-radius: 25px;
    overflow: hidden;
    box-shadow: 0 8px 30px rgba(0, 0, 0, 0.08);
    margin-bottom: 30px;
    transition: transform 0.3s ease;
    display: flex;
    flex-direction: row;
    min-height: 350px;
}
.post-detail-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 15px 40px rgba(0, 0, 0, 0.12);
}
.post-detail-card .post-image-side {
    background: #f8f9fa;
    padding: 0;
    display: flex;
    align-items: center;
    justify-content: center;
    border-radius: 25px 0 0 25px;
    min-height: 350px;
}
.post-detail-card .post-main-image {
    width: 100%;
    height: 350px;
    object-fit: cover;
    border-radius: 25px 0 0 25px;
    box-shadow: 0 2px 10px rgba(161, 140, 209, 0.08);
}
.post-detail-card .post-content-side {
    background: white;
    border-radius: 0 25px 25px 0;
    padding: 40px;
    display: flex;
    flex-direction: column;
    justify-content: center;
}
.post-title-section {
    margin-bottom: 20px;
}
.post-title {
    font-size: 2.2rem;
    font-weight: 900;
    margin: 0 0 10px 0;
    letter-spacing: 1px;
    background: linear-gradient(45deg, #667eea, #764ba2);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    background-clip: text;
    line-height: 1.2;
}
.post-meta {
    display: flex;
    gap: 20px;
    flex-wrap: wrap;
    margin-bottom: 10px;
}
.meta-item {
    display: flex;
    align-items: center;
    gap: 8px;
    background: rgba(161, 140, 209, 0.08);
    padding: 6px 14px;
    border-radius: 20px;
    font-size: 0.95rem;
    font-weight: 500;
}
.meta-item i {
    font-size: 1rem;
    color: #a18cd1;
}
.meta-item a {
    color: #a18cd1;
    text-decoration: none;
    font-weight: 600;
}
.meta-item a:hover {
    color: #764ba2;
    text-decoration: underline;
}
.post-description {
    font-size: 1.1rem;
    color: #636e72;
    line-height: 1.5;
    margin: 0 0 15px 0;
    font-style: italic;
}
.related-posts-section {
    background: linear-gradient(135deg, #f8f9fa, #e9ecef);
    border-radius: 25px;
    margin-top: 60px;
    padding: 40px 30px;
    box-shadow: 0 4px 20px rgba(0,0,0,0.06);
}
.section-header {
    text-align: center;
    margin-bottom: 40px;
}
.header-content {
    display: inline-block;
    padding: 0 40px;
}
.header-icon {
    width: 60px;
    height: 60px;
    background: linear-gradient(135deg, #a18cd1, #8b7cc6);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    margin: 0 auto 15px auto;
    font-size: 1.5rem;
    color: white;
    box-shadow: 0 4px 15px rgba(161, 140, 209, 0.2);
}
.section-header h2 {
    font-size: 2rem;
    font-weight: 900;
    color: #2d3436;
    margin: 0 0 10px 0;
    background: linear-gradient(135deg, #667eea, #764ba2);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    background-clip: text;
}
.related-post-item {
    background: white;
    border-radius: 15px;
    box-shadow: 0 2px 10px rgba(161, 140, 209, 0.08);
    padding: 20px;
    margin-bottom: 10px;
    transition: box-shadow 0.2s;
}
.related-post-item:hover {
    box-shadow: 0 6px 20px rgba(161, 140, 209, 0.18);
}
.related-post-item h6 {
    margin: 0 0 8px 0;
    font-weight: 700;
}
.related-post-item a {
    color: #2d3436;
    text-decoration: none;
    font-weight: 600;
    transition: color 0.3s;
}
.related-post-item a:hover {
    color: #a18cd1;
    text-decoration: underline;
}
.container > .row > .col-lg-10 {
    max-width: 100%;
    flex: 0 0 83.333333%;
}
.container > .row > .col-lg-2 {
    max-width: 100%;
    flex: 0 0 16.666667%;
}
@media (max-width: 991.98px) {
    .container > .row > .col-lg-10,
    .container > .row > .col-lg-2 {
        flex: 0 0 100%;
        max-width: 100%;
    }
}
.related-posts-section .row {
    padding: 0 10px;
}
.related-posts-section .col-lg-4,
.related-posts-section .col-md-6 {
    display: flex;
}
.related-posts-section .x-post-card {
    width: 100%;
}
@media (max-width: 576px) {
    .post-title {
        font-size: 1.6rem;
    }
    .post-title_card {
        padding: 20px;
    }
    .post-content_card {
        padding: 20px;
    }
    .post-content {
        font-size: 1rem;
        margin-bottom: 30px;
    }
    .sidebar-header {
        padding: 20px;
    }
    .topic-display {
        padding: 20px;
    }
    .related-posts-list {
        padding: 20px;
    }
}
.back-btn {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    background: #f8f9fa;
    color: #764ba2;
    border-radius: 20px;
    padding: 8px 18px;
    font-weight: 600;
    font-size: 1rem;
    box-shadow: 0 2px 8px rgba(161, 140, 209, 0.08);
    text-decoration: none;
    transition: background 0.2s, color 0.2s, box-shadow 0.2s;
    margin-bottom: 0;
}
.back-btn i {
    font-size: 1.1rem;
}
.back-btn:hover {
    background: #e9ecef;
    color: #a18cd1;
    box-shadow: 0 4px 16px rgba(161, 140, 209, 0.15);
    text-decoration: none;
}
.post-back-btn-wrapper {
    position: absolute;
    top: 30px;
    left: 40px;
    z-index: 10;
}
@media (max-width: 991.98px) {
    .post-back-btn-wrapper {
        position: static;
        margin-bottom: 10px;
        left: unset;
        top: unset;
    }
}
</style>
@endsection
