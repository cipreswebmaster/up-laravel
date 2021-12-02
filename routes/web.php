<?php

use App\Http\Controllers\ContactoController;
use App\Models\Acreditacion;
use App\Models\Ciudad;
use App\Models\Pais;
use App\Models\Universidad;
use App\Models\User;
use Illuminate\Support\Facades\Http;
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
Route::post("/change_pass", "UsuariosController@change_password")->name("change_pass");

/* Actualidad */
Route::prefix("/actualidad")->group(function () {
  Route::get("/", "PostsController@actualidad")->name("actualidad");
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
  Route::get("/c/{idCountry?}/{uniCountry?}/{uni?}", "UniversidadesController@universidadExtranjero")->name("uniCountry");
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

/* API */
Route::prefix("api")->group(function () {
  Route::post("/add_post", "PostsController@add_post");
  Route::post("/get_posts", "PostsController@get_posts");
  Route::post("/delete_post", "PostsController@delete_post");

  Route::post("/profesiones", "ProfesionesController@profesiones");

  Route::post("/universidades", "UniversidadesController@universidades");
  Route::post("/create_universidad", "UniversidadesController@create_universidad");
  Route::post("/add_basic_u", "UniversidadesController@add_basic_u");
  Route::post("/add_profs_to_national", "UniversidadesController@add_profs_to_national");
  Route::post("/convert_basics_profile", "UniversidadesController@convert_basics_profile");
  Route::post("/subir_pensums", "UniversidadesController@subir_pensums");

  Route::post('/acreditaciones', function () {
    return response()->json(Acreditacion::all());
  });
  Route::post("/paises", function () {
    return response()->json(Pais::all());
  });

  Route::post("/prof_masivo", "AdminController@profMasivo");
  Route::post("/add_school", "UsuariosController@addColegio");

  Route::post("/get_ciudades_nacionales", function () {
    return response()->json(Ciudad::where("id_pais", 1)->get());
  });
});

/* Administrador */
Route::prefix("admin")->group(function () {
  Route::get("/test_done", function () {
    $usuarios = User::where("id_colegio", 1)->get();
    $test_hechos = 0;
    foreach ($usuarios as $u) {
      $done = Http::withHeaders([
          "token" => "4bcgp-bgyt",
        ])->post("https://apps4beyond.com/REST/api/consultarResultados", [
          "token_id" => $u["4beyond_token_id"]
        ])["result"]["resultObject"];
      
        if (gettype($done) != "string")
          $test_hechos++;
    }
    echo "Totales: " . count($usuarios) . "<br />";
    echo "Tests finalizados: " . $test_hechos;
  });
});
