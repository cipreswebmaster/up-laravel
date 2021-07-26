@extends('base')

@section('title')
  Universidades
@endsection

@section('styles')
    <link rel="stylesheet" href="{{ asset("css/universidades.css") }}">
@endsection

@section('body')
  <x-banner
    img="universidades.jpg"
    topText="Universidades"
    arrow="uni"
  />
  {{-- <div class="show_all">
    Mostrar todas las universidades
  </div> --}}
  @if (!count($universidades))
    <h1 style="
      font-family: Poppins-ExtraBold;
      text-align: center;
      margin: 100px
    ">No hay universidades que presenten esta carrera</h1>
  @else
    <div class="uni-content">
      <x-showcase 
        title="Universidades"
        :samples="$universidades"
        cardComponent="universities"
        imageFieldName="img_name"
        cardTitle="nombre_universidad"
      />
    </div>
  @endif
@endsection
