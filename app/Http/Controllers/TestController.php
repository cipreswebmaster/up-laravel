<?php

namespace App\Http\Controllers;

use App\Models\Area;
use App\Models\Profesion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class TestController extends Controller
{
  public function index() {
    return view("test.index");
  }

  public function example() {
    $res = Http::withHeaders([
      "token" => "4bcgp-bgyt",
    ])->post("https://apps4beyond.com/REST/api/consultarResultados", [
      "token_id" => "0ead8013-43e8-11eb-8ecc-02eef28b5605"
    ])["result"]["resultObject"][0];

    $areas = Area::all();
    $profesiones = Profesion::all();

    return view("test.results", [
      "results" => $res,
      "areas" => $areas,
      "profesiones" => $profesiones
    ]);
  }
}
