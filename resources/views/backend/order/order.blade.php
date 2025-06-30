@extends('layouts.admin')
@section('title','Quản lý Đơn hàng')
@section('content')
<div class="content-wrapper">
    <!-- CONTENT -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="text-gradient fw-bold">
              <i class="fas fa-shopping-cart me-2"></i>Quản lý Đơn hàng
            </h1>
          </div>
          <div class="col-sm-6">
            <nav aria-label="breadcrumb" class="float-sm-right">
              <ol class="breadcrumb bg-transparent mb-0">
                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard.index') }}" class="text-primary">Bảng điều khiển</a></li>
                <li class="breadcrumb-item active text-secondary">Đơn hàng</li>
              </ol>
            </nav>
          </div>
        </div>
      </div>
    </section>
    
    <section class="content">
      <div class="card shadow-lg border-0 rounded-4 overflow-hidden">
        <div class="card-header bg-gradient-primary text-white border-0 py-4">
          <div class="row align-items-center">
            <div class="col-md-6">
              <h4 class="mb-0 fw-bold">
                <i class="fas fa-shopping-cart me-2"></i>Tất cả Đơn hàng
              </h4>
              <small class="opacity-75">Quản lý đơn hàng và giao hàng khách hàng</small>
            </div>
            <div class="col-md-6">
              <!-- Search and Filter -->
              <div class="row g-2">
                <div class="col-md-8">
                  <div class="input-group">
                    <span class="input-group-text bg-white border-end-0">
                      <i class="fas fa-search text-muted"></i>
                    </span>
                    <input type="text" class="form-control border-start-0 ps-0" placeholder="Tìm kiếm đơn hàng..." id="searchInput">
                  </div>
                </div>
                <div class="col-md-4">
                  <select class="form-select" id="statusFilter">
                    <option value="">Tất cả đơn hàng</option>
                    <option value="has-products">Có sản phẩm</option>
                    <option value="no-products">Chưa có sản phẩm</option>
                  </select>
                </div>
              </div>
            </div>
          </div>
          
          <!-- Action Buttons -->
          <div class="row mt-3">
            <div class="col-12 text-end">
              <a href="{{ route('admin.order.trash') }}" class="btn btn-outline-light btn-sm rounded-pill shadow-sm hover-lift">
                <i class="fas fa-trash me-1"></i>Thùng rác
              </a>
            </div>
          </div>
        </div>
        <div class="card-body p-0">
          <div class="table-responsive">
            <table class="table table-hover mb-0" id="ordersTable"> 
              <thead class="bg-light">
                <tr>
                  <th class="border-0 py-3">
                    <i class="fas fa-user me-2 text-primary"></i>Khách hàng & Thời gian
                  </th>
                  <th class="border-0 py-3">
                    <i class="fas fa-truck me-2 text-success"></i>Giao hàng
                  </th>
                  <th class="border-0 py-3">
                    <i class="fas fa-envelope me-2 text-info"></i>Liên hệ
                  </th>
                  <th class="border-0 py-3">
                    <i class="fas fa-box me-2 text-warning"></i>Sản phẩm
                  </th>
                  <th class="border-0 py-3">
                    <i class="fas fa-money-bill-wave me-2 text-success"></i>Tổng tiền
                  </th>
                  <th class="border-0 py-3">
                    <i class="fas fa-sticky-note me-2 text-secondary"></i>Ghi chú
                  </th>
                  <th class="text-center border-0 py-3">
                    <i class="fas fa-cogs me-2 text-dark"></i>Thao tác
                  </th>
                </tr>
              </thead>
              <tbody>
                @foreach ($list as $row)
                  <tr class="order-row border-bottom" data-status="{{ $row->status }}">
                    <td class="align-middle">
                      <div class="d-flex align-items-center">
                        <div class="avatar-circle me-3">
                          <i class="fas fa-user text-white"></i>
                        </div>
                        <div>
                          <div class="fw-bold text-dark">{{ $row->name }}</div>
                          <small class="text-muted">ID: #{{ $row->orderid }}</small>
                          <div class="small text-info">
                            <i class="fas fa-calendar me-1"></i>{{ date('d/m/Y H:i', strtotime($row->created_at)) }}
                          </div>
                        </div>
                      </div>
                    </td>
                    <td class="align-middle">
                      <div class="delivery-info">
                        <span class="text-muted fst-italic">
                          <i class="fas fa-info-circle me-1"></i>Thông tin giao hàng sẽ được cập nhật từ đơn hàng
                        </span>
                        <div class="mt-1">
                          <small class="text-secondary">Đơn hàng được tạo bởi khách hàng</small>
                        </div>
                      </div>
                    </td>
                    <td class="align-middle">
                      <div class="contact-info">
                        <span class="text-muted fst-italic">
                          <i class="fas fa-info-circle me-1"></i>Thông tin liên hệ sẽ được cập nhật từ thông tin khách hàng
                        </span>
                        <div class="mt-1">
                          <small class="text-secondary">User ID: {{ $row->user_id }}</small>
                        </div>
                      </div>
                    </td>
                    <td class="align-middle">
                      <div class="product-info text-center">
                        <span class="badge bg-gradient-primary rounded-pill px-3 py-2">
                          <i class="fas fa-box me-1"></i>{{ $row->total_products ?: 0 }} sản phẩm
                        </span>
                      </div>
                    </td>
                    <td class="align-middle">
                      <div class="amount-info text-center">
                        @if($row->total_amount && $row->total_amount > 0)
                          <span class="badge bg-gradient-success rounded-pill px-3 py-2 fw-bold">
                            <i class="fas fa-money-bill-wave me-1"></i>{{ number_format($row->total_amount, 0, ',', '.') }} VNĐ
                          </span>
                        @else
                          <span class="badge bg-gradient-secondary rounded-pill px-3 py-2">
                            <i class="fas fa-minus me-1"></i>Chưa có giá trị
                          </span>
                        @endif
                      </div>
                    </td>
                    <td class="align-middle">
                      <div class="text-muted">
                        <span class="fst-italic">
                          <i class="fas fa-info-circle me-1"></i>Ghi chú sẽ được cập nhật khi chỉnh sửa đơn hàng
                        </span>
                      </div>
                    </td>
                    <td class="text-center align-middle">
                      @php
                          $args = ['id' => $row->orderid ?? $row->id];
                      @endphp
                      <div class="btn-group" role="group">
                        <a href="{{ route('admin.order.edit', $args) }}" 
                           class="btn btn-sm btn-outline-primary rounded-pill me-1 hover-lift"
                           title="Chỉnh sửa">
                            <i class="fas fa-edit"></i>
                        </a>
                        <a href="{{ route('admin.order.delete', $args) }}" 
                           class="btn btn-sm btn-outline-danger rounded-pill hover-lift"
                           title="Xóa"
                           onclick="return confirm('Bạn có chắc chắn muốn xóa đơn hàng này?')">
                            <i class="fas fa-trash"></i>
                        </a>
                      </div>
                    </td>
                  </tr>
                @endforeach
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </section>
</div>

