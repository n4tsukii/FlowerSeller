@extends('layouts.admin')
@section('title','Quản lý bài viết')
@section('content')
<div class="content-wrapper">
    <!-- CONTENT -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="text-gradient fw-bold">
              <i class="fas fa-blog me-2"></i>Quản lý bài viết
            </h1>
          </div>
          <div class="col-sm-6">
            <nav aria-label="breadcrumb" class="float-sm-right">
              <ol class="breadcrumb bg-transparent mb-0">
                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard.index') }}" class="text-primary">Dashboard</a></li>
                <li class="breadcrumb-item active text-secondary">Bài viết</li>
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
                <i class="fas fa-blog me-2"></i>Tất cả bài viết
              </h4>
              <small class="opacity-75">Quản lý bài viết và tin tức</small>
            </div>
            <div class="col-md-6">
              <!-- Search and Filter -->
              <div class="row g-2">
                <div class="col-md-8">
                  <div class="input-group">
                    <span class="input-group-text bg-white border-end-0">
                      <i class="fas fa-search text-muted"></i>
                    </span>
                    <input type="text" class="form-control border-start-0 ps-0" placeholder="Tìm kiếm bài viết..." id="searchInput">
                  </div>
                </div>
                <div class="col-md-4">
                  <select class="form-select" id="statusFilter">
                    <option value="">Tất cả trạng thái</option>
                    <option value="1">Hoạt động</option>
                    <option value="0">Tạm dừng</option>
                  </select>
                </div>
              </div>
            </div>
          </div>
          
          <!-- Action Buttons -->
          <div class="row mt-3">
            <div class="col-12 text-end">
              <a href="{{route('admin.post.create')}}" class="btn btn-light btn-sm rounded-pill shadow-sm me-2 hover-lift">
                <i class="fas fa-plus me-1"></i>Thêm bài viết
              </a>
              <a href="{{ route('admin.post.trash') }}" class="btn btn-outline-light btn-sm rounded-pill shadow-sm hover-lift">
                <i class="fas fa-trash me-1"></i>Thùng rác
              </a>
            </div>
          </div>
        </div>
        <div class="card-body p-0">
          <div class="table-responsive">
            <table class="table table-hover mb-0" id="postsTable"> 
              <thead class="bg-light">
                <tr>
                  <th class="border-0 py-3">
                    <i class="fas fa-image me-2 text-primary"></i>Hình ảnh
                  </th>
                  <th class="border-0 py-3">
                    <i class="fas fa-tags me-2 text-success"></i>Chủ đề
                  </th>
                  <th class="border-0 py-3">
                    <i class="fas fa-heading me-2 text-info"></i>Tiêu đề
                  </th>
                  <th class="border-0 py-3">
                    <i class="fas fa-align-left me-2 text-warning"></i>Mô tả
                  </th>
                  <th class="text-center border-0 py-3">
                    <i class="fas fa-toggle-on me-2 text-secondary"></i>Trạng thái
                  </th>
                  <th class="text-center border-0 py-3">
                    <i class="fas fa-cogs me-2 text-dark"></i>Thao tác
                  </th>
                </tr>
              </thead>
              <tbody>
                @foreach($list as $row)
                  <tr class="post-row border-bottom" data-status="{{ $row->status }}">
                    <td class="align-middle">
                      <div class="d-flex align-items-center">
                        <div class="post-image-container me-3">
                          @if($row->image && file_exists(public_path('images/posts/' . $row->image)))
                              <img src="{{ asset('images/posts/' . $row->image) }}" 
                                   alt="{{ $row->title }}" 
                                   class="rounded-3 shadow-sm"
                                   style="width: 60px; height: 60px; object-fit: cover;">
                          @else
                              <div class="bg-light rounded-3 d-flex align-items-center justify-content-center" 
                                   style="width: 60px; height: 60px;">
                                  <i class="fas fa-file-alt text-muted"></i>
                              </div>
                          @endif
                        </div>
                      </div>
                    </td>
                    <td class="align-middle">
                      <span class="badge bg-gradient-success rounded-pill px-3 py-2">
                        <i class="fas fa-tag me-1"></i>{{ $row->topicname }}
                      </span>
                    </td>
                    <td class="align-middle">
                      <div class="fw-bold text-dark mb-1">{{ Str::limit($row->title, 30) }}</div>
                      <small class="text-muted">ID: {{ $row->id }}</small>
                    </td>
                    <td class="align-middle">
                      <div class="text-muted">
                        {{ Str::limit($row->description, 50) }}
                      </div>
                    </td>
                    <td class="text-center align-middle">
                      @if ($row->status == 1)
                        <span class="badge bg-gradient-success rounded-pill px-3 py-2">
                          <i class="fas fa-check-circle me-1"></i>Hoạt động
                        </span>
                      @else
                        <span class="badge bg-gradient-secondary rounded-pill px-3 py-2">
                          <i class="fas fa-pause-circle me-1"></i>Tạm dừng
                        </span>
                      @endif
                    </td>
                    <td class="text-center align-middle">
                      @php
                          $args = ['id' => $row->id];
                      @endphp
                      <div class="btn-group" role="group">
                        @if ($row->status==1)
                        <a href="{{ route('admin.post.status', $args) }}" 
                           class="btn btn-sm btn-outline-success rounded-pill me-1 hover-lift"
                           title="Tạm dừng">
                            <i class="fas fa-toggle-on"></i>
                        </a>
                        @else
                        <a href="{{ route('admin.post.status', $args) }}" 
                           class="btn btn-sm btn-outline-secondary rounded-pill me-1 hover-lift"
                           title="Kích hoạt">
                            <i class="fas fa-toggle-off"></i>
                        </a>
                        @endif
                        <a href="{{ route('admin.post.edit', $args) }}" 
                           class="btn btn-sm btn-outline-primary rounded-pill me-1 hover-lift"
                           title="Chỉnh sửa">
                            <i class="fas fa-edit"></i>
                        </a>
                        <a href="{{ route('admin.post.delete', $args) }}" 
                           class="btn btn-sm btn-outline-danger rounded-pill hover-lift"
                           title="Xóa"
                           onclick="return confirm('Bạn có chắc chắn muốn xóa bài viết này?')">
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
    const table = document.getElementById('postsTable');
    const rows = table.querySelectorAll('tbody tr');
    
    function filterTable() {
        const searchTerm = searchInput.value.toLowerCase();
        const statusValue = statusFilter.value;
        
        rows.forEach(row => {
            const title = row.querySelector('td:nth-child(3)').textContent.toLowerCase();
            const topic = row.querySelector('td:nth-child(2)').textContent.toLowerCase();
            const description = row.querySelector('td:nth-child(4)').textContent.toLowerCase();
            const status = row.getAttribute('data-status');
            
            const matchesSearch = title.includes(searchTerm) || 
                                topic.includes(searchTerm) || 
                                description.includes(searchTerm);
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

.post-row {
    transition: all 0.3s ease;
}

.post-image-container {
    position: relative;
    overflow: hidden;
    border-radius: 0.5rem;
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
</style>

@endsection