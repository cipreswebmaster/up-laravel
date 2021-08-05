@extends('base')

@section('styles')
  <style>
    h1 {
      font-size: 150px;
      font-family: Poppins-ExtraBold;
      margin-top: 50px;
    }

    p {
      font-size: 25px;
      padding: 25px 100px;
      margin-bottom: 25px;
    }

    p a {
      color: blue;
      text-decoration: underline !important;
    }
  </style>
@endsection

@section('body')
  <h1 align="center">Error 404</h1>
  <p align="center">
    Ups, parece que la página que intentas buscar no existe, pero no te preocupes, trabajamos arduamente para que esta página exista en el futuro. Si crees que esto es un error, te invitamos a que nos lo detalles en el apartado de <a href="/contacto">contacto</a>
  </p>
@endsection
