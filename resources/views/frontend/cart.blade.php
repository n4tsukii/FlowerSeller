@extends('layouts.site')
@section('title','Cart')
@section('content')
<div class="container py-4">
    <h2 class="mb-4 text-center" style="color:#a18cd1;font-weight:700;">GIỎ HÀNG CỦA BẠN</h2>
    <form action="{{ route('site.cart.update') }}" method="post">
        @csrf
        <div class="table-responsive">
        <table class="table align-middle table-hover shadow-sm rounded" style="background: #fff;">
            <thead class="table-light">
                <tr>
                    <th style="width:90px">Hình</th>
                    <th>Tên sản phẩm</th>
                    <th style="width:110px;">Số lượng</th>
                    <th>Giá</th>
                    <th>Thành tiền</th>
                    <th>Hành động</th>
                </tr>
            </thead>
            <tbody>
                @php
                    $totalMoney = 0;
                @endphp
                @if(count($list_cart) == 0)
                <tr>
                    <td colspan="6" class="text-center text-muted py-5" style="font-size: 1.2rem;">
                        Giỏ hàng của bạn đang rỗng.
                    </td>
                </tr>
                @else
                @foreach($list_cart as $row_cart)
                <tr>
                    <td>
                        <img class="img-thumbnail" style="width:70px;height:70px;object-fit:cover;border-radius:8px;" src="{{ asset('images/products/' . $row_cart['image']) }}" alt="{{ $row_cart['image'] }}">
                    </td>
                    <td style="font-weight:500;">{{ $row_cart['name'] }}</td>
                    <td>
                        <input type="number" style="width:60px" min="1" name="qty[{{ $row_cart['id'] }}]" value="{{ $row_cart['qty'] }}" class="form-control text-center">
                    </td>
                    <td class="text-success fw-semibold">{{ number_format($row_cart['price']) }}₫</td>
                    <td class="fw-semibold">{{ number_format($row_cart['price'] * $row_cart['qty']) }}₫</td>
                    <td class="text-center">
                        <a href="{{ route('site.cart.delete', ['id' => $row_cart['id']]) }}" class="btn btn-outline-danger btn-sm" title="Xóa sản phẩm">
                            <i class="bi bi-trash"></i>
                        </a>
                    </td>
                </tr>
                @php
                    $totalMoney += $row_cart['price'] * $row_cart['qty'];
                @endphp
                @endforeach
                @endif
            </tbody>
            <tfoot>
                <tr>
                    <th colspan="5" class="border-0">
                        <a class="btn btn-success px-3 me-2" href="{{ route('site.home') }}"><i class="bi bi-arrow-left"></i> Mua thêm</a>
                        <button type="submit" class="btn btn-primary px-3 me-2"><i class="bi bi-arrow-repeat"></i> Cập nhật</button>
                        <a class="btn btn-info px-3 text-white" href="{{ route('site.cart.checkout') }}"><i class="bi bi-credit-card"></i> Thanh toán</a>
                    </th>
                    <th colspan="2" class="text-end fs-5 border-0" style="color:#a18cd1;">
                        Tổng tiền: <span class="fw-bold">{{ number_format($totalMoney) }}₫</span>
                    </th>
                </tr>
            </tfoot>
        </table>
        </div>
    </form>
</div>
@endsection
<style>
    .table thead th {
        color: #a18cd1;
        font-weight: 700;
        font-size: 1.05rem;
        background: #f8f9fa;
        border-bottom: 2px solid #a18cd1;
    }
    .table tfoot th {
        background: #f8f9fa;
        border-top: 2px solid #a18cd1;
    }
</style>
