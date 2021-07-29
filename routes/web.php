<?php

use App\Http\Controllers\ContactoController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::view('/', 'index');
Route::view('/membresias', 'membresias');

Route::get('/becas', 'BecasController@index');
Route::get("/logout", "UsuariosController@logout")->name("logout");
Route::get("/registrate", "UsuariosController@registrate")->name("registrate");
Route::get("/perfil", "PerfilController@index")->name("perfil");
Route::get("/pagar/{plan}", "PagosController@pagar")->name("pagar");
Route::get('/estado_pago', 'PagosController@estado_pago');

Route::post("/registrar", "UsuariosController@registrar")->name("registrar");
Route::post('/registrar-contacto', "ContactoController@registrar");

/* Contacto */
Route::prefix("contacto")->group(function () {
  Route::get("/", "ContactoController@index");
  Route::post('/contactar', "ContactoController@contactar");
});

/* Test */
Route::prefix("test")->group(function () {
  Route::get("/", "TestController@index");
  Route::get("/example", "TestController@example");
});

/* Profesiones */
Route::prefix("profesiones")->group(function () {
  Route::get('/', 'ProfesionesController@index');
  Route::get("/{professionName}", 'ProfesionesController@profesion')
    ->name("profession")
    ->middleware("islogged");
});

/* Universidades */
Route::prefix("universidades")->group(function () {
  Route::get('/', 'UniversidadesController@index');
  Route::get('/{uniName}', 'UniversidadesController@universidad')
    ->name("university")
    ->middleware("islogged");;
  Route::get('/p/{professionName}', 'UniversidadesController@unisOfProf')
    ->name("unisOfProf");
  Route::get('/{uniName}/{professionName}', 'UniversidadesController@profInU')
    ->name("profInU")
    ->middleware("islogged");;
});

/* Login */
Route::prefix("login")->group(function () {
  Route::get("/", "UsuariosController@login")
    ->name("login");
  Route::post("/validar", "UsuariosController@validar")
    ->name("validar");
  Route::get("/codigo", "UsuariosController@codigo")
    ->name("login_code");
  Route::post("/comprobar_codigo", "UsuariosController@comprobarCodigo")
    ->name("comprobar_codigo");
});
