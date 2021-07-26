<?php

namespace App\View\Components;

use Illuminate\View\Component;

class ProfessionCard extends Component
{
    public $imgSrc;
    public $title;
    public $arrow;
    public $isOnU;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($imgSrc, $title = "", $arrow, $isOnU = false)
    {
      $this->imgSrc = $imgSrc;
      $this->title = $title;
      $this->arrow = $arrow;
      $this->isOnU = $isOnU;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.profession-card');
    }
}
