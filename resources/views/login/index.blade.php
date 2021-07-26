@extends('login.base')

@section('form')
  <div class="credentials_form">
    <form action="{{ route("validar") }}" method="POST" class="credentials">
      @csrf
      <input type="text" placeholder="Email" id="email" name="email" />
      <input type="password" placeholder="Contraseña" id="password" name="password" />
      <button> INGRESAR </button>
    </form>
    <div class="forgot_password">
      <a href="">OLVIDÉ MI CONTRASEÑA</a>
    </div>
  </div>
@endsection
