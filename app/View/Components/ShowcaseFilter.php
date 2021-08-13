<?php

namespace App\View\Components;

use App\Models\Pais;
use Illuminate\View\Component;

class ShowcaseFilter extends Component
{
    public $title;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($title)
    {
        $this->title = $title;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        $paises = Pais::all();
        return view('components.showcase-filter', compact("paises"));
    }
}
