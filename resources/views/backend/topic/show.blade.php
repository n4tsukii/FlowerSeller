@extends('layouts.admin')
@section('title', 'Chi tiết chủ đề')
@section('content')
<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Chi tiết chủ đề</h1>
                </div>
            </div>
        </div>
    </section>
    <section class="content">
        <div class="card">
            <div class="card-header">
                <div class="row">
                    <div class="col-12 text-right">
                        <a href="{{ route('admin.topic.edit', ['id' => $topic->id]) }}" class="btn btn-sm btn-primary">
                            <i class="far fa-edit"></i>  
                        </a>
                        <a href="{{ route('admin.topic.delete', ['id' => $topic->id]) }}" class="btn btn-sm btn-danger">
                            <i class="fas fa-trash"></i>  
                        </a>
                        <a class="btn btn-sm btn-info" href="{{ route('admin.topic.index') }}">
                            <i class="fa fa-arrow-left"></i> Back to topics
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
                            <td class="text-center"><strong>Mã chủ đề</strong></td>
                            <td class="text-center">{{ $topic->id }}</td>
                        </tr>
                        <tr>
                            <td class="text-center"><strong>Tên chủ đề</strong></td>
                            <td class="text-center">{{ $topic->name }}</td>
                        </tr>
                        <tr>
                            <td class="text-center"><strong>Mô tả</strong></td>
                            <td class="text-center">{{ $topic->description }}</td>
                        </tr>
                        <tr>
                            <td class="text-center"><strong>Thứ tự</strong></td>
                            <td class="text-center">{{ $topic->sort_order }}</td>
                        </tr>
                        <tr>
                            <td class="text-center"><strong>Trạng thái</strong></td>
                            <td class="text-center">{{ $topic->status == 1 ? 'Xuất bản' : 'Chưa xuất bản' }}</td>
                        </tr>
                        <tr>
                            <td class="text-center"><strong>Ngày tạo</strong></td>
                            <td class="text-center">{{ $topic->created_at }}</td>
                        </tr>
                        <tr>
                            <td class="text-center"><strong>Ngày cập nhật</strong></td>
                            <td class="text-center">{{ $topic->updated_at }}</td>
                        </tr>
                        <tr>
                            <td class="text-center"><strong>Người tạo</strong></td>
                            <td class="text-center">{{ $topic->created_by }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </section>
</div>
@endsection
