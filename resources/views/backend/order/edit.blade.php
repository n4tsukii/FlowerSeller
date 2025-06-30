@extends('layouts.admin')
@section('title','Cập nhật Đơn hàng')
@section('content')
<div class="content-wrapper">
    <!-- CONTENT -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="text-gradient fw-bold">
              <i class="fas fa-edit me-2"></i>Cập nhật Đơn hàng
            </h1>
          </div>
          <div class="col-sm-6">
            <nav aria-label="breadcrumb" class="float-sm-right">
              <ol class="breadcrumb bg-transparent mb-0">
                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard.index') }}" class="text-primary">Bảng điều khiển</a></li>
                <li class="breadcrumb-item"><a href="{{ route('admin.order.index') }}" class="text-primary">Đơn hàng</a></li>
                <li class="breadcrumb-item active text-secondary">Cập nhật</li>
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
                <i class="fas fa-edit me-2"></i>Cập nhật Đơn hàng
              </h4>
              <small class="opacity-75">Chỉnh sửa thông tin đơn hàng</small>
            </div>
            <div class="col-md-6 text-end">
              <a href="{{ route('admin.order.index') }}" class="btn btn-outline-light btn-sm rounded-pill shadow-sm hover-lift">
                <i class="fas fa-arrow-left me-1"></i>Quay lại danh sách
              </a>
            </div>
          </div>
        </div>
        <div class="card-body p-4">
            <form action="{{ route('admin.order.update', $order->id) }}" method="post" class="needs-validation" novalidate>
                @csrf
                @method('put')
                <div class="container-fluid">
                    <div class="row g-4">
                        <div class="col-md-6">
                            <div class="form-floating">
                                <input type="text" id="user_id" class="form-control" name="user_id" value="{{ old('user_id', $order->user_id) }}" readonly placeholder="ID Người dùng" />
                                <label for="user_id"><i class="fas fa-user me-2"></i>ID Người dùng</label>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-floating">
                                <input type="text" id="delivery_name" class="form-control @error('delivery_name') is-invalid @enderror" name="delivery_name" value="{{ old('delivery_name', $order->delivery_name) }}" placeholder="Tên người nhận" required />
                                <label for="delivery_name"><i class="fas fa-user-tag me-2"></i>Tên người nhận</label>
                                @error('delivery_name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-floating">
                                <select id="delivery_gender" class="form-select @error('delivery_gender') is-invalid @enderror" name="delivery_gender" required>
                                    <option value="">Chọn giới tính</option>
                                    <option value="1" {{ old('delivery_gender', $order->delivery_gender) == 1 ? 'selected' : '' }}>Nam</option>
                                    <option value="2" {{ old('delivery_gender', $order->delivery_gender) == 2 ? 'selected' : '' }}>Nữ</option>
                                </select>
                                <label for="delivery_gender"><i class="fas fa-venus-mars me-2"></i>Giới tính</label>
                                @error('delivery_gender')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-floating">
                                <input type="email" id="delivery_email" class="form-control @error('delivery_email') is-invalid @enderror" name="delivery_email" value="{{ old('delivery_email', $order->delivery_email) }}" placeholder="Email người nhận" required />
                                <label for="delivery_email"><i class="fas fa-envelope me-2"></i>Email người nhận</label>
                                @error('delivery_email')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-floating">
                                <input type="tel" id="delivery_phone" class="form-control @error('delivery_phone') is-invalid @enderror" name="delivery_phone" value="{{ old('delivery_phone', $order->delivery_phone) }}" placeholder="Số điện thoại" required />
                                <label for="delivery_phone"><i class="fas fa-phone me-2"></i>Số điện thoại</label>
                                @error('delivery_phone')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-floating">
                                <select name="status" id="status" class="form-select @error('status') is-invalid @enderror" required>
                                    <option value="1" {{ $order->status == 1 ? 'selected' : '' }}>Chờ xử lý</option>
                                    <option value="2" {{ $order->status == 2 ? 'selected' : '' }}>Đang xử lý</option>
                                    <option value="3" {{ $order->status == 3 ? 'selected' : '' }}>Hoàn thành</option>
                                    <option value="4" {{ $order->status == 4 ? 'selected' : '' }}>Đã hủy</option>
                                </select>
                                <label for="status"><i class="fas fa-flag me-2"></i>Trạng thái</label>
                                @error('status')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="col-12">
                            <div class="form-floating">
                                <input type="text" id="delivery_address" class="form-control @error('delivery_address') is-invalid @enderror" name="delivery_address" value="{{ old('delivery_address', $order->delivery_address) }}" placeholder="Địa chỉ giao hàng" required />
                                <label for="delivery_address"><i class="fas fa-map-marker-alt me-2"></i>Địa chỉ giao hàng</label>
                                @error('delivery_address')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="col-12">
                            <div class="form-floating">
                                <textarea id="note" class="form-control @error('note') is-invalid @enderror" name="note" placeholder="Ghi chú giao hàng" style="height: 120px">{{ old('note', $order->note) }}</textarea>
                                <label for="note"><i class="fas fa-sticky-note me-2"></i>Ghi chú giao hàng</label>
                                @error('note')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="col-12">
                            <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                                <a href="{{ route('admin.order.index') }}" class="btn btn-outline-secondary btn-lg rounded-pill me-md-2">
                                    <i class="fas fa-times me-2"></i>Hủy bỏ
                                </a>
                                <button class="btn btn-primary btn-lg rounded-pill" type="submit">
                                    <i class="fas fa-save me-2"></i>Cập nhật Đơn hàng
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
      </div>
    </section>
</div>
</div>

<style>
.text-gradient {
    background: linear-gradient(45deg, #667eea 0%, #764ba2 100%);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    background-clip: text;
}

.bg-gradient-primary {
    background: linear-gradient(45deg, #667eea 0%, #764ba2 100%);
}

.hover-lift:hover {
    transform: translateY(-2px);
    box-shadow: 0 4px 15px rgba(0,0,0,0.2);
    transition: all 0.3s ease;
}

.card {
    border: none;
    box-shadow: 0 10px 30px rgba(0,0,0,0.1);
}

.form-floating > .form-control:focus ~ label,
.form-floating > .form-control:not(:placeholder-shown) ~ label,
.form-floating > .form-select ~ label {
    color: #667eea;
}

.form-floating > .form-control:focus,
.form-floating > .form-select:focus {
    border-color: #667eea;
    box-shadow: 0 0 0 0.25rem rgba(102, 126, 234, 0.25);
}

.btn-primary {
    background: linear-gradient(45deg, #667eea 0%, #764ba2 100%);
    border: none;
}

.btn-primary:hover {
    background: linear-gradient(45deg, #5a67d8 0%, #6b46c1 100%);
    transform: translateY(-2px);
    box-shadow: 0 4px 15px rgba(102, 126, 234, 0.3);
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Form validation
    const forms = document.querySelectorAll('.needs-validation');
    Array.from(forms).forEach(form => {
        form.addEventListener('submit', event => {
            if (!form.checkValidity()) {
                event.preventDefault();
                event.stopPropagation();
            }
            form.classList.add('was-validated');
        }, false);
    });

    // Auto-focus first input
    const firstInput = document.querySelector('input[name="delivery_name"]');
    if (firstInput) {
        firstInput.focus();
    }
});
</script>

@endsection