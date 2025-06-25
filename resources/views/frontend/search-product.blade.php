@extends('layouts.site')
@section('title', 'Tìm kiếm sản phẩm')
@section('content')
    <section class="bread-crumb">
        <span class="crumb-border p-3"></span>
        <div class="container">
            <div class="rows">
                <div class="col-md-12">
                    <ul class="breadcrumb">
                        <li class="home">
                            <a href="{{ route('site.home') }}" class="text-dark"><span>Trang chủ</span></a>
                            <span class="mr_lr">&nbsp;<i class="fa fa-angle-right" style="color: #e39494;"></i>&nbsp;</span>
                        </li>
                        <li><strong><span style="color: #e39494;">Tìm kiếm: "{{ $query }}"</span></strong></li>
                    </ul>
                </div>
            </div>
        </div>
    </section>

    <section class="main container">
        <div class="row">
            @if (count($product_list) > 0)
            <div class="row product-container grid-view" id="gridViewSection">
                @foreach ($product_list as $product)
                    <div class="col-md-3 mb-4 product-item">
                        <x-product-card :product="$product" />
                    </div>
                @endforeach
            </div>
            @else
                <div class="col-md-12 text-center">
                    <h5>Không tìm thấy sản phẩm nào phù hợp với từ khóa "{{ $query }}"</h5>
                </div>
            @endif

        </div>

    </section>
@endsection
