@extends('layouts.site')
@section('title', 'Chi tiết sản phẩm')
@section('content')
<div class="container my-3">
    <div class="row">
        <div class="col-md-6 d-flex align-items-center justify-content-center">
            <img 
                class="img-fluid rounded shadow-sm border" 
                src="{{ asset('images/products/' . $product->image) }}" 
                alt="{{ $product->image }}" 
                style="width: 250px; height: 350px; object-fit: cover; background: #fafafa;"
            >
        </div>
        <div class="col-md-6">
            <h1>{{ $product->name }}</h1>
            <p>Mô tả</p>
            <h3 class="fs-6">{{ $product->description }}</h3>
            <div class="row">
            @if ($product->pricesale > 0 && $product->pricesale < $product->price)
                <div class="col-8">
                    <span class="text-success">{{ number_format($product->pricesale) }}₫</span>
                    <del class="text-muted">{{ number_format($product->price) }}₫</del>
                </div>
                <div class="col-4  text-danger">
                    -{{ number_format((($product->price - $product->pricesale) / $product->price) * 100) }}%
                </div>
            @else
                <div class="col-12">
                    <span class="text-success">{{ number_format($product->price) }}₫</span>
                </div>
            @endif
            </div>
            <div class="input-group my-3">
                <input type="number" value="1" min="0" id="qty" aria-label="Recipient's username" aria-describedby="basic-addon2">
                <button type="submit" class="btn btn-info"  onclick="handleAddCart({{$product->id}})">Place order</button>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <h3>Detail</h3>
            {!!$product->detail!!}
        </div>
    </div>
    <div class="row mt-3 mb-3">
        <div class="col-12">
        <nav>
            <div class="nav nav-tabs" id="nav-tab" role="tablist">
                <button class="nav-link active" id="nav-home-tab" data-bs-toggle="tab" data-bs-target="#nav-home" type="button" role="tab" aria-controls="nav-home" aria-selected="true">Related product</button>
                <button class="nav-link" id="nav-profile-tab" data-bs-toggle="tab" data-bs-target="#nav-profile" type="button" role="tab" aria-controls="nav-profile" aria-selected="false">Comment</button>
                
            </div>
        </nav>
        <div class="tab-content" id="nav-tabContent">
            <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
                <div class="section_product_new my-5">
                    <div class="row">
                        @foreach ($product_list as $product)
                            <div class="col-md-3 mb-4">
                                <x-product-card :product="$product" />
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
            <div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">Embeded FB</div>
        </div>
        </div>
    </div>
</div>
@endsection
@section('footer')
    <script>
        function handleAddCart(productid) {
            let qty = document.getElementById("qty").value;
            
            // Show loading state
            const button = event.target;
            const originalText = button.innerHTML;
            button.innerHTML = '<i class="fa fa-spinner fa-spin"></i> Adding...';
            button.disabled = true;
            
            $.ajax({
                url: '{{ route('site.cart.addcart') }}',
                type: "GET",
                data: {
                    productid: productid,
                    qty: qty
                },
                success: function(response, status, xhr) {
                    if (response.success) {
                        // Update cart count display if it exists
                        if (document.getElementById("showqty")) {
                            document.getElementById("showqty").innerHTML = response.cart_count;
                        }
                        
                        // Show toastr notification
                        if (response.toastr_type === 'success') {
                            toastr.success(response.message);
                        } else if (response.toastr_type === 'info') {
                            toastr.info(response.message);
                        }
                    } else {
                        if (response.toastr_type === 'error') {
                            toastr.error(response.message);
                        } else {
                            toastr.error(response.message || 'Failed to add to cart');
                        }
                    }
                },
                error: function(xhr, status, error) {
                    console.error('Cart error:', error);
                    toastr.error('An error occurred while adding to cart');
                },
                complete: function() {
                    // Restore button state
                    button.innerHTML = originalText;
                    button.disabled = false;
                }
            });
        }
    </script>
@endsection