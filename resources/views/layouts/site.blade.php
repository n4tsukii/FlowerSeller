<!DOCTYPE html>
<html lang="en">

  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>@yield('title')</title>
    <link href="img/favicon.ico" rel="icon" />
    
    <link rel="preconnect" href="https://fonts.gstatic.com" />
    <link href="https://fonts.googleapis.com/css2?family=Jost:wght@500;600;700&family=Open+Sans:wght@400;600&display=swap" rel="stylesheet" />
    
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    
    <!-- Font Awesome CSS -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet" />
    
    <!-- Custom CSS -->
    <link href="{{ asset('assets/css/style.css') }}" rel="stylesheet" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    <script src="{{ asset('vendor/flasher/toastr.min.js') }}"></script>
    <script src="{{ asset('vendor/flasher/flasher-toastr.min.js') }}"></script>

  </head>
  <body>
    <header>
    <nav
        class="navbar navbar-expand-lg bg-white navbar-light shadow-sm py-3 py-lg-0 px-3 px-lg-0"
        style="background: linear-gradient(90deg, #a18cd1 0%, #fbc2eb 100%); border-bottom: 2px solid #a18cd1;"
      >
        <div class="navbar-brand-container d-flex align-items-center">
          <a href="{{route('site.home')}}" class="navbar-brand ms-lg-5" style="font-size: 2rem; font-weight: bold; color: #a18cd1;">
            <span class="logo-safe">Shop</span><span class="logo-cam" style="color: #fbc2eb;">Hoa</span>
          </a>
          <button
            class="navbar-toggler"
            type="button"
            data-bs-toggle="collapse"
            data-bs-target="#navbarCollapse"
          >
            <span class="navbar-toggler-icon"></span>
          </button>
        </div>
        <div class="nav-item search-container ms-3 me-3 flex-grow-1 d-flex align-items-center" style="height: 56px; pointer-events: none;">
          <form action="{{ route('site.product.search') }}" method="GET" class="d-flex align-items-center w-100" style="max-width: 400px; pointer-events: auto;">
              <input
                  type="text"
                  name="search_query"
                  placeholder="Tìm kiếm sản phẩm..."
                  class="form-control py-2 px-3 rounded-start"
                  style="border: 1px solid #a18cd1; border-right: none; height: 40px;"
                  value="{{ request('search_query') }}"
              />
              <button
                  type="submit"
                  class="btn d-flex align-items-center justify-content-center"
                  style="background: #a18cd1; border-radius: 0 6px 6px 0; border: 1px solid #a18cd1; border-left: none; height: 40px; width: 48px; min-width: 48px;"
              >
              </button>
          </form>
        </div>
        <div class="nav-item d-flex align-items-center">
            @if (Auth::check())
                @php
                    $user = Auth::user();
                @endphp
                <div class="dropdown">
                    <button class="btn btn-outline-primary me-2 dropdown-toggle" type="button" id="userDropdown" data-bs-toggle="dropdown" aria-expanded="false" style="border-color: #a18cd1; color: #a18cd1;">
                        <i class="bi bi-person"></i> {{ $user->name }}
                    </button>
                    <ul class="dropdown-menu" aria-labelledby="userDropdown">
                        <li><a class="dropdown-item" style="font-size: 15px !important; color: red !important;" href="{{ route('website.logout') }}">Logout</a></li>
                    </ul>
                </div>
            @else
                <button class="btn btn-outline-primary me-2" onclick="window.location='{{ route('website.getsignup') }}'" style="border-color: #a18cd1; color: #a18cd1;">
                    <i class="bi bi-person-plus"></i> Đăng ký
                </button>
                <button class="btn btn-outline-primary me-2" onclick="window.location='{{ route('website.getlogin') }}'" style="border-color: #a18cd1; color: #a18cd1;">
                    <i class="bi bi-person"></i> Đăng nhập
                </button>
            @endif

            <a class="btn btn-outline-primary" style="border-color: #a18cd1; color: #a18cd1;" href="{{route('site.cart.index')}}">
                @php
                    $count = count(session('carts',[]))
                @endphp
                <i class="bi bi-cart"></i> Giỏ hàng (<span id="showqty">{{$count}}</span>)
            </a>
        </div>
      </nav>
      <div class="alignt-item-center">
        <x-main-menu/>
      </div>
    </header>
    <main style="background: #f8f9fa;">
        @yield('content')
    </main>
    <footer>
    <div class="container-fluid bg-dark text-light py-5" style="background: linear-gradient(90deg, #a18cd1 0%, #fbc2eb 100%);">
        <div class="container">
            <div class="row g-5">
                <div class="col-lg-3 col-md-6">
                    <h3 class="text-white mb-4">Liên hệ</h3>
                    <p><i class="bi bi-geo-alt"></i> PKA College</p>
                    <p><i class="bi bi-envelope-open"></i> phamthuat@example.com</p>
                    <p><i class="bi bi-telephone"></i> +012 345 67890</p>
                </div>
                <div class="col-lg-3 col-md-6">
                    <h3 class="text-white mb-4">Theo dõi chúng tôi</h3>
                    <div class="social-links">
                        <a href="#" class="twitter"><i class="fab fa-twitter"></i></a>
                        <a href="#" class="facebook"><i class="fab fa-facebook-f"></i></a>
                        <a href="#" class="linkedin"><i class="fab fa-linkedin-in"></i></a>
                        <a href="#" class="instagram"><i class="fab fa-instagram"></i></a>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <h3 class="text-white mb-4">Chính sách</h3>                  
                    <x-footer-menu />
                </div>
            </div>
        </div>
    </div>
    <div class="container-fluid bg-primary text-light py-4" style="background: #a18cd1;">
        <div class="container">
            <div class="row">
                <div class="col-md-6 text-center text-md-start">
                    <p class="mb-md-0">&copy; <a href="#" style="color: #fff;">ShopHoa</a>. All Rights Reserved.</p>
                </div>
                <div class="col-md-6 text-center text-md-end">
                    <p class="mb-0">Designed by <a href="https://htmlcodex.com" style="color: #fff;">HTML Codex</a></p>
                </div>
            </div>
        </div>
    </div>
    </footer>
    <script>
      let slideIndex = 1;
      showSlides(slideIndex);
      function moveSlide(n) {
        showSlides((slideIndex += n));
      }
      function showSlides(n) {
        let i;
        let slides = document.getElementsByClassName("slide");
        if (n > slides.length) {
          slideIndex = 1;
        }
        if (n < 1) {
          slideIndex = slides.length;
        }
        for (i = 0; i < slides.length; i++) {
          slides[i].style.display = "none";
        }
        slides[slideIndex - 1].style.display = "block";
      }
    </script>
    <!-- Include jQuery from a CDN -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
    @yield('footer')
  </body>
</html>
    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
    @yield('footer')
  </body>
</html>
</html>
