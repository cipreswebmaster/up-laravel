<?php

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
Route::view('/test', 'test');
Route::get('/becas', 'BecasController@index');

/* Profesiones */
Route::prefix("profesiones")->group(function () {
  Route::get('/', 'ProfesionesController@index');
  Route::get("/{professionName}", 'ProfesionesController@profesion')
    ->name("profession");
});

/* Universidades */
Route::prefix("universidades")->group(function () {
  Route::get('/', 'UniversidadesController@index');
  Route::get('/{uniName}', 'UniversidadesController@universidad')
    ->name("university");
  Route::get('/p/{professionName}', 'UniversidadesController@unisOfProf')
    ->name("unisOfProf");
  Route::get('/{uniName}/{professionName}', 'UniversidadesController@profInU')
    ->name("profInU");
});

/* Login */
Route::prefix("login")->group(function () {
  Route::get("/", "UsuariosController@login");
});
