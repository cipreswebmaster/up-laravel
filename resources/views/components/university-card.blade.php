<link rel="stylesheet" href="{{ asset("css/university-card.css") }}">
@php
  $profession = isset($_SESSION["profesion"]) ? $_SESSION["profesion"] : "none";
  $redirects = [
    "unisOfProf" => route("profInU", ["uniName" => Str::slug($title), "professionName" => Str::slug($profession)]),
    "uniIndex" => route("university", ["uniName" => Str::slug($title)]),
    "uniIndexCountry" => "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]/" . Str::slug($title),
  ]
@endphp
<div class="card">
  <a href="{{ $redirects[Route::currentRouteName()] }}">
    <div class="uni_img">
      <img src="{{ env("API_URL") . "/images/unis/logo/" . $imgSrc }}" alt="" />
    </div>
    <div class="layer">
      <div class="header_img">
        @php $bannerName = str_replace(".","-banner.", $imgSrc); @endphp
        <img src="{{ env("API_URL") . "/images/unis/banners/" . $bannerName }}" alt="" />
      </div>
      <div class="info">
        <div class="title">{{ $title }}</div>
      </div>
    </div>
  </a>
</div>