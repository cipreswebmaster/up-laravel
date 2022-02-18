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
      $this->makeActualizacion($universidad, "nombre_universidad");
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
