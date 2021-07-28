<?php

namespace App\Http\Controllers;

use App\Http\Traits\HelpersTrait;
use App\Models\Area;
use App\Models\Profesion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class TestController extends Controller
{
  use HelpersTrait;

  public function index() {
    return view("test.index");
  }

  public function example() {
    $res = Http::withHeaders([
      "token" => "4bcgp-bgyt",
    ])->post("https://apps4beyond.com/REST/api/consultarResultados", [
      "token_id" => "0ead8013-43e8-11eb-8ecc-02eef28b5605"
    ])["result"]["resultObject"][0];

    $favs = Http::withHeaders([
      "token" => "4bcgp-bgyt",
    ])->post("https://apps4beyond.com/REST/api/getFavoritas", [
      "token_id" => "0ead8013-43e8-11eb-8ecc-02eef28b5605"
    ])["result"]["resultObject"];

    $areas = Area::all();
    $profesiones = Profesion::all();

    foreach ($profesiones as &$prof) {
      $info = $this->search4BeyondCareerData($prof->id_carrera_4beyond, $prof->id_area);
      if ($info)
        $prof->afinidad = $info["Afinidad"];
      else $prof->afinidad = 0;
    }
    
    foreach ($favs as &$fav) {
      $prof = array_values(array_filter($profesiones->toArray(), function ($el) use ($fav) {
        return $el["id_carrera_4beyond"] == $fav["id_carrera"];
      }))[0];
      $fav["nombre_carrera"] = $prof["nombre_carrera"];
      $fav["afinidad"] = $prof["afinidad"];
    }

    return view("test.results", [
      "results" => $res,
      "areas" => $areas,
      "profesiones" => $profesiones,
      "favs" => $favs,
      "token" => "0ead8013-43e8-11eb-8ecc-02eef28b5605"
    ]);
  }
}
