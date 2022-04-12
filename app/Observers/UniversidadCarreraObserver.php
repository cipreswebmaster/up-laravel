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
      $changes = $universidadCarrera->getChanges();
      $changes_arr = [
        "precio_semestre" => preg_replace("/[^0-9]/", "", $changes["precio_semestre"])
      ];
      $original = $universidadCarrera->getOriginal();
      $original_arr = [
        "precio_semestre" => preg_replace("/[^0-9]/", "", $original["precio_semestre"])
      ];

      $this->makeActualizacion("universidad_carrera", $universidadCarrera->id_universidad_carrera, $changes_arr, $original_arr);
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
