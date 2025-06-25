@extends('layouts.site')
@section('title', 'Giỏ hàng')
@section('content')
    <div class="container mt-2">
        <b class="text-center ">
            <h2>Thanh toán</h2>
        </b>
        <div class="row">

            <div class="col-md-12">

                <div class="row mt-5 mb-3">
                    <div class="col-12 d-flex justify-content-end">
                        <a href="#" class="btn btn-sm btn-danger mx-1">
                            <i class="fas fa-trash"></i> Hủy giỏ hàng
                        </a>
                        <a class="btn btn-sm btn-info mx-1" href="{{ route('site.home') }}">
                            <i class="fa fa-arrow-left"></i> Về trang chủ
                        </a>
                    </div>
                </div>
                <table class="table table-bordered table-striped table-hover">
                    <thead>
                        <tr>
                            <th class="text-center" style="width:30px;">#</th>
                            <th class="text-center">ID</th>
                            <th class="text-center">Hình ảnh</th>
                            <th class="text-center">Tên sản phẩm</th>
                            <th class="text-center">Giá</th>
                            <th class="text-center">Số lượng</th>
                            <th class="text-center">Thành tiền</th>

                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $totalMoney = 0;
                        @endphp
                        @if (is_array($cart_list) && count($cart_list) > 0)
                            @foreach ($cart_list as $item)
                                <tr class="text-center">
                                    <td class="text-center">
                                        <input type="checkbox" id="checkId" value="1" name="checkId[]">
                                    </td>
                                    <td>{{ $item['id'] }}</td>
                                    <td><img src="{{ asset('images/products/' . $item['image']) }}" style="width: 200px;"
                                            alt="{{ $item['name'] }}" /></td>
                                    <td>{{ $item['name'] }}</td>
                                    <td>{{ $item['price'] }}</td>
                                    <td>

                                        {{ $item['qty'] }}
                                    </td>
                                    <td>{{ $item['price'] * $item['qty'] }}</td>

                                </tr>
                                @php
                                    $totalMoney += $item['price'] * $item['qty'];
                                @endphp
                            @endforeach

                        @endif

                    </tbody>

                    <tfoot>

                        <tr>
                            <th colspan="6"class="text-end">
                                <strong>Tổng tiền:</strong>
                            </th>
                            <th colspan="2" class="text-start">
                                <strong> {{ $totalMoney }}</strong>
                            </th>
                        </tr>
                    </tfoot>
                </table>


            </div>
            <div class="col-md-3"></div>
        </div>
        @if (!Auth::check())
            <div class="row">
                <div class="col-12">
                    <h3>Hãy đăng nhập để thanh toán</h3>
                    <a href="{{ route('website.getlogin') }}">Đăng nhập</a>
                </div>
            </div>
        @else
            <form action="{{ route('site.cart.docheckout') }}" method="post">
                @csrf
                <div class="row my-5">
                    @php
                        $user = Auth::user();
                    @endphp
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label>Họ tên</label>
                            <input type="text" name ="name" value="{{ $user->name }}" class="form-control">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label>Email</label>
                            <input type="text" name ="email" value="{{ $user->email }}" class="form-control">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label>Điện thoại</label>
                            <input type="text" name ="phone" value="{{ $user->phone }}" class="form-control">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label>Địa chỉ</label>
                            <input type="text" name ="address" value="{{ $user->address }}" class="form-control">
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="mb-3">
                            <label>Chú ý</label>
                            <textarea name="note" class="form-control"></textarea>

                        </div>

                    </div>
                    <div class="col-md-12 text-end">
                        <button class="btn btn-success"type="submit">Đặt mua</button>


                    </div>
                </div>
            </form>
        @endif
    </div>

@endsection
