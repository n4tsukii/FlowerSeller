@extends('layouts.admin')
@section('title','Quản lý sản phẩm')
@section('content')
<div class="content-wrapper">
    <!-- Content Header -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1><i class="fas fa-boxes me-2"></i>Quản lý sản phẩm</h1>
            <p class="text-muted">Danh sách tất cả sản phẩm trong hệ thống</p>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{route('admin.dashboard.index')}}">Trang chủ</a></li>
              <li class="breadcrumb-item active">Sản phẩm</li>
            </ol>
          </div>
        </div>
      </div>
    </section>

    <!-- Main content -->
    <section class="content">
      <!-- Statistics Cards -->
      <div class="row mb-3">
        <div class="col-lg-6 col-6">
          <div class="small-box bg-primary">
            <div class="inner">
              <h3>{{count($all_products)}}</h3>
              <p>Tổng sản phẩm</p>
            </div>
            <div class="icon">
              <i class="fas fa-box"></i>
            </div>
          </div>
        </div>
        <div class="col-lg-6 col-6">
          <div class="small-box bg-danger">
            <div class="inner">
              <h3>{{$all_products->where('qty', 0)->count()}}</h3>
              <p>Hết hàng</p>
            </div>
            <div class="icon">
              <i class="fas fa-exclamation-triangle"></i>
            </div>
          </div>
        </div>
      </div>

      <!-- Main Card -->
      <div class="card">
        <!-- Card Header -->
        <div class="card-header">
          <div class="row align-items-center">
            <div class="col-md-6">
              <h3 class="card-title mb-0">
                <i class="fas fa-list me-2"></i>Danh sách sản phẩm
                @if(request()->anyFilled(['search', 'category', 'status']))
                  <small class="text-muted">
                    - Tìm thấy {{ $list->total() }} kết quả
                    @if(request('search'))
                      cho "{{ request('search') }}"
                    @endif
                  </small>
                @endif
              </h3>
            </div>
            <div class="col-md-6 text-end">
              <div class="btn-group" role="group">
                <a href="{{route('admin.product.create')}}" class="btn btn-success">
                  <i class="fa fa-plus me-2"></i>Thêm sản phẩm
                </a>
                <a href="{{route('admin.product.trash')}}" class="btn btn-danger">
                  <i class="fa fa-trash me-2"></i>Thùng rác
                </a>
              </div>
            </div>
          </div>
        </div>

        <!-- Search and Filter -->
        <div class="card-body border-bottom">
          <form method="GET" action="{{ route('admin.product.index') }}" id="filterForm">
            <div class="row">
              <div class="col-md-4">
                <div class="input-group">
                  <span class="input-group-text"><i class="fas fa-search"></i></span>
                  <input type="text" class="form-control" placeholder="Tìm kiếm sản phẩm..." 
                         name="search" value="{{ request('search') }}" id="searchInput">
                </div>
              </div>
              <div class="col-md-3">
                <select class="form-select" name="category" id="categoryFilter">
                  <option value="">Tất cả danh mục</option>
                  @foreach($categories as $category)
                    <option value="{{$category->id}}" {{ request('category') == $category->id ? 'selected' : '' }}>
                      {{$category->name}}
                    </option>
                  @endforeach
                </select>
              </div>
              <div class="col-md-3">
                <select class="form-select" name="status" id="statusFilter">
                  <option value="">Tất cả trạng thái</option>
                  <option value="1" {{ request('status') === '1' ? 'selected' : '' }}>Đang bán</option>
                  <option value="0" {{ request('status') === '0' ? 'selected' : '' }}>Tạm dừng</option>
                </select>
              </div>
              <div class="col-md-2">
                <div class="btn-group w-100">
                  <button type="submit" class="btn btn-primary">
                    <i class="fas fa-search me-1"></i>Tìm
                  </button>
                  <a href="{{ route('admin.product.index') }}" class="btn btn-outline-secondary">
                    <i class="fas fa-redo"></i>
                  </a>
                </div>
              </div>
            </div>
          </form>
        </div>

        <!-- Table -->
        <div class="card-body p-0">
          <div class="table-responsive">
            <table class="table table-hover table-striped mb-0">
              <thead>
                <tr>
                  <th class="text-center" style="width: 80px;">Hình ảnh</th>
                  <th>Tên sản phẩm</th>
                  <th class="text-center">Danh mục</th>
                  <th class="text-center">Thương hiệu</th>
                  <th class="text-center">Giá bán</th>
                  <th class="text-center">Giá khuyến mãi</th>
                  <th class="text-center">Số lượng</th>
                  <th class="text-center">Trạng thái</th>
                  <th class="text-center" style="width: 150px;">Thao tác</th>
                </tr>
              </thead>
              <tbody>
                @forelse ($list as $row)
                <tr data-status="{{ $row->status }}" data-category="{{ $row->categoryid }}" data-qty="{{ $row->qty }}">
                  <td class="text-center">
                    <img class="rounded" style="width: 60px; height: 60px; object-fit: cover;" 
                         src="{{ asset('images/products/'.$row->image) }}" 
                         alt="{{ $row->name }}">
                  </td>
                  <td>
                    <div class="fw-bold">{{$row->name}}</div>
                    <small class="text-muted">SKU: PRD{{$row->id}}</small>
                  </td>
                  <td class="text-center">
                    <span class="badge bg-info">{{$row->categoryname}}</span>
                  </td>
                  <td class="text-center">
                    <span class="badge bg-secondary">{{$row->brandname}}</span>
                  </td>
                  <td class="text-center">
                    <strong class="text-primary">{{number_format($row->price)}}₫</strong>
                  </td>
                  <td class="text-center">
                    @if($row->pricesale > 0)
                      <strong class="text-danger">{{number_format($row->pricesale)}}₫</strong>
                      <br><small class="text-muted">Giảm {{round((($row->price - $row->pricesale) / $row->price) * 100)}}%</small>
                    @else
                      <span class="text-muted">Không có</span>
                    @endif
                  </td>
                  <td class="text-center">
                    @if($row->qty == 0)
                      <span class="badge bg-danger">
                        <i class="fas fa-times me-1"></i>Hết hàng
                      </span>
                    @else
                      <span class="badge bg-success">
                        <i class="fas fa-check me-1"></i>{{$row->qty}} sản phẩm
                      </span>
                    @endif
                  </td>
                  <td class="text-center">
                    @php $args = ['id' => $row->id]; @endphp
                    @if ($row->status == 1)
                      <span class="badge bg-success">
                        <i class="fas fa-check me-1"></i>Đang bán
                      </span>
                    @else
                      <span class="badge bg-warning">
                        <i class="fas fa-pause me-1"></i>Tạm dừng
                      </span>
                    @endif
                  </td>
                  <td class="text-center">
                    <div class="btn-group" role="group">
                      @if ($row->status == 1)
                        <a href="{{ route('admin.product.status', $args) }}" 
                           class="btn btn-sm btn-outline-warning rounded-pill me-1" 
                           title="Tạm dừng bán">
                          <i class="fas fa-pause"></i>
                        </a>
                      @else
                        <a href="{{ route('admin.product.status', $args) }}" 
                           class="btn btn-sm btn-outline-success rounded-pill me-1" 
                           title="Kích hoạt bán">
                          <i class="fas fa-play"></i>
                        </a>
                      @endif
                      <a href="{{ route('admin.product.edit', $args) }}" 
                         class="btn btn-sm btn-outline-primary rounded-pill me-1" 
                         title="Chỉnh sửa sản phẩm">
                        <i class="fas fa-edit"></i>
                      </a>
                      <a href="{{ route('admin.product.delete', $args) }}" 
                         class="btn btn-sm btn-outline-danger rounded-pill" 
                         title="Xóa sản phẩm"
                         onclick="return confirm('Bạn có chắc chắn muốn xóa sản phẩm này?')">
                        <i class="fas fa-trash"></i>
                      </a>
                    </div>
                  </td>
                </tr>
                @empty
                <tr>
                  <td colspan="9" class="text-center py-4">
                    <div class="text-muted">
                      <i class="fas fa-search fa-3x mb-3"></i>
                      <h5>Không tìm thấy sản phẩm nào</h5>
                      @if(request()->anyFilled(['search', 'category', 'status']))
                        <p>Hãy thử thay đổi từ khóa tìm kiếm hoặc bộ lọc</p>
                        <a href="{{ route('admin.product.index') }}" class="btn btn-primary">
                          <i class="fas fa-redo me-1"></i>Xem tất cả sản phẩm
                        </a>
                      @else
                        <p>Chưa có sản phẩm nào được thêm vào hệ thống</p>
                        <a href="{{ route('admin.product.create') }}" class="btn btn-success">
                          <i class="fas fa-plus me-1"></i>Thêm sản phẩm đầu tiên
                        </a>
                      @endif
                    </div>
                  </td>
                </tr>
                @endforelse
              </tbody>
            </table>
          </div>
        </div>

        <!-- Card Footer with Pagination -->
        <div class="card-footer">
          <div class="row align-items-center">
            <div class="col-md-6">
              <div class="d-flex align-items-center">
                <span class="me-3">Hiển thị:</span>
                <span class="text-muted">{{$list->firstItem()}} - {{$list->lastItem()}} trên tổng số {{$list->total()}} sản phẩm</span>
              </div>
            </div>
            <div class="col-md-6">
              <div class="d-flex justify-content-end">
                {{ $list->links() }}
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
</div>

