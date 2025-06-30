@extends('layouts.admin')
@section('title','Dashboard')
@section('content')
<div class="content-wrapper">
    <!-- Content Header -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="text-gradient fw-bold">
              <i class="fas fa-tachometer-alt me-2"></i>Dashboard
            </h1>
            <p class="text-muted">Tổng quan hệ thống quản lý</p>
          </div>
          <div class="col-sm-6">
            <nav aria-label="breadcrumb" class="float-sm-right">
              <ol class="breadcrumb bg-transparent mb-0">
                <li class="breadcrumb-item active text-secondary">Dashboard</li>
              </ol>
            </nav>
          </div>
        </div>
      </div>
    </section>

    <section class="content">
      <div class="row">
        <!-- Stats Cards -->
        <div class="col-lg-3 col-6">
          <div class="small-box bg-info">
            <div class="inner">
              <h3>{{ $totalProducts ?? 0 }}</h3>
              <p>Sản phẩm</p>
            </div>
            <div class="icon">
              <i class="fas fa-box"></i>
            </div>
            <a href="{{ route('admin.product.index') }}" class="small-box-footer">
              Xem chi tiết <i class="fas fa-arrow-circle-right"></i>
            </a>
          </div>
        </div>
        
        <div class="col-lg-3 col-6">
          <div class="small-box bg-success">
            <div class="inner">
              <h3>{{ $totalOrders ?? 0 }}</h3>
              <p>Đơn hàng</p>
            </div>
            <div class="icon">
              <i class="fas fa-shopping-cart"></i>
            </div>
            <a href="{{ route('admin.order.index') }}" class="small-box-footer">
              Xem chi tiết <i class="fas fa-arrow-circle-right"></i>
            </a>
          </div>
        </div>
        
        <div class="col-lg-3 col-6">
          <div class="small-box bg-warning">
            <div class="inner">
              <h3>{{ $totalUsers ?? 0 }}</h3>
              <p>Khách hàng</p>
            </div>
            <div class="icon">
              <i class="fas fa-user-plus"></i>
            </div>
            <a href="{{ route('admin.user.index') }}" class="small-box-footer">
              Xem chi tiết <i class="fas fa-arrow-circle-right"></i>
            </a>
          </div>
        </div>
        
        <div class="col-lg-3 col-6">
          <div class="small-box bg-danger">
            <div class="inner">
              <h3>{{ $totalPosts ?? 0 }}</h3>
              <p>Bài viết</p>
            </div>
            <div class="icon">
              <i class="fas fa-blog"></i>
            </div>
            <a href="{{ route('admin.post.index') }}" class="small-box-footer">
              Xem chi tiết <i class="fas fa-arrow-circle-right"></i>
            </a>
          </div>
        </div>
      </div>

      <!-- Main Content -->
      <div class="row">
        <div class="col-12">
          <div class="card shadow-lg border-0 rounded-4">
            <div class="card-header bg-gradient-primary text-white">
              <h3 class="card-title mb-0">
                <i class="fas fa-chart-line me-2"></i>Báo cáo bán hàng
              </h3>
            </div>
            <div class="card-body">
              <div class="row">
                <div class="col-md-4">
                  <div class="info-box">
                    <span class="info-box-icon bg-info">
                      <i class="fas fa-money-bill-wave"></i>
                    </span>
                    <div class="info-box-content">
                      <span class="info-box-text">Tổng doanh thu</span>
                      <span class="info-box-number">{{ number_format($totalRevenue ?? 0, 0, ',', '.') }} đ</span>
                    </div>
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="info-box">
                    <span class="info-box-icon bg-success">
                      <i class="fas fa-shopping-cart"></i>
                    </span>
                    <div class="info-box-content">
                      <span class="info-box-text">Đơn hàng thành công</span>
                      <span class="info-box-number">{{ $totalOrdersSuccess ?? 0 }}</span>
                    </div>
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="info-box">
                    <span class="info-box-icon bg-warning">
                      <i class="fas fa-box"></i>
                    </span>
                    <div class="info-box-content">
                      <span class="info-box-text">Sản phẩm đã bán</span>
                      <span class="info-box-number">{{ $totalProductsSold ?? 0 }}</span>
                    </div>
                  </div>
                </div>
              </div>
              <div class="row mt-4">
                <div class="col-12 text-center">
                  <h4 class="text-muted">Chào mừng đến với Admin Panel</h4>
                  <p class="text-muted">Sử dụng menu bên trái để quản lý hệ thống</p>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
</div>

@push('styles')
<style>
.text-gradient {
  background: linear-gradient(135deg, #007bff, #28a745);
  -webkit-background-clip: text;
  -webkit-text-fill-color: transparent;
  background-clip: text;
}

.bg-gradient-primary {
  background: linear-gradient(135deg, #007bff, #0056b3) !important;
}

.small-box {
  transition: transform 0.3s ease, box-shadow 0.3s ease;
}

.small-box:hover {
  transform: translateY(-5px);
  box-shadow: 0 8px 25px rgba(0,0,0,0.15);
}

.info-box {
  transition: transform 0.3s ease;
}

.info-box:hover {
  transform: scale(1.05);
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

.animate-fade-in-up {
  animation: fadeInUp 0.6s ease-out;
}
</style>
@endpush

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
  // Animate cards on load
  const cards = document.querySelectorAll('.small-box, .info-box');
  cards.forEach((card, index) => {
    card.style.opacity = '0';
    card.style.transform = 'translateY(20px)';
    setTimeout(() => {
      card.style.transition = 'all 0.5s ease';
      card.style.opacity = '1';
      card.style.transform = 'translateY(0)';
    }, index * 100);
  });
});
</script>
@endpush

@endsection