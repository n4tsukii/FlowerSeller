<div class="new-products">
    <h2>Sản phẩm mới</h2>
    <div id="product-container" class="d-flex flex-wrap">
        <div class="section_product_new my-5">
            <div class="container">
                 <div class="row">
                    @foreach ($listproduct as $product)
                        <div class="col-md-3 mb-3">
                            <x-product-card :product="$product" />
                        </div>
                    @endforeach
                </div>
                <div class="row mt-5">
                    <div class="col-12 text-center">
                        <button class="btn btn-success px-5">
                        <a href="{{ route('site.product')}}">Thêm</a></button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
