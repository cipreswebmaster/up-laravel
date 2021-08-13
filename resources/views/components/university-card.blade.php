<link rel="stylesheet" href="{{ asset("css/university-card.css") }}">
<div class="card">
  <a href="{{ Route::currentRouteName() == "unisOfProf" ? 
    route("profInU", ["uniName" => Str::slug($title), "professionName" => Str::slug($_SESSION["profesion"])]) : 
    route("university", ["uniName" => Str::slug($title)]) }}">
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