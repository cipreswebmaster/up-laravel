<?php

namespace App\View\Components;

use Illuminate\View\Component;

class UniversityCard extends Component
{
    public $title;
    public $imgSrc;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($title, $imgSrc)
    {
      $this->title = $title;
      $this->imgSrc = $imgSrc;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.university-card');
    }
}
