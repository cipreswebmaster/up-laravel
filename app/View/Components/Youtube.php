<?php

namespace App\View\Components;

use Illuminate\View\Component;

class Youtube extends Component
{
    public $videoId;
    public $class;
    public $containerClass;
    
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($videoId, $class="", $containerClass)
    {
      $this->videoId = $videoId;
      $this->class = $class;
      $this->containerClass = $containerClass;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.youtube');
    }
}
