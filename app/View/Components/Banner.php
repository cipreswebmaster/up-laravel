<?php

namespace App\View\Components;

use Illuminate\View\Component;

class Banner extends Component
{
    public $topText;
    public $bottomText;
    public $fromTop;
    public $arrow;
    public $img;
    public $isProfession;
    public $isUniBanner;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($topText, $bottomText = '', $fromTop = false, $arrow, $img, $isProfession = false, $isUniBanner = false)
    {
      $this->topText = $topText;
      $this->bottomText = $bottomText;
      $this->fromTop = $fromTop;
      $this->arrow = $arrow;
      $this->img = $img;
      $this->isProfession = $isProfession;
      $this->isUniBanner = $isUniBanner;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.banner');
    }
}
