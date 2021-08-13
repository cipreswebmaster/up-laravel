@extends('login.base')

@section('title')
  Inicia sesión
@endsection

@section('form')
  @isset($_GET["pass_err"])
    <div class="error" style="text-align: center; color: red;">
      Tu contraseña es incorrecta
    </div>
  @endisset
  @isset($_GET["no_user"])
    <div class="error" style="text-align: center; color: red;">
      Este usuario no existe
    </div>
  @endisset
  <div class="credentials_form">
    <form action="{{ route("validar") }}" method="POST" class="credentials">
      @csrf
      <input type="text" placeholder="Email" id="email" name="email" />
      <input type="password" placeholder="Contraseña" id="password" name="password" />
      <button> INGRESAR </button>
    </form>
    {{-- <div class="forgot_password">
      <a href="">OLVIDÉ MI CONTRASEÑA</a>
    </div> --}}
    {{-- <div class="registrate" style="text-align: center; margin-top: 15px">
      ¿No tienes cuenta? <a href="/registrate" style="text-decoration: underline !important">Regístrate gratis</a>
    </div> --}}
  </div>
@endsection
