<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class PagosController extends Controller
{
  private const plans = [30000, 45000, 55000];
  private const testAttempts = [1, 3, 6];

  public function pagar($plan) {
    session_start();
    if (intval($plan) > 3 || !isset($_SESSION["logged"]))
      return redirect("/");

    $user = User::where("session_token", $_SESSION["session_token"])->get()[0];
    $id = (string) uniqid(time(), true);
    $id = (int) substr($id, 0, 10);
    
    try {
      $iva = intval(self::plans[$plan-1]) * 0.19;
      $soap_client = new \SoapClient("https://www.zonapagos.com/ws_inicio_pagov2/Zpagos.asmx?wsdl");
      $params = [
        "id_tienda" => 30563,
        "clave" => "Cipres30563*",
        "total_con_iva" => self::plans[$plan-1] + $iva,
        "valor_iva" => $iva,
        "id_pago" => $id,
        "descripcion_pago" => "Pago por membresía UP",
        "email" => $user->email,
        "id_cliente" => $user["id_user"],
        "tipo_id" => 0,
        "nombre_cliente" => $user["names"],
        "apellido_cliente" => $user["last_names"],
        "telefono_cliente" => $user["phone_number"],
        "info_opcional1" => "",
        "info_opcional2" => "",
        "info_opcional3" => "",
        // "codigo_servicio_principal" => 2701,
        "codigo_servicio_principal" => 2008,
        "lista_codigos_servicio_multicredito" => ["0"],
        "lista_nit_codigos_servicio_multicredito" => ["0"],
        "lista_valores_con_iva" => [0],
        "lista_valores_iva" => [0],
        "total_codigos_servicio" => 0
      ];
      $response = $soap_client->inicio_pagoV2($params);
    
      $u = User::find($user->id_user);
      $u->payment_token = $id;
      $u->save();
      
      $_SESSION["pago_token"] = $response->inicio_pagoV2Result;
      $_SESSION["plan"] = $plan;
      return redirect("/estado_pago");
    } catch (\Exception $e) {
      echo $e->getMessage();
    }
  }

  public function estado_pago() {
    session_start();
    if (!isset($_SESSION["logged"]))
      return redirect("/");

    $user = User::where("session_token", $_SESSION["session_token"])->first();
    $id = $user->payment_token;

    try {
      $soap_client = new \SoapClient("https://www.zonapagos.com/WsVerificarPagoV4/VerificarPagos.asmx?wsdl");
      $params = [
        "int_id_comercio" => 30563,
        "str_usr_comercio" => "Cipres",
        "str_pwd_Comercio" => "Cipres30563*",
        "str_id_pago" => $id,
        "int_no_pago" => -1,
        "int_error" => 0,
        "str_detalle" => "Error description",
        "int_cantidad_pagos" => -1,
        "str_res_pago" => -1
      ];
      $response = $soap_client->verificar_pago_v4($params);
      $result = $response->verificar_pago_v4Result;
      
      // if ($result == -1) {
      //   Response::server_error("Ha ocurrido un error mientras se procesaba la verficación");
      // }
    
      $data = [
        "zona_pago_state" => $response->int_error,
        "zona_pago_state_detail" => $response->str_detalle, 
      ];
    
      if ($data["zona_pago_state"] == 0) {
        $res_pago_exploded = explode("|", $response->str_res_pago);
        if (intval($res_pago_exploded[1]) == 1) {
          $planMonths = self::testAttempts[intval($_SESSION["plan"]) - 1];

          $today = date_create();
          date_add($today, date_interval_create_from_date_string($planMonths . " months"));
          $fechaRenovacion = date_format($today, "Y-m-d");

          // $res_4beyond = Http::withHeaders([
          //   "token" => "4bcgp-bgyt",
          // ])->post("https://apps4beyond.com/REST/api/createUserCipres", [
          //   "nombre" => $user->names,
          //   "apellido" => $user->last_names
          // ])["result"]["resultObject"];

          $userObj = User::find($user->id_user);
          $userObj->state = 0;
          $userObj->test_attempts = $planMonths;
          $userObj->payment_expiration = $fechaRenovacion;
          $userObj->save();
          return;
        }
        $data["zona_pago_payment_info"] = [
          "estado_pago" => trim($res_pago_exploded[1]),
          "forma_pago" => trim($res_pago_exploded[14])
        ];
    
        // $data["zona_pago_payment_info"] = explode("|", $response->str_res_pago);
      }
    } catch (\Exception $e) {
      echo $e->getMessage(); 
    }
    return view("estado_pago", [
      "estado" => $data,
      "token" => isset($_SESSION["pago_token"]) ? $_SESSION["pago_token"] : null
    ]);
  }
}
