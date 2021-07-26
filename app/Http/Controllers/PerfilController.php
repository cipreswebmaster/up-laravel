<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class PerfilController extends Controller
{
  public function index() {
    session_start();
    if (!isset($_SESSION["logged"]))
      return redirect()->route("login");
    $token = $_SESSION["session_token"];
    $user = User::where("session_token", "=", $token)->first();
    $userInfoToShow = [
      "nombres" => $user->names,
      "apellidos" => $user->last_names,
      "email" => $user->email,
      "celular" => $user->phone_number,
      "nacimiento" => $user->birthday,
      "id_gender" => $user->id_gender
    ];

    return view("perfil", [
      "user" => $userInfoToShow
    ]);
  }
}
