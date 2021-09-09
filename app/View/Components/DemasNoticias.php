<?php

namespace App\View\Components;

use App\Models\Post;
use Illuminate\View\Component;

class DemasNoticias extends Component
{
    public $noticiasInteres;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct()
    {
      $noticiasInteres = array_values(
        Post::where("seccion", "Noticias interes")->get()->reverse()->toArray()
      );

      $principal = $noticiasInteres[0] ?? [];
      $this->noticiasInteres = [
        "principal" => $principal,
        "secundarias" => array_slice($noticiasInteres, 1)
      ];
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.demas-noticias');
    }
}
