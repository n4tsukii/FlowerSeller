@extends('layouts.admin')
@section('title', 'Chỉnh sửa chủ đề')
@section('content')

<div class="content-wrapper">
    <!-- CONTENT -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="text-gradient fw-bold">
                        <i class="fas fa-edit me-2"></i>Chỉnh sửa chủ đề
                    </h1>
                </div>
                <div class="col-sm-6">
                    <nav aria-label="breadcrumb" class="float-sm-right">
                        <ol class="breadcrumb bg-transparent mb-0">
                            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard.index') }}" class="text-primary">Dashboard</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('admin.topic.index') }}" class="text-primary">Quản lý chủ đề</a></li>
                            <li class="breadcrumb-item active text-secondary">Chỉnh sửa</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </section>
    <section class="content">
        <div class="card shadow-lg border-0 rounded-4 overflow-hidden">
            <div class="card-header bg-gradient-info text-white border-0 py-4">
                <div class="row align-items-center">
                    <div class="col-md-6">
                        <h4 class="mb-0 fw-bold">
                            <i class="fas fa-edit me-2"></i>Chỉnh sửa chủ đề
                        </h4>
                        <small class="opacity-75">Cập nhật thông tin chủ đề</small>
                    </div>
                    <div class="col-md-6 text-end">
                        <a href="{{ route('admin.topic.index') }}" class="btn btn-outline-light btn-sm rounded-pill shadow-sm hover-lift">
                            <i class="fa fa-arrow-left me-1"></i>Quay lại danh sách
                        </a>
                    </div>
                </div>
            </div>
            <div class="card-body p-4">
                <div class="row justify-content-center">
                    <div class="col-md-8">
                        <form action="{{ route('admin.topic.update', $topic->id) }}" method="post" id="editTopicForm">
                            @csrf
                            @method('PUT')

                            <div class="mb-4">
                                <label for="name" class="form-label fw-bold">
                                    <i class="fas fa-tag me-2 text-primary"></i>Tên chủ đề
                                </label>
                                <input type="text" id="name" class="form-control form-control-lg rounded-3 shadow-sm" name="name"
                                    value="{{ old('name', $topic->name) }}" placeholder="Nhập tên chủ đề" />
                                @error('name')
                                <div class="text-danger mt-1"><i class="fas fa-exclamation-triangle me-1"></i>{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-4">
                                <label for="sort_order" class="form-label fw-bold">
                                    <i class="fas fa-sort me-2 text-secondary"></i>Thứ tự sắp xếp
                                </label>
                                <select name="sort_order" id="sort_order" class="form-select form-select-lg rounded-3 shadow-sm">
                                    <option value="0">Chọn vị trí</option>
                                    {!! $htmlsortorder !!}
                                </select>
                                @error('sort_order')
                                <div class="text-danger mt-1"><i class="fas fa-exclamation-triangle me-1"></i>{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-4">
                                <label for="description" class="form-label fw-bold">
                                    <i class="fas fa-align-left me-2 text-info"></i>Mô tả
                                </label>
                                <textarea name="description" id="description" class="form-control form-control-lg rounded-3 shadow-sm"
                                    rows="4" placeholder="Nhập mô tả chủ đề">{{ old('description', $topic->description) }}</textarea>
                                @error('description')
                                <div class="text-danger mt-1"><i class="fas fa-exclamation-triangle me-1"></i>{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-4">
                                <label for="status" class="form-label fw-bold">
                                    <i class="fas fa-toggle-on me-2 text-success"></i>Trạng thái
                                </label>
                                <select name="status" id="status" class="form-select form-select-lg rounded-3 shadow-sm">
                                    <option value="1" {{ $topic->status == 1 ? 'selected' : '' }}>Kích hoạt</option>
                                    <option value="0" {{ $topic->status == 0 ? 'selected' : '' }}>Tạm dừng</option>
                                </select>
                                @error('status')
                                <div class="text-danger mt-1"><i class="fas fa-exclamation-triangle me-1"></i>{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="text-center">
                                <button type="submit" class="btn btn-gradient-info btn-lg rounded-pill shadow px-5 hover-lift">
                                    <i class="fas fa-save me-2"></i>Cập nhật chủ đề
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- /.CONTENT -->
</div>

<!-- Enhanced JavaScript -->
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Form validation
    const form = document.getElementById('editTopicForm');
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

.bg-gradient-info {
    background: linear-gradient(45deg, #36d1dc 0%, #5b86e5 100%);
}

.btn-gradient-info {
    background: linear-gradient(45deg, #36d1dc 0%, #5b86e5 100%);
    border: none;
    color: white;
}

.btn-gradient-info:hover {
    background: linear-gradient(45deg, #2ab5bf 0%, #4a73d1 100%);
    color: white;
}

.card {
    border: none;
    box-shadow: 0 10px 30px rgba(0,0,0,0.1);
}

.form-control:focus, .form-select:focus {
    border-color: #36d1dc;
    box-shadow: 0 0 0 0.2rem rgba(54, 209, 220, 0.25);
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
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-12 mb-3">
                                <label for="sort_order" class="form-label">Sort Order</label>
                                <select name="sort_order" id="sort_order" class="form-control">
                                    <option value="">Sort order</option>
                                    {!! $htmlsortorder !!}
                                </select>
                                @error('sort_order')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-12 mb-3">
                                <label for="description" class="form-label">Description</label>
                                <textarea 
                                    name="description" 
                                    id="description" 
                                    class="form-control"
                                    rows="3"
                                >{{ old('description', $topic->description) }}</textarea>
                                @error('description')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-12 mb-3">
                                <label for="status" class="form-label">Status</label>
                                <select name="status" id="status" class="form-control">
                                    <option value="1" {{ old('status', $topic->status) == 1 ? 'selected' : '' }}>Chưa xuất bản</option>
                                    <option value="0" {{ old('status', $topic->status) == 0 ? 'selected' : '' }}>Xuất bản</option>
                                </select>
                                @error('status')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-12 mb-3">
                                <button class="btn btn-primary w-100" type="submit">
                                    Update
                                </button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </section>
    <!-- /.CONTENT -->
</div>
@endsection
