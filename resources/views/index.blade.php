@extends('base')

@section('title') Orientación Vocacional @endsection

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
