@extends('layouts.admin')
@section('title','Categories Management')
@section('content')
<div class="content-wrapper">
    <!-- CONTENT -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="text-gradient fw-bold">
              <i class="fas fa-sitemap me-2"></i>Categories Management
            </h1>
          </div>
          <div class="col-sm-6">
            <nav aria-label="breadcrumb" class="float-sm-right">
              <ol class="breadcrumb bg-transparent mb-0">
                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard.index') }}" class="text-primary">Dashboard</a></li>
                <li class="breadcrumb-item active text-secondary">Categories</li>
              </ol>
            </nav>
          </div>
        </div>
      </div>
    </section>
    
    <section class="content">
      <div class="row">
        <!-- Add New Category Form -->
        <div class="col-md-4">
          <div class="card shadow-lg border-0 rounded-4 overflow-hidden">
            <div class="card-header bg-gradient-success text-white border-0 py-4">
              <h5 class="mb-0 fw-bold">
                <i class="fas fa-plus-circle me-2"></i>Thêm danh mục mới
              </h5>
              <small class="opacity-75">Tạo danh mục sản phẩm mới</small>
            </div>
            <div class="card-body p-4">
              <form action="{{ route('admin.category.store') }}" method="post" enctype="multipart/form-data" id="categoryForm">
                @csrf
                <div class="mb-3">
                  <label for="name" class="form-label fw-bold">
                    <i class="fas fa-tag me-2 text-primary"></i>Tên danh mục
                  </label>
                  <input type="text" value="{{ old('name') }}" name="name" id="name" 
                         class="form-control form-control-lg rounded-3 shadow-sm" 
                         placeholder="Nhập tên danh mục">
                  @error('name')
                    <div class="text-danger mt-1"><i class="fas fa-exclamation-triangle me-1"></i>{{ $message }}</div>
                  @enderror
                </div>
                
                <div class="mb-3">
                  <label for="description" class="form-label fw-bold">
                    <i class="fas fa-align-left me-2 text-info"></i>Mô tả
                  </label>
                  <textarea name="description" id="description" rows="3" 
                            class="form-control rounded-3 shadow-sm" 
                            placeholder="Nhập mô tả danh mục">{{ old('description') }}</textarea>
                  @error('description')
                    <div class="text-danger mt-1"><i class="fas fa-exclamation-triangle me-1"></i>{{ $message }}</div>
                  @enderror
                </div>
                
                <div class="mb-3">
                  <label for="parent_id" class="form-label fw-bold">
                    <i class="fas fa-sitemap me-2 text-warning"></i>Danh mục cha
                  </label>
                  <select name="parent_id" id="parent_id" class="form-select rounded-3 shadow-sm">
                    <option value="0">Danh mục gốc</option>
                    {!! $htmlparentid !!}
                  </select>
                  @error('parent_id')
                    <div class="text-danger mt-1"><i class="fas fa-exclamation-triangle me-1"></i>{{ $message }}</div>
                  @enderror
                </div>
                
                <div class="mb-3">
                  <label for="sort_order" class="form-label fw-bold">
                    <i class="fas fa-sort me-2 text-secondary"></i>Thứ tự sắp xếp
                  </label>
                  <select name="sort_order" id="sort_order" class="form-select rounded-3 shadow-sm">
                    <option value="">Chọn vị trí</option>
                    {!! $htmlsortorder !!}
                  </select>
                  @error('sort_order')
                    <div class="text-danger mt-1"><i class="fas fa-exclamation-triangle me-1"></i>{{ $message }}</div>
                  @enderror
                </div>
                
                <div class="mb-3">
                  <label for="image" class="form-label fw-bold">
                    <i class="fas fa-image me-2 text-primary"></i>Hình ảnh danh mục
                  </label>
                  <input type="file" name="image" id="image" 
                         class="form-control rounded-3 shadow-sm" 
                         accept="image/*">
                  @error('image')
                    <div class="text-danger mt-1"><i class="fas fa-exclamation-triangle me-1"></i>{{ $message }}</div>
                  @enderror
                </div>
                
                <div class="mb-4">
                  <label for="status" class="form-label fw-bold">
                    <i class="fas fa-toggle-on me-2 text-success"></i>Trạng thái
                  </label>
                  <select name="status" id="status" class="form-select rounded-3 shadow-sm">
                    <option value="1">Kích hoạt</option>
                    <option value="0">Tạm dừng</option>
                  </select>
                  @error('status')
                    <div class="text-danger mt-1"><i class="fas fa-exclamation-triangle me-1"></i>{{ $message }}</div>
                  @enderror
                </div>
                
                <div class="d-grid">
                  <button type="submit" class="btn btn-gradient-success btn-lg rounded-pill shadow hover-lift">
                    <i class="fas fa-plus me-2"></i>Thêm danh mục
                  </button>
                </div>
              </form>
            </div>
          </div>
        </div>
        
        <!-- Categories List -->
        <div class="col-md-8">
          <div class="card shadow-lg border-0 rounded-4 overflow-hidden">
            <div class="card-header bg-gradient-primary text-white border-0 py-4">
              <div class="row align-items-center">
                <div class="col-md-6">
                  <h4 class="mb-0 fw-bold">
                    <i class="fas fa-sitemap me-2"></i>Tất cả danh mục
                  </h4>
                  <small class="opacity-75">Quản lý danh mục sản phẩm</small>
                </div>
                <div class="col-md-6 text-end">
                  <a href="{{ route('admin.category.trash') }}" class="btn btn-outline-light btn-sm rounded-pill shadow-sm hover-lift">
                    <i class="fas fa-trash me-1"></i>Thùng rác
                  </a>
                </div>
              </div>
            </div>
            <div class="card-body p-0">
              <div class="table-responsive">
                <table class="table table-hover mb-0" id="categoriesTable"> 
                  <thead class="bg-light">
                    <tr>
                      <th class="border-0 py-3">
                        <i class="fas fa-image me-2 text-primary"></i>Hình ảnh
                      </th>
                      <th class="border-0 py-3">
                        <i class="fas fa-tag me-2 text-success"></i>Danh mục
                      </th>
                      <th class="border-0 py-3">
                        <i class="fas fa-sitemap me-2 text-info"></i>Danh mục cha
                      </th>
                      <th class="border-0 py-3">
                        <i class="fas fa-link me-2 text-warning"></i>Đường dẫn
                      </th>
                      <th class="text-center border-0 py-3">
                        <i class="fas fa-cogs me-2 text-dark"></i>Thao tác
                      </th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach ($list as $row)
                      <tr class="category-row border-bottom" data-status="{{ $row->status }}">
                        <td class="align-middle">
                          <div class="category-image-container">
                            @if($row->slug && file_exists(public_path('images/categories/'.$row->slug.'.png')))
                              <img src="{{ asset('images/categories/'.$row->slug.'.png') }}" 
                                   alt="{{ $row->name }}" 
                                   class="rounded-3 shadow-sm"
                                   style="width: 50px; height: 50px; object-fit: cover;">
                            @elseif($row->slug && file_exists(public_path('images/categories/'.$row->slug.'.jpg')))
                              <img src="{{ asset('images/categories/'.$row->slug.'.jpg') }}" 
                                   alt="{{ $row->name }}" 
                                   class="rounded-3 shadow-sm"
                                   style="width: 50px; height: 50px; object-fit: cover;">
                            @elseif($row->slug && file_exists(public_path('images/categories/'.$row->slug.'.jpeg')))
                              <img src="{{ asset('images/categories/'.$row->slug.'.jpeg') }}" 
                                   alt="{{ $row->name }}" 
                                   class="rounded-3 shadow-sm"
                                   style="width: 50px; height: 50px; object-fit: cover;">
                            @else
                              <div class="bg-light rounded-3 d-flex align-items-center justify-content-center" 
                                   style="width: 50px; height: 50px;">
                                <i class="fas fa-image text-muted"></i>
                              </div>
                            @endif
                          </div>
                        </td>
                        <td class="align-middle">
                          <div class="category-info">
                            <div class="fw-bold text-dark mb-1">{{ $row->name }}</div>
                            <small class="text-muted">{{ Str::limit($row->description, 50) }}</small>
                            <br><small class="text-muted">ID: {{ $row->id }}</small>
                          </div>
                        </td>
                        <td class="align-middle">
                          @if($row->parent_id == 0)
                            <span class="badge bg-gradient-primary rounded-pill px-3 py-2">
                              <i class="fas fa-crown me-1"></i>Gốc
                            </span>
                          @else
                            <span class="badge bg-gradient-secondary rounded-pill px-3 py-2">
                              <i class="fas fa-level-up-alt me-1"></i>ID: {{ $row->parent_id }}
                            </span>
                          @endif
                        </td>
                        <td class="align-middle">
                          <div class="text-muted font-monospace">
                            <i class="fas fa-link me-1"></i>{{ $row->slug }}
                          </div>
                        </td>
                        <td class="text-center align-middle">
                          @php
                              $args = ['id' => $row->id];
                          @endphp
                          <div class="btn-group" role="group">
                            @if ($row->status==1)
                            <a href="{{ route('admin.category.status', $args) }}" 
                               class="btn btn-sm btn-outline-success rounded-pill me-1 hover-lift"
                               title="Tạm dừng">
                                <i class="fas fa-toggle-on"></i>
                            </a>
                            @else
                            <a href="{{ route('admin.category.status', $args) }}" 
                               class="btn btn-sm btn-outline-secondary rounded-pill me-1 hover-lift"
                               title="Kích hoạt">
                                <i class="fas fa-toggle-off"></i>
                            </a>
                            @endif
                            <a href="{{ route('admin.category.edit', $args) }}" 
                               class="btn btn-sm btn-outline-primary rounded-pill me-1 hover-lift"
                               title="Chỉnh sửa">
                                <i class="fas fa-edit"></i>
                            </a>
                            <a href="{{ route('admin.category.delete', $args) }}" 
                               class="btn btn-sm btn-outline-danger rounded-pill hover-lift"
                               title="Xóa"
                               onclick="return confirm('Bạn có chắc chắn muốn xóa danh mục này?')">
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
        </div>
      </div>
    </section>
