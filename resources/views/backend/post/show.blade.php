@extends('layouts.admin')
@section('title', 'Chi tiết bài viết')
@section('content')
<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Chi tiết bài viết</h1>
                </div>
            </div>
        </div>
    </section>
    <section class="content">
        <div class="card">
            <div class="card-header">
                <div class="row">
                    <div class="col-12 text-right">
                        <a href="{{ route('admin.post.edit', ['id' => $post->id])}}" class="btn btn-sm btn-primary">
                            <i class="far fa-edit"></i> 
                        </a>
                        <a href="{{ route('admin.post.delete',['id' => $post->id])}}" class="btn btn-sm btn-danger">
                            <i class="fas fa-trash"></i> 
                        </a>
                        <a class="btn btn-sm btn-info" href="{{ route('admin.post.index') }}">
                            <i class="fa fa-arrow-left"></i> Back to posts
                        </a>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <table class="table table-bordered table-striped table-hover">
                    <thead>
                        <tr>
                            <th class="text-center" style="width:30%;">
                                <strong>Tên trường</strong>
                            </th>
                            <th class="text-center" style="width:70%;">Giá trị</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td class="text-center"><strong>Topic ID</strong></td>
                            <td class="text-center">{{ $post->topic_id }}</td>
                        </tr>
                        <tr>
                            <td class="text-center"><strong>Tiêu đề bài viết</strong></td>
                            <td class="text-center">{{ $post->title }}</td>
                        </tr>
                        <tr>
                            <td class="text-center"><strong>Slug</strong></td>
                            <td class="text-center">{{ $post->slug }}</td>
                        </tr>
                        <tr>
                            <td class="text-center"><strong>Chi tiết</strong></td>
                            <td class="text-center">{{ $post->detail }}</td>
                        </tr>
                        <tr>
                            <td class="text-center"><strong>Image</strong></td>
                            <td class="text-center">{{ $post->image }}</td>
                        </tr>
                        <tr>
                            <td class="text-center"><strong>Kiểu</strong></td>
                            <td class="text-center">{{ $post->type }}</td>
                        </tr>
                        <tr>
                            <td class="text-center"><strong>Mô tả</strong></td>
                            <td class="text-center">{{ $post->description }}</td>
                        </tr>
                        <tr>
                            <td class="text-center"><strong>Trạng thái</strong></td>
                            <td class="text-center">{{ $post->status == 1 ? 'Xuất bản' : 'Chưa xuất bản' }}</td>
                        </tr>
                        <tr>
                            <td class="text-center"><strong>Ngày tạo</strong></td>
                            <td class="text-center">{{ $post->created_at }}</td>
                        </tr>
                        <td class="text-center"><strong>Người tạo</strong></td>
                        <td class="text-center">{{ $post->created_by }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </section>
</div>
@endsection
 