<link rel="stylesheet" href="{{ asset("css/banner.css") }}">

@php
    $arrows = [
      "uni" => [
        "arrow" => asset("images/banners/arrows/uni-arrow.svg"),
        "color" => "#b700d8", 
      ],
      "prof" => [
        "arrow" => asset("images/banners/arrows/prof-arrow.svg"),
        "color" => "#00adf2", 
      ],
      "uniProf" => [
        "arrow" => asset("images/banners/arrows/uni.prof-arrow.svg"),
        "color" => "#ff680d", 
      ],
    ];
@endphp

<div class="banner">
  <div class="img">
    @if ($isProfession)
      <img src="{{ env("API_URL") . "/images/carreras/$img" }}" alt="" @if ($fromTop) class="from_top" @endif />      
    @elseif ($isUniBanner)
      <img src="{{env("API_URL") . "/images/unis/banners/$img" }}" alt="" @if ($fromTop) class="from_top" @endif />
    @else
      <img src="{{ asset("images/banners/main-img/$img") }}" alt="" @if ($fromTop) class="from_top" @endif />
    @endif
  </div>
  <div class="content">
    <div class="arrows">
      <img src="{{ $arrows[$arrow]["arrow"] }}" alt="Arrows" />
    </div>
    <div class="info">
      <div class="topText" >
        {{ mb_strtoupper($topText) }}
      </div>
      <div
        class="line"
        style="background-color: {{ $arrows[$arrow]["color"] }}"
      ></div>
      @if ($bottomText)
        <div class="bottomText" >
          {{ mb_strtoupper($bottomText) }}
        </div>
      @endif
    </div>
  </div>
</div>