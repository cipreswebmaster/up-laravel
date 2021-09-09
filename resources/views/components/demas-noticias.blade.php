<link rel="stylesheet" href="{{ mix("css/demas-noticias.css") }}">

<div class="demas-noticias only-pc">
  <div class="noticias-interes">
    <div class="ni-h">
      Noticias de interés
    </div>
    <div class="noticias">
      @if (count($noticiasInteres["principal"]) > 0)
        <a href="{{ route("post", ["postName" => Str::slug($noticiasInteres["principal"]["title"])]) }}">
          <div class="mas-reciente">
            <div class="image">
              <img 
                src="{{ asset("images/posts/post/" . $noticiasInteres["principal"]["image"]) }}"
                alt="{{ $noticiasInteres["principal"]["title"] }}"
                title="{{ $noticiasInteres["principal"]["title"] }}" />
            </div>
            <div class="title">
              {{ $noticiasInteres["principal"]["title"] }}
            </div>
          </div>
        </a>
      @endif
      <div class="demas">
        @foreach ($noticiasInteres["secundarias"] as $noticia)
          <div class="ns">
            <div class="title">
              <a href="{{ route("post", ["postName" => Str::slug($noticia["title"])]) }}">
                {{ $noticia["title"] }}
              </a>
            </div>
            <div class="entradilla">
              @if (strlen($noticia["entradilla"]) > 100)
                {{ trim(Str::substr($noticia["entradilla"], 0, 100)) }}...
              @else
                {{ $noticia["entradilla"] }}
              @endif
            </div>
          </div>
        @endforeach
      </div>
    </div>
  </div>
  <div class="noticias-areas">
    <div class="na-h">
      Noticias por áreas
    </div>
    <div class="coming-soon">
      PRÓXIMAMENTE
    </div>
  </div>
</div>