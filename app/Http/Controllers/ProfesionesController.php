<?php

namespace App\Http\Controllers;

use App\Http\Traits\HelpersTrait;
use App\Models\Area;
use App\Models\Profesion;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;

class ProfesionesController extends Controller
{
  use HelpersTrait;

  #region Path functions
  public function index() {
    $profesiones = Profesion::orderBy("nombre_carrera")->get();
    $areas = Area::all();
    foreach ($profesiones as &$profesion) {
      $id_area = $profesion["id_area"];
      $area = &$areas[$id_area - 1];
      $area_img = $this->getAreaImageName($area["nombre_area"]);
      $profesion["area_img"] = $area_img;
      $area["img"] = $area_img;
    }
    
    return view("profesiones.index", compact("profesiones", "areas"));
  }

  public function profesion($professionName) {
    $profession = $this->getDatabaseInfoWithSlugifyiedName(
      "carreras",
      $professionName,
      "nombre_carrera",
      Profesion::$shortWordsException
    );

    // Procesando habilidades
    $delimiter = strpos($profession["habilidades"], "titulo:") === false ? "Titulo:" : "titulo:";
    $habs_exploded = $this->process_data($profession["habilidades"], $delimiter);
    array_shift($habs_exploded);
    $profession["habilidades"] = $this->getDataWithIcons($habs_exploded);

    // Procesando requerimientos perfil
    $reqs_exploded = array_filter($this->process_data($profession["requerimientos_perfil"]));
    $profession["requerimientos_perfil"] = $this->getDataWithIcons($reqs_exploded, ":");

    // Procesando información general
    $profession["especializar"] = $this->process_data($profession["especializar"]);
    $profession["razon_estudio"] = $this->process_data($profession["razon_estudio"]);
    $profession["areas_desempenio"] = $this->process_data($profession["areas_desempenio"]);
    $profession["posgrados"] = $this->process_data($profession["posgrados"]);
    $profession["carreras_rel"] = $this->process_data(str_replace("-", " ", $profession["carreras_rel"]));

    $fourBeyondData = $this->search4BeyondCareerData($profession["id_carrera_4beyond"], $profession["id_area"]);
    return view("profesiones.profesion", compact("profession", "fourBeyondData", "professionName"));
  }
  #endregion

  /**
   * Look for an icon in the bbdd and return an array with the information ordened, including an icon name
   * 
   * @param array $data_exploded
   * @param string $separator The string to divide de data
   * 
   * @return array The information in order, including the icon name
   */
  private function getDataWithIcons(array $data_exploded, string $separator = ">>") {
    $final_splitted = [];
    foreach ($data_exploded as $hab) {
      $data_processed = $this->process_data($hab, $separator);
      $title = @$data_processed[0];
      $title_exploded = explode(" ", trim($title));
      $icon = DB::table('habilidades')
        ->where("titulo_habilidad", "LIKE", '%' . $title_exploded[0] . '%');
      for ($i = 1; $i < count($title_exploded); $i++) { 
        $curr = $title_exploded[$i];
        if (strlen($curr) > 3)
          $icon->orWhere("titulo_habilidad", "LIKE", '%' . $curr . '%');
      }
      $icon = $icon->first();
      $image = "trabajo-en-equipo.svg";
      if ($icon) {
        $image = strtolower(clean_string($icon->nombre_icono));
        if (strrpos($image, ".") !== strlen($image) - 1)
          $image .= ".";
        $image .= "svg";
      }
      
      array_push($final_splitted, [
        "title" => $data_processed[0],
        "content" => @$data_processed[1],
        "image" => $image
      ]);
    }

    return $final_splitted;
  }
}
