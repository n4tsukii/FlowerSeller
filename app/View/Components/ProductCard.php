<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class ProductCard extends Component
{
    public $product_item;
    /**
     * Create a new component instance.
     */
    public function __construct($product)
    {
        $this->product_item= $product;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        $productitem = $this->product_item;
        return view('components.product-card',["product"=>$productitem]);
    }
}
