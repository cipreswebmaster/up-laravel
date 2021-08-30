<?php

namespace App\View\Components;

use App\Http\Traits\HelpersTrait;
use App\Models\Profesion;
use Illuminate\View\Component;

class ProfessionCard extends Component
{
  use HelpersTrait;

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
      $this->isOnU = $isOnU;
      $this->arrow = $arrow != "sin-area"
                            ? 'images/select-area/arrows/' . $arrow . '.svg'
                            : "none";
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        $slugifyiedTitle = str_replace([" ", ","], "-", strtolower(clean_string($this->title)));
        $profesion = $this->getDatabaseInfoWithSlugifyiedName(
          "carreras",
          $slugifyiedTitle,
          "nombre_carrera",
          Profesion::$shortWordsException
        );
        return view('components.profession-card', [
          "id_area" => $profesion["id_area"]
        ]);
    }
}
