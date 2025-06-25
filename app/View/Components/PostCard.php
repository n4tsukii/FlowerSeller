<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class PostCard extends Component
{
    public $post_item;
    /**
     * Create a new component instance.
     */
    public function __construct($post)
    {
        $this->post_item= $post;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        $postitem = $this->post_item;
        return view('components.post-card',["post"=>$postitem]);
    }
}
