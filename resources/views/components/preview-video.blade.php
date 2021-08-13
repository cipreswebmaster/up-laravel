<link rel="stylesheet" href="{{ asset("css/preview-video.css") }}">

<div class="preview_video">
  <div class="video">
    <x-youtube
      :videoId="$videoId"
      class="frame"
      containerClass="frame_container" />
  </div>
  <div class="description">
    <div class="text">{{ $text }}</div>
    <div class="example only-pc">
      <a href="{{ url("$example/example") }}">
        <img src="{{ asset("images/examples/$example.png") }}" alt="ejemplo" />
      </a>
    </div>
    {{-- <x-join-now-btn /> --}}
  </div>
</div>
