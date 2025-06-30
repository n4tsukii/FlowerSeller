
@extends('layouts.admin')
@section('title','Quản Lý Người Dùng')
@section('content')
<div class="content-wrapper">
    <!-- CONTENT -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="text-gradient fw-bold">
              <i class="fas fa-users me-2"></i>Quản Lý Người Dùng
            </h1>
          </div>
          <div class="col-sm-6">
            <nav aria-label="breadcrumb" class="float-sm-right">
              <ol class="breadcrumb bg-transparent mb-0">
                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard.index') }}" class="text-primary">Bảng Điều Khiển</a></li>
                <li class="breadcrumb-item active text-secondary">Người Dùng</li>
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
                <i class="fas fa-users me-2"></i>Tất Cả Người Dùng
              </h4>
              <small class="opacity-75">Quản lý người dùng và quản trị viên hệ thống</small>
            </div>
            <div class="col-md-6">
              <!-- Search and Filter -->
              <div class="row g-2">
                <div class="col-md-8">
                  <div class="input-group">
                    <span class="input-group-text bg-white border-end-0">
                      <i class="fas fa-search text-muted"></i>
                    </span>
                    <input type="text" class="form-control border-start-0 ps-0" placeholder="Tìm kiếm người dùng..." id="searchInput">
                  </div>
                </div>
                <div class="col-md-4">
                  <select class="form-select" id="statusFilter">
                    <option value="">Tất Cả Trạng Thái</option>
                    <option value="1">Đang Hoạt Động</option>
                    <option value="0">Không Hoạt Động</option>
                  </select>
                </div>
              </div>
            </div>
          </div>
          
          <!-- Action Buttons -->
          <div class="row mt-3">
            <div class="col-12 text-end">
              <a href="{{route('admin.user.create')}}" class="btn btn-light btn-sm rounded-pill shadow-sm me-2 hover-lift">
                <i class="fas fa-plus me-1"></i>Thêm Người Dùng Mới
              </a>
              <a href="{{ route('admin.user.trash') }}" class="btn btn-outline-light btn-sm rounded-pill shadow-sm hover-lift">
                <i class="fas fa-trash me-1"></i>Thùng Rác
              </a>
            </div>
          </div>
        </div>
        <div class="card-body p-0">
          <div class="table-responsive">
            <table class="table table-hover mb-0" id="usersTable"> 
              <thead class="bg-light">
                <tr>
                  <th class="border-0 py-3">
                    <i class="fas fa-user me-2 text-primary"></i>Hồ Sơ
                  </th>
                  <th class="border-0 py-3">
                    <i class="fas fa-id-card me-2 text-success"></i>Thông Tin Cá Nhân
                  </th>
                  <th class="border-0 py-3">
                    <i class="fas fa-envelope me-2 text-info"></i>Liên Hệ
                  </th>
                  <th class="border-0 py-3">
                    <i class="fas fa-user-tag me-2 text-warning"></i>Vai Trò
                  </th>
                  <th class="text-center border-0 py-3">
                    <i class="fas fa-toggle-on me-2 text-secondary"></i>Trạng Thái
                  </th>
                  <th class="text-center border-0 py-3">
                    <i class="fas fa-cogs me-2 text-dark"></i>Thao Tác
                  </th>
                </tr>
              </thead>
              <tbody>
                @foreach ($list as $row)
                  <tr class="user-row border-bottom" data-status="{{ $row->status }}">
                    <td class="align-middle">
                      <div class="d-flex align-items-center">
                        <div class="user-avatar me-3">
                          @if($row->image)
                            <img src="{{ asset('images/users/'.$row->image) }}" 
                                 alt="{{ $row->name }}" 
                                 class="rounded-circle shadow-sm"
                                 style="width: 50px; height: 50px; object-fit: cover;">
                          @else
                            <div class="avatar-placeholder">
                              <i class="fas fa-user"></i>
                            </div>
                          @endif
                        </div>
                        <div>
                          <div class="fw-bold text-dark">{{ $row->name }}</div>
                          <small class="text-muted">@{{ $row->username }}</small>
                        </div>
                      </div>
                    </td>
                    <td class="align-middle">
                      <div class="personal-info">
                        <div class="d-flex align-items-center mb-1">
                          @if ($row->gender == 'male' || $row->gender == 1)
                            <span class="badge bg-primary rounded-pill me-2">
                              <i class="fas fa-mars me-1"></i>Nam
                            </span>
                          @elseif ($row->gender == 'female' || $row->gender == 2)
                            <span class="badge bg-pink rounded-pill me-2">
                              <i class="fas fa-venus me-1"></i>Nữ
                            </span>
                          @else
                            <span class="badge bg-secondary rounded-pill me-2">
                              <i class="fas fa-question me-1"></i>{{ $row->gender ?: 'Không có' }}
                            </span>
                          @endif
                        </div>
                        <small class="text-muted">
                          <i class="fas fa-hashtag me-1"></i>ID: {{ $row->id }}
                        </small>
                      </div>
                    </td>
                    <td class="align-middle">
                      <div class="contact-info">
                        <div class="mb-1">
                          <i class="fas fa-envelope me-2 text-info"></i>
                          <span class="text-dark">{{ $row->email }}</span>
                        </div>
                        @if($row->phone)
                        <div class="mb-1">
                          <i class="fas fa-phone me-2 text-success"></i>
                          <span class="text-dark">{{ $row->phone }}</span>
                        </div>
                        @endif
                        @if($row->address)
                        <small class="text-muted">
                          <i class="fas fa-map-marker-alt me-1"></i>{{ Str::limit($row->address, 30) }}
                        </small>
                        @endif
                      </div>
                    </td>
                    <td class="align-middle">
                      @php
                        $roleClass = match($row->roles) {
                          'admin' => 'bg-gradient-danger',
                          'manager' => 'bg-gradient-warning',
                          'editor' => 'bg-gradient-info',
                          default => 'bg-gradient-secondary'
                        };
                        $roleIcon = match($row->roles) {
                          'admin' => 'fas fa-crown',
                          'manager' => 'fas fa-user-tie',
                          'editor' => 'fas fa-edit',
                          default => 'fas fa-user'
                        };
                      @endphp
                      <span class="badge {{ $roleClass }} rounded-pill px-3 py-2">
                        <i class="{{ $roleIcon }} me-1"></i>{{ ucfirst($row->roles) }}
                      </span>
                    </td>
                    <td class="text-center align-middle">
                      @if ($row->status == 1)
                        <span class="badge bg-gradient-success rounded-pill px-3 py-2">
                          <i class="fas fa-check-circle me-1"></i>Đang Hoạt Động
                        </span>
                      @else
                        <span class="badge bg-gradient-secondary rounded-pill px-3 py-2">
                          <i class="fas fa-pause-circle me-1"></i>Không Hoạt Động
                        </span>
                      @endif
                    </td>
                    <td class="text-center align-middle">
                      @php
                          $args = ['id' => $row->id];
                      @endphp
                      <div class="btn-group" role="group">
                        @if ($row->status==1)
                        <a href="{{ route('admin.user.status', $args) }}" 
                           class="btn btn-sm btn-outline-success rounded-pill me-1 hover-lift"
                           title="Tắt hoạt động">
                            <i class="fas fa-toggle-on"></i>
                        </a>
                        @else
                        <a href="{{ route('admin.user.status', $args) }}" 
                           class="btn btn-sm btn-outline-secondary rounded-pill me-1 hover-lift"
                           title="Bật hoạt động">
                            <i class="fas fa-toggle-off"></i>
                        </a>
                        @endif
                        <a href="{{ route('admin.user.edit', $args) }}" 
                           class="btn btn-sm btn-outline-primary rounded-pill me-1 hover-lift"
                           title="Chỉnh sửa">
                            <i class="fas fa-edit"></i>
                        </a>
                        <a href="{{ route('admin.user.delete', $args) }}" 
                           class="btn btn-sm btn-outline-danger rounded-pill hover-lift"
                           title="Xóa"
                           onclick="return confirm('Bạn có chắc chắn muốn xóa người dùng này không?')">
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
    const table = document.getElementById('usersTable');
    const rows = table.querySelectorAll('tbody tr');
    
    function filterTable() {
        const searchTerm = searchInput.value.toLowerCase();
        const statusValue = statusFilter.value;
        
        rows.forEach(row => {
            const name = row.querySelector('td:nth-child(1)').textContent.toLowerCase();
            const contact = row.querySelector('td:nth-child(3)').textContent.toLowerCase();
            const role = row.querySelector('td:nth-child(4)').textContent.toLowerCase();
            const status = row.getAttribute('data-status');
            
            const matchesSearch = name.includes(searchTerm) || 
                                contact.includes(searchTerm) || 
                                role.includes(searchTerm);
            const matchesStatus = statusValue === '' || status === statusValue;
            
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

.user-row {
    transition: all 0.3s ease;
}

.avatar-placeholder {
    width: 50px;
    height: 50px;
    border-radius: 50%;
    background: linear-gradient(45deg, #667eea 0%, #764ba2 100%);
    display: flex;
    align-items: center;
    justify-content: center;
    color: white;
    font-size: 1.2rem;
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

.bg-gradient-danger {
    background: linear-gradient(45deg, #ff6b6b 0%, #feca57 100%);
}

.bg-gradient-warning {
    background: linear-gradient(45deg, #f39c12 0%, #f1c40f 100%);
}

.bg-gradient-info {
    background: linear-gradient(45deg, #3498db 0%, #2980b9 100%);
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

.personal-info, .contact-info {
    min-width: 180px;
}
</style>

@endsection