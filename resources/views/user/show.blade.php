@extends('layouts.admin')
@section('title', 'Chi tiết người dùng')
@section('content')
<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Chi tiết người dùng</h1>
                </div>
            </div>
        </div>
    </section>
    <section class="content">
        <div class="card">
            <div class="card-header">
                <div class="row">
                    <div class="col-12 text-right">
                        <a href="{{ route('admin.user.edit', ['id' => $user->id]) }}" class="btn btn-sm btn-primary">
                            <i class="far fa-edit"></i>  
                        </a>
                        <a href="{{ route('admin.user.delete', ['id' => $user->id]) }}" class="btn btn-sm btn-danger">
                            <i class="fas fa-trash"></i>  
                        </a>
                        <a class="btn btn-sm btn-info" href="{{ route('admin.user.index') }}">
                            <i class="fa fa-arrow-left"></i> Quay lại danh sách
                        </a>
                    </div>
                </div>
            </div>
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
                            <td class="text-center"><strong>Mã người dùng</strong></td>
                            <td class="text-center">{{ $user->id }}</td>
                        </tr>
                        <tr>
                            <td class="text-center"><strong>Tên người dùng</strong></td>
                            <td class="text-center">{{ $user->name }}</td>
                        </tr>
                        <tr>
                            <td class="text-center"><strong>Tên đăng nhập</strong></td>
                            <td class="text-center">{{ $user->username }}</td>
                        </tr>
                        <tr>
                            <td class="text-center"><strong>Giới tính</strong></td>
                            <td class="text-center">{{ $user->gender == 1 ? 'Nam' : 'Nữ' }}</td>
                        </tr>
                        <tr>
                            <td class="text-center"><strong>Điện thoại</strong></td>
                            <td class="text-center">{{ $user->phone }}</td>
                        </tr>
                        <tr>
                            <td class="text-center"><strong>Email</strong></td>
                            <td class="text-center">{{ $user->email }}</td>
                        </tr>
                        <tr>
                            <td class="text-center"><strong>Địa chỉ</strong></td>
                            <td class="text-center">{{ $user->address }}</td>
                        </tr>
                        <tr>
                            <td class="text-center"><strong>Vai trò</strong></td>
                            <td class="text-center">{{ $user->roles }}</td>
                        </tr>
                        <tr>
                            <td class="text-center"><strong>Trạng thái</strong></td>
                            <td class="text-center">{{ $user->status == 1 ? 'Hoạt động' : 'Không hoạt động' }}</td>
                        </tr>
                        <tr>
                            <td class="text-center"><strong>Ngày tạo</strong></td>
                            <td class="text-center">{{ $user->created_at }}</td>
                        </tr>
                        <tr>
                            <td class="text-center"><strong>Ngày cập nhật</strong></td>
                            <td class="text-center">{{ $user->updated_at }}</td>
                        </tr>
                        <tr>
                            <td class="text-center"><strong>Người tạo</strong></td>
                            <td class="text-center">{{ $user->created_by }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </section>
</div>
@endsection
