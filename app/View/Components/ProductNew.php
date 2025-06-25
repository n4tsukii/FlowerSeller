<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;
use App\Models\Product; // Ensure you import the Product model
class ProductNew extends Component
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
        $listproduct = Product::where('status', '=', '1')
        ->orderBy('created_at', 'desc')
        ->limit(4)
        ->get();

         return view('components.product-new', compact('listproduct'));
    }
}
