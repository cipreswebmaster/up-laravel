<?php

namespace App\Http\Controllers;

use App\Http\Traits\HelpersTrait;
use App\Models\Area;
use App\Models\Profesion;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class TestController extends Controller
{
  use HelpersTrait;

  public function index() {
    session_start();
    if (isset($_SESSION["logged"])) {
      $token = $_SESSION["session_token"];
      $user = User::where("session_token", $token)->first();
      if ($user->state != 0)
        return view("test.index");

      $fourBeyond = Http::withHeaders([
        "token" => "4bcgp-bgyt",
      ])->post("https://apps4beyond.com/REST/api/consultarResultados", [
        "token_id" => $user["4beyond_token_id"]
      ])["result"]["resultObject"];

      if ($fourBeyond == "No Result Set Return") {
        return view("test.test", ["token" => $user["4beyond_token_id"]]);
      }

      $attempts = $user->test_attempts;
      return view("test.index_pago", compact("attempts"));
    }
    return view("test.index");
  }

  public function example() {
    $results = $this->getResultsInfo("0ead8013-43e8-11eb-8ecc-02eef28b5605");
    return view("test.results", $results);
  }

  public function results() {
    $user = User::where("session_token", $_SESSION["session_token"])->first()->toArray();
    $results = $this->getResultsInfo($user["4beyond_token_id"]);
    if (!$results)
      return redirect("/test");
    return view("test.results", $results);
  }

  private function getResultsInfo($token) {
    $res = Http::withHeaders([
      "token" => "4bcgp-bgyt",
    ])->post("https://apps4beyond.com/REST/api/consultarResultados", [
      "token_id" => $token
    ])["result"]["resultObject"];

    if ($res == "No Result Set Return")
      return false;
    $res = $res[0];

    $favs = Http::withHeaders([
      "token" => "4bcgp-bgyt",
    ])->post("https://apps4beyond.com/REST/api/getFavoritas", [
      "token_id" => $token
    ])["result"]["resultObject"];

    $areas = Area::all();
    $profesiones = Profesion::all();

    foreach ($profesiones as &$prof) {
      $info = $this->search4BeyondCareerData($prof->id_carrera_4beyond, $prof->id_area, $token);
      if ($info)
        $prof->afinidad = $info["Afinidad"];
      else $prof->afinidad = 0;
    }
    
    foreach ($favs as $i => &$fav) {
      $prof = array_values(array_filter($profesiones->toArray(), function ($el) use ($fav) {
        $carrera4beyond = $el["id_carrera_4beyond"];
        $carreraFav = $fav["id_carrera"];
        return $carreraFav  == $carrera4beyond;
      }));
      if (!$prof) {
        unset($favs[$i]);
        continue;
      }
      $fav["nombre_carrera"] = $prof[0]["nombre_carrera"];
      $fav["afinidad"] = $prof[0]["afinidad"];
    }

    return [
      "results" => $res,
      "areas" => $areas,
      "profesiones" => $profesiones,
      "favs" => $favs,
      "token" => $token
    ];
  }

  public function renew() {
    $user = User::where("session_token", $_SESSION["session_token"])->first();

    $obj = [
      "nombre" => $user["names"],
      "apellido" => $user["last_names"],
      "email" => $user["email"],
      "clave" => $user["document"],
      "id_genero" => $user["id_gender"],
      "force_renew" => "1"
    ];

    // Http::withHeaders([
    //   "token" => "4bcgp-bgyt",
    // ])->post("https://apps4beyond.com/REST/api/createUserCipres", [
    //   "nombre" => $user[""]
    // ])["result"]["resultObject"];

    return redirect("/test");
  }
}
