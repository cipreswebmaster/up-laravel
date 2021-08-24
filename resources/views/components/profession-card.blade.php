@php
  $isTitleLarge = strlen($title) > 25 && count(str_split($title)) > 3;
  $titleSlugged = Str::slug($title);

  $redirects = [
    "university" => Request::url() . "/$titleSlugged",
    "profIndex" => route("profession", ["professionName" => $titleSlugged])
  ]
@endphp

<div class="card area-{{ $id_area }}">
  <a @if (Route::currentRouteName() != "uniCountry") href="{{ $redirects[Route::currentRouteName()] }}" @endif>
    <div class="card-img">
      <img src="{{ env("API_URL") . '/' . $imgSrc }}" alt={{ $title }} />
    </div>
    <div class="card-title">
      <div
        style="
          display: flex;
          height: {{ $isTitleLarge ? '50px' : '25px' }};
          width: 100%
        "
      >
        <div class="arrow">
          <img src="{{ asset($arrow) }}" alt="arrow" />
        </div>
        <div
          class="title"
          style="font-size: {{ $isTitleLarge ? '0.9rem' : '' }}"
        >
          {{ Str::upper($title) }}
        </div>
      </div>
    </div>
  </a>
</div>
