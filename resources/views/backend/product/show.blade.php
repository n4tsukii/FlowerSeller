@extends('layouts.admin')
@section('title', 'Chi tiết sản phẩm')
@section('content')
<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Chi tiết sản phẩm</h1>
                </div>
            </div>
        </div>
    </section>
    <section class="content">
        <div class="card">
            <div class="card-header">
                <div class="row">
                    <div class="col-12 text-right">
                        <a href="{{ route('admin.product.edit', ['id' => $product->id]) }}" class="btn btn-sm btn-primary">
                            <i class="far fa-edit"></i>
                        </a>
                        <a href="{{ route('admin.product.delete', ['id' => $product->id]) }}" class="btn btn-sm btn-danger">
                            <i class="fas fa-trash"></i>
                        </a>
                        <a class="btn btn-sm btn-info" href="{{ route('admin.product.index') }}">
                            <i class="fa fa-arrow-left"></i> Back to products
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
                            <td class="text-center"><strong>Mã sản phẩm</strong></td>
                            <td class="text-center">{{ $product->id }}</td>
                        </tr>
                        <tr>
                            <td class="text-center"><strong>Tên sản phẩm</strong></td>
                            <td class="text-center">{{ $product->name }}</td>
                        </tr>
                        <tr>
                            <td class="text-center"><strong>Hình ảnh</strong></td>
                            <td class="text-center"><img style="width: 150px; height: 150px;" src="{{ asset('images/products/'.$product->image) }}" alt="{{ $product->name }}"></td>
                        </tr>
                        <tr>
                            <td class="text-center"><strong>Category ID</strong></td>
                            <td class="text-center">{{ $product->category_id }}</td>
                        </tr>
                        <tr>
                            <td class="text-center"><strong>Brand ID</strong></td>
                            <td class="text-center">{{ $product->brand_id }}</td>
                        </tr>
                        <tr>
                            <td class="text-center"><strong>Giá</strong></td>
                            <td class="text-center">{{ $product->price }}</td>
                        </tr>
                        <tr>
                            <td class="text-center"><strong>Giá khuyến mãi</strong></td>
                            <td class="text-center">{{ $product->pricesale }}</td>
                        </tr>
                        <tr>
                            <td class="text-center"><strong>Mô tả</strong></td>
                            <td class="text-center">{{ $product->description }}</td>
                        </tr>
                        <tr>
                            <td class="text-center"><strong>Trạng thái</strong></td>
                            <td class="text-center">{{ $product->status == 1 ? 'Hoạt động' : 'Không hoạt động' }}</td>
                        </tr>
                        <tr>
                            <td class="text-center"><strong>Ngày tạo</strong></td>
                            <td class="text-center">{{ $product->created_at }}</td>
                        </tr>
                        <tr>
                            <td class="text-center"><strong>Ngày cập nhật</strong></td>
                            <td class="text-center">{{ $product->updated_at }}</td>
                        </tr>
                        <tr>
                            <td class="text-center"><strong>Người tạo</strong></td>
                            <td class="text-center">{{ $product->created_by }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </section>
</div>
@endsection
