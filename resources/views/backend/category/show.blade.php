@extends('layouts.admin')
@section('title', 'Chi tiết danh mục')
@section('content')
<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Chi tiết danh mục</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Blank Page</li>
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
                    <a href="{{ route('admin.category.edit', ['id' => $category->id])}}" class="btn btn-sm btn-primary">
                            <i class="far fa-edit"></i> 
                        </a>
                        <a href="{{ route('admin.category.delete',['id' => $category->id])}}" class="btn btn-sm btn-danger">
                            <i class="fas fa-trash"></i> 
                        </a>
                        <a class="btn btn-sm btn-info" href="category_index.html">
                            <i class="fa fa-arrow-left"></i> Back to category
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
                                <td class="text-center"><strong>Tên danh mục</strong></td>
                                <td class="text-center">{{ $category->name }}</td>
                            </tr>
                            <tr>
                                <td class="text-center"><strong>Slug</strong></td>
                                <td class="text-center">{{ $category->slug }}</td>
                            </tr>
                            <tr>
                                <td class="text-center"><strong>Mô tả</strong></td>
                                <td class="text-center">{{ $category->description }}</td>
                            </tr>
                            <tr>
                                <td class="text-center"><strong>Parent ID</strong></td>
                                <td class="text-center">{{ $category->parent_id }}</td>
                            </tr>
                            <tr>
                                <td class="text-center"><strong>Sort Order</strong></td>
                                <td class="text-center">{{ $category->sort_order }}</td>
                            </tr>
                            <tr>
                                <td class="text-center"><strong>Trạng thái</strong></td>
                                <td class="text-center">{{ $category->status }}</td>
                            </tr>
                            <tr>
                                <td class="text-center"><strong>Ngày tạo</strong></td>
                                <td class="text-center">{{ $category->created_at }}</td>
                            </tr>
                            <tr>
                                <td class="text-center"><strong>Người tạo</strong></td>
                                <td class="text-center">{{ $category->created_by }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
    </section>
    </div>
@endsection
 