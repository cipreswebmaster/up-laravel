<?php

namespace App\Http\Controllers;

use App\Mail\LoginCode;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class UsuariosController extends Controller
{
  public function login() {
    session_start();
    if (isset($_SESSION["logged"]))
      return redirect("perfil");
    return view("login.index");
  }

  public function validar(Request $request) {
    $email = $request->email;
    $password = $request->password;
    if (!$email || !$password)
      return redirect()->route("login");
    $user = User::where("email", $email)->first();

    $params_to_login = [ "error" => true ];
    session_start();
    if (password_verify($password, $user->password)) {
      unset($user->password);
      $code = $this->random_string();
      $_SESSION["confirm_code"] = $code;
      $_SESSION["email"] = $email;
      Mail::to($email)->send(new LoginCode($code));
      unset($params_to_login["error"]);
    }
    return redirect()->route("login_code", $params_to_login);
  }

  public function codigo() {
    session_start();
    if (isset($_SESSION["logged"]))
      return redirect("perfil");
    if (!isset($_SESSION["confirm_code"]))
      return redirect()->route("login");
    return view("login.codigo");
  }

  public function comprobarCodigo(Request $request) {
    session_start();
    $userCode = $request->code;
    try {
      $code = $_SESSION["confirm_code"];
      $email = $_SESSION["email"];
    } catch (Exception $e) {
      return redirect("/login");
    }
    unset($_SESSION["confirm_code"]);
    unset($_SESSION["email"]);
    if ($code != $userCode)
      return redirect()->route("login_code", ["error" => true]);
    
    $user = User::where("email", $email)->first();
    $_SESSION["session_token"] = $user->session_token;
    $_SESSION["logged"] = true;
    return redirect()->route("perfil");
  }

  public function logout() {
    session_start();
    session_destroy();
    return redirect("/");
  }

  public function registrate() {
    session_start();
    if (isset($_SESSION["logged"]))
      return redirect("perfil");
    return view("registrate");
  }

  public function registrar(Request $request) {
    $email = $request->email;
    $document = $request->documento;
    $userAlreadyExists = User::where("email", "=", $email)
                              ->orWhere("document", "=", $document)->get();

    if ($userAlreadyExists != null) {
      return redirect()->route("registrate", ["user_exists" => true]);
    }

    $user = new User();
    $user->names = $request->nombres;
    $user->last_names = $request->apellidos;
    $user->id_gender = $request->gender;
    $user->phone_number = $request->tel;
    $user->email = $request->email;
    $user->document = $request->documento;
    $user->password = password_hash($request->password, PASSWORD_DEFAULT);
    $user->state = 1;

    $dia = intval($request->day);
    $mes = intval($request->month);
    $anio = intval($request->year);
    $user->birthday = "$dia/$mes/$anio";

    $user->session_token = md5(time() + random_int(100, 1000000));

    $user->save();

    return redirect()->route("login");
  }

  /**
   * Genera una cadena de caracteres aleatorio que será usado como código de login
   * 
   * @param int $length La longitud de la cadena
   * 
   * @return string La cadena a ser usada como código
   */
  private function random_string(int $length = 7) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $randomString = "";
  
    for ($i = 0; $i < $length; $i++) {
      $index = rand(0, strlen($characters) - 1);
      $randomString .= $characters[$index];
    }
    return $randomString;
  }
}
