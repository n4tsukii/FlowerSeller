<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;
use App\Models\Menu;
class FooterMenu extends Component
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
        $listmenu= Menu::where([
            ['status', '=', 1],
            ['position', '=', 'footermenu'],
        ])->orderBy('created_at', 'asc')
        ->limit(5)
        ->get();
        return view(('components.footer-menu'),compact('listmenu'));
     }
}
