@php
  $isTitleLarge = strlen($title) > 25 && count(str_split($title)) > 3;
  $titleSlugged = clean_string(Str::slug($title));
@endphp

<div class="card">
  <a href="@if (Route::currentRouteName() == "university")
    {{ Request::url() . "/$titleSlugged" }}
  @else
    {{ route("profession", ["professionName" => $titleSlugged]) }}
  @endif">
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
