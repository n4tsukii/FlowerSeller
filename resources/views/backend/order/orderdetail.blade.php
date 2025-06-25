@extends('layouts.admin')
@section('title','Orderdetail')
@section('content')
<div class="content-wrapper">
    <!-- CONTENT -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Orderdetail Page</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Orderdetail Page</li>
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
                  <a href="{{ route('admin.order.show', ['id' => $list[0]->order_id]) }}" class="btn btn-sm btn-success ">
                 Back to order
                    </a>
            </div>
          </div>
        </div>
        <div class="card-body">
          <table class="table table-bordered table-hover table-striped"> 
            <thead>
            <tr>
                <th class="text-center">#</th>
                <th class="text-center">Order ID</th>
                <th class="text-center">Product ID</th>
                <th class="text-center">Price</th>
                <th class="text-center">Quantity</th>
                <th class="text-center">Discount</th>
                <th class="text-center">Total</th>
    
                <th class="text-center">ID</th>

            </tr>
            </thead>
            @foreach ($list as $row)
                            <tr>
                                <td><input type="checkbox" name="orderdetail_checkbox" value="1"></td>
                                <td>{{ $row->order_id }}</td>
                                <td>{{ $row->product_id }}</td>
                                <td>{{ $row->price }}</td>
                                <td>{{ $row->qty }}</td>
                                <td>{{ $row->discount }}</td>
                                <td>{{ $row->amount }}</td>
                                <td>{{ $row->id }}</td>
                            </tr>
                        @endforeach
          </table>
        </div>
      </div>
    </section>
    <!-- /.CONTENT -->
  </div>@endsection