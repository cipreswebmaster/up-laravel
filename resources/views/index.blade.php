@extends('base')

@section('title', "Orientación Vocacional")

@section('keywords', "Buscar carrera profesional, Orientacion Vocacional, Eleccion de carrera, Toma de desiciones, Vocacional es un proceso, intereses vocacionales, Carrera profesional")

@section('description', "UP Es una Plataforma Universitaria, diseñada para guiarte en la elección de tu carrera y te las asociamos con las carreras profesionales afines.")

@section("og_image_url", asset("images/index/og_image.jpeg"))
@section("og_image_alt", "Universidades y profesiones")

@section('styles')
  <link rel="stylesheet" href="{{ asset("css/index.css") }}">
  <link rel="stylesheet" href="{{ asset("css/what-is-up.css") }}">
  <link rel="stylesheet" href="{{ asset("css/index-video-instruction.css") }}">
@endsection

@section('body')
<x-carousel />
<div>
  <x-what-is-up />
  <x-index-videos-instruction />
  <x-horizontal-ad />
  <x-actualidad-universitaria />
  <x-demas-noticias />
  <x-horizontal-ad />
</div>
@endsection

@section('scripts')
  <script>
    const carousel = document.getElementById("carouselExampleIndicators");
    new bootstrap.Carousel(carousel, {
      interval: 3000
    });
  </script>
@endsection
