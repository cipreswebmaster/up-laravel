<?php

namespace App\Http\Controllers;

use App\Mail\Contacto;
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

  public function registrar() {
    return redirect("/universidades");
  }
}
