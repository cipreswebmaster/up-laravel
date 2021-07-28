<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ContactoController extends Controller
{
  public function index() {
    return view("contacto");
  }

  public function registrar() {
    return redirect("/universidades");
  }
}
