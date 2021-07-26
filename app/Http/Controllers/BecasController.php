<?php

namespace App\Http\Controllers;

use App\Models\Beca;
use Illuminate\Http\Request;

class BecasController extends Controller
{
  public function index() {
    $becas = Beca::all();
    $becasBySection = [];

    foreach ($becas as $beca) {
      $region = $beca["region"];
      if (!array_key_exists($region, $becasBySection))
        $becasBySection[$region] = [];
      
      array_push($becasBySection[$region], json_decode(json_encode($beca), true));
    }

    return view("becas", [
      "becas" => $becasBySection
    ]);
  }
}
