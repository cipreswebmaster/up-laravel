<?php

namespace App\Http\Controllers;

use App\Http\Traits\HelpersTrait;
use App\Models\Profesion;
use App\Models\Universidad;
use App\Models\UniversidadCarrera;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UniversidadesController extends Controller
{
  use HelpersTrait;

  public function index() {
    $universidades = Universidad::orderBy("nombre_universidad")->get();
    return view("universidades.index", compact("universidades"));
  }

  public function universidad($uniName) {
    $universidad = json_decode(json_encode(
      $this->getDatabaseInfoWithSlugifyiedName(
        "universidades",
        $uniName,
        "nombre_universidad"
      )), true);
    $professions = $this->convertAllElementsToArray(
      DB::table('universidad_carrera')
      ->join("carreras", "universidad_carrera.id_carrera", "=", "carreras.id_carrera")
      ->join("areas", "carreras.id_area", "=", "areas.id_area")
      ->where("universidad_carrera.id_universidad", "=", $universidad["id_universidad"])
      ->select("carreras.*", "areas.nombre_area")
      ->distinct()->orderBy("carreras.nombre_carrera")->get()->toArray()
    );

    foreach ($professions as &$profession) {
      $profession["area_img"] = $this->getAreaImageName($profession["nombre_area"]);
    }

    return view("universidades.universidad", [
      "university" => $universidad,
      "professions" => $professions
    ]);
  }

  public function profInU($uniName, $professionName) {
    $universidad = json_decode(json_encode(
      $this->getDatabaseInfoWithSlugifyiedName(
        "universidades",
        $uniName,
        "nombre_universidad"
      )
    ), true);

    $universidad["proceso_admision"] = $this->process_data(str_replace("•", "", $universidad["proceso_admision"]));
    $universidad["apoyo_financiero"] = $this->process_data(str_replace("•", "", (string) $universidad["apoyo_financiero"]));
    $intercambios = $this->process_data(str_replace("•", "", (string) $universidad["intercambios"]), ":");
    $universidad["intercambios"] = count($intercambios) == 1 ? false : [
      $intercambios[0],
      $this->process_data($intercambios[1])
    ];

    $profesion = json_decode(json_encode(
      $this->getDatabaseInfoWithSlugifyiedName(
        "carreras",
        $professionName,
        "nombre_carrera"
      )
    ), true);
    $prof_uni = UniversidadCarrera
      ::where("id_universidad", $universidad["id_universidad"])
      ->where("id_carrera", $profesion["id_carrera"])->first();

    return view("universidades.profession", compact("universidad", "profesion", "prof_uni"));
  }

  public function unisOfProf($professionName) {
    $profesion = $this->getDatabaseInfoWithSlugifyiedName(
      "carreras",
      $professionName,
      "nombre_carrera",
      Profesion::$shortWordsException
    );
    $unis = DB::table('universidades')
      ->join("universidad_carrera", "universidades.id_universidad", "=", "universidad_carrera.id_universidad")
      ->where("universidad_carrera.id_carrera", "=", $profesion["id_carrera"])
      ->select("universidades.*")
      ->distinct()->get()->toArray();
    
    return view("universidades.index", [
      "universidades" => $this->convertAllElementsToArray($unis)
    ]);
  }

  private function convertAllElementsToArray($object) : array {
    $array = [];
    foreach ($object as $item) {
      array_push($array, json_decode(json_encode($item), true));
    }
    return $array;
  }
}
