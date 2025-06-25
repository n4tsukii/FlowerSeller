@extends('layouts.site')
@section('title', 'Thông báo')
@section('content')
    <div class="container-my-5 text-center my-3">
        <h3>Bạn đã thanh toán thành công</h3>
        <a class="btn btn-success px-3" href="{{ route('site.home') }}">Quay ve</a>

    </div>
@endsection
