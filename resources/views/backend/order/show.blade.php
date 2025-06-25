@extends('layouts.admin')
@section('title', 'Chi tiết đơn hàng')
@section('content')
<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Chi tiết đơn hàng</h1>
                </div>
            </div>
        </div>
    </section>
    <section class="content">
        <div class="card">
            <div class="card-header">
                <div class="row">
                    <div class="col-12 text-right">
                        <a href="{{ route('admin.order.edit', ['id' => $order->id]) }}" class="btn btn-sm btn-primary">
                            <i class="far fa-edit"></i>  
                        </a>
                        <a href="{{ route('admin.order.delete', ['id' => $order->id]) }}" class="btn btn-sm btn-danger">
                            <i class="fas fa-trash"></i>  
                        </a>
                        <a class="btn btn-sm btn-info" href="{{ route('admin.order.index') }}">
                            <i class="fa fa-arrow-left"></i> Back to orders
                        </a>
                        <a class="btn btn-sm btn-info" href="{{ route('admin.orderdetail.index',['id' => $order->id]) }}">
                            Orderdetail
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
                            <td class="text-center"><strong>Order ID</strong></td>
                            <td class="text-center">{{ $order->id }}</td>
                        </tr>
                        <tr>
                            <td class="text-center"><strong>User Name</strong></td>
                            <td class="text-center">{{ $order->username }}</td>
                        </tr>
                        <tr>
                            <td class="text-center"><strong>Delivery Name</strong></td>
                            <td class="text-center">{{ $order->delivery_name }}</td>
                        </tr>
                        <tr>
                            <td class="text-center"><strong>Delivery Gender</strong></td>
                            <td class="text-center">{{ $order->delivery_gender == 1 ? 'Male' : 'Female' }}</td>
                        </tr>
                        <tr>
                            <td class="text-center"><strong>Delivery Email</strong></td>
                            <td class="text-center">{{ $order->delivery_email }}</td>
                        </tr>
                        <tr>
                            <td class="text-center"><strong>Delivery Phone</strong></td>
                            <td class="text-center">{{ $order->delivery_phone }}</td>
                        </tr>
                        <tr>
                            <td class="text-center"><strong>Delivery Address</strong></td>
                            <td class="text-center">{{ $order->delivery_address }}</td>
                        </tr>
                        <tr>
                            <td class="text-center"><strong>Delivery Note</strong></td>
                            <td class="text-center">{{ $order->note }}</td>
                        </tr>
                        <tr>
                            <td class="text-center"><strong>Status</strong></td>
                            <td class="text-center">{{ $order->status }}</td>
                        </tr>
                        <tr>
                            <td class="text-center"><strong>Created At</strong></td>
                            <td class="text-center">{{ $order->created_at }}</td>
                        </tr>
                        <tr>
                            <td class="text-center"><strong>Updated At</strong></td>
                            <td class="text-center">{{ $order->updated_at }}</td>
                        </tr>
                      
                    </tbody>
                </table>
            </div>
        </div>
    </section>
</div>
@endsection
 