</div>

<!-- Enhanced JavaScript -->
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Form validation
    const form = document.getElementById('categoryForm');
    const nameInput = document.getElementById('name');
    
    form.addEventListener('submit', function(e) {
        if (nameInput.value.trim() === '') {
            e.preventDefault();
            nameInput.classList.add('is-invalid');
            nameInput.focus();
            return false;
        }
    });
    
    nameInput.addEventListener('input', function() {
        this.classList.remove('is-invalid');
    });
    
    // Image preview
    const imageInput = document.getElementById('image');
    if (imageInput) {
        imageInput.addEventListener('change', function(e) {
            const file = e.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    // Create preview if doesn't exist
                    let preview = document.getElementById('imagePreview');
                    if (!preview) {
                        preview = document.createElement('img');
                        preview.id = 'imagePreview';
                        preview.className = 'mt-2 rounded-3 shadow-sm';
                        preview.style.width = '100px';
                        preview.style.height = '100px';
                        preview.style.objectFit = 'cover';
                        imageInput.parentNode.appendChild(preview);
                    }
                    preview.src = e.target.result;
                };
                reader.readAsDataURL(file);
            }
        });
    }
    
    // Table row hover effects
    const rows = document.querySelectorAll('.category-row');
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
.hover-lift:hover {
    transform: translateY(-2px);
    box-shadow: 0 4px 15px rgba(0,0,0,0.2);
    transition: all 0.3s ease;
}

.category-row {
    transition: all 0.3s ease;
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

.btn-gradient-success {
    background: linear-gradient(45deg, #56ab2f 0%, #a8e6cf 100%);
    border: none;
    color: white;
}

.btn-gradient-success:hover {
    background: linear-gradient(45deg, #4a9d26 0%, #95d9bb 100%);
    color: white;
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

.form-control:focus, .form-select:focus {
    border-color: #667eea;
    box-shadow: 0 0 0 0.2rem rgba(102, 126, 234, 0.25);
}

.is-invalid {
    border-color: #dc3545;
    animation: shake 0.5s ease-in-out;
}

@keyframes shake {
    0%, 100% { transform: translateX(0); }
    25% { transform: translateX(-5px); }
    75% { transform: translateX(5px); }
}
</style>

@endsection