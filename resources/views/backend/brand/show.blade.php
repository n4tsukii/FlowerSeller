@extends('layouts.admin')
@section('title', 'Chi tiết thương hiệu')
@section('content')
<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Chi tiết thương hiệu</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard.index') }}">Trang chủ</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('admin.brand.index') }}">Quản lý thương hiệu</a></li>
                        <li class="breadcrumb-item active">Chi tiết</li>
                    </ol>
                </div>
            </div>
        </div>
    </section>
    <section class="content">
        <div class="card">
            <div class="card-header">
                <div class="row">
                    <div class="col-12 text-right">
                        <a href="{{ route('admin.brand.edit', ['id' => $brand->id]) }}" class="btn btn-sm btn-primary">
                            <i class="far fa-edit"></i> Chỉnh sửa
                        </a>
                        <a href="{{ route('admin.brand.delete', ['id' => $brand->id]) }}" class="btn btn-sm btn-danger">
                            <i class="fas fa-trash"></i> Xóa
                        </a>
                        <a class="btn btn-sm btn-info" href="{{ route('admin.brand.index') }}">
                            <i class="fa fa-arrow-left"></i> Quay lại danh sách
                        </a>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div class="card-body">
                    <table class="table table-bordered table-striped table-hover">
                        <thead>
                            <tr>
                                <th class="text-center" style="width:30%;"><strong>Tên trường</strong></th>
                                <th class="text-center" style="width:70%;">Giá trị</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td class="text-center"><strong>Tên thương hiệu</strong></td>
                                <td class="text-center">{{ $brand->name }}</td>
                            </tr>
                            <tr>
                                <td class="text-center"><strong>Slug</strong></td>
                                <td class="text-center">{{ $brand->slug }}</td>
                            </tr>
                            <tr>
                                <td class="text-center"><strong>Mô tả</strong></td>
                                <td class="text-center">{{ $brand->description }}</td>
                            </tr>
                            <tr>
                                <td class="text-center"><strong>Hình ảnh</strong></td>
                                <td class="text-center">
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
                                        <img class="rounded" style="max-width: 150px; max-height: 150px; object-fit: cover;" 
                                             src="{{ $imagePath }}" 
                                             alt="{{ $brand->name }}">
                                    @else
                                        <div class="bg-light rounded d-flex align-items-center justify-content-center mx-auto" 
                                             style="width: 150px; height: 150px;">
                                            <i class="fas fa-building text-muted fa-3x"></i>
                                        </div>
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <td class="text-center"><strong>Thứ tự sắp xếp</strong></td>
                                <td class="text-center">{{ $brand->sort_order }}</td>
                            </tr>
                            <tr>
                                <td class="text-center"><strong>Trạng thái</strong></td>
                                <td class="text-center">
                                    @if ($brand->status==1)
                                        <span class="badge bg-success">
                                            <i class="fas fa-check me-1"></i>Hoạt động
                                        </span>
                                    @else
                                        <span class="badge bg-warning">
                                            <i class="fas fa-pause me-1"></i>Tạm dừng
                                        </span>
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <td class="text-center"><strong>Ngày tạo</strong></td>
                                <td class="text-center">{{ $brand->created_at->format('d/m/Y H:i:s') }}</td>
                            </tr>
                            <tr>
                                <td class="text-center"><strong>Người tạo</strong></td>
                                <td class="text-center">{{ $brand->created_by }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection
 