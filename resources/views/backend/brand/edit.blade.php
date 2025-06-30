@extends('layouts.admin')
@section('title','Cập nhật thương hiệu')
@section('content')
<div class="content-wrapper">
    <!-- CONTENT -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="text-gradient fw-bold">
              <i class="fas fa-edit me-2"></i>Cập nhật thương hiệu
            </h1>
          </div>
          <div class="col-sm-6">
            <nav aria-label="breadcrumb" class="float-sm-right">
              <ol class="breadcrumb bg-transparent mb-0">
                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard.index') }}" class="text-primary">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="{{ route('admin.brand.index') }}" class="text-primary">Quản lý thương hiệu</a></li>
                <li class="breadcrumb-item active text-secondary">Cập nhật</li>
              </ol>
            </nav>
          </div>
        </div>
      </div>
    </section>
    <section class="content">
    <div class="card shadow-lg border-0 rounded-4 overflow-hidden">
        <div class="card-header bg-gradient-warning text-white border-0 py-4">
            <div class="row align-items-center">
                <div class="col-md-6">
                    <h4 class="mb-0 fw-bold">
                        <i class="fas fa-edit me-2"></i>Chỉnh sửa thương hiệu
                    </h4>
                    <small class="opacity-75">Cập nhật thông tin thương hiệu</small>
                </div>
                <div class="col-md-6 text-end">
                    <a href="{{ route('admin.brand.index') }}" class="btn btn-outline-light btn-sm rounded-pill shadow-sm hover-lift">
                        <i class="fa fa-arrow-left me-1"></i>Quay lại danh sách
                    </a>
                </div>
            </div>
        </div>
        <div class="card-body p-4">
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <form action="{{ route('admin.brand.update', $brand->id) }}" method="post" enctype="multipart/form-data" id="editBrandForm">
                        @csrf
                        @method('put')
                        
                        <div class="mb-4">
                            <label for="name" class="form-label fw-bold">
                                <i class="fas fa-building me-2 text-primary"></i>Tên thương hiệu
                            </label>
                            <input type="text" value="{{ old('name', $brand->name) }}" name="name" id="name" 
                                   class="form-control form-control-lg rounded-3 shadow-sm" 
                                   placeholder="Nhập tên thương hiệu">
                            @error('name')
                                <div class="text-danger mt-1"><i class="fas fa-exclamation-triangle me-1"></i>{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="description" class="form-label fw-bold">
                                <i class="fas fa-align-left me-2 text-info"></i>Mô tả
                            </label>
                            <textarea name="description" id="description" rows="4" 
                                      class="form-control form-control-lg rounded-3 shadow-sm" 
                                      placeholder="Nhập mô tả thương hiệu">{{ old('description', $brand->description) }}</textarea>
                            @error('description')
                                <div class="text-danger mt-1"><i class="fas fa-exclamation-triangle me-1"></i>{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="sort_order" class="form-label fw-bold">
                                <i class="fas fa-sort me-2 text-secondary"></i>Thứ tự sắp xếp
                            </label>
                            <select name="sort_order" id="sort_order" class="form-select form-select-lg rounded-3 shadow-sm">
                                <option value="">Chọn thứ tự</option>
                                {!! $htmlsortorder !!}
                            </select>
                            @error('sort_order')
                                <div class="text-danger mt-1"><i class="fas fa-exclamation-triangle me-1"></i>{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="image" class="form-label fw-bold">
                                <i class="fas fa-image me-2 text-primary"></i>Hình ảnh thương hiệu
                            </label>
                            
                            <!-- Current Image Display -->
                            <div class="current-image-preview mb-3">
                                @php
                                    $imagePath = null;
                                    $extensions = ['png', 'jpg', 'jpeg'];
                                    foreach ($extensions as $ext) {
                                        $path = public_path('images/brand/' . $brand->slug . '.' . $ext);
                                        if (file_exists($path)) {
                                            $imagePath = asset('images/brand/' . $brand->slug . '.' . $ext);
                                            break;
                                        }
                                    }
                                @endphp
                                
                                @if($imagePath)
                                    <div class="current-image-container p-3 bg-light rounded-3">
                                        <div class="text-muted mb-2">
                                            <i class="fas fa-image me-1"></i>Hình ảnh hiện tại:
                                        </div>
                                        <img src="{{ $imagePath }}" alt="{{ $brand->name }}" 
                                             class="rounded-3 shadow-sm border"
                                             style="max-width: 150px; max-height: 150px; object-fit: cover;">
                                    </div>
                                @else
                                    <div class="no-image-container p-3 bg-light rounded-3">
                                        <div class="text-muted mb-2">
                                            <i class="fas fa-exclamation-circle me-1"></i>Chưa có hình ảnh:
                                        </div>
                                        <div class="bg-white rounded-3 d-flex align-items-center justify-content-center border" 
                                             style="width: 150px; height: 150px;">
                                            <div class="text-center text-muted">
                                                <i class="fas fa-building fa-3x mb-2"></i>
                                                <div>Chưa có ảnh</div>
                                            </div>
                                        </div>
                                    </div>
                                @endif
                            </div>
                            
                            <input type="file" name="image" id="image" 
                                   class="form-control form-control-lg rounded-3 shadow-sm" 
                                   accept="image/*">
                            <small class="form-text text-muted mt-2">
                                <i class="fas fa-info-circle me-1"></i>Chọn file ảnh mới để thay đổi (PNG, JPG, JPEG)
                            </small>
                            @error('image')
                                <div class="text-danger mt-1"><i class="fas fa-exclamation-triangle me-1"></i>{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="status" class="form-label fw-bold">
                                <i class="fas fa-toggle-on me-2 text-success"></i>Trạng thái
                            </label>
                            <select name="status" id="status" class="form-select form-select-lg rounded-3 shadow-sm">
                                <option value="1" {{ $brand->status == 1 ? 'selected' : '' }}>Hiển thị</option>
                                <option value="0" {{ $brand->status == 0 ? 'selected' : '' }}>Ẩn</option>
                            </select>
                            @error('status')
                                <div class="text-danger mt-1"><i class="fas fa-exclamation-triangle me-1"></i>{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="text-center">
                            <button type="submit" class="btn btn-gradient-warning btn-lg rounded-pill shadow px-5 hover-lift">
                                <i class="fas fa-save me-2"></i>Cập nhật thương hiệu
                            </button>
                        </div>
                    </form>
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
    const form = document.getElementById('editBrandForm');
    const nameInput = document.getElementById('name');
    const imageInput = document.getElementById('image');
    
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
    if (imageInput) {
        imageInput.addEventListener('change', function(e) {
            const file = e.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    // Create or update preview
                    let previewContainer = document.querySelector('.new-image-preview');
                    if (!previewContainer) {
                        previewContainer = document.createElement('div');
                        previewContainer.className = 'new-image-preview mt-3 p-3 bg-success bg-opacity-10 rounded-3';
                        imageInput.parentNode.appendChild(previewContainer);
                    }
                    
                    previewContainer.innerHTML = `
                        <div class="text-success mb-2">
                            <i class="fas fa-check-circle me-1"></i>Ảnh mới đã chọn:
                        </div>
                        <img src="${e.target.result}" alt="Preview" 
                             class="rounded-3 shadow-sm border border-success"
                             style="max-width: 150px; max-height: 150px; object-fit: cover;">
                    `;
                };
                reader.readAsDataURL(file);
            }
        });
    }
});
</script>

<style>
.hover-lift:hover {
    transform: translateY(-2px);
    box-shadow: 0 4px 15px rgba(0,0,0,0.2);
    transition: all 0.3s ease;
}

.text-gradient {
    background: linear-gradient(45deg, #667eea 0%, #764ba2 100%);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    background-clip: text;
}

.bg-gradient-warning {
    background: linear-gradient(45deg, #f093fb 0%, #f5576c 100%);
}

.btn-gradient-warning {
    background: linear-gradient(45deg, #f093fb 0%, #f5576c 100%);
    border: none;
    color: white;
}

.btn-gradient-warning:hover {
    background: linear-gradient(45deg, #ed7de6 0%, #f04356 100%);
    color: white;
}

.card {
    border: none;
    box-shadow: 0 10px 30px rgba(0,0,0,0.1);
}

.form-control:focus, .form-select:focus {
    border-color: #f093fb;
    box-shadow: 0 0 0 0.2rem rgba(240, 147, 251, 0.25);
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

.current-image-container, .no-image-container {
    transition: all 0.3s ease;
}

.current-image-container:hover, .no-image-container:hover {
    transform: translateY(-2px);
    box-shadow: 0 4px 15px rgba(0,0,0,0.1);
}
</style>

@endsection
