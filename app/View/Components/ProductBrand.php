<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;
use App\Models\Brand;
class ProductBrand extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        $brand_list = Brand::where("status","=",1)
        ->select("id", "name", "slug")
        ->get();
        return view('components.product-brand',compact("brand_list"));
    }
}
