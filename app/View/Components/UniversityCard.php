<?php

namespace App\View\Components;

use Illuminate\View\Component;

class UniversityCard extends Component
{
    public $title;
    public $imgSrc;
    public $ciudad;
    public $rankingMundo;
    public $rankingPais;
    public $idCiudad;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(
      $title, 
      $imgSrc, 
      $idCiudad = '',
      $ciudad = '', 
      $rankingMundo = '', 
      $rankingPais = '')
    {
      $this->title = $title;
      $this->imgSrc = $imgSrc;
      $this->ciudad = $ciudad;
      $this->rankingMundo = $rankingMundo;
      $this->rankingPais = $rankingPais;
      $this->idCiudad = $idCiudad;
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
