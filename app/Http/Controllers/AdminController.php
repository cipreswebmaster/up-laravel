<?php

namespace App\Http\Controllers;

use App\Http\Traits\HelpersTrait;
use App\Models\Profesion;
use App\Models\Universidad;
use App\Models\UniversidadCarrera;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Input;

class AdminController extends Controller
{
    use HelpersTrait;

  public function profMasivo(Request $request) {
    $req_arr = $request->toArray();
    $uni = new Universidad();

    $carreras = $req_arr["carreras"];
    unset($req_arr["carreras"]);

    $req_arr = array_filter($req_arr);

    foreach ($req_arr as $key => $value) {
      $uni[$key] = $value;
    }
    $uni["id_pais"] = 2;
    $uni["img_name"] = Str::slug($uni["nombre_universidad"]) . ".jpg";
    $uni->save();

    $carreras_exploded = explode(":", $carreras);
    $carreras = count($carreras_exploded) == 1 ? $carreras_exploded[0] : $carreras_exploded[1];
    $carreras = str_replace(["• ", "\n"], "", $carreras);
    $carreras = $this->process_data($carreras);

    foreach ($carreras as $carrera) {
      $slugged_name = Str::slug($carrera);
      try {
        $model = $this->getDatabaseInfoWithSlugifyiedName(
          "carreras",
          $slugged_name,
          "nombre_carrera",
          Profesion::$shortWordsException
        );
      } catch (\Exception $e) {
        continue;
      }
      
      $uni_prof = new UniversidadCarrera();
      $uni_prof->id_universidad = $uni->id_universidad;
      $uni_prof->id_carrera = $model["id_carrera"];
      $uni_prof->save();
    }

    return response()->json([
      "Nombre" => "Mipe",
      "Apellido" => "Ne"
    ]);
  }

  public function precios(Request $request) {
    
  }
}
