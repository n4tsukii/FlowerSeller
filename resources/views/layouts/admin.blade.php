<!DOCTYPE html>
<html lang="vi" data-bs-theme="light">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>@yield('title') - FlowerSeller Admin</title>
  
  <!-- Google Fonts -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap">
  
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
  
  <!-- Bootstrap 5 -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  
  <!-- AdminLTE -->
  <link rel="stylesheet" href="{{ asset('assets/admin/dist/css/adminlte.min.css') }}">
  
  <!-- Custom Admin Styles -->
  <style>
    :root {
      --primary-color: #667eea;
      --secondary-color: #764ba2;
      --success-color: #06d6a0;
      --warning-color: #f9844a;
      --danger-color: #ee6c4d;
      --info-color: #3d5af1;
      --dark-color: #212529;
      --light-color: #f8f9fa;
      --sidebar-width: 280px;
    }
    
    body {
      font-family: 'Inter', sans-serif;
      background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
      min-height: 100vh;
    }
    
    .wrapper {
      background: white;
      border-radius: 15px;
      margin: 10px;
      box-shadow: 0 10px 30px rgba(0,0,0,0.1);
      overflow: hidden;
    }
    
    /* Header */
    .main-header {
      background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
      border: none;
      box-shadow: 0 2px 10px rgba(0,0,0,0.1);
    }
    
    .main-header .navbar-nav .nav-link {
      color: white !important;
      font-weight: 500;
      transition: all 0.3s ease;
    }
    
    .main-header .navbar-nav .nav-link:hover {
      background: rgba(255,255,255,0.1);
      border-radius: 8px;
      transform: translateY(-2px);
    }
    
    /* Sidebar */
    .main-sidebar {
      background: linear-gradient(180deg, #2c3e50 0%, #34495e 100%);
      box-shadow: 2px 0 10px rgba(0,0,0,0.1);
    }
    
    .brand-link {
      background: rgba(255,255,255,0.1);
      border-bottom: 1px solid rgba(255,255,255,0.1);
      color: white !important;
      padding: 15px;
    }
    
    .brand-text {
      font-size: 1.2rem;
      font-weight: 600;
    }
    
    .user-panel {
      border-bottom: 1px solid rgba(255,255,255,0.1);
      padding: 15px;
    }
    
    .user-panel .info a {
      color: white;
      font-weight: 500;
    }
    
    /* Navigation */
    .nav-sidebar .nav-item > .nav-link {
      color: rgba(255,255,255,0.8);
      border-radius: 8px;
      margin: 2px 10px;
      transition: all 0.3s ease;
      font-weight: 500;
    }
    
    .nav-sidebar .nav-item > .nav-link:hover,
    .nav-sidebar .nav-item > .nav-link.active {
      background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
      color: white;
      transform: translateX(5px);
      box-shadow: 0 4px 15px rgba(102, 126, 234, 0.4);
    }
    
    .nav-treeview .nav-link {
      color: rgba(255,255,255,0.7);
      padding-left: 50px;
      border-radius: 8px;
      margin: 1px 10px;
    }
    
    .nav-treeview .nav-link:hover {
      background: rgba(255,255,255,0.1);
      color: white;
    }
    
    /* Content */
    .content-wrapper {
      background: #f8f9fa;
      margin-left: var(--sidebar-width);
      border-radius: 0 0 15px 0;
    }
    
    .content-header {
      background: white;
      border-radius: 15px;
      margin: 15px;
      padding: 20px;
      box-shadow: 0 2px 10px rgba(0,0,0,0.05);
    }
    
    .content-header h1 {
      color: var(--dark-color);
      font-weight: 600;
      margin: 0;
    }
    
    .breadcrumb {
      background: transparent;
      margin: 0;
    }
    
    .breadcrumb-item + .breadcrumb-item::before {
      content: "→";
      color: var(--primary-color);
    }
    
    /* Cards */
    .card {
      border: none;
      border-radius: 15px;
      box-shadow: 0 4px 20px rgba(0,0,0,0.08);
      margin: 15px;
      overflow: hidden;
    }
    
    .card-header {
      background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
      border-bottom: 1px solid rgba(0,0,0,0.05);
      padding: 20px;
    }
    
    /* Buttons */
    .btn {
      border-radius: 8px;
      font-weight: 500;
      padding: 8px 16px;
      transition: all 0.3s ease;
    }
    
    .btn-success {
      background: linear-gradient(135deg, var(--success-color), #00b894);
      border: none;
    }
    
    .btn-danger {
      background: linear-gradient(135deg, var(--danger-color), #d63031);
      border: none;
    }
    
    .btn-primary {
      background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
      border: none;
    }
    
    .btn-gradient-warning {
      background: linear-gradient(135deg, #ffc107, #e0a800);
      border: none;
      color: #212529;
    }
    
    .btn:hover {
      transform: translateY(-2px);
      box-shadow: 0 4px 15px rgba(0,0,0,0.2);
    }
    
    /* Table */
    .table {
      border-radius: 10px;
      overflow: hidden;
    }
    
    .table thead th {
      background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
      color: white;
      border: none;
      font-weight: 600;
      padding: 15px;
    }
    
    .table tbody tr {
      transition: all 0.3s ease;
    }
    
    .table tbody tr:hover {
      background: rgba(102, 126, 234, 0.05);
      transform: scale(1.01);
    }
    
    /* Footer */
    .main-footer {
      background: white;
      border-top: 1px solid rgba(0,0,0,0.05);
      margin-left: var(--sidebar-width);
      border-radius: 0 0 15px 0;
      padding: 15px;
    }
    
    /* Alert */
    .alert {
      border: none;
      border-radius: 10px;
      margin: 15px;
      box-shadow: 0 4px 15px rgba(0,0,0,0.1);
    }
    
    .alert-success {
      background: linear-gradient(135deg, var(--success-color), #00b894);
      color: white;
    }
    
    /* Enhanced UI Styles */
    .btn-gradient-primary {
      background: linear-gradient(135deg, #007bff, #0056b3);
      border: none;
    }
    
    .btn-gradient-success {
      background: linear-gradient(135deg, #28a745, #1e7e34);
      border: none;
    }
    
    .hover-lift {
      transition: transform 0.2s ease, box-shadow 0.2s ease;
    }
    
    .hover-lift:hover {
      transform: translateY(-2px);
      box-shadow: 0 4px 15px rgba(0,0,0,0.2);
    }
    
    .text-gradient {
      background: linear-gradient(135deg, #007bff, #28a745);
      -webkit-background-clip: text;
      -webkit-text-fill-color: transparent;
      background-clip: text;
    }
    
    .bg-gradient-primary {
      background: linear-gradient(135deg, #007bff, #0056b3) !important;
    }
    
    .bg-gradient-success {
      background: linear-gradient(135deg, #28a745, #1e7e34) !important;
    }
    
    .bg-gradient-info {
      background: linear-gradient(135deg, #17a2b8, #117a8b) !important;
    }
    
    .bg-gradient-warning {
      background: linear-gradient(135deg, #ffc107, #e0a800) !important;
    }
    
    .bg-gradient-danger {
      background: linear-gradient(135deg, #dc3545, #c82333) !important;
    }
    
    /* Table enhancements */
    .table-hover tbody tr:hover {
      background-color: rgba(0,123,255,0.1);
      transform: scale(1.01);
      transition: all 0.3s ease;
    }
    
    /* Card animations */
    .card {
      transition: transform 0.3s ease, box-shadow 0.3s ease;
    }
    
    .card:hover {
      transform: translateY(-2px);
      box-shadow: 0 8px 25px rgba(0,0,0,0.15);
    }
    
    /* Form enhancements */
    .form-control:focus,
    .form-select:focus {
      border-color: #007bff;
      box-shadow: 0 0 0 0.2rem rgba(0,123,255,0.25);
    }
    
    /* Badge styles */
    .badge {
      font-size: 0.75em;
      padding: 0.5em 0.75em;
    }
    
    /* Sidebar responsive */
    @media (max-width: 768px) {
      .main-sidebar {
        margin-left: -250px;
      }
      
      .sidebar-open .main-sidebar {
        margin-left: 0;
      }
      
      .content-wrapper {
        margin-left: 0;
      }
    }
    
    /* Animation keyframes */
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
    
    .animate-fade-in-up {
      animation: fadeInUp 0.6s ease-out;
    }
    
    /* Pagination styling */
    .pagination .page-link {
      border-radius: 50px !important;
      margin: 0 2px;
      border: 1px solid #dee2e6;
    }
    
    .pagination .page-item.active .page-link {
      background: linear-gradient(135deg, #007bff, #0056b3);
      border-color: #007bff;
    }
  </style>
</head>
<body class="hold-transition sidebar-mini">

<div class="wrapper">
  <!-- Header -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button">
          <i class="fas fa-bars"></i>
        </a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="{{route('admin.dashboard.index')}}" class="nav-link">
          <i class="fas fa-home me-2"></i>Trang chủ
        </a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="#" class="nav-link">
          <i class="fas fa-chart-line me-2"></i>Thống kê
        </a>
      </li>
    </ul>
    
    <!-- Right navbar links -->
    <ul class="navbar-nav ms-auto">
      <!-- User Menu -->
      <li class="nav-item dropdown">
        <a class="nav-link" data-bs-toggle="dropdown" href="#" aria-expanded="false">
          <i class="far fa-user"></i> Admin
          <i class="fas fa-caret-down ms-1"></i>
        </a>
        <div class="dropdown-menu dropdown-menu-end">
          <a href="#" class="dropdown-item">
            <i class="fas fa-user me-2"></i> Hồ sơ
          </a>
          <a href="#" class="dropdown-item">
            <i class="fas fa-cog me-2"></i> Cài đặt
          </a>
          <div class="dropdown-divider"></div>
          <a href="{{route('website.logout')}}" class="dropdown-item">
            <i class="fas fa-power-off me-2"></i> Đăng xuất
          </a>
        </div>
      </li>
    </ul>
  </nav>

  <!-- Sidebar -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="{{route('admin.dashboard.index')}}" class="brand-link">
      <i class="fas fa-seedling brand-image" style="font-size: 2rem; margin-right: 10px;"></i>
      <span class="brand-text">FlowerSeller</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- User panel -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <div class="rounded-circle bg-primary d-flex align-items-center justify-content-center" style="width: 40px; height: 40px;">
            <i class="fas fa-user text-white"></i>
          </div>
        </div>
        <div class="info">
          <a href="#" class="d-block">Quản trị viên</a>
          <small class="text-muted">
            <i class="fas fa-circle text-success" style="font-size: 8px;"></i> Trực tuyến
          </small>
        </div>
      </div>

      <!-- Navigation Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          
          <!-- Dashboard -->
          <li class="nav-item">
            <a href="{{route('admin.dashboard.index')}}" class="nav-link">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>Dashboard</p>
            </a>
          </li>

          <!-- Products Section -->
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-boxes"></i>
              <p>
                Quản lý sản phẩm
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{route('admin.product.index')}}" class="nav-link">
                  <i class="fas fa-box nav-icon"></i>
                  <p>Danh sách sản phẩm</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{route('admin.category.index')}}" class="nav-link">
                  <i class="fas fa-tags nav-icon"></i>
                  <p>Danh mục</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{route('admin.brand.index')}}" class="nav-link">
                  <i class="fas fa-trademark nav-icon"></i>
                  <p>Thương hiệu</p>
                </a>
              </li>
            </ul>
          </li>

          <!-- Posts Section -->
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-newspaper"></i>
              <p>
                Quản lý bài viết
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{route('admin.post.index')}}" class="nav-link">
                  <i class="fas fa-edit nav-icon"></i>
                  <p>Tất cả bài viết</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{route('admin.topic.index')}}" class="nav-link">
                  <i class="fas fa-hashtag nav-icon"></i>
                  <p>Chủ đề</p>
                </a>
              </li>
            </ul>
          </li>

          <!-- Orders -->
          <li class="nav-item">
            <a href="{{route('admin.order.index')}}" class="nav-link">
              <i class="fas fa-shopping-cart nav-icon"></i>
              <p>Đơn hàng</p>
            </a>
          </li>

          <!-- Contact -->
          <li class="nav-item">
            <a href="{{route('admin.contact.index')}}" class="nav-link">
              <i class="fas fa-envelope nav-icon"></i>
              <p>Liên hệ</p>
            </a>
          </li>

          <!-- Interface Section -->
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-palette"></i>
              <p>
                Giao diện
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{route('admin.menu.index')}}" class="nav-link">
                  <i class="fas fa-bars nav-icon"></i>
                  <p>Menu</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{route('admin.banner.index')}}" class="nav-link">
                  <i class="fas fa-image nav-icon"></i>
                  <p>Banner</p>
                </a>
              </li>
            </ul>
          </li>

          <!-- Users Section -->
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-users"></i>
              <p>
                Người dùng
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{route('admin.user.index')}}" class="nav-link">
                  <i class="fas fa-user-friends nav-icon"></i>
                  <p>Danh sách người dùng</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{route('admin.user.create')}}" class="nav-link">
                  <i class="fas fa-user-plus nav-icon"></i>
                  <p>Thêm người dùng</p>
                </a>
              </li>
            </ul>
          </li>
          <!-- Kết thúc Users Section -->
        </ul>
      </nav>
    </div>
  </aside>
  <!-- Success Alert -->
  @if(Session::has('success'))
  <div class="alert alert-success alert-dismissible fade show" role="alert">
    <i class="fas fa-check-circle me-2"></i>
    {{Session::get('success')}}
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
  </div>
  @endif

  <!-- Error Alert -->
  @if(Session::has('error'))
  <div class="alert alert-danger alert-dismissible fade show" role="alert">
    <i class="fas fa-exclamation-circle me-2"></i>
    {{Session::get('error')}}
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
  </div>
  @endif

  <!-- Main Content -->
  @yield('content')

  <!-- Footer -->
  <footer class="main-footer">
    <div class="float-right d-none d-sm-block">
      <b>Version</b> 2.0.0
    </div>
    <strong>Copyright &copy; 2024 <a href="#" style="color: var(--primary-color);">FlowerSeller Admin</a>.</strong>
    Tất cả các quyền được bảo lưu.
  </footer>

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
  </aside>
</div>

<!-- Scripts -->
<!-- jQuery -->
<script src="{{ asset('assets/admin/plugins/jquery/jquery.min.js') }}"></script>

<!-- Bootstrap 5 -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

<!-- AdminLTE -->
<script src="{{ asset('assets/admin/dist/js/adminlte.min.js') }}"></script>

<!-- Custom Admin Scripts -->
<script>
// Add loading state to buttons
document.addEventListener('DOMContentLoaded', function() {
  const forms = document.querySelectorAll('form');
  forms.forEach(function(form) {
    form.addEventListener('submit', function(e) {
      const submitBtn = this.querySelector('button[type="submit"]');
      if (submitBtn) {
        // Set loading state
        const originalText = submitBtn.innerHTML;
        submitBtn.innerHTML = '<span class="spinner-border spinner-border-sm me-2"></span>Đang xử lý...';
        submitBtn.disabled = true;
        
        // Re-enable button after timeout in case of error
        setTimeout(() => {
          submitBtn.innerHTML = originalText;
          submitBtn.disabled = false;
        }, 10000); // 10 seconds timeout
      }
    });
  });
});

// Enhanced table interactions
document.addEventListener('DOMContentLoaded', function() {
  const tableRows = document.querySelectorAll('.table tbody tr');
  tableRows.forEach(function(row) {
    row.addEventListener('click', function(e) {
      if (!e.target.closest('a, button')) {
        row.classList.toggle('table-active');
      }
    });
  });
});

// Sidebar mobile toggle
document.addEventListener('DOMContentLoaded', function() {
  const sidebarToggle = document.querySelector('[data-widget="pushmenu"]');
  const sidebar = document.querySelector('.main-sidebar');
  
  if (window.innerWidth <= 768) {
    sidebarToggle.addEventListener('click', function() {
      sidebar.classList.toggle('sidebar-open');
    });
  }
});

// Smooth scroll for anchor links
document.addEventListener('DOMContentLoaded', function() {
  const anchorLinks = document.querySelectorAll('a[href^="#"]');
  anchorLinks.forEach(function(link) {
    link.addEventListener('click', function(e) {
      e.preventDefault();
      const target = document.querySelector(this.getAttribute('href'));
      if (target) {
        target.scrollIntoView({
          behavior: 'smooth',
          block: 'start'
        });
      }
    });
  });
});

// Add tooltips to all elements with title attribute
document.addEventListener('DOMContentLoaded', function() {
  const tooltipElements = document.querySelectorAll('[title]');
  tooltipElements.forEach(function(element) {
    new bootstrap.Tooltip(element);
  });
});

// Add confirmation to delete actions
document.addEventListener('DOMContentLoaded', function() {
  const deleteLinks = document.querySelectorAll('a[href*="delete"], a[href*="destroy"]');
  deleteLinks.forEach(function(link) {
    link.addEventListener('click', function(e) {
      if (!confirm('Bạn có chắc chắn muốn xóa không?')) {
        e.preventDefault();
      }
    });
  });
});

// UI Enhancement scripts
document.addEventListener('DOMContentLoaded', function() {
  const badges = document.querySelectorAll('.badge');
  badges.forEach(function(badge) {
    badge.style.animation = 'pulse 2s infinite';
  });
});

// Enhanced search functionality
function enhanceSearch() {
  const searchInputs = document.querySelectorAll('input[type="search"], input[placeholder*="Tìm kiếm"]');
  searchInputs.forEach(function(input) {
    input.addEventListener('input', function() {
      const searchTerm = this.value.toLowerCase();
      const table = this.closest('.card').querySelector('table tbody');
      if (table) {
        const rows = table.querySelectorAll('tr');
        rows.forEach(function(row) {
          const text = row.textContent.toLowerCase();
          row.style.display = text.includes(searchTerm) ? '' : 'none';
        });
      }
    });
  });
}

// Initialize enhanced search
document.addEventListener('DOMContentLoaded', enhanceSearch);
</script>

@stack('scripts')

</body>
</html>
