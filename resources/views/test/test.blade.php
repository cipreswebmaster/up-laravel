@extends('base')

@section('title')
  Test
@endsection

@section('styles')
  <style>
    .frame {
      width: 100%;
      height: 1000px;
    }
  </style>
@endsection

@section('body')
  <iframe
    src="https://apps4beyond.com/TeOrienta3.0/#/login-partner?logintoken={{ $token }}"
    title="Test de 4Beyond"
    class="frame"
    ></iframe>
@endsection

@section('scripts')
  <script>
    setTimeout(function () {
      Swal.fire({
        icon: "info",
        text: "Al terminar el test, recarga la página para poder ver tus resultados",
        confirmButtonText: "¡Entendido!"
      });
    }, 5000)
  </script>
@endsection
