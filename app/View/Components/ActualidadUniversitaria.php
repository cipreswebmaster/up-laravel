<?php

namespace App\View\Components;

use App\Models\Post;
use Illuminate\View\Component;

class ActualidadUniversitaria extends Component
{
    public $posts;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct()
    {
      $this->posts = Post::all()->reverse();
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.actualidad-universitaria');
    }
}
