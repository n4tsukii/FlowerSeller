@extends('layouts.site')
@section('title', 'Thanh toán')
@section('content')
<div class="container py-4">
    <h2 class="mb-4 text-center" style="color:#a18cd1;font-weight:700;">THANH TOÁN</h2>
    <div class="row justify-content-center">
        <div class="col-xl-8 col-lg-10">
            <div class="order-summary-card card shadow-sm p-4 mb-4 border-0 w-100">
                <h4 class="mb-3" style="color:#764ba2;font-weight:700;"><i class="bi bi-receipt"></i> Đơn hàng của bạn</h4>
                @php 
                    $totalMoney = 0; 
                    $totalQty = 0;
                @endphp
                <div class="order-products-list mb-3">
                    @if (is_array($cart_list) && count($cart_list) > 0)
                        @foreach ($cart_list as $item)
                        <div class="d-flex align-items-center mb-3 pb-2 border-bottom">
                            <img src="{{ asset('images/products/' . $item['image']) }}" alt="{{ $item['name'] }}" style="width:70px;height:70px;object-fit:cover;border-radius:12px;box-shadow:0 2px 8px #a18cd133;">
                            <div class="ms-3 flex-grow-1">
                                <div class="fw-bold">{{ $item['name'] }}</div>
                                <div class="text-muted small">x{{ $item['qty'] }}</div>
                            </div>
                            <div class="fw-semibold" style="color:#a18cd1;min-width:100px;text-align:right;">{{ number_format($item['price'] * $item['qty']) }}₫</div>
                        </div>
                        @php 
                            $totalMoney += $item['price'] * $item['qty'];
                            $totalQty += $item['qty'];
                        @endphp
                        @endforeach
                    @else
                        <div class="text-center text-muted py-4">Giỏ hàng của bạn đang rỗng.</div>
                    @endif
                </div>
                <div class="d-flex justify-content-between align-items-center border-top pt-3">
                    <span class="fw-bold fs-5">Tổng tiền:</span>
                    <span class="fw-bold fs-3" style="color:#764ba2;">{{ number_format($totalMoney) }}₫</span>
                </div>
            </div>
            <div class="mb-4 p-4 bg-white shadow-sm rounded-3 border w-100">
                <h4 class="mb-3" style="color:#764ba2;font-weight:700;"><i class="bi bi-person-circle"></i> Thông tin khách hàng</h4>
                @if (!Auth::check())
                    <div class="alert alert-warning mb-0">Hãy đăng nhập để thanh toán</div>
                    <a href="{{ route('website.getlogin') }}" class="btn btn-primary mt-3">Đăng nhập</a>
                @else
                <form action="{{ route('site.cart.docheckout') }}" method="post">
                    @csrf
                    @php $user = Auth::user(); @endphp
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label class="form-label">Họ tên</label>
                            <input type="text" name="name" value="{{ $user->name }}" class="form-control" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Email</label>
                            <input type="email" name="email" value="{{ $user->email }}" class="form-control" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Điện thoại</label>
                            <input type="text" name="phone" value="{{ $user->phone }}" class="form-control" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Địa chỉ</label>
                            <input type="text" name="address" value="{{ $user->address }}" class="form-control" required>
                        </div>
                        <div class="col-12">
                            <label class="form-label">Ghi chú</label>
                            <textarea name="note" class="form-control" rows="2"></textarea>
                        </div>
                        <div class="col-12">
                            <label class="form-label">Phương thức thanh toán</label>
                            <select name="payment_method" class="form-select">
                                <option value="cod">Thanh toán khi nhận hàng (COD)</option>
                                <option value="bank">Chuyển khoản ngân hàng</option>
                            </select>
                        </div>
                        <div class="col-12 text-end mt-3">
                            <button class="btn btn-success px-4 py-2 fs-5" type="submit">Đặt mua</button>
                        </div>
                    </div>
                </form>
                @endif
            </div>
        </div>
    </div>
</div>
<style>
.order-summary-card {
    border-radius: 18px;
    background: linear-gradient(135deg, #f8f9fa 80%, #e9ecef 100%);
    box-shadow: 0 4px 24px #a18cd133;
    min-width: 320px;
    max-width: 100%;
}
.order-products-list {
    max-height: 350px;
    overflow-y: auto;
}
@media (max-width: 991.98px) {
    .order-summary-card { margin-top: 30px; }
    .col-xl-8.col-lg-10 { max-width: 100% !important; }
}
@media (max-width: 576px) {
    .order-summary-card, .mb-4.p-4.bg-white.shadow-sm.rounded-3.border {
        padding: 10px !important;
    }
    .order-products-list img { width: 48px !important; height: 48px !important; }
}
</style>
@endsection
