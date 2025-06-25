@props(['post'])

<div class="card post-card shadow-sm border-0">
    <a href="{{ route('site.post.detail', ['slug' => $post->slug]) }}">
        <img src="{{ asset('images/posts/' . $post->image) }}" alt="{{ $post->title }}"
            class="card-img-top post-image" loading="lazy">
    </a>
    <div class="card-body bg-light d-flex flex-column">
        <h5 class="post-title mb-1">
            <a href="{{ route('site.post.detail', ['slug' => $post->slug]) }}">{{ $post->title }}</a>
        </h5>
        <p class="text-muted mb-1" style="font-size: 0.95rem;">{{ Str::limit($post->description, 80) }}</p>
    </div>
</div>

<style>
    .post-card {
        border-radius: 18px;
        overflow: hidden;
        transition: all 0.25s ease-in-out;
        height: 100%;
        background: #fff;
    }

    .post-card:hover {
        box-shadow: 0 12px 28px rgba(0, 0, 0, 0.08), 0 4px 12px rgba(161, 140, 209, 0.2);
        transform: translateY(-4px);
    }

    .post-image {
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

    .post-title a {
        color: #6c5ce7;
        font-weight: 700;
        font-size: 1.1rem;
        text-decoration: none;
        transition: color 0.2s;
    }

    .post-title a:hover {
        color: #341f97;
    }

    a {
        text-decoration: none !important;
    }
</style>