@push('scripts')
<script>
// Enhanced search and filter functionality with server-side processing
document.addEventListener('DOMContentLoaded', function() {
    const searchInput = document.getElementById('searchInput');
    const statusFilter = document.getElementById('statusFilter');
    const categoryFilter = document.getElementById('categoryFilter');
    const filterForm = document.getElementById('filterForm');
    
    let searchTimeout;
    
    // Auto-submit form on search input (with debounce)
    searchInput.addEventListener('input', function() {
        clearTimeout(searchTimeout);
        searchTimeout = setTimeout(() => {
            filterForm.submit();
        }, 500); // Wait 500ms after user stops typing
    });
    
    // Auto-submit form on filter change
    statusFilter.addEventListener('change', function() {
        filterForm.submit();
    });
    
    categoryFilter.addEventListener('change', function() {
        filterForm.submit();
    });
    
    // Show loading state during form submission
    filterForm.addEventListener('submit', function() {
        const submitBtn = this.querySelector('button[type="submit"]');
        if (submitBtn) {
            submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin me-1"></i>Đang tìm...';
            submitBtn.disabled = true;
        }
    });
    
    // Animate cards on load
    const cards = document.querySelectorAll('.small-box');
    cards.forEach((card, index) => {
        card.style.opacity = '0';
        card.style.transform = 'translateY(20px)';
        setTimeout(() => {
            card.style.transition = 'all 0.5s ease';
            card.style.opacity = '1';
            card.style.transform = 'translateY(0)';
        }, index * 100);
    });
    
    // Add hover effects to table rows
    const tableRows = document.querySelectorAll('tbody tr');
    tableRows.forEach(row => {
        row.addEventListener('mouseenter', function() {
            this.style.transform = 'scale(1.01)';
            this.style.transition = 'transform 0.2s ease';
        });
        
        row.addEventListener('mouseleave', function() {
            this.style.transform = 'scale(1)';
        });
    });
    
    // Focus search input if it has value
    if (searchInput.value) {
        searchInput.focus();
        searchInput.setSelectionRange(searchInput.value.length, searchInput.value.length);
    }
});

// Add CSS animations
const style = document.createElement('style');
style.textContent = `
    @keyframes fadeIn {
        from { opacity: 0; transform: translateY(10px); }
        to { opacity: 1; transform: translateY(0); }
    }
    
    .table tbody tr {
        animation: fadeIn 0.3s ease-in;
    }
`;
document.head.appendChild(style);
</script>
@endpush

@endsection