<!-- Enhanced JavaScript -->
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Search functionality
    const searchInput = document.getElementById('searchInput');
    const statusFilter = document.getElementById('statusFilter');
    const table = document.getElementById('ordersTable');
    const rows = table.querySelectorAll('tbody tr');
    
    function filterTable() {
        const searchTerm = searchInput.value.toLowerCase();
        const statusValue = statusFilter.value;
        
        rows.forEach(row => {
            const customer = row.querySelector('td:nth-child(1)').textContent.toLowerCase();
            const delivery = row.querySelector('td:nth-child(2)').textContent.toLowerCase();
            const contact = row.querySelector('td:nth-child(3)').textContent.toLowerCase();
            const products = row.querySelector('td:nth-child(4)').textContent.toLowerCase();
            const amount = row.querySelector('td:nth-child(5)').textContent.toLowerCase();
            const note = row.querySelector('td:nth-child(6)').textContent.toLowerCase();
            
            const matchesSearch = customer.includes(searchTerm) || 
                                delivery.includes(searchTerm) || 
                                contact.includes(searchTerm) ||
                                products.includes(searchTerm) ||
                                amount.includes(searchTerm) ||
                                note.includes(searchTerm);
            
            let matchesStatus = true;
            if (statusValue === 'has-products') {
                matchesStatus = !products.includes('0 sản phẩm');
            } else if (statusValue === 'no-products') {
                matchesStatus = products.includes('0 sản phẩm');
            }
            
            if (matchesSearch && matchesStatus) {
                row.style.display = '';
                row.style.animation = 'fadeIn 0.3s ease-in';
            } else {
                row.style.display = 'none';
            }
        });
    }
    
    searchInput.addEventListener('input', filterTable);
    statusFilter.addEventListener('change', filterTable);
    
    // Add hover effects and animations
    rows.forEach(row => {
        row.addEventListener('mouseenter', function() {
            this.style.transform = 'translateX(5px)';
            this.style.boxShadow = '0 4px 15px rgba(0,0,0,0.1)';
        });
        
        row.addEventListener('mouseleave', function() {
            this.style.transform = 'translateX(0)';
            this.style.boxShadow = 'none';
        });
    });
});
</script>

<style>
@keyframes fadeIn {
    from { opacity: 0; transform: translateY(10px); }
    to { opacity: 1; transform: translateY(0); }
}

.hover-lift:hover {
    transform: translateY(-2px);
    box-shadow: 0 4px 15px rgba(0,0,0,0.2);
    transition: all 0.3s ease;
}

.order-row {
    transition: all 0.3s ease;
}

.avatar-circle {
    width: 40px;
    height: 40px;
    border-radius: 50%;
    background: linear-gradient(45deg, #667eea 0%, #764ba2 100%);
    display: flex;
    align-items: center;
    justify-content: center;
    flex-shrink: 0;
}

.text-gradient {
    background: linear-gradient(45deg, #667eea 0%, #764ba2 100%);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    background-clip: text;
}

.bg-gradient-primary {
    background: linear-gradient(45deg, #667eea 0%, #764ba2 100%);
}

.bg-gradient-success {
    background: linear-gradient(45deg, #56ab2f 0%, #a8e6cf 100%);
}

.bg-gradient-secondary {
    background: linear-gradient(45deg, #bdc3c7 0%, #2c3e50 100%);
}

.bg-pink {
    background: linear-gradient(45deg, #ff9a9e 0%, #fecfef 100%);
}

.card {
    border: none;
    box-shadow: 0 10px 30px rgba(0,0,0,0.1);
}

tbody tr:hover {
    background-color: rgba(102, 126, 234, 0.05);
}

.btn-group .btn {
    margin-right: 0.25rem;
}

.btn-group .btn:last-child {
    margin-right: 0;
}

.delivery-info, .contact-info {
    min-width: 180px;
}

.product-info, .amount-info {
    min-width: 120px;
}

.product-info .badge,
.amount-info .badge {
    font-size: 0.85rem;
    font-weight: 600;
}

.bg-gradient-primary {
    background: linear-gradient(45deg, #667eea 0%, #764ba2 100%);
}

.bg-gradient-success {
    background: linear-gradient(45deg, #56ab2f 0%, #a8e6cf 100%);
}

.bg-gradient-secondary {
    background: linear-gradient(45deg, #bdc3c7 0%, #6c757d 100%);
}
</style>

@endsection