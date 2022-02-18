<?php

namespace App\Observers;

use App\Http\Traits\HelpersTrait;
use App\Models\Profesion;
use App\Models\Universidad;
use App\Models\UniversidadCarrera;

class UniversidadCarreraObserver
{
    use HelpersTrait;

    /**
     * Handle the UniversidadCarrera "created" event.
     *
     * @param  \App\Models\UniversidadCarrera  $universidadCarrera
     * @return void
     */
    public function created(UniversidadCarrera $universidadCarrera)
    {
        //
    }

    /**
     * Handle the UniversidadCarrera "updated" event.
     *
     * @param  \App\Models\UniversidadCarrera  $universidadCarrera
     * @return void
     */
    public function updated(UniversidadCarrera $universidadCarrera)
    {
      $carrera = Profesion::find($universidadCarrera["id_carrera"]);
      $universidad = Universidad::find($universidadCarrera["id_universidad"]);
      $reference = $carrera["nombre_carrera"] + " en " + $universidad["nombre_universidad"];
      $this->makeActualizacion($universidadCarrera, $reference);
    }

    /**
     * Handle the UniversidadCarrera "deleted" event.
     *
     * @param  \App\Models\UniversidadCarrera  $universidadCarrera
     * @return void
     */
    public function deleted(UniversidadCarrera $universidadCarrera)
    {
        //
    }

    /**
     * Handle the UniversidadCarrera "restored" event.
     *
     * @param  \App\Models\UniversidadCarrera  $universidadCarrera
     * @return void
     */
    public function restored(UniversidadCarrera $universidadCarrera)
    {
        //
    }

    /**
     * Handle the UniversidadCarrera "force deleted" event.
     *
     * @param  \App\Models\UniversidadCarrera  $universidadCarrera
     * @return void
     */
    public function forceDeleted(UniversidadCarrera $universidadCarrera)
    {
        //
    }
}
