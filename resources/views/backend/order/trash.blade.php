@extends('layouts.admin')
@section('title', 'Thùng rác Đơn hàng')
@section('content')
<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="text-gradient fw-bold">
                        <i class="fas fa-trash me-2"></i>Thùng rác Đơn hàng
                    </h1>
                </div>
                <div class="col-sm-6">
                    <nav aria-label="breadcrumb" class="float-sm-right">
                        <ol class="breadcrumb bg-transparent mb-0">
                            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard.index') }}" class="text-primary">Bảng điều khiển</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('admin.order.index') }}" class="text-primary">Đơn hàng</a></li>
                            <li class="breadcrumb-item active text-secondary">Thùng rác</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </section>
    
    <section class="content">
        <div class="card shadow-lg border-0 rounded-4 overflow-hidden">
            <div class="card-header bg-gradient-danger text-white border-0 py-4">
                <div class="row align-items-center">
                    <div class="col-md-6">
                        <h4 class="mb-0 fw-bold">
                            <i class="fas fa-trash me-2"></i>Đơn hàng đã xóa
                        </h4>
                        <small class="opacity-75">Khôi phục hoặc xóa vĩnh viễn đơn hàng</small>
                    </div>
                    <div class="col-md-6 text-end">
                        <a href="{{ route('admin.order.index') }}" class="btn btn-light btn-sm rounded-pill shadow-sm hover-lift">
                            <i class="fas fa-arrow-left me-1"></i>Quay lại Đơn hàng
                        </a>
                    </div>
                </div>
            </div>
            <div class="card-body p-0">
                @if($list->count() > 0)
                    <div class="table-responsive">
                        <table class="table table-hover mb-0">
                            <thead class="bg-light">
                                <tr>
                                    <th class="border-0 py-3">
                                        <i class="fas fa-user me-2 text-primary"></i>Khách hàng
                                    </th>
                                    <th class="border-0 py-3">
                                        <i class="fas fa-truck me-2 text-success"></i>Thông tin giao hàng
                                    </th>
                                    <th class="border-0 py-3">
                                        <i class="fas fa-envelope me-2 text-info"></i>Liên hệ
                                    </th>
                                    <th class="text-center border-0 py-3">
                                        <i class="fas fa-cogs me-2 text-dark"></i>Thao tác
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($list as $row)
                                <tr class="border-bottom">
                                    <td class="align-middle">
                                        <div class="d-flex align-items-center">
                                            <div class="avatar-circle me-3">
                                                <i class="fas fa-user text-white"></i>
                                            </div>
                                            <div>
                                                <div class="fw-bold text-dark">{{ $row->name }}</div>
                                                <small class="text-muted">ID Đơn hàng: {{ $row->id }}</small>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="align-middle">
                                        <div class="delivery-info">
                                            <div class="fw-bold text-dark">{{ $row->delivery_name }}</div>
                                            <div class="d-flex align-items-center mt-1">
                                                @if ($row->delivery_gender == 1)
                                                    <span class="badge bg-primary rounded-pill me-2">
                                                        <i class="fas fa-mars me-1"></i>Nam
                                                    </span>
                                                @elseif ($row->delivery_gender == 2)
                                                    <span class="badge bg-pink rounded-pill me-2">
                                                        <i class="fas fa-venus me-1"></i>Nữ
                                                    </span>
                                                @endif
                                            </div>
                                            <small class="text-muted">
                                                <i class="fas fa-map-marker-alt me-1"></i>{{ Str::limit($row->delivery_address, 30) }}
                                            </small>
                                        </div>
                                    </td>
                                    <td class="align-middle">
                                        <div class="contact-info">
                                            <div class="mb-1">
                                                <i class="fas fa-envelope me-2 text-info"></i>
                                                <span class="text-dark">{{ $row->delivery_email }}</span>
                                            </div>
                                            <div>
                                                <i class="fas fa-phone me-2 text-success"></i>
                                                <span class="text-dark">{{ $row->delivery_phone }}</span>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="text-center align-middle">
                                        @php
                                            $args = ['id' => $row->id];
                                        @endphp
                                        <div class="btn-group" role="group">
                                            <a href="{{ route('admin.order.show', $args) }}" 
                                               class="btn btn-outline-info btn-sm rounded-pill me-1 hover-lift"
                                               title="View Details">
                                                <i class="fas fa-eye"></i>
                                            </a>
                                            <a href="{{ route('admin.order.restore', $args) }}" 
                                               class="btn btn-outline-success btn-sm rounded-pill me-1 hover-lift"
                                               title="Restore Order">
                                                <i class="fas fa-undo"></i>
                                            </a>
                                            <form action="{{ route('admin.order.destroy', $args) }}" 
                                                  method="post" 
                                                  style="display: inline-block;"
                                                  onsubmit="return confirm('Are you sure you want to permanently delete this order?')">
                                                @csrf
                                                @method('delete')
                                                <button class="btn btn-outline-danger btn-sm rounded-pill hover-lift" 
                                                        type="submit"
                                                        title="Delete Permanently">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @else
                    <div class="text-center py-5">
                        <div class="mb-4">
                            <i class="fas fa-trash text-muted" style="font-size: 4rem;"></i>
                        </div>
                        <h5 class="text-muted">No deleted orders found</h5>
                        <p class="text-muted mb-4">All orders are active and available.</p>
                        <a href="{{ route('admin.order.index') }}" class="btn btn-primary rounded-pill">
                            <i class="fas fa-arrow-left me-2"></i>Back to Orders
                        </a>
                    </div>
                @endif
            </div>
        </div>
    </section>
</div>

<style>
.avatar-circle {
    width: 40px;
    height: 40px;
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    box-shadow: 0 2px 10px rgba(0,0,0,0.1);
}

.bg-pink {
    background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%) !important;
}
</style>
@endsection
