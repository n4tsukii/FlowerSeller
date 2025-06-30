@extends('layouts.admin')
@section('title', 'Quản lý chủ đề')
@section('content')
<div class="content-wrapper">
    <!-- CONTENT -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="text-gradient fw-bold">
                        <i class="fas fa-tags me-2"></i>Quản lý chủ đề
                    </h1>
                </div>
                <div class="col-sm-6">
                    <nav aria-label="breadcrumb" class="float-sm-right">
                        <ol class="breadcrumb bg-transparent mb-0">
                            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard.index') }}" class="text-primary">Dashboard</a></li>
                            <li class="breadcrumb-item active text-secondary">Chủ đề</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </section>
    <section class="content">
        <div class="row">
            <!-- Add New Topic Form -->
            <div class="col-md-4">
                <div class="card shadow-lg border-0 rounded-4 overflow-hidden">
                    <div class="card-header bg-gradient-info text-white border-0 py-4">
                        <h5 class="mb-0 fw-bold">
                            <i class="fas fa-plus-circle me-2"></i>Thêm chủ đề mới
                        </h5>
                        <small class="opacity-75">Tạo chủ đề cho bài viết</small>
                    </div>
                    <div class="card-body p-4">
                        <form action="{{ route('admin.topic.store') }}" method="post" id="topicForm">
                            @csrf
                            <div class="mb-3">
                                <label for="name" class="form-label fw-bold">
                                    <i class="fas fa-tag me-2 text-primary"></i>Tên chủ đề
                                </label>
                                <input type="text" id="name" class="form-control form-control-lg rounded-3 shadow-sm" name="name"
                                    value="{{ old('name') }}" placeholder="Nhập tên chủ đề" />
                                @error('name')
                                <div class="text-danger mt-1"><i class="fas fa-exclamation-triangle me-1"></i>{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="sort_order" class="form-label fw-bold">
                                    <i class="fas fa-sort me-2 text-secondary"></i>Thứ tự sắp xếp
                                </label>
                                <select name="sort_order" id="sort_order" class="form-select rounded-3 shadow-sm">
                                    <option value="0">Chọn vị trí</option>
                                    {!! $htmlsortorder !!}
                                </select>
                                @error('sort_order')
                                <div class="text-danger mt-1"><i class="fas fa-exclamation-triangle me-1"></i>{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="description" class="form-label fw-bold">
                                    <i class="fas fa-align-left me-2 text-info"></i>Mô tả
                                </label>
                                <textarea name="description" id="description" class="form-control rounded-3 shadow-sm"
                                    rows="3" placeholder="Nhập mô tả chủ đề">{{ old('description') }}</textarea>
                                @error('description')
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
                                <button class="btn btn-gradient-info btn-lg rounded-pill shadow hover-lift" type="submit">
                                    <i class="fas fa-plus me-2"></i>Thêm chủ đề
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            
            <!-- Topics List -->
            <div class="col-md-8">
                <div class="card shadow-lg border-0 rounded-4 overflow-hidden">
                    <div class="card-header bg-gradient-primary text-white border-0 py-4">
                        <div class="row align-items-center">
                            <div class="col-md-6">
                                <h4 class="mb-0 fw-bold">
                                    <i class="fas fa-tags me-2"></i>Tất cả chủ đề
                                </h4>
                                <small class="opacity-75">Quản lý chủ đề bài viết</small>
                            </div>
                            <div class="col-md-6 text-end">
                                <a href="{{ route('admin.topic.trash') }}" class="btn btn-outline-light btn-sm rounded-pill shadow-sm hover-lift">
                                    <i class="fas fa-trash me-1"></i>Thùng rác
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <table class="table table-hover mb-0" id="topicsTable">
                                <thead class="bg-light">
                                    <tr>
                                        <th class="border-0 py-3">
                                            <i class="fas fa-tag me-2 text-primary"></i>Tên chủ đề
                                        </th>
                                        <th class="border-0 py-3">
                                            <i class="fas fa-align-left me-2 text-info"></i>Mô tả
                                        </th>
                                        <th class="text-center border-0 py-3">
                                            <i class="fas fa-toggle-on me-2 text-success"></i>Trạng thái
                                        </th>
                                        <th class="text-center border-0 py-3">
                                            <i class="fas fa-cogs me-2 text-dark"></i>Thao tác
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($list as $row)
                                    <tr class="topic-row border-bottom" data-status="{{ $row->status }}">
                                        <td class="align-middle">
                                            <div class="fw-bold text-dark mb-1">{{$row->name}}</div>
                                            <small class="text-muted">ID: {{ $row->id }}</small>
                                        </td>
                                        <td class="align-middle">
                                            <div class="text-muted">{{ Str::limit($row->description, 60) }}</div>
                                        </td>
                                        <td class="text-center align-middle">
                                            @if ($row->status==1)
                                                <span class="badge bg-gradient-success rounded-pill px-3 py-2">
                                                    <i class="fas fa-check me-1"></i>Hoạt động
                                                </span>
                                            @else
                                                <span class="badge bg-gradient-secondary rounded-pill px-3 py-2">
                                                    <i class="fas fa-pause me-1"></i>Tạm dừng
                                                </span>
                                            @endif
                                        </td>
                                        <td class="text-center align-middle">
                                            @php
                                                $args = ['id' => $row->id];
                                            @endphp
                                            <div class="btn-group" role="group">
                                                @if ($row->status==1)
                                                    <a href="{{ route('admin.topic.status', $args) }}" class="btn btn-sm btn-outline-warning rounded-pill me-1 hover-lift" title="Tạm dừng">
                                                        <i class="fas fa-pause"></i>
                                                    </a>
                                                @else
                                                    <a href="{{ route('admin.topic.status', $args) }}" class="btn btn-sm btn-outline-success rounded-pill me-1 hover-lift" title="Kích hoạt">
                                                        <i class="fas fa-play"></i>
                                                    </a>
                                                @endif
                                                <a href="{{ route('admin.topic.edit', $args) }}" class="btn btn-sm btn-outline-primary rounded-pill me-1 hover-lift" title="Chỉnh sửa">
                                                    <i class="fas fa-edit"></i>
                                                </a>
                                                <a href="{{ route('admin.topic.delete', $args) }}" class="btn btn-sm btn-outline-danger rounded-pill hover-lift" title="Xóa"
                                                   onclick="return confirm('Bạn có chắc chắn muốn xóa chủ đề này?')">
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
    <!-- /.CONTENT -->
</div>

<!-- Enhanced JavaScript -->
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Form validation
    const form = document.getElementById('topicForm');
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
    
    // Table row hover effects
    const rows = document.querySelectorAll('.topic-row');
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

.topic-row {
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

.bg-gradient-info {
    background: linear-gradient(45deg, #36d1dc 0%, #5b86e5 100%);
}

.bg-gradient-success {
    background: linear-gradient(45deg, #56ab2f 0%, #a8e6cf 100%);
}

.bg-gradient-secondary {
    background: linear-gradient(45deg, #bdc3c7 0%, #2c3e50 100%);
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
