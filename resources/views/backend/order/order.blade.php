@extends('layouts.admin')
@section('title','Order')
@section('content')
<div class="content-wrapper">
    <!-- CONTENT -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Order Page</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Order Page</li>
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
            
                    <a href="{{ route('admin.order.trash') }}" class="btn btn-sm btn-danger ">
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
                <th class="text-center">User Name</th>
                <th class="text-center">Delivery name</th>
                <th class="text-center">Delivery gender</th>
                <th class="text-center">Delivery email</th>
                <th class="text-center">Delivery phone</th>
                <th class="text-center">Delivery adress</th>
                <th class="text-center">Delivery note</th>
                <th class="text-center">Action</th>
                <th class="text-center">ID</th>
                <th class="text-center">Status</th>
            </tr>
            </thead>
            <tbody>
              @foreach ($list as $row)
                <tr>
                    <td><input type="checkbox" name="order_checkbox" value="1"></td>
                    <td>{{$row->name}}</td>
                    <td>{{$row->delivery_name}}</td>
                    <td>
                        @if ($row->delivery_gender == 1)
                            Male
                        @elseif ($row->delivery_gender == 2)
                            Female
                        @endif
                    </td>                    <td>{{$row->delivery_email}}</td>
                    <td>{{$row->delivery_phone}}</td>
                    <td>{{$row->delivery_address}}</td>
                    <td>{{$row->note}}</td>
                    <td>
    @php
        $args = ['id' => $row->orderid];
    @endphp
    @if ($row->status==1)
    <a href="{{ route('admin.order.status', $args) }}" class="btn btn-sm btn-success">
        <i class="fa fa-toggle-on" aria-hidden="true"></i>
    </a>
    @else
    <a href="{{ route('admin.order.status', $args) }}" class="btn btn-sm btn-danger">
        <i class="fa fa-toggle-off" aria-hidden="true"></i>
    </a>
    @endif
    <a href="{{ route('admin.order.show', $args) }}" class="btn btn-sm btn-info">
        <i class="fa fa-eye" aria-hidden="true"></i>
    </a>
    <a href="{{ route('admin.order.edit', $args) }}" class="btn btn-sm btn-primary">
        <i class="fa fa-edit" aria-hidden="true"></i>
    </a>
    <a href="{{ route('admin.order.delete', $args) }}" class="btn btn-sm btn-danger">
        <i class="fa fa-trash" aria-hidden="true"></i>
    </a>
</td >
                <td>{{$row->id}}</td>
                <td>{{$row->status}}</td>
                </tr>
              @endforeach
            </tbody>
          </table>
        </div>
      </div>
    </section>
    <!-- /.CONTENT -->
  </div>@endsection