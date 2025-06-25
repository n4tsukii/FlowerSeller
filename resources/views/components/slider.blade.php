<div class="section_slider slider-container">
    <div id="carouselExample" class="carousel slide carousel-fade shadow-lg rounded-4 overflow-hidden" data-bs-ride="carousel" data-bs-interval="3000" style="border-radius: 24px;">
        <div class="carousel-inner">
            @foreach ($list_banner as $row)
                @if ($loop->first)
                    <div class="carousel-item active">
                        <img src="{{ asset('images/banners/' . $row->image) }}" class="d-block w-100 h-100 slider-img" alt="{{ $row->image }}">
                    </div>
                @else
                    <div class="carousel-item">
                        <img src="{{ asset('images/banners/' . $row->image) }}" class="d-block w-100 h-100 slider-img" alt="{{ $row->image }}">
                    </div>
                @endif
            @endforeach
        </div>
        <button class="carousel-control-prev custom-carousel-btn" type="button" data-bs-target="#carouselExample" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true" style="background-color: #a18cd1; border-radius: 50%;"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next custom-carousel-btn" type="button" data-bs-target="#carouselExample" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true" style="background-color: #a18cd1; border-radius: 50%;"></span>
            <span class="visually-hidden">Next</span>
        </button>
        <div class="carousel-indicators mb-3">
            @foreach ($list_banner as $row)
                <button type="button" data-bs-target="#carouselExample" data-bs-slide-to="{{ $loop->index }}" class="{{ $loop->first ? 'active' : '' }}" aria-current="{{ $loop->first ? 'true' : 'false' }}" aria-label="Slide {{ $loop->iteration }}"></button>
            @endforeach
        </div>
    </div>
</div>

<style>
    .slider-container {
        width: 100%;
        max-width: 1200px;
        margin: 0 auto 24px auto;
        height: 380px;
        border-radius: 24px;
        box-shadow: 0 8px 32px rgba(161,140,209,0.13), 0 1.5px 8px rgba(0,0,0,0.06);
        background: #fff;
    }
    .slider-img {
        width: 100% !important;
        height: 380px !important;
        object-fit: cover;
        border-radius: 24px;
        transition: transform 0.4s cubic-bezier(.4,2.3,.3,1);
    }
    .carousel-item.active .slider-img,
    .carousel-item .slider-img:hover {
        transform: scale(1.01);
    }
    .carousel-control-prev,
    .carousel-control-next {
        width: 48px;
        height: 48px;
        top: 50%;
        transform: translateY(-50%);
        opacity: 0.85;
    }
    .custom-carousel-btn span {
        width: 36px !important;
        height: 36px !important;
        background-size: 60% 60% !important;
        background-position: center !important;
        background-repeat: no-repeat !important;
    }
    .carousel-indicators [data-bs-target] {
        width: 12px;
        height: 12px;
        border-radius: 50%;
        background: #a18cd1;
        opacity: 0.5;
        margin: 0 4px;
        border: none;
        transition: opacity 0.2s, background 0.2s;
    }
    .carousel-indicators .active {
        opacity: 1;
        background: #fbc2eb;
        border: 2px solid #a18cd1;
    }
    @media (max-width: 900px) {
        .slider-container, .slider-img { height: 220px !important; }
    }
    @media (max-width: 600px) {
        .slider-container, .slider-img { height: 120px !important; }
    }
</style>
