<!DOCTYPE html>
<html lang="en">

  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
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
    
    <style>
        /* Điều chỉnh khoảng cách giữa các section - GIẢM TỐI ĐA */
        main .container-fluid, footer .container-fluid {
            padding-top: 5px !important;
            padding-bottom: 5px !important;
        }
        
        /* Navbar container padding = 0 */
        .navbar, .navbar .container, .navbar .container-fluid {
            padding-left: 0 !important;
            padding-right: 0 !important;
            padding-top: 0 !important;
            padding-bottom: 0 !important;
        }
        
        .section-spacing {
            margin-bottom: 10px;
        }
        
        /* Giảm padding cho các card và component */
        .card {
            margin-bottom: 10px;
        }
        
        /* Điều chỉnh spacing cho main content - GIẢM TỐI ĐA */
        main .container, main .container-fluid {
            padding-top: 5px;
            padding-bottom: 5px;
        }
        
        /* Giảm margin cho footer */
        footer {
            margin-top: 10px !important;
        }
    </style>

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
                  class="form-control py-2 px-3 rounded"
                  style="border: 1px solid #a18cd1; height: 40px;"
                  value="{{ request('search_query') }}"
              />
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
                    if (Auth::check()) {
                        $count = App\Models\Cart::where('user_id', Auth::id())->sum('quantity');
                    } else {
                        $count = 0; // No cart for unauthenticated users
                    }
                @endphp
                <i class="bi bi-cart"></i> Giỏ hàng (<span id="showqty">{{$count}}</span>)
            </a>
        </div>
      </nav>
      <div class="alignt-item-center">
        <x-main-menu/>
      </div>
    </header>
    <main style="background: #f8f9fa; padding-top: 5px;">
        @yield('content')
    </main>
    <footer style="margin-top: 5px;">
    <div class="container-fluid bg-dark text-light py-4" style="background: linear-gradient(90deg, #a18cd1 0%, #fbc2eb 100%);">
        <div class="container">
            <div class="row g-4">
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
    
    <!-- Toastr JS (must be after jQuery) -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    <script src="{{ asset('vendor/flasher/flasher-toastr.min.js') }}"></script>
    
    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
    
    <!-- Global Cart Functions -->
    <script>
        // Setup CSRF token for AJAX requests
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        
        function quickAddToCart(productid) {
            console.log('quickAddToCart called with productid:', productid); // Debug log
            
            // Find the button element properly
            let button = event.target;
            
            // If user clicked on the icon inside the button, get the parent button
            if (!button.classList.contains('add-to-cart-btn')) {
                button = button.closest('.add-to-cart-btn');
            }
            
            if (!button) {
                console.error('Button not found');
                return;
            }
            
            console.log('Button found:', button.className); // Debug log
            
            const originalHTML = button.innerHTML;
            
            console.log('Adding product to cart:', productid); // Debug log
            
            // Show loading state
            button.innerHTML = '<i class="fa fa-spinner fa-spin"></i> Đang thêm...';
            button.disabled = true;
            
            $.ajax({
                url: '{{ route('site.cart.addcart') }}',
                type: "GET",
                data: {
                    productid: productid,
                    qty: 1  // Default quantity for quick add
                },
                timeout: 10000, // 10 second timeout
                cache: false, // Prevent caching
                success: function(response) {
                    console.log('Cart response:', response); // Debug log
                    
                    try {
                        if (response.success) {
                            // Update cart count displays
                            $('#showqty').text(response.cart_count);
                            $('.cart-count').text(response.cart_count);
                            
                            // Show success notification
                            if (response.toastr_type === 'success') {
                                toastr.success(response.message && !/add(ed)? to cart|successfully|thành công/i.test(response.message) ? response.message : 'Thêm vào giỏ hàng thành công!');
                            } else if (response.toastr_type === 'warning') {
                                toastr.warning(response.message && !/warning|cảnh báo/i.test(response.message) ? response.message : 'Có cảnh báo khi thêm vào giỏ hàng!');
                            } else {
                                toastr.error(response.message && !/error|failed|lỗi/i.test(response.message) ? response.message : 'Có lỗi xảy ra khi thêm vào giỏ hàng.');
                            }
                        } else {
                            // Handle different message types
                            if (response.toastr_type === 'warning') {
                                toastr.warning(response.message);
                            } else {
                                toastr.error(response.message || 'Có lỗi xảy ra khi thêm vào giỏ hàng.');
                            }
                            
                            // Handle redirect (e.g., to login page)
                            if (response.redirect) {
                                setTimeout(function() {
                                    window.location.href = response.redirect;
                                }, 1500);
                            }
                        }
                    } catch (e) {
                        console.error('Error processing response:', e);
                        toastr.error('Có lỗi xảy ra khi xử lý phản hồi.');
                    }
                },
                error: function(xhr, status, error) {
                    console.error('Cart AJAX Error:', {xhr, status, error}); // Debug log
                    console.error('Response Text:', xhr.responseText); // Debug log
                    
                    if (status === 'timeout') {
                        toastr.error('Hết thời gian chờ, vui lòng thử lại.');
                    } else if (status === 'abort') {
                        toastr.error('Yêu cầu bị hủy.');
                    } else {
                        toastr.error('Có lỗi xảy ra khi thêm vào giỏ hàng: ' + error);
                    }
                },
                complete: function() {
                    console.log('AJAX request completed'); // Debug log
                    // Restore button state (always execute this)
                    try {
                        button.innerHTML = originalHTML;
                        button.disabled = false;
                    } catch (e) {
                        console.error('Error restoring button state:', e);
                        // Fallback restoration
                        button.innerHTML = '<i class="fa fa-shopping-cart me-1"></i> Thêm vào giỏ';
                        button.disabled = false;
                    }
                }
            });
        }
    </script>
    
    @yield('footer')
  </body>
</html>
