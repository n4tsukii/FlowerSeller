@extends('layouts.admin')
@section('title','Update Order')
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
                <a href="{{ route('admin.order.index') }}" class="btn btn-sm btn-info">
                    <i class="fa fa-arrow-left" aria-hidden="true"></i> Back to Orders
                </a>
            </div>
          </div>
        </div>
        <div class="card-body">
            <form action="{{ route('admin.order.update', $order->id) }}" method="post">
                @csrf
                @method('put')
                <h1 class="text-center">Update Order</h1>
                <div class="container">
                    <div class="row g-3">
                    <div class="col-md-12 mb-3">
                    <label for="user_id" class="form-label">User ID</label>
                    <input type="text" id="user_id" class="form-control" name="user_id" value="{{ old('user_id', $order->user_id) }}" readonly />
                </div>

                        <div class="col-md-12 mb-3">
                            <label for="delivery_name" class="form-label">Delivery Name</label>
                            <input type="text" id="delivery_name" class="form-control" name="delivery_name" value="{{ old('delivery_name', $order->delivery_name) }}" />
                            @error('delivery_name')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-12 mb-3">
    <label for="delivery_gender" class="form-label">Delivery Gender</label>
    <select id="delivery_gender" class="form-control" name="delivery_gender">
        <option value="1" {{ old('delivery_gender', $order->delivery_gender) == 1 ? 'selected' : '' }}>Male</option>
        <option value="2" {{ old('delivery_gender', $order->delivery_gender) == 2 ? 'selected' : '' }}>Female</option>
    </select>
    @error('delivery_gender')
        <div class="text-danger">{{ $message }}</div>
    @enderror
</div>

                        <div class="col-md-12 mb-3">
                            <label for="delivery_email" class="form-label">Delivery Email</label>
                            <input type="email" id="delivery_email" class="form-control" name="delivery_email" value="{{ old('delivery_email', $order->delivery_email) }}" />
                            @error('delivery_email')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-12 mb-3">
                            <label for="delivery_phone" class="form-label">Delivery Phone</label>
                            <input type="text" id="delivery_phone" class="form-control" name="delivery_phone" value="{{ old('delivery_phone', $order->delivery_phone) }}" />
                            @error('delivery_phone')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-12 mb-3">
                            <label for="delivery_address" class="form-label">Delivery Address</label>
                            <input type="text" id="delivery_address" class="form-control" name="delivery_address" value="{{ old('delivery_address', $order->delivery_address) }}" />
                            @error('delivery_address')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-12 mb-3">
                            <label for="note" class="form-label">Delivery Note</label>
                            <textarea id="note" class="form-control" name="note" rows="3">{{ old('note', $order->note) }}</textarea>
                            @error('note')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-12 mb-3">
                            <label for="status" class="form-label">Status</label>
                            <select name="status" id="status" class="form-control">
                                <option value="1" {{ $order->status == 1 ? 'selected' : '' }}>Pending</option>
                                <option value="2" {{ $order->status == 2 ? 'selected' : '' }}>Processing</option>
                                <option value="3" {{ $order->status == 3 ? 'selected' : '' }}>Completed</option>
                                <option value="4" {{ $order->status == 4 ? 'selected' : '' }}>Cancelled</option>
                            </select>
                            @error('status')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-12 mb-3">
                            <button class="btn btn-success w-100" type="submit">Update Order</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
      </div>
    </section>
</div>
@endsection
