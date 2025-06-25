@extends('layouts.admin')
@section('title', 'Chi tiết banner')
@section('content')
<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Chi tiết banner</h1>
                </div>
            </div>
        </div>
    </section>
    <section class="content">
        <div class="card">
            <div class="card-header">
                <div class="row">
                    <div class="col-12 text-right">
                        <a href="{{ route('admin.banner.edit', ['id' => $banner->id]) }}" class="btn btn-sm btn-primary">
                            <i class="far fa-edit"></i> 
                        </a>
                        <a href="{{ route('admin.banner.delete', ['id' => $banner->id]) }}" class="btn btn-sm btn-danger">
                            <i class="fas fa-trash"></i> 
                        </a>
                        <a class="btn btn-sm btn-info" href="{{ route('admin.banner.index') }}">
                            <i class="fa fa-arrow-left"></i> Back to banners
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
                                <td class="text-center"><strong>Tên banner</strong></td>
                                <td class="text-center">{{ $banner->name }}</td>
                            </tr>
                            <tr>
                                <td class="text-center"><strong>Image</strong></td>
                                <td class="text-center">{{ $banner->image }}</td>
                            </tr>
                            <tr>
                                <td class="text-center"><strong>Mô tả</strong></td>
                                <td class="text-center">{{ $banner->description }}</td>
                            </tr>
                            <tr>
                                <td class="text-center"><strong>Sắp xếp</strong></td>
                                <td class="text-center">{{ $banner->sort_order }}</td>
                            </tr>
                            <tr>
                                <td class="text-center"><strong>Vị trí</strong></td>
                                <td class="text-center">{{ $banner->position }}</td>
                            </tr>
                            <tr>
                                <td class="text-center"><strong>Trạng thái</strong></td>
                                <td class="text-center">{{ $banner->status }}</td>
                            </tr>
                            <tr>
                                <td class="text-center"><strong>Ngày tạo</strong></td>
                                <td class="text-center">{{ $banner->created_at }}</td>
                            </tr>
                            <tr>
                                <td class="text-center"><strong>Người tạo</strong></td>
                                <td class="text-center">{{ $banner->created_by }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
    </section>
</div>
@endsection
 