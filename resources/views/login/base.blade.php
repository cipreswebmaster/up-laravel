@extends('base')

@section('styles')
  <link rel="stylesheet" href="{{ asset("css/login.css") }}">
@endsection

@section('body')
  @if (isset($_GET["message"]))
    <h1 align="center" style="font-family: Poppins-SemiBold; margin: 15px">Inicia sesión o registrate gratis para poder acceder a la información de las carreras</h1>
  @endif
  <div class="container">
    <div class="image">
      <img src="{{ asset("images/login/graduated-smiling.jpg") }}" alt="" />
    </div>
    <div class="form">
      @yield('form')
    </div>
  </div>
  
@endsection
