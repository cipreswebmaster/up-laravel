<link rel="stylesheet" href="{{ mix("css/university-card.css") }}">
@php
  $profession = isset($_SESSION["profesion"]) ? $_SESSION["profesion"] : "none";
  $redirects = [
    "unisOfProf" => route("profInU", ["uniName" => Str::slug($title), "professionName" => Str::slug($profession)]),
    "uniIndex" => route("university", ["uniName" => Str::slug($title)]),
    "uniIndexCountry" => "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]/" . Str::slug($title),
  ]
@endphp
<div class="card" data-ciudad="{{ $idCiudad }}">
  <a href="{{ $redirects[Route::currentRouteName()] }}">
    <div class="uni_img">
      <img src="{{ asset("/images/universidades/logo/" . $imgSrc) }}?{{ uniqid() }}" alt="" />
    </div>
    <div class="layer">
      <div class="header_img">
        @php $bannerName = str_replace(".","-banner.", $imgSrc); @endphp
        <img src="{{ asset("/images/universidades/campus/300xauto/" . $bannerName) }}" alt="" />
      </div>
      <div class="info">
        <div class="title">{{ $title }}</div>
        @if ($ciudad)
          <div class="ciudad">
            {{ $ciudad }}
          </div>
        @endif
        @if ($rankingMundo && $rankingPais)
            <div class="rankings">
              <div class="mundial">Ranking mundial: {{ $rankingMundo }}</div>
              <div class="pais">Ranking nacional: {{ $rankingPais }}</div>
            </div>
        @endif
      </div>
    </div>
  </a>
</div>