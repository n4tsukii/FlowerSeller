@extends('layouts.admin')
@section('title', 'Trash Order')
@section('content')
<div class="content-wrapper">
    <!-- CONTENT -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Trash Order Page</h1>
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
                        <a href="{{ route('admin.order.index') }}" class="btn btn-sm btn-info">
                            <i class="fa fa-arrow-left" aria-hidden="true"></i> Back to Orders
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
                            <th class="text-center">Delivery Name</th>
                            <th class="text-center">Delivery Gender</th>
                            <th class="text-center">Delivery Email</th>
                            <th class="text-center">Delivery Phone</th>
                            <th class="text-center">Delivery Address</th>
                            <th class="text-center">Delivery Note</th>
                            <th class="text-center">Action</th>
                            <th class="text-center">ID</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($list as $row)
                        <tr>
                            <td><input type="checkbox" name="order_checkbox" value="1"></td>
                            <td>{{ $row->name }}</td>
                            <td>{{ $row->delivery_name }}</td>
                            <td>
                                @if ($row->delivery_gender == 1)
                                    Male
                                @elseif ($row->delivery_gender == 2)
                                    Female
                                @endif
                            </td>
                            <td>{{ $row->delivery_email }}</td>
                            <td>{{ $row->delivery_phone }}</td>
                            <td>{{ $row->delivery_address }}</td>
                            <td>{{ $row->note }}</td>
                            <td>
                                @php
                                    $args = ['id' => $row->id];
                                @endphp
                            

                                <a href="{{ route('admin.order.show', $args) }}" class="btn btn-sm btn-info">
                                    <i class="fa fa-eye" aria-hidden="true"></i>
                                </a>
                                <a href="{{ route('admin.order.restore', $args) }}" class="btn btn-sm btn-warning">
                                    <i class="fa fa-undo" aria-hidden="true"></i>
                                </a>
                                <form action="{{ route('admin.order.destroy', $args) }}" method="post" style="display: inline-block;">
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
    <!-- /.CONTENT -->
</div>
@endsection
