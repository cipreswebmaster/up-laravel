<?php

use App\Http\Controllers\ContactoController;
use App\Models\Universidad;
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

/* Actualidad */
Route::prefix("/actualidad")->group(function () {
  Route::get("/", "PostsController@index")->name("actualidad");
  Route::get("/{postName}", "PostsController@post")->name("post");
});

/* Contacto */
Route::prefix("contacto")->group(function () {
  Route::get("/", "ContactoController@index");
  Route::post('/contactar', "ContactoController@contactar");
});

/* Test */
Route::prefix("test")->group(function () {
  Route::get("/", "TestController@index");
  Route::get("/example", "TestController@example")->name("test_example");
  Route::get("/results", "TestController@results")
    ->name("results")
    ->middleware("islogged");
  Route::get("/renew_test", "TestController@renew")
  ->name("renew_test")
  ->middleware("islogged");
});

/* Profesiones */
Route::prefix("profesiones")->group(function () {
  Route::get('/', 'ProfesionesController@index')->name("profIndex");
  Route::get("/{professionName}", 'ProfesionesController@profesion')
    ->name("profession");
});

/* Universidades */
Route::prefix("universidades")->group(function () {
  Route::get('/', 'UniversidadesController@index')->name("uniIndex");
  Route::get("/c/{idCountry?}/{uniCountry?}", "UniversidadesController@index")->name("uniIndexCountry");
  Route::get('/{uniName}', 'UniversidadesController@universidad')
    ->name("university");
  Route::get('/p/{professionName}', 'UniversidadesController@unisOfProf')
    ->name("unisOfProf");
  Route::get('/{uniName}/{professionName}', 'UniversidadesController@profInU')
    ->name("profInU");
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

/* Administrador */

Route::prefix("admin")->group(function () {
  Route::match(["get", "post"],"/precios", "AdminController@precios");
  Route::get("/websites", function () {
    $links = [
      ["42",	"https://www.cesa.edu.co/"],
      // ["CUN",	"https://cun.edu.co/"],
      // ["Escuela de Artes y Letras",	"https://artesyletras.com.co/"],
      ["3",	"https://www.esmic.edu.co/"],
      ["4",	"https://www.escuelaing.edu.co/es/estudiantes/"],
      // ["Politécnico grancolombiano",	"https://www.poli.edu.co/"],
      ["13",	"https://www.udca.edu.co/"],
      ["28",	"https://www.uniagraria.edu.co/"],
      ["43",	"https://www.uniagustiniana.edu.co/"],
      // ["unicoc",	"https://www.unicoc.edu.co/"],
      ["21",	"https://www.unimonserrate.edu.co/"],
      // ["Uninpahu",	"https://www.uninpahu.edu.co/"],
      // ["Unitec",	"https://www.unitec.edu.co/"],
      ["10",	"https://www.uamerica.edu.co/"],
      ["1",	"https://www.uan.edu.co/"],
      ["2",	"https://www.areandina.edu.co/es"],
      ["11",	"http://www.fuac.edu.co/aspirantes"],
      ["29",	"https://www.ucatolica.edu.co/"],
      ["12",	"https://www.ucentral.edu.co/"],
      // ["Universidad Compensar",	"https://ucompensar.edu.co/"],
      ["30",	"https://www.ucc.edu.co/"],
      ["31",	"https://www.unisabana.edu.co/"],
      ["32",	"https://www.lasalle.edu.co/"],
      ["34",	"https://www.urosario.edu.co/"],
      ["14",	"https://www.udistrital.edu.co/inicio"],
      ["15",	"https://universidadean.edu.co/"],
      ["25",	"https://www.ecci.edu.co/"],
      ["35",	"https://www.unbosque.edu.co/"],
      ["24",	"https://www.uexternado.edu.co/"],
      ["16",	"https://www.unincca.edu.co/"],
      ["27",	"https://www.javeriana.edu.co/"],
      ["44",	"https://www.juanncorpas.edu.co/"],
      ["17",	"http://www.konradlorenz.edu.co/"],
      ["5",	"https://www.ugc.edu.co/"],
      ["18",	"http://www.unilibre.edu.co/"],
      ["33",	"https://uniandes.edu.co/"],
      ["19",	"https://www.ulibertadores.edu.co/"],
      ["20",	"https://umb.edu.co/"],
      ["36",	"https://www.umng.edu.co/"],
      ["26",	"https://www.uniminuto.edu/"],
      ["22",	"https://unal.edu.co/"],
      ["37",	"https://www.unipiloto.edu.co/"],
      ["6",	"https://www.usbbog.edu.co/"],
      ["7",	"http://www.sanmartin.edu.co/"],
      ["8",	"https://www.usta.edu.co/"],
      ["9",	"https://www.usergioarboleda.edu.co/"],
      ["23",	"https://www.utadeo.edu.co/es"]
    ];

    foreach ($links as $link) {
      $u = Universidad::find($link[0]);
      $u->web = $link[1];
      $u->save();
    }
  });
});
