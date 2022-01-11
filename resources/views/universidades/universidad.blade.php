@extends('base')

@section('title', $university["nombre_universidad"])

@php
  $profesiones_string = "";
  foreach ($professions as $profesion)
    $profesiones_string .= ", " . $profesion["nombre_carrera"];
@endphp
@section('keywords', $university["nombre_universidad"] . $profesiones_string)

@section('description', substr($university["descripcion_uni"], 0, 175) . "...")

@php
  $uniImg = str_replace(".","-banner.",$university["img_name"]);
@endphp
@section("og_image_url", asset("/images/universidades/campus/" . $uniImg))
@section("og_image_alt", $university["nombre_universidad"])

@section('styles')
    <link rel="stylesheet" href="{{ asset("css/universidad.css") }}">
    <link rel="stylesheet" href="{{ asset("css/profession-card.css") }}">
@endsection

@section('body')
  <x-banner
    :topText="$university['nombre_universidad']"
    :isUniBanner="true"
    :img="$uniImg"
    arrow="uni"
  />
  <div class="uni-content">
    <div class="uni_info">
      <div class="info">
        <div class="pic">
          <img src="{{ asset("/images/universidades/logo/" . $university["img_name"]) }}" alt="" />
        </div>
        <div class="name">{{ $university["nombre_universidad"] }}</div>
        <div class="description">{{ $university["descripcion_uni"] }}</div>
      </div>
      <div class="video">
        <x-youtube
          :videoId="$university['video_pres']"
          class="video_frame"
          containerClass="video_container"
        />
      </div>
    </div>
    @if (count($university["acreditaciones"]))
      <div class="accreditations">
        <div class="title">Acreditaciones</div>
        <div class="logos">
          @foreach ($university["acreditaciones"] as $acreditacion)
            <img
              src="{{ asset("images/acreditaciones/" . $acreditacion["logo"]) }}"
              alt="{{ $acreditacion["nombre_acreditacion"] }}"
              title="{{ $acreditacion["nombre_acreditacion"] }}"
            />
          @endforeach
        </div>
      </div>
    @endif
    <x-showcase 
      title="Profesiones"
      :samples="$professions"
      cardComponent="professions"
      imageFieldName="imagen_carrera"
      cardTitle="nombre_carrera"
    />
@endsection

@section('scripts')
  <script src="{{ asset("js/profesiones.js") }}"></script>
@endsection
