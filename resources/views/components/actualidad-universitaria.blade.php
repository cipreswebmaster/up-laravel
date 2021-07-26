<link rel="stylesheet" href="{{ asset("css/actualidad-universitaria.css") }}">

<div class="actualidad-universitaria">
  <div class="au-title">ACTUALIDAD UNIVERSITARIA</div>
    <div class="au-noticias">
      <div class="noticia-principal">
        <a href="/posts">
          <div class="np-title"> {{ strtoupper($posts[0]["title"]) }} </div>
          <div class="np-img">
            <img src="{{ env("API_URL") . "/images/posts/" . $posts[0]["image"] }}" alt="">
          </div>
        </a>
      </div>
      <div class="noticias-secundarias">
        @for ($i = 1; $i < 3; $i++)
          <div class="noticia">
            <div class="n-information">
              <a href="/">
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
        <a href="" class="ver-mas">Ver más</a>
      </div>
    </div>
</div>