<?php

namespace App\Http\Controllers;

use App\Http\Traits\HelpersTrait;
use App\Models\Pais;
use App\Models\Profesion;
use App\Models\Universidad;
use App\Models\UniversidadCarrera;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UniversidadesController extends Controller
{
  use HelpersTrait;

  public function index($idCountry = '', $uniCountry = '') {
    $universidades = $idCountry ?
      Pais::find($idCountry)->universidades()->orderBy("nombre_universidad")->get() :
      Universidad::orderBy("nombre_universidad")->where("id_pais", 1)->get();

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
    $universidad["contacto_admision"] = $this->process_data($universidad["contacto_admision"]);
    $intercambios = $this->process_data(str_replace("•", "", (string) $universidad["intercambios"]), ":");
    $universidad["intercambios"] = trim($intercambios[0]) == "NO REGISTRA" ? false : [
      $intercambios[0],
      count($intercambios) > 1 ? $this->process_data($intercambios[1]) : []
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

    $perfil = $this->process_data($prof_uni->perfil_aspirante, ":");
    $prof_uni->perfil_aspirante = [
      $perfil[0],
      count($perfil) > 1 ? $this->process_data($perfil[1]) : []
    ];

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
      ->where("universidades.id_pais", "=", 1)
      ->select("universidades.*")
      ->distinct()->get()->toArray();

    session_start();
    $_SESSION["profesion"] = $profesion["nombre_carrera"];
    return view("universidades.index", [
      "universidades" => $this->convertAllElementsToArray($unis),
      "profesion" => $profesion["nombre_carrera"]
    ]);
  }

  public function universidadExtranjero($idCountry = '', $uniCountry = '', $uni = '') {
    $universidad = json_decode(json_encode(
      $this->getDatabaseInfoWithSlugifyiedName(
        "universidades",
        $uni,
        "nombre_universidad"
      )
    ), true);

    $universidad["proceso_admision"] = $this->process_data(str_replace("•", "", $universidad["proceso_admision"]));
    $universidad["apoyo_financiero"] = $this->process_data(str_replace("•", "", (string) $universidad["apoyo_financiero"]));
    $universidad["contacto_admision"] = $this->process_data($universidad["contacto_admision"]);
    $intercambios = $this->process_data(str_replace("•", "", (string) $universidad["intercambios"]), ":");

    $profesiones = $this->convertAllElementsToArray(
      DB::table('universidad_carrera')
      ->join("carreras", "universidad_carrera.id_carrera", "=", "carreras.id_carrera")
      ->join("areas", "carreras.id_area", "=", "areas.id_area")
      ->where("universidad_carrera.id_universidad", "=", $universidad["id_universidad"])
      ->select("carreras.*", "areas.nombre_area")
      ->distinct()->orderBy("carreras.nombre_carrera")->get()->toArray()
    );

    foreach ($profesiones as &$profession) {
      $area_img = &$profession["nombre_area"];
      while (mb_strtolower($area_img) == "sin area") {
        $profesiones_count = count($profesiones);
        $random_number = rand(0, $profesiones_count - 1);
        $area_img = $profesiones[$random_number]["nombre_area"];
      }
      $profession["area_img"] = $this->getAreaImageName($profession["nombre_area"]);
    }

    return view("universidades.extranjero", compact("universidad", "profesiones"));
  }

  private function convertAllElementsToArray($object) : array {
    $array = [];
    foreach ($object as $item) {
      array_push($array, json_decode(json_encode($item), true));
    }
    return $array;
  }
}
