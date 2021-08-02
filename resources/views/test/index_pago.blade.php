@extends('base')

@section('title')
  Test
@endsection

@section('styles')
  <link rel="stylesheet" href="{{ asset("css/index_pago.css") }}">
@endsection

@section('body')
  <div class="count">Intentos restantes: {{ $attempts }}</div>
    <div class="buttons">
    @if ($attempts)
      <a href="/test/renew_test" class="do_again">
        Hacer el test nuevamente
      </a>
    @endif
    <a href="/test/results" class="go_results">
      Ir a mis resultados
    </a>
  </div>
@endsection
