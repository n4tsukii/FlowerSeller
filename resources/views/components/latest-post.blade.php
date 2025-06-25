<div class="new-products">
    <h2>Bài viết mới nhất</h2>
    <div id="product-container" class="d-flex flex-wrap">
        <div class="section_product_new my-5">
            <div class="container">
                 <div class="row">
                    @foreach ($listpost as $post)
                        <div class="col-md-3 mb-3">
                            <x-post-card :post="$post" />
                        </div>
                    @endforeach
                </div>
                <div class="row mt-5">
                    <div class="col-12 text-center">
                    <button class="btn btn-success px-5">
                    <a href="{{ route('site.post')}}">Thêm</a>
                            </button>                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
 