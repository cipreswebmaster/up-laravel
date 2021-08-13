<?php

namespace App\Http\Controllers;

use App\Mail\Contacto;
use App\Mail\SerContactado;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class ContactoController extends Controller
{
  public function index() {
    return view("contacto");
  }

  public function contactar(Request $request) {
    $names = $request->names;
    $school = $request->school;
    $email = $request->email;
    $phone = $request->phone;
    $message = $request->message;

    Mail::to("contacto@universidadesyprofesiones.com")
          ->cc("nbermudez@cipres.com.co")
          ->send(new Contacto($names, $school, $email, $phone, $message));

    return redirect("/contacto?success");
  }

  public function registrar(Request $request) {
    $nombre = $request->nombre;
    $universidad = $request->universidad;
    $telefono = $request->tel;
    $correo = $request->email;
    $profesion = $request->profesion;

    Mail::to("contacto@universidadesyprofesiones.com")
          ->cc("nbermudez@cipres.com.co")
          ->send(new SerContactado($universidad, $nombre, $telefono, $correo, $profesion));

    return back();
  }
}
