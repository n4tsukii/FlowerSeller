@extends('layouts.admin')
@section('title', 'Chi tiết sản phẩm')
@section('content')
<div class="content-wrapper">
    <!-- Content Header -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="text-gradient fw-bold">
                        <i class="fas fa-eye me-2"></i>Chi tiết sản phẩm
                    </h1>
                    <p class="text-muted">Thông tin chi tiết sản phẩm</p>
                </div>
                <div class="col-sm-6">
                    <nav aria-label="breadcrumb" class="float-sm-right">
                        <ol class="breadcrumb bg-transparent mb-0">
                            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard.index') }}" class="text-primary">Dashboard</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('admin.product.index') }}" class="text-primary">Sản phẩm</a></li>
                            <li class="breadcrumb-item active text-secondary">Chi tiết</li>
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
                    <div class="card-header bg-gradient-info text-white border-0 py-4">
                        <div class="row align-items-center">
                            <div class="col-md-6">
                                <h4 class="mb-0 fw-bold">
                                    <i class="fas fa-info-circle me-2"></i>{{ $product->name }}
                                </h4>
                                <small class="opacity-75">ID: {{ $product->id }}</small>
                            </div>
                            <div class="col-md-6 text-end">
                                <div class="btn-group">
                                    <a href="{{ route('admin.product.edit', ['id' => $product->id]) }}" 
                                       class="btn btn-outline-light btn-sm rounded-pill me-2 shadow-sm hover-lift">
                                        <i class="fas fa-edit me-1"></i>Chỉnh sửa
                                    </a>
                                    <a href="{{ route('admin.product.delete', ['id' => $product->id]) }}" 
                                       class="btn btn-outline-light btn-sm rounded-pill me-2 shadow-sm hover-lift"
                                       onclick="return confirm('Bạn có chắc chắn muốn xóa sản phẩm này?')">
                                        <i class="fas fa-trash me-1"></i>Xóa
                                    </a>
                                    <a href="{{ route('admin.product.index') }}" 
                                       class="btn btn-light btn-sm rounded-pill shadow-sm hover-lift">
                                        <i class="fas fa-arrow-left me-1"></i>Quay lại
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="card-body p-0">
                        <div class="row g-0">
                            <!-- Hình ảnh sản phẩm -->
                            <div class="col-lg-5">
                                <div class="p-4 bg-light h-100 d-flex align-items-center justify-content-center">
                                    @if($product->image && file_exists(public_path('images/products/'.$product->image)))
                                        <img src="{{ asset('images/products/'.$product->image) }}" 
                                             alt="{{ $product->name }}" 
                                             class="img-fluid rounded-3 shadow-lg"
                                             style="max-height: 400px; object-fit: cover;">
                                    @else
                                        <div class="text-center text-muted">
                                            <i class="fas fa-image fa-5x mb-3"></i>
                                            <p>Không có hình ảnh</p>
                                        </div>
                                    @endif
                                </div>
                            </div>
                            
                            <!-- Thông tin sản phẩm -->
                            <div class="col-lg-7">
                                <div class="p-4">
                                    <div class="row g-4">
                                        <!-- Tên sản phẩm -->
                                        <div class="col-12">
                                            <div class="info-item">
                                                <label class="info-label">
                                                    <i class="fas fa-tag text-primary me-2"></i>Tên sản phẩm
                                                </label>
                                                <div class="info-value h5 fw-bold text-dark">{{ $product->name }}</div>
                                            </div>
                                        </div>

                                        <!-- Danh mục và Thương hiệu -->
                                        <div class="col-md-6">
                                            <div class="info-item">
                                                <label class="info-label">
                                                    <i class="fas fa-sitemap text-success me-2"></i>Danh mục
                                                </label>
                                                <div class="info-value">
                                                    <span class="badge bg-gradient-success rounded-pill px-3 py-2">
                                                        ID: {{ $product->category_id }}
                                                    </span>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="info-item">
                                                <label class="info-label">
                                                    <i class="fas fa-award text-warning me-2"></i>Thương hiệu
                                                </label>
                                                <div class="info-value">
                                                    <span class="badge bg-gradient-warning rounded-pill px-3 py-2">
                                                        ID: {{ $product->brand_id }}
                                                    </span>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Giá -->
                                        <div class="col-md-6">
                                            <div class="info-item">
                                                <label class="info-label">
                                                    <i class="fas fa-money-bill-wave text-info me-2"></i>Giá bán
                                                </label>
                                                <div class="info-value h5 text-info fw-bold">
                                                    {{ number_format($product->price, 0, ',', '.') }}đ
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="info-item">
                                                <label class="info-label">
                                                    <i class="fas fa-percent text-danger me-2"></i>Giá khuyến mãi
                                                </label>
                                                <div class="info-value h5 text-danger fw-bold">
                                                    @if($product->pricesale > 0)
                                                        {{ number_format($product->pricesale, 0, ',', '.') }}đ
                                                    @else
                                                        <span class="text-muted">Không có</span>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Số lượng -->
                                        <div class="col-md-6">
                                            <div class="info-item">
                                                <label class="info-label">
                                                    <i class="fas fa-boxes text-secondary me-2"></i>Số lượng
                                                </label>
                                                <div class="info-value">
                                                    <span class="badge bg-gradient-secondary rounded-pill px-3 py-2 h6">
                                                        {{ $product->qty }} sản phẩm
                                                    </span>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Trạng thái -->
                                        <div class="col-md-6">
                                            <div class="info-item">
                                                <label class="info-label">
                                                    <i class="fas fa-toggle-on text-success me-2"></i>Trạng thái
                                                </label>
                                                <div class="info-value">
                                                    @if($product->status == 1)
                                                        <span class="badge bg-gradient-success rounded-pill px-3 py-2">
                                                            <i class="fas fa-check-circle me-1"></i>Đang bán
                                                        </span>
                                                    @else
                                                        <span class="badge bg-gradient-secondary rounded-pill px-3 py-2">
                                                            <i class="fas fa-pause-circle me-1"></i>Tạm dừng
                                                        </span>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Chi tiết -->
                                        @if($product->detail)
                                        <div class="col-12">
                                            <div class="info-item">
                                                <label class="info-label">
                                                    <i class="fas fa-align-left text-primary me-2"></i>Chi tiết ngắn
                                                </label>
                                                <div class="info-value">
                                                    <div class="p-3 bg-light rounded-3">
                                                        {{ $product->detail }}
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        @endif

                                        <!-- Mô tả -->
                                        @if($product->description)
                                        <div class="col-12">
                                            <div class="info-item">
                                                <label class="info-label">
                                                    <i class="fas fa-file-alt text-success me-2"></i>Mô tả chi tiết
                                                </label>
                                                <div class="info-value">
                                                    <div class="p-3 bg-light rounded-3">
                                                        {{ $product->description }}
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        @endif

                                        <!-- Thời gian -->
                                        <div class="col-md-6">
                                            <div class="info-item">
                                                <label class="info-label">
                                                    <i class="fas fa-calendar-plus text-info me-2"></i>Ngày tạo
                                                </label>
                                                <div class="info-value text-muted">
                                                    {{ $product->created_at->format('d/m/Y H:i') }}
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="info-item">
                                                <label class="info-label">
                                                    <i class="fas fa-calendar-edit text-warning me-2"></i>Cập nhật cuối
                                                </label>
                                                <div class="info-value text-muted">
                                                    {{ $product->updated_at->format('d/m/Y H:i') }}
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
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
.info-item {
    margin-bottom: 1.5rem;
}

.info-label {
    display: block;
    font-weight: 600;
    color: #6c757d;
    margin-bottom: 0.5rem;
    font-size: 0.9rem;
}

.info-value {
    font-size: 1rem;
    color: #495057;
    line-height: 1.5;
}

.card {
    box-shadow: 0 10px 30px rgba(0,0,0,0.1);
}

.product-detail-image {
    max-height: 400px;
    object-fit: cover;
    transition: transform 0.3s ease;
}

.product-detail-image:hover {
    transform: scale(1.05);
}

@media (max-width: 768px) {
    .col-lg-5, .col-lg-7 {
        flex: 0 0 100%;
        max-width: 100%;
    }
}
</style>
@endpush

@endsection
                            <td class="text-center"><strong>Ngày cập nhật</strong></td>
                            <td class="text-center">{{ $product->updated_at }}</td>
                        </tr>
                        <tr>
                            <td class="text-center"><strong>Người tạo</strong></td>
                            <td class="text-center">{{ $product->created_by }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </section>
</div>
@endsection
