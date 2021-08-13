@extends('base')

@section('title')
  {{ $university["nombre_universidad"] }}
@endsection

@section('styles')
    <link rel="stylesheet" href="{{ asset("css/universidad.css") }}">
    <link rel="stylesheet" href="{{ asset("css/profession-card.css") }}">
@endsection

@php
  $uniImg = str_replace(".","-banner.",$university["img_name"]);
@endphp
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
          <img src="{{ env("API_URL") . "/images/unis/logo/" . $university["img_name"] }}" alt="" />
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
    <div class="accreditations">
      <div class="title">Acreditaciones</div>
      {{-- <div class="logos">
        {university.acreditaciones.map((acc, idx) => (
          <img
            src={`${API_URL}/images/accreditations/${acc.logo}`}
            alt={acc.nombre_acreditacion}
            title={acc.nombre_acreditacion}
            key={idx}
          />
        ))}
      </div> --}}
    </div>
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
