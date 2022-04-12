<?php

namespace App\Observers;

use App\Http\Traits\HelpersTrait;
use App\Models\ActualizacionBBDD;
use App\Models\Universidad;

class UniversidadObserver
{
    use HelpersTrait;

    /**
     * Handle the Universidad "created" event.
     *
     * @param  \App\Models\Universidad  $universidad
     * @return void
     */
    public function created(Universidad $universidad)
    {
        //
    }

    /**
     * Handle the Universidad "updated" event.
     *
     * @param  \App\Models\Universidad  $universidad
     * @return void
     */
    public function updated(Universidad $universidad)
    {
      $changes = $universidad->getChanges();
      $changes_arr = [
        "link_internacionalizacion" => $changes["link_internacionalizacion"],
        "web" => $changes["web"]
      ];
      $original = $universidad->getOriginal();
      $original_arr = [
        "link_internacionalizacion" => $original["link_internacionalizacion"],
        "web" => $original["web"]
      ];

      $this->makeActualizacion("universidades", $universidad->id_universidad, $changes_arr, $original_arr);
    }

    /**
     * Handle the Universidad "deleted" event.
     *
     * @param  \App\Models\Universidad  $universidad
     * @return void
     */
    public function deleted(Universidad $universidad)
    {
        //
    }

    /**
     * Handle the Universidad "restored" event.
     *
     * @param  \App\Models\Universidad  $universidad
     * @return void
     */
    public function restored(Universidad $universidad)
    {
        //
    }

    /**
     * Handle the Universidad "force deleted" event.
     *
     * @param  \App\Models\Universidad  $universidad
     * @return void
     */
    public function forceDeleted(Universidad $universidad)
    {
        //
    }
}
