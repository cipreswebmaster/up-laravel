<?php

namespace App\View\Components;

use Illuminate\View\Component;

class Sample extends Component
{
    public $samples;
    public $cardComponent;
    public $imageFieldName;
    public $cardTitle;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(
      $samples, 
      $cardComponent, 
      $imageFieldName, 
      $cardTitle
    )
    {
      $this->samples = $samples;
      $this->cardComponent = $cardComponent;
      $this->imageFieldName = $imageFieldName;
      $this->cardTitle = $cardTitle;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.sample');
    }
}
