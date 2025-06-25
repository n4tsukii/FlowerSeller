@extends('layouts.admin')
@section('title','Product')
@section('content')
<div class="content-wrapper">
    <!-- CONTENT -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Product Page</h1>
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
            <a href="{{route('admin.product.create')}}" class="btn btn-sm btn-success ">
                        <i class="fa fa-plus px-2" aria-hidden="true"></i>Add
                    </a>
                    <a href="{{route('admin.product.trash')}}" class="btn btn-sm btn-danger ">
                        <i class="fa fa-trash px-2" aria-hidden="true"></i>Trash bin
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
                <th class="text-center">Sale price</th>
                <th class="text-center">Action</th>
                <th class="text-center">ID</th>

            </tr>
            </thead>
            <tbody>
              @foreach ($list as $row)
              <tr>
              <td><input type="checkbox" name="product_checkbox" value="1"></td>
                    <td><img style="width: 150px; height: 150px;" src="{{ asset('images/products/'.$row->image) }}" alt="{{ $row->image }}"></td>
                    <td>{{$row->name}}</td>
                    <td>{{$row->categoryname}}</td>
                    <td>{{$row->brandname}}</td>
                    <td>{{$row->price}}</td>
                    <td>{{$row->pricesale}}</td>
                    <td>
                    @php
                        $args = ['id' => $row->id];
                    @endphp
                    @if ($row->status==1)
                    <a href="{{ route('admin.product.status', $args) }}" class="btn btn-sm btn-success">
                        <i class="fa fa-toggle-on" aria-hidden="true"></i>
                    </a>
                    @else
                    <a href="{{ route('admin.product.status', $args) }}" class="btn btn-sm btn-danger">
                        <i class="fa fa-toggle-off" aria-hidden="true"></i>
                    </a>
                    @endif
                    <a href="{{ route('admin.product.show', $args) }}" class="btn btn-sm btn-info">
                        <i class="fa fa-eye" aria-hidden="true"></i>
                    </a>
                    <a href="{{ route('admin.product.edit', $args) }}" class="btn btn-sm btn-primary">
                        <i class="fa fa-edit" aria-hidden="true"></i>
                    </a>
                    <a href="{{ route('admin.product.delete', $args) }}" class="btn btn-sm btn-danger">
                        <i class="fa fa-trash" aria-hidden="true"></i>
                    </a>
                </td>
                <td>{{$row->id}}</td>
              @endforeach
                </tr>
            </tbody>
          </table>
        </div>
      </div>
    </section>
  </div>@endsection