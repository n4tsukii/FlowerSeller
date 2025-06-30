@extends('layouts.admin')
@section('title', 'Thùng rác thương hiệu')
@section('content')
<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Thùng rác thương hiệu</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard.index') }}">Trang chủ</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('admin.brand.index') }}">Quản lý thương hiệu</a></li>
                        <li class="breadcrumb-item active">Thùng rác</li>
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
                        <a href="{{ route('admin.brand.index') }}" class="btn btn-sm btn-info">
                            <i class="fa fa-arrow-left" aria-hidden="true"></i> Quay lại danh sách
                        </a>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-12">
                        <table class="table table-bordered table-hover table-striped">
                            <thead>
                                <tr>
                                    <th class="text-center">Hình ảnh</th>
                                    <th class="text-center">Tên thương hiệu</th>
                                    <th class="text-center">Mô tả</th>
                                    <th class="text-center">Thao tác</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($list as $row)
                                <tr>
                                    <td class="text-center">
                                        @php
                                            $imagePath = null;
                                            $extensions = ['png', 'jpg', 'jpeg'];
                                            foreach ($extensions as $ext) {
                                                $path = public_path('images/brand/' . $row->slug . '.' . $ext);
                                                if (file_exists($path)) {
                                                    $imagePath = asset('images/brand/' . $row->slug . '.' . $ext);
                                                    break;
                                                }
                                            }
                                        @endphp
                                        
                                        @if($imagePath)
                                            <img class="rounded" style="width: 60px; height: 60px; object-fit: cover;" 
                                                 src="{{ $imagePath }}" 
                                                 alt="{{ $row->name }}">
                                        @else
                                            <div class="bg-light rounded d-flex align-items-center justify-content-center" 
                                                 style="width: 60px; height: 60px;">
                                                <i class="fas fa-building text-muted"></i>
                                            </div>
                                        @endif
                                    </td>
                                    <td class="fw-bold">{{ $row->name }}</td>
                                    <td>{{ $row->description }}</td>
                                    <td class="text-center">
                                        @php
                                            $args = ['id' => $row->id];
                                        @endphp

                                        <div class="btn-group" role="group">
                                            <a href="{{ route('admin.brand.restore', $args) }}" class="btn btn-sm btn-warning" title="Khôi phục">
                                                <i class="fa fa-undo" aria-hidden="true"></i>
                                            </a>
                                            <form action="{{ route('admin.brand.destroy', $args) }}" method="post" style="display: inline-block;">
                                                @csrf
                                                @method('delete')
                                                <button class="btn btn-sm btn-danger" name="delete" type="submit" title="Xóa vĩnh viễn">
                                                    <i class="fa fa-trash" aria-hidden="true"></i>
                                                </button>
                                            </form>
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
    </section>
</div>
@endsection
