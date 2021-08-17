@extends('base')

@section('title')
  Profesiones
@endsection

@section('styles')
  <link rel="stylesheet" href="{{ asset("css/profesiones.index.css") }}">
  <link rel="stylesheet" href="{{ asset("css/profession-card.css") }}">
@endsection

@section('body')
  <x-banner
    topText="Profesiones"
    arrow="prof"
    img="profesiones.jpg" />

  {{-- Seleccionar carreras por área --}}
  <div style="padding: 6.5%">
    <div class="select-area">
      <div class="no-real-area only-mobile">
        SELECCIONA CARRERAS POR ÁREA
      </div>
      <div class="areas-container">
        <div class="no-real-area only-pc">SELECCIONA CARRERAS POR ÁREA</div>
        @foreach ($areas as $area)
          @php $lowLetter = count(str_split($area["nombre_area"])) @endphp
          <div
            class="area"
            id="area-{{ $area["id_area"] }}">
            <div class="img">
              <img 
                src="{{ asset("images/select-area/back-img/" . $area["img"]) . ".png" }}"
                alt="{{ $area["nombre_area"] }}" />
            </div>
            <div class="text @if ($lowLetter) low @endif" style="border: 4px solid {{ $area["color"] }}">
              {{ mb_strtoupper($area["nombre_area"]) }}
            </div>
            <div class="arrow">
              <img 
                src="{{ asset("images/select-area/arrows/" . $area["img"]) . ".svg" }}" 
                alt="{{ $area["nombre_area"] }}" />
            </div>
          </div>
        @endforeach
        <div class="area only-pc" id="all">
          <div class="text" style="background-color: #252146">
            Mostrar todas las profesiones
          </div>
        </div>
      </div>
      <div class="only-mobile responsive_show_all" style="cursor: pointer" >
        Mostras todas las profesiones
      </div>
    </div>
    <div class="search">
      <x-showcase 
        title="Profesiones"
        :samples="$profesiones"
        cardComponent="professions"
        imageFieldName="imagen_carrera"
        cardTitle="nombre_carrera"
      />
    </div>
  </div>
@endsection

@section('scripts')
  <script src="{{ asset("js/profesiones.js") }}"></script>
@endsection
