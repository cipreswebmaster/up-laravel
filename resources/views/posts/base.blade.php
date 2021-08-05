@extends('base')

@section('title')
  @yield('title') Actualidad universitaria
@endsection

@section('styles')
  @yield('styles')
@endsection

@section('body')
  <x-banner
    arrow="uni"
    img="actualidad.jpg"
    topText="Actualidad"
    :fromTop="true" />
  @yield('content')
@endsection
