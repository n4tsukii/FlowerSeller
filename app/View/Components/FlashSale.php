<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;
use App\Models\Product;
class FlashSale extends Component
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
        $listproduct = Product::where([['status', '=', '1'],['pricesale','>',0]])
        ->orderBy('pricesale', 'desc')
        ->limit(4)
        ->get();
        return view('components.flash-sale', compact('listproduct'));
    }
}
