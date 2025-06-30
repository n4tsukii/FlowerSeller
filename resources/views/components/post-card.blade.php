@props(['post'])

<div class="modern-post-card">
    <div class="post-image-container">
        <a href="{{ route('site.post.detail', ['slug' => $post->slug]) }}">
            <img src="{{ asset('images/posts/' . $post->image) }}" alt="{{ $post->title }}" class="post-image" loading="lazy">
        </a>
        <div class="post-date-badge">
            {{ $post->created_at->format('d') }}
            <small>{{ $post->created_at->format('M') }}</small>
        </div>
    </div>
    
    <div class="post-content">
        <div class="post-meta">
            @if($post->topic)
                <span class="post-topic">{{ $post->topic->name }}</span>
            @endif
            <span class="post-read-time">
                <i class="fas fa-clock"></i>
                {{ ceil(str_word_count(strip_tags($post->detail ?? $post->description)) / 200) }} phút đọc
            </span>
        </div>
        
        <h3 class="post-title">
            <a href="{{ route('site.post.detail', ['slug' => $post->slug]) }}">{{ $post->title }}</a>
        </h3>
        
        <p class="post-excerpt">{{ Str::limit(strip_tags($post->description), 100) }}</p>
        
        <div class="post-footer">
            <div class="post-author">
                <i class="fas fa-user-circle"></i>
                <span>Admin</span>
            </div>
            <a href="{{ route('site.post.detail', ['slug' => $post->slug]) }}" class="read-more-link">
                Đọc thêm
                <i class="fas fa-arrow-right"></i>
            </a>
        </div>
    </div>
</div>

<style>
.modern-post-card {
    background: #ffffff;
    border-radius: 20px;
    box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
    overflow: hidden;
    transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    position: relative;
    height: 100%;
    min-height: 480px;
    display: flex;
    flex-direction: column;
}

.modern-post-card:hover {
    transform: translateY(-8px);
    box-shadow: 0 12px 40px rgba(161, 140, 209, 0.15);
}

.post-image-container {
    position: relative;
    overflow: hidden;
    border-radius: 20px 20px 0 0;
    background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
}

.post-image {
    width: 100%;
    height: 240px;
    object-fit: cover;
    object-position: center;
    transition: transform 0.3s ease;
}

.modern-post-card:hover .post-image {
    transform: scale(1.05);
}

.post-date-badge {
    position: absolute;
    top: 15px;
    right: 15px;
    background: rgba(255, 255, 255, 0.95);
    color: #2d3436;
    padding: 10px 12px;
    border-radius: 12px;
    text-align: center;
    font-weight: 700;
    font-size: 0.9rem;
    line-height: 1.2;
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
    backdrop-filter: blur(10px);
}

.post-date-badge small {
    display: block;
    font-size: 0.7rem;
    color: #636e72;
    font-weight: 500;
}

.post-content {
    padding: 25px 20px 20px;
    flex-grow: 1;
    display: flex;
    flex-direction: column;
}

.post-meta {
    display: flex;
    align-items: center;
    justify-content: space-between;
    margin-bottom: 15px;
    flex-wrap: wrap;
    gap: 10px;
}

.post-topic {
    background: linear-gradient(135deg, #a18cd1, #8b7cc6);
    color: white;
    padding: 6px 12px;
    border-radius: 15px;
    font-size: 0.75rem;
    font-weight: 600;
    text-transform: uppercase;
    letter-spacing: 0.5px;
}

.post-read-time {
    color: #636e72;
    font-size: 0.8rem;
    display: flex;
    align-items: center;
    gap: 5px;
}

.post-read-time i {
    font-size: 0.75rem;
}

.post-title {
    margin: 0 0 15px 0;
    font-size: 1.1rem;
    font-weight: 700;
    line-height: 1.4;
    min-height: 2.8rem; /* Ensure consistent title height */
}

.post-title a {
    color: #2d3436;
    text-decoration: none;
    transition: color 0.3s ease;
    display: -webkit-box;
    -webkit-line-clamp: 2;
    -webkit-box-orient: vertical;
    overflow: hidden;
}

.post-title a:hover {
    color: #a18cd1;
}

.post-excerpt {
    color: #636e72;
    font-size: 0.9rem;
    line-height: 1.6;
    margin: 0 0 20px 0;
    min-height: 4.8rem; /* Ensure consistent excerpt height */
    display: -webkit-box;
    -webkit-line-clamp: 3;
    -webkit-box-orient: vertical;
    overflow: hidden;
}

.post-footer {
    display: flex;
    align-items: center;
    justify-content: space-between;
    margin-top: auto;
    padding-top: 15px;
    border-top: 1px solid #f8f9fa;
}

.post-author {
    display: flex;
    align-items: center;
    gap: 8px;
    color: #636e72;
    font-size: 0.85rem;
    font-weight: 500;
}

.post-author i {
    color: #a18cd1;
    font-size: 1rem;
}

.read-more-link {
    color: #a18cd1;
    text-decoration: none;
    font-weight: 600;
    font-size: 0.9rem;
    display: flex;
    align-items: center;
    gap: 5px;
    transition: all 0.3s ease;
}

.read-more-link:hover {
    color: #8b7cc6;
    transform: translateX(3px);
}

.read-more-link i {
    font-size: 0.8rem;
    transition: transform 0.3s ease;
}

.read-more-link:hover i {
    transform: translateX(3px);
}

/* Responsive adjustments */
@media (max-width: 768px) {
    .modern-post-card {
        min-height: 420px;
    }
    
    .post-image {
        height: 200px;
    }
    
    .post-content {
        padding: 20px 15px 15px;
    }
    
    .post-title {
        font-size: 1rem;
        min-height: 2.4rem;
    }
    
    .post-excerpt {
        min-height: 4.2rem;
    }
    
    .post-meta {
        flex-direction: column;
        align-items: flex-start;
        gap: 8px;
    }
}

@media (max-width: 576px) {
    .modern-post-card {
        margin-bottom: 20px;
        min-height: 380px;
    }
    
    .post-image {
        height: 180px;
    }
    
    .post-title {
        min-height: 2.2rem;
    }
    
    .post-excerpt {
        min-height: 3.8rem;
    }
    
    .post-footer {
        flex-direction: column;
        gap: 10px;
        align-items: flex-start;
    }
}
</style>