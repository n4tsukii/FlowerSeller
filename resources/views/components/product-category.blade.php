@foreach($product_list as $product)
<div class="col-md-3 mb-3">
    <x-product-card :product="$product"/>
</div>
@endforeach
 
 