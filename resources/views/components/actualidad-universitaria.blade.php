<link rel="stylesheet" href="{{ asset("css/actualidad-universitaria.css") }}">

<div class="actualidad-universitaria only-pc">
  <div class="au-title">ACTUALIDAD UNIVERSITARIA</div>
    <div class="au-noticias">
      <div class="noticia-principal">
        <a href="{{ route("post", ["postName" => Str::slug($posts[0]["title"])]) }}">
          <div class="np-title">
            <div class="title">
              {{ mb_strtoupper($posts[0]["title"]) }}
            </div>
          </div>
          <div class="np-img">
            <img src="{{ env("API_URL") . "/images/posts/" . $posts[0]["image"] }}" alt="">
          </div>
        </a>
      </div>
      <div class="noticias-secundarias">
        @for ($i = 1; $i < 3; $i++)
          <div class="noticia">
            <div class="n-information">
              <a href="{{ route("post", ["postName" => Str::slug($posts[$i]["title"])]) }}">
                <div class="n-title">{{ $posts[$i]["title"] }}</div>
              </a>
              <div class="n-entradilla">{{ $posts[$i]["entradilla"] }}</div>
              <div class="n-fecha">{{ explode(" ", $posts[$i]["created_at"])[0] }}</div>
            </div>
            <div class="n-img">
              <img src="{{ env("API_URL") . "/images/posts/" . $posts[$i]["image"] }}" alt="">
            </div>
          </div>
        @endfor
        @if (
          !isset($_SESSION["logged"]) ||
          (isset($_SESSION["logged"]) && $_SESSION["state"] == 1)
        )
          <a href="/membresias" class="ver-mas">Ver más</a>
        @else
          <a href="/actualidad" class="ver-mas">Ver más</a>
        @endif
      </div>
    </div>
</div>
