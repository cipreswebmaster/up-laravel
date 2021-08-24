<?php

namespace App\Http\Controllers;

use App\Mail\ColegioMail;
use App\Mail\LoginCode;
use App\Models\Profesion;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
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

    $redirect = "login";
    if (!$user)
      $redirect .= "?no_user=1";
    else {
      session_start();
      $isSchoolFirstTime = strpos($user->password, "[c]") !== false;
      $user->password = str_replace("[c]", "", $user->password);
      if (
        password_verify($password, $user->password) ||
        ($isSchoolFirstTime && $user->password == $password)  
      ) {
        unset($user->password);
        $code = $this->random_string();
        $_SESSION["confirm_code"] = $code;
        $_SESSION["email"] = $email;
        if ($isSchoolFirstTime) {
          $_SESSION["change_pass"] = true;
          $_SESSION["token"] = $user["session_token"];
        }
        Mail::to($email)->send(new LoginCode($code));

        return redirect()->route("login_code");
      } else {
        $redirect .= "?pass_err=1";
      }
    }
    return redirect($redirect);
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
    
    if ($code != $userCode) {
      $_SESSION["error"] = true;
      return redirect()->route("login_code");
    }
    
    unset($_SESSION["error"]);
    unset($_SESSION["email"]);
    unset($_SESSION["confirm_code"]);
    
    $user = User::where("email", $email)->first();
    $_SESSION["session_token"] = $user->session_token;
    $_SESSION["state"] = $user->state;
    $_SESSION["logged"] = true;
    return redirect()->route("perfil");
  }

  public function logout() {
    session_start();
    session_unset();
    session_destroy();
    return redirect("/");
  }

  public function registrate() {
    session_start();
    if (isset($_SESSION["logged"]))
      return redirect("perfil");
    $profesiones = Profesion::all();
    return view("registrate", compact("profesiones"));
  }

  public function registrar(Request $request) {
    $email = $request->email;
    $userAlreadyExists = User::where("email", "=", $email)->first();

    if ($userAlreadyExists != null) {
      return redirect()->route("registrate", ["user_exists" => true]);
    }

    $user = new User();
    $user->names = $request->nombres;
    $user->last_names = $request->apellidos;
    $user->id_gender = $request->gender == "Selecciona tu género" ? 3 : $request->gender;
    $user->phone_number = $request->tel;
    $user->email = $request->email;
    $user->document = $request->documento ?? "00000";
    $user->password = password_hash($request->password, PASSWORD_DEFAULT);
    $user->state = 1;
    $user->test_attempts = 0;
    $user->carrera_prospecto = $request->favorita;

    $dia = intval($request->day);
    $mes = intval($request->month);
    $anio = intval($request->year);
    $user->birthday = "$dia/$mes/$anio";

    $user->session_token = $this->generate_session_token();

    $user->save();

    return redirect()->route("login");
  }

  function addColegio(Request $request) {
    $usuarios = $request->file;
    $failed = [];
    foreach ($usuarios as $usuario) {
      $userAlreadyExists = User::where("email", $usuario["email"])->exists();
      if ($userAlreadyExists) {
        array_push($failed, $usuario["email"]);
        continue;
      }

      $gender = $usuario["gender"];
      unset($usuario["gender"]);
      
      $user = new User();
      foreach ($usuario as $key => $value) {
        $user[$key] = $value;
      }

      $user["names"] = ucfirst(mb_strtolower($user["names"]));
      $user["last_names"] = ucwords(mb_strtolower($user["last_names"]));
      $user["birthday"] = date("Y-m-d", strtotime($user["birthday"]));
      $user["id_gender"] = !$gender ? null : $this->GENDERS[strtolower(trim($gender))];
      $user["state"] = 0;
      $user["test_attempts"] = 0;
      $user["id_colegio"] = 1;
      $user["password"] = "[c]" . $user["document"];
      $user["session_token"] = $this->generate_session_token();
      $user["carrera_prospecto"] = $user["carrera_prospecto"] ?? "No sé";
      $user["4beyond_token_id"] = Http::withHeaders([
        "token" => "4bcgp-bgyt",
      ])->post("https://apps4beyond.com/REST/api/createUserCipres", [
        "nombre" => $user["names"],
        "apellido" => $user["last_names"],
        "clave" => $user["document"],
        "documento" => $user["document"],
        "id_genero" => $user["id_gender"],
        "email" => $user["email"],
        "force_renew" => 0
      ])["result"]["resultObject"][0]["tokenId"];
 
      $user->save();

      Mail::to($user["email"])
          ->send(new ColegioMail(
            $user["names"]." ".$user["last_names"],
            str_replace("[c]","", $user["password"]),
            $user["email"]
          ));
    }

    $failedCount = count($failed);
    return response()->json([
      "failed" => $failedCount,
      "existingEmails" => implode(",", $failed),
      "success" => count($usuarios) - $failedCount
    ]);
  }

  public function change_password(Request $request) {
    session_start();
    $pass = $request->password;
    $user = User::where("session_token", $_SESSION["token"])->first();
    $user->password = password_hash($pass, PASSWORD_DEFAULT);
    $user->save();
    unset($_SESSION["change_pass"]);
    unset($_SESSION["token"]);
    return back();
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

  /**
   * Genera un token para un usuario nuevo
   * 
   * @return string El token
   */
  private function generate_session_token() {
    return md5(time() + random_int(100, 1000000));
  }

  private $GENDERS = [
    "femenino" => 1,
    "masculino" => 2
  ];
}
