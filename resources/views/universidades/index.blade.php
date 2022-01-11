@extends('base')

@section('title', "Universidades")

@section('keywords',  "Universidades, Universidades y profesiones UP")

@section('description', "Elige que carrera estudiar y en cual universidad con Up podras encontrar la universidad y la carrera ideal para ti.")

@section("og_image_url", asset("images/banners/main-img/universidades.jpg"))
@section("og_image_alt", "Universidades y Profesiones UP")

@section('styles')
    <link rel="stylesheet" href="{{ mix("/css/universidades.css") }}">
@endsection

@section('body')

  @if (Route::currentRouteName() == "unisOfProf")
    <x-banner
      img="universidades.jpg"
      topText="Universidades"
      :bottomText="$profesion"
      arrow="uni"
    />
  @else
    <x-banner
      img="universidades.jpg"
      topText="Universidades"
      arrow="uni"
    />
  @endif
  {{-- <div class="show_all">
    Mostrar todas las universidades
  </div> --}}
  <div class="uni-content">
    @if (!count($universidades))
      <h1 style="
        font-family: Poppins-ExtraBold;
        text-align: center;
        margin: 100px
      ">No hay universidades que presenten esta carrera</h1>
    @else
      <x-showcase 
        title="Universidades"
        :samples="$universidades"
        cardComponent="universities"
        imageFieldName="img_name"
        cardTitle="nombre_universidad"
      />
    @endif
    @if (@count($perfiles_basicos))
      <div class="perfiles_basicos">
        <div class="title">Explora más universidades en el país</div>
        <div class="perfiles">
          @foreach ($perfiles_basicos as $perfil)
            <div onclick="goToWeb('{{ $perfil['web'] }}')">
              <x-university-card 
                :title="$perfil['nombre_universidad']"
                :imgSrc="$perfil['img_name']"
                :ciudad="$perfil['ciudad']"
                :rankingMundo="$perfil['ranking_mundo']"
                :rankingPais="$perfil['ranking_pais']"
              />
            </div>
          @endforeach
        </div>
      </div>
    @endif
  </div>
@endsection

@section('scripts')
  <script src="{{ mix("js/universidades.js") }}"></script>
  <script>
    function goToWeb(web) {
      window.open(web, '_blank');
    }
  </script>
@endsection
