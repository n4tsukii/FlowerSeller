@extends('layouts.admin')
@section('title', 'Chỉnh sửa sản phẩm')
@section('content')
<div class="content-wrapper">
    <!-- Content Header -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="text-gradient fw-bold">
                        <i class="fas fa-edit me-2"></i>Chỉnh sửa sản phẩm
                    </h1>
                    <p class="text-muted">Cập nhật thông tin sản phẩm</p>
                </div>
                <div class="col-sm-6">
                    <nav aria-label="breadcrumb" class="float-sm-right">
                        <ol class="breadcrumb bg-transparent mb-0">
                            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard.index') }}" class="text-primary">Dashboard</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('admin.product.index') }}" class="text-primary">Sản phẩm</a></li>
                            <li class="breadcrumb-item active text-secondary">Chỉnh sửa</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </section>

    <section class="content">
        <div class="row">
            <div class="col-12">
                <div class="card shadow-lg border-0 rounded-4 overflow-hidden">
                    <div class="card-header bg-gradient-warning text-white border-0 py-4">
                        <div class="row align-items-center">
                            <div class="col-md-6">
                                <h4 class="mb-0 fw-bold">
                                    <i class="fas fa-pencil-alt me-2"></i>Cập nhật sản phẩm
                                </h4>
                                <small class="opacity-75">ID: {{ $product->id }} - {{ $product->name }}</small>
                            </div>
                            <div class="col-md-6 text-end">
                                <a href="{{ route('admin.product.index') }}" class="btn btn-outline-light btn-sm rounded-pill shadow-sm hover-lift">
                                    <i class="fas fa-arrow-left me-1"></i>Quay lại
                                </a>
                            </div>
                        </div>
                    </div>

                    <div class="card-body p-4">
                        <form action="{{ route('admin.product.update', $product->id) }}" method="post" enctype="multipart/form-data" id="editProductForm">
                            @csrf
                            @method('put')
                            <div class="row g-4">
                                <!-- Tên sản phẩm -->
                                <div class="col-md-6">
                                    <label for="name" class="form-label fw-bold">
                                        <i class="fas fa-tag me-2 text-primary"></i>Tên sản phẩm
                                    </label>
                                    <input type="text" id="name" class="form-control form-control-lg rounded-3 shadow-sm" 
                                           name="name" value="{{ old('name', $product->name) }}" placeholder="Nhập tên sản phẩm">
                                    @error('name')
                                        <div class="text-danger mt-1"><i class="fas fa-exclamation-triangle me-1"></i>{{ $message }}</div>
                                    @enderror
                                </div>
                                <!-- Danh mục -->
                                <div class="col-md-6">
                                    <label for="category_id" class="form-label fw-bold">
                                        <i class="fas fa-sitemap me-2 text-success"></i>Danh mục
                                    </label>
                                    <select name="category_id" id="category_id" class="form-select form-select-lg rounded-3 shadow-sm">
                                        <option value="">Chọn danh mục</option>
                                        {!! $htmlcategoryid !!}
                                    </select>
                                    @error('category_id')
                                        <div class="text-danger mt-1"><i class="fas fa-exclamation-triangle me-1"></i>{{ $message }}</div>
                                    @enderror
                                </div>

                                <!-- Thương hiệu -->
                                <div class="col-md-6">
                                    <label for="brand_id" class="form-label fw-bold">
                                        <i class="fas fa-award me-2 text-warning"></i>Thương hiệu
                                    </label>
                                    <select name="brand_id" id="brand_id" class="form-select form-select-lg rounded-3 shadow-sm">
                                        <option value="">Chọn thương hiệu</option>
                                        {!! $htmlbrandid !!}
                                    </select>
                                    @error('brand_id')
                                        <div class="text-danger mt-1"><i class="fas fa-exclamation-triangle me-1"></i>{{ $message }}</div>
                                    @enderror
                                </div>

                                <!-- Giá bán -->
                                <div class="col-md-6">
                                    <label for="price" class="form-label fw-bold">
                                        <i class="fas fa-money-bill-wave me-2 text-info"></i>Giá bán
                                    </label>
                                    <div class="input-group input-group-lg">
                                        <span class="input-group-text"><i class="fas fa-dong-sign"></i></span>
                                        <input type="number" id="price" class="form-control rounded-end-3 shadow-sm" 
                                               name="price" value="{{ old('price', $product->price) }}" placeholder="0">
                                    </div>
                                    @error('price')
                                        <div class="text-danger mt-1"><i class="fas fa-exclamation-triangle me-1"></i>{{ $message }}</div>
                                    @enderror
                                </div>

                                <!-- Giá khuyến mãi -->
                                <div class="col-md-6">
                                    <label for="pricesale" class="form-label fw-bold">
                                        <i class="fas fa-percent me-2 text-danger"></i>Giá khuyến mãi
                                    </label>
                                    <div class="input-group input-group-lg">
                                        <span class="input-group-text"><i class="fas fa-dong-sign"></i></span>
                                        <input type="number" id="pricesale" class="form-control rounded-end-3 shadow-sm" 
                                               name="pricesale" value="{{ old('pricesale', $product->pricesale) }}" placeholder="0">
                                    </div>
                                    @error('pricesale')
                                        <div class="text-danger mt-1"><i class="fas fa-exclamation-triangle me-1"></i>{{ $message }}</div>
                                    @enderror
                                </div>

                                <!-- Số lượng -->
                                <div class="col-md-6">
                                    <label for="qty" class="form-label fw-bold">
                                        <i class="fas fa-boxes me-2 text-info"></i>Số lượng
                                    </label>
                                    <input type="number" id="qty" class="form-control form-control-lg rounded-3 shadow-sm" 
                                           name="qty" value="{{ old('qty', $product->qty) }}" placeholder="0" min="0">
                                    @error('qty')
                                        <div class="text-danger mt-1"><i class="fas fa-exclamation-triangle me-1"></i>{{ $message }}</div>
                                    @enderror
                                </div>

                                <!-- Hình ảnh -->
                                <div class="col-md-6">
                                    <label for="image" class="form-label fw-bold">
                                        <i class="fas fa-image me-2 text-secondary"></i>Hình ảnh sản phẩm
                                    </label>
                                    @if($product->image && file_exists(public_path("images/products/" . $product->image)))
                                        <div class="mb-3">
                                            <img src="{{ asset("images/products/" . $product->image) }}" 
                                                 alt="{{ $product->name }}" 
                                                 class="img-thumbnail rounded-3 shadow-sm"
                                                 style="max-width: 150px; max-height: 150px; object-fit: cover;">
                                            <p class="text-muted small mt-1">Ảnh hiện tại</p>
                                        </div>
                                    @endif
                                    <input type="file" id="image" class="form-control form-control-lg rounded-3 shadow-sm" 
                                           name="image" accept="image/*" onchange="previewImage(this)">
                                    @error('image')
                                        <div class="text-danger mt-1"><i class="fas fa-exclamation-triangle me-1"></i>{{ $message }}</div>
                                    @enderror
                                    <div id="imagePreview" class="mt-2"></div>
                                </div>

                                <!-- Chi tiết -->
                                <div class="col-12">
                                    <label for="detail" class="form-label fw-bold">
                                        <i class="fas fa-align-left me-2 text-primary"></i>Chi tiết ngắn
                                    </label>
                                    <textarea name="detail" id="detail" class="form-control form-control-lg rounded-3 shadow-sm" 
                                              rows="3" placeholder="Mô tả ngắn về sản phẩm">{{ old('detail', $product->detail) }}</textarea>
                                    @error('detail')
                                        <div class="text-danger mt-1"><i class="fas fa-exclamation-triangle me-1"></i>{{ $message }}</div>
                                    @enderror
                                </div>

                                <!-- Mô tả -->
                                <div class="col-12">
                                    <label for="description" class="form-label fw-bold">
                                        <i class="fas fa-file-alt me-2 text-success"></i>Mô tả chi tiết
                                    </label>
                                    <textarea name="description" id="description" class="form-control form-control-lg rounded-3 shadow-sm" 
                                              rows="5" placeholder="Mô tả chi tiết về sản phẩm">{{ old('description', $product->description) }}</textarea>
                                    @error('description')
                                        <div class="text-danger mt-1"><i class="fas fa-exclamation-triangle me-1"></i>{{ $message }}</div>
                                    @enderror
                                </div>

                                <!-- Trạng thái -->
                                <div class="col-md-6">
                                    <label for="status" class="form-label fw-bold">
                                        <i class="fas fa-toggle-on me-2 text-success"></i>Trạng thái
                                    </label>
                                    <select name="status" id="status" class="form-select form-select-lg rounded-3 shadow-sm">
                                        <option value="1" {{ $product->status == 1 ? 'selected' : '' }}>Đang bán</option>
                                        <option value="0" {{ $product->status == 0 ? 'selected' : '' }}>Tạm dừng</option>
                                    </select>
                                    @error('status')
                                        <div class="text-danger mt-1"><i class="fas fa-exclamation-triangle me-1"></i>{{ $message }}</div>
                                    @enderror
                                </div>

                                <!-- Submit buttons -->
                                <div class="col-12">
                                    <div class="d-flex justify-content-end gap-3 mt-4">
                                        <a href="{{ route('admin.product.index') }}" class="btn btn-outline-secondary btn-lg rounded-pill px-4">
                                            <i class="fas fa-times me-2"></i>Hủy bỏ
                                        </a>
                                        <button type="submit" class="btn btn-gradient-warning btn-lg rounded-pill px-4 shadow hover-lift">
                                            <i class="fas fa-save me-2"></i>Cập nhật sản phẩm
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

@push('scripts')
<script>
function previewImage(input) {
    const preview = document.getElementById('imagePreview');
    preview.innerHTML = '';
    
    if (input.files && input.files[0]) {
        const reader = new FileReader();
        reader.onload = function(e) {
            preview.innerHTML = `
                <div class="mt-2">
                    <p class="text-muted small">Ảnh mới được chọn:</p>
                    <img src="${e.target.result}" class="img-thumbnail rounded-3 shadow-sm" 
                         style="max-width: 200px; max-height: 200px; object-fit: cover;">
                </div>
            `;
        };
        reader.readAsDataURL(input.files[0]);
    }
}

// Form enhancement
document.addEventListener('DOMContentLoaded', function() {
    // Add smooth animations
    const formGroups = document.querySelectorAll('.col-md-6, .col-12');
    formGroups.forEach((group, index) => {
        group.style.opacity = '0';
        group.style.transform = 'translateY(20px)';
        setTimeout(() => {
            group.style.transition = 'all 0.5s ease';
            group.style.opacity = '1';
            group.style.transform = 'translateY(0)';
        }, index * 100);
    });
});
</script>
@endpush

@endsection
