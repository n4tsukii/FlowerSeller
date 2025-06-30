@extends('layouts.site')
@section('title', 'Chi tiết bài viết')
@section('content')
<section class="container mt-4">
    <div class="row">
        <div class="col-lg-8">
            <!-- Post Title Section -->
            <div class="post-title-card">
                <h1 class="post-title">{{ $post->title }}</h1>
                <div class="post-meta">
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

            <!-- Post Image Section -->
            @if($post->image)
            <div class="post-image-card">
                <img class="post-image" src="{{ asset('images/posts/' . $post->image) }}" alt="{{ $post->title }}">
            </div>
            @endif

            <!-- Post Content Section -->
            <div class="post-content-card">
                <div class="post-content">
                    {!! $post->content !!}
                </div>
                
                <div class="post-actions">
                    <a href="{{ route('site.post') }}" class="back-btn">
                        <i class="fas fa-arrow-left"></i>
                        <span>Quay lại danh sách</span>
                    </a>
                </div>
            </div>
        </div>

        <!-- Sidebar -->
        <div class="col-lg-4">
            <div class="modern-sidebar">
                @if($post->topic)
                <div class="sidebar-section">
                    <div class="sidebar-header">
                        <i class="fas fa-tag"></i>
                        <h3>Chủ đề</h3>
                    </div>
                    <div class="topic-display">
                        <a href="{{ route('site.post.topic', ['slug' => $post->topic->slug]) }}" class="current-topic">
                            <div class="topic-icon">
                                <i class="fas fa-tag"></i>
                            </div>
                            <span class="topic-name">{{ $post->topic->name }}</span>
                            <i class="fas fa-external-link-alt topic-link"></i>
                        </a>
                    </div>
                </div>
                @endif

                <!-- Related Posts -->
                @if($related_posts && $related_posts->count() > 0)
                <div class="sidebar-section">
                    <div class="sidebar-header">
                        <i class="fas fa-newspaper"></i>
                        <h3>Bài viết liên quan</h3>
                    </div>
                    <div class="related-posts-list">
                        @foreach ($related_posts as $relatedPost)
                        <div class="related-post-item">
                            <h6><a href="{{ route('site.post.detail', ['slug' => $relatedPost->slug]) }}">{{ $relatedPost->title }}</a></h6>
                            <small class="text-muted">{{ $relatedPost->created_at->format('d/m/Y') }}</small>
                        </div>
                        @endforeach
                    </div>
                </div>
                @endif
            </div>
        </div>
    </div>
</section>

<style>
/* Post Title Card */
.post-title-card {
    background: white;
    border-radius: 20px;
    padding: 40px;
    margin-bottom: 30px;
    box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
}

.post-title {
    font-size: 2.5rem;
    font-weight: 700;
    color: #2d3436;
    margin-bottom: 20px;
    line-height: 1.3;
    background: linear-gradient(135deg, #667eea, #764ba2);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    background-clip: text;
}

.post-meta {
    display: flex;
    gap: 20px;
    margin-bottom: 20px;
    flex-wrap: wrap;
}

.meta-item {
    display: flex;
    align-items: center;
    gap: 8px;
    color: #636e72;
    font-size: 0.9rem;
}

.meta-item i {
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
    font-size: 1.2rem;
    color: #636e72;
    line-height: 1.6;
    margin: 0;
    font-style: italic;
}

/* Post Image Card */
.post-image-card {
    margin-bottom: 30px;
    border-radius: 20px;
    overflow: hidden;
    box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
}

.post-image {
    width: 100%;
    height: 400px;
    object-fit: cover;
    display: block;
}

/* Post Content Card */
.post-content-card {
    background: white;
    border-radius: 20px;
    padding: 40px;
    box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
}

.post-content {
    line-height: 1.8;
    font-size: 1.1rem;
    color: #2d3436;
    margin-bottom: 40px;
}

.post-content p {
    margin-bottom: 20px;
}

.post-content h1, .post-content h2, .post-content h3, .post-content h4 {
    color: #667eea;
    margin: 30px 0 20px 0;
    font-weight: 700;
}

.post-content ul, .post-content ol {
    margin: 20px 0;
    padding-left: 30px;
}

.post-content li {
    margin-bottom: 8px;
}

.post-actions {
    padding-top: 30px;
    border-top: 2px solid #f8f9fa;
}

.back-btn {
    display: inline-flex;
    align-items: center;
    gap: 10px;
    background: linear-gradient(135deg, #a18cd1, #8b7cc6);
    color: white;
    padding: 12px 25px;
    border-radius: 25px;
    text-decoration: none;
    font-weight: 600;
    transition: all 0.3s ease;
}

.back-btn:hover {
    color: white;
    text-decoration: none;
    transform: translateX(-5px);
    box-shadow: 0 6px 20px rgba(161, 140, 209, 0.3);
}

/* Sidebar Styles */
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
}

.sidebar-header i {
    font-size: 1.4rem;
}

.sidebar-header h3 {
    margin: 0;
    font-size: 1.2rem;
    font-weight: 700;
}

.topic-display {
    padding: 25px;
}

.current-topic {
    display: flex;
    align-items: center;
    gap: 15px;
    padding: 20px;
    background: linear-gradient(135deg, #f8f9fa, #e9ecef);
    border-radius: 15px;
    text-decoration: none;
    color: #2d3436;
    transition: all 0.3s ease;
}

.current-topic:hover {
    color: #a18cd1;
    text-decoration: none;
    transform: translateX(5px);
}

.topic-icon {
    width: 40px;
    height: 40px;
    background: linear-gradient(135deg, #a18cd1, #8b7cc6);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    color: white;
    font-size: 1rem;
}

.topic-name {
    flex-grow: 1;
    font-weight: 600;
    font-size: 1.1rem;
}

.topic-link {
    color: #a18cd1;
    font-size: 1rem;
}

.related-posts-list {
    padding: 25px;
}

.related-post-item {
    padding: 15px 0;
    border-bottom: 1px solid #f8f9fa;
}

.related-post-item:last-child {
    border-bottom: none;
}

.related-post-item h6 {
    margin: 0 0 8px 0;
}

.related-post-item a {
    color: #2d3436;
    text-decoration: none;
    font-weight: 600;
    transition: color 0.3s ease;
}

.related-post-item a:hover {
    color: #a18cd1;
    text-decoration: none;
}

/* Responsive Design */
@media (max-width: 768px) {
    .post-title {
        font-size: 2rem;
    }
    
    .post-title-card {
        padding: 25px;
    }
    
    .post-content-card {
        padding: 25px;
    }
    
    .post-image {
        height: 250px;
    }
    
    .post-meta {
        gap: 15px;
    }
    
    .sidebar-section {
        margin-bottom: 20px;
    }
}

@media (max-width: 576px) {
    .post-title {
        font-size: 1.6rem;
    }
    
    .post-title-card {
        padding: 20px;
    }
    
    .post-content-card {
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
</style>
@endsection
