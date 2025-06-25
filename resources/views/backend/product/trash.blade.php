@extends('layouts.admin')
@section('title', 'Trash Product')
@section('content')
<div class="content-wrapper">
    <!-- CONTENT -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Trash Product Page</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Product Page</li>
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
                        <a href="{{ route('admin.product.index') }}" class="btn btn-sm btn-info">
                            <i class="fa fa-arrow-left" aria-hidden="true"></i> Back to Products
                        </a>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <table class="table table-bordered table-hover table-striped">
                    <thead>
                        <tr>
                            <th class="text-center">#</th>
                            <th class="text-center">Image</th>
                            <th class="text-center">Product Name</th>
                            <th class="text-center">Category</th>
                            <th class="text-center">Brand</th>
                            <th class="text-center">Price</th>
                            <th class="text-center">Sale Price</th>
                            <th class="text-center">Action</th>
                            <th class="text-center">ID</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($list as $row)
                        <tr>
                            <td><input type="checkbox" name="product_checkbox" value="1"></td>
                            <td><img style="width: 150px; height: 150px;" src="{{ asset('images/products/'.$row->image) }}" alt="{{ $row->image }}"></td>
                            <td>{{ $row->name }}</td>
                            <td>{{ $row->categoryname }}</td>
                            <td>{{ $row->brandname }}</td>
                            <td>{{ $row->price }}</td>
                            <td>{{ $row->pricesale }}</td>
                            <td>
                                @php
                                    $args = ['id' => $row->id];
                                @endphp

                                <a href="{{ route('admin.product.show', $args) }}" class="btn btn-sm btn-info">
                                    <i class="fa fa-eye" aria-hidden="true"></i>
                                </a>
                                <a href="{{ route('admin.product.restore', $args) }}" class="btn btn-sm btn-warning">
                                    <i class="fa fa-undo" aria-hidden="true"></i>
                                </a>
                                <form action="{{ route('admin.product.destroy', $args) }}" method="post" style="display: inline-block;">
                                    @csrf
                                    @method('delete')
                                    <button class="btn btn-sm btn-danger" name="delete" type="submit">
                                        <i class="fa fa-trash" aria-hidden="true"></i>
                                    </button>
                                </form>
                            </td>
                            <td>{{ $row->id }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </section>
</div>
@endsection
