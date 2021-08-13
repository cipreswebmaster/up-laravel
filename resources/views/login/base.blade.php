@extends('base')

@section('styles')
  <link rel="stylesheet" href="{{ asset("css/login.css") }}">
@endsection

@section('body')
  {{-- <h1 align="center" style="font-size: 37px; margin-bottom: 15px">
    Inicia sesión o regístrate para acceder <span style="font-family: Poppins-SemiBold; color: #fc5a48; font-size: 50px">completamente gratis</span> a toda la información de carreras y universidades que UP tiene para ti
  </h1> --}}
  <h1 align="center" style="font-size: 30px; margin-bottom: 15px">
    Inicia sesión para acceder a toda la información de carreras, universidades, becas, actualidad universitaria y el test premium que UP tiene para ti
  </h1>
  <div class="container">
    <div class="image">
      <img src="{{ asset("images/login/img.jpg") }}" alt="" />
    </div>
    <div class="form">
      @yield('form')
    </div>
  </div>
  
@endsection
