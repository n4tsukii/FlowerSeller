@foreach ($category_list as $cat_row)
<div id="product-container" class="d-flex flex-wrap">
    <div class="section_product_new my-5">
        <div class="container">
            <h1>{{ $cat_row->name }} - {{$cat_row->id}}</h1>
            <div class="row">
                <div class="col-md-12">
                    <img class="img-fluid w-100" src="{{ asset('images/category_nam.png') }}" alt="">
                </div>
            </div>
            <div class="row">
                    <x-product-category :catrow="$cat_row"/>
            </div>
            <div class="row mt-5">
                <div class="col-12 text-center">
                    <button class="btn btn-success px-5"><a href="{{ route('site.product')}}">Thêm</a></button>
                </div>
            </div>
        </div>
    </div>
</div>
@endforeach

