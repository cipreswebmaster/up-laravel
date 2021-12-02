<?php

namespace App\Http\Controllers;

use App\Http\Traits\HelpersTrait;
use App\Models\Acreditacion;
use App\Models\Pais;
use App\Models\Profesion;
use App\Models\Universidad;
use App\Models\UniversidadCarrera;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Symfony\Component\HttpFoundation\File\Exception\FileException;

class UniversidadesController extends Controller
{
  use HelpersTrait;

  public function index($idCountry = '', $uniCountry = '') {
    $universidades = Universidad::orderBy("nombre_universidad")
                                  ->where("id_pais", $idCountry ?: 1)
                                  ->where("perfil_basico", 0)
                                  ->get();

    $perfiles_basicos = [];
    if ($idCountry) {
      $perfiles_basicos = Universidad::orderBy("nombre_universidad")
                                      ->where("id_pais", $idCountry)
                                      ->where("perfil_basico", 1)
                                      ->get();
    }

    return view("universidades.index", compact("universidades", "perfiles_basicos"));
  }

  /**
   * Route: /universidad/{$uniName}
   */
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

    /* Obteniendo acreditaciones */
    $this->processAcreditations($universidad);

    return view("universidades.universidad", [
      "university" => $universidad,
      "professions" => $professions
    ]);
  }

  /**
   * Route: /universidades/{$uniName}/{$professionName}
   */
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

    $perfil = $this->process_data($prof_uni->perfil_aspirante ?: "", ":");
    if ($perfil) {
      $prof_uni->perfil_aspirante = [
        $perfil[0],
        count($perfil) > 1 ? $this->process_data($perfil[1]) : []
      ];
    }

    /* Obteniendo acreditaciones */
    $this->processAcreditations($universidad);

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

    $pais = Pais::where("id_pais", $universidad["id_pais"])->get();

    $universidad["proceso_admision"] = $this->process_data(str_replace("•", "", $universidad["proceso_admision"]));
    $universidad["apoyo_financiero"] = $this->process_data(str_replace("•", "", (string) $universidad["apoyo_financiero"]));
    $universidad["contacto_admision"] = $this->process_data($universidad["contacto_admision"]);
    $universidad["abreviatura_pais"] = $pais[0]->abreviatura;
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

  #region API
  /**
   * Route: /api/universidades
   */
  public function universidades() {
    $universidades = Universidad::all();
    return response()->json($universidades);
  }

  /**
   * Route: /api/create_universidad
   */
  public function create_universidad(Request $request) {
    $info = $request->all();
    $campus = $request->file("campus");
    $logo = $request->file("logo");
    $profesiones = explode(",", $info["profesiones"]);

    unset($info["acreditaciones"]);
    unset($info["campus"]);
    unset($info["logo"]);
    unset($info["profesiones"]);

    $logo_name = Str::slug($info["nombre_universidad"]) . ".jpg";
    $banner_name = Str::slug($info["nombre_universidad"]) . "-banner.jpg";
    $info["img_name"] = $logo_name;

    $u_created = Universidad::create($info);

    try {
      $path_campus = public_path($this->getThePath("/images/universidades/campus"));
      $path_logo = public_path($this->getThePath("/images/universidades/logo"));
      $campus->move($path_campus, $banner_name);
      $logo->move($path_logo, $logo_name);
    } catch(FileException $e) {
      $u_created->delete();
      return response()->json([
        "success" => false,
        "message" => $e->getMessage()
      ]);
    }

    foreach ($profesiones as $id) {
      $nuevaCarrera = new UniversidadCarrera();
      $nuevaCarrera->id_universidad = $u_created->id_universidad;
      $nuevaCarrera->id_carrera = $id;
      $nuevaCarrera->save();
    }
  }

  /**
   * Route: /api/add_basic_u
   */
  public function add_basic_u(Request $request) {
    $info = $request->all();
    $universidades = json_decode($info["universidades"]);

    foreach ($universidades as $universidad) {
      $nombre_u = $universidad->nombre_universidad;
      $uni_exists = Universidad::where("nombre_universidad", $nombre_u)->exists();
      if ($uni_exists)
        continue;

      $campus = scandir(public_path($this->getThePath("images/universidades/pre_upload/campus")));
      unset($campus[0]);
      unset($campus[1]);
  
      $logos = scandir(public_path($this->getThePath("images/universidades/pre_upload/logos")));
      unset($logos[0]);
      unset($logos[1]);

      foreach ($campus as $img) {
        $could_upload_two_images = false;
        if (Str::slug($nombre_u) . "jpg" != Str::slug($img))
          continue;

        $img_name_slug = Str::slug(explode(".", $img)[0]) . "-banner.jpg";
        
        $campus_from_path = public_path($this->getThePath("images/universidades/pre_upload/campus/") . $img);
        $campus_to_path = public_path($this->getThePath("images/universidades/campus/" . $img_name_slug));
        $campus = rename($campus_from_path, $campus_to_path);

        if ($campus) {
          $logo_from_path = public_path($this->getThePath("images/universidades/pre_upload/logos/") . $img);
          $logo_to_path = public_path($this->getThePath("images/universidades/logo/" . str_replace("-banner", "", $img_name_slug)));
          $logo = @rename($logo_from_path, $logo_to_path);

          if (!$logo)
            rename($campus_to_path, $campus_from_path);

          $could_upload_two_images = $logo;
        }
        break;
      }

      if (!$could_upload_two_images)
        continue;

      $uni = new universidad();
      $uni->nombre_universidad = $nombre_u;
      $uni->web = $universidad->web;
      $uni->ranking_pais = $universidad->ranking_pais;
      $uni->ranking_mundo = $universidad->ranking_mundo;
      $uni->ciudad = $universidad->ciudad;
      $uni->estado = @$universidad->estado ?: null;
      $uni->id_pais = $info["id_pais"];
      $uni->perfil_basico = 1;
      $uni->img_name = Str::slug($nombre_u) . ".jpg";
      $uni->save();
    }

    return response()->json([
      "success" => true
    ]);
  }

  /**
   * Route: /api/add_profs_to_national
   */
  public function add_profs_to_national(Request $request) {
    $info = $request->all();
    $universidades = json_decode($info["universidades"]);

    foreach ($universidades as $universidad) {
      $ya_existe = UniversidadCarrera::where("id_carrera", $universidad->id_carrera)->where("id_universidad", $info['u'])->exists();
      if ($ya_existe)
        continue;

      // Obtiendo código de video de YouTube
      $url_components = parse_url($universidad->video);
      parse_str($url_components["query"], $params);
        
      $prof = new UniversidadCarrera();
      $prof->id_universidad = $info['u'];
      $prof->id_carrera = $universidad->id_carrera;
      $prof->video = $params['v'];
      $prof->proposito_carrera = $universidad->proposito_carrera;
      $prof->perfil_aspirante = $universidad->perfil_aspirante;
      $prof->perfil_prof = $universidad->perfil_prof;
      $prof->precio_semestre = $universidad->precio_semestre;
      $prof->pensum = 1;
      $prof->save();
    }

    return response()->json(["success" => true]);
  }

  /**
   * Route: /api/convert_basics_profile
   */
  public function convert_basics_profile(Request $request) {
    $info = $request->all();
    $universidades = json_decode($info["universidades"]);
    
    foreach ($universidades as $universidad) {
      $universidad_modelo = Universidad::find($universidad->id_universidad);
      $carreras = $this->process_data($universidad->carreras);
      unset($universidad->carreras);

      $info_actualizar = json_decode(json_encode($universidad), true);
      $info_actualizar["perfil_basico"] = 0;

      $universidad_modelo->update($info_actualizar);

      foreach ($carreras as $carrera) {
        try {
          $carrera_modelo = $this->getDatabaseInfoWithSlugifyiedName(
            "carreras", 
            Str::slug($carrera), 
            "nombre_carrera", 
            Profesion::$shortWordsException
          );
          if (!$carrera_modelo) continue;
          $model_exists = UniversidadCarrera::where("id_universidad", $universidad->id_universidad)
                                            ->where("id_carrera", $carrera_modelo["id_carrera"])
                                            ->exists();
          if ($model_exists) continue;
          UniversidadCarrera::create([
            "id_universidad" => $universidad->id_universidad,
            "id_carrera" => $carrera_modelo["id_carrera"]
          ]);
        } catch (\Throwable $e) {
          
        }
      }
    }

    return response()->json(["success" => true]);
  }

  /**
   * Route: /api/subir_pensums
   */
  public function subir_pensums(Request $request) {
    $data = $request->all();
    $universidad = $data["universidad"];
    $pensums = $data["pensums"];

    foreach ($pensums as $pensum) {
      $filename = pathinfo($pensum->getClientOriginalName(), PATHINFO_FILENAME);
      $id_carrera = explode("-", $filename)[1];
      $pensum_name = $universidad . "." . $id_carrera . ".jpg";
      $pensum_path = public_path($this->getThePath("images/universidades/pensums"));
      if (!file_exists($pensum_path . '/' . $pensum_name));
        $pensum->move($pensum_path, $pensum_name);
    }
    
    return response()->json([ "success" => true ]);
  }
  #endregion

  #region Functions
  private function convertAllElementsToArray($object) : array {
    $array = [];
    foreach ($object as $item) {
      array_push($array, json_decode(json_encode($item), true));
    }
    return $array;
  }

  private function processAcreditations(&$universidad) {
    $delimiter = strpos($universidad["acreditaciones"], ">>") === false ? "-" : ">>";
    $accreditations_exploded = explode($delimiter, $universidad["acreditaciones"]);
    $new_accs = [];
    foreach ($accreditations_exploded as $acc) {
      $acc_name = trim($acc);
      $noTieneLogo = strpos($acc_name, "(NO TIENE LOGO)");
      if ($noTieneLogo !== false)
        continue;

      try {
        $accreditation = $this->getDatabaseInfoWithSlugifyiedName(
          "acreditaciones",
          Str::slug($acc_name),
          "nombre_acreditacion"
        );
        array_push($new_accs, $accreditation);
      } catch (\Exception $th) {
        
      }
    }
    $universidad["acreditaciones"] = array_values(array_unique($new_accs, SORT_REGULAR));
  }
  #endregion
}
