@extends("base")

@section('title')
  {{ $profesion["nombre_carrera"] }} | {{ $universidad["nombre_universidad"] }}
@endsection

@section('styles')
  <link rel="stylesheet" href="{{ mix("/css/universidad.profesion.css") }}">
@endsection

@php
  function getPrice($price) {
    $_price = "$";
    $priceWithoutDots = str_replace(".", "", $price);
    if (!is_numeric($priceWithoutDots))
      return $price;
    for ($i = 0; $i < strlen($priceWithoutDots); $i++) {
      $_price .= $priceWithoutDots[$i];
      $dotContinue = (strlen($priceWithoutDots) - ($i + 1)) % 3 == 0;
      if ($dotContinue && $i + 1 < strlen($priceWithoutDots))
        $_price .= ".";
    }
    return $_price;
  }
@endphp

@section('body')
  <x-banner
    :topText="$profesion['nombre_carrera']"
    :bottomText="$universidad['nombre_universidad']"
    isProfession
    :img="$profesion['imagen_carrera']"
    arrow="uniProf"
  />
  <div class="u">
    <div class="career-info column-container">
      <div class="column" style="position: relative">
        <div class="presentation-card">
          <div class="uni-img">
            @php
              $bannerImg = str_replace(".", "-banner.", $universidad["img_name"]);
            @endphp
            <img src="{{ env("API_URL") . "/images/unis/banners/$bannerImg" }}" alt="" />
          </div>
          <div class="uni-cover-img">
            <img src="{{ env("API_URL") . "/images/unis/logo/" . $universidad['img_name'] }}" alt="" />
          </div>
          <div class="uni-info">
            <div class="uni-name">{{ $universidad["nombre_universidad"] }}</div>
            <div class="uni-city">Bogotá</div>
            <div class="uni-desc">{{ $universidad["descripcion_uni"] }}</div>
          </div>
          <div class="ver-carreras">
            <a href="{{ route("university", [
              "uniName" => Str::slug($universidad["nombre_universidad"])
              ]) }}">Ver todas las carreras > ></a>
          </div>
        </div>
        <div class="sticky">
          <div class="general-info">
            <div class="item">
              <div>
                <img src="{{ asset("images/university.profession/icons/precio_semestre.jpg") }}" alt="">
              </div>
              <div style="margin-left: 15px;">Precio semestre</div>
            </div>
            <div class="item">
              {{ getPrice($prof_uni["precio_semestre"]) }}
            </div>
          </div>
          <div class="info-contacto">
            <div class="title">
              <div>
                <img src="{{ asset("images/university.profession/icons/admisiones.jpg") }}" alt="">
              </div>
              <div>Información de contacto</div>
            </div>
            <div class="content">
              <ul style="font-size: 15px; list-style: none">
                @foreach ($universidad["contacto_admision"] as $c)
                  <li>
                    {{ $c }}
                  </li>
                @endforeach
              </ul>
            </div>
          </div>
          <div class="contacto btn">
            <span class="btn_link">
              Quiero ser contactado
            </span>
          </div>
          <div class="section" style="padding: 0px; margin-top: 35px">
            <div class="section-title">
              <div class="icon">
                <img src="{{ asset("images/university.profession/icons/ubicacion.jpg") }}" alt="">
              </div>
              <div class="s-title">
                Ubicación
              </div>
            </div>
            <div class="section-content" style="overflow: hidden; padding: 0px">
              {!! $universidad["mapa"] !!}
            </div>
          </div>
        </div>
      </div>
      <div class="column">
        <div class="carreer-pre">
          <div class="videos only-pc">
            <x-youtube
              :videoId="$universidad['video_pres']"
              containerClass="video"
              class="frame"
            />
            @if ($prof_uni["video"])
              <x-youtube
                :videoId="$prof_uni['video']"
                containerClass="video"
                class="frame"
              />
            @endif
          </div>
          
          {{-- Proposito de la carrera --}}
          <div class="section">
            <div class="section-title">
              <div class="icon">
                <img src="{{ asset("images/university.profession/icons/proposito_carrera.jpg") }}" alt="">
              </div>
              <div class="s-title">
                {{ $profesion["nombre_carrera"] }}
              </div>
            </div>
            <div class="section-content">
              {{ $prof_uni["proposito_carrera"] }}
            </div>
          </div>

          {{-- Perfil de aspirante --}}
          <div class="section">
            <div class="section-title">
              <div class="icon">
                <img src="{{ asset("images/university.profession/icons/perfil_aspirante.jpg") }}" alt="">
              </div>
              <div class="s-title">
                Perfil del aspirante
              </div>
            </div>
            <div class="section-content">
              {{ $prof_uni["perfil_aspirante"][0] }}
              <ul>
                @foreach ($prof_uni["perfil_aspirante"][1] as $pa)
                  <li>{{ $pa }}</li>
                @endforeach
              </ul>
            </div>
          </div>

          {{-- Proceso de admision --}}
          <div class="section">
            <div class="section-title">
              <div class="icon">
                <img src="{{ asset("images/university.profession/icons/proceso_admision.jpg") }}" alt="">
              </div>
              <div class="s-title">
                Proceso de admisión
              </div>
            </div>
            <div class="section-content">
              <ul>
                @foreach ($universidad["proceso_admision"] as $item)
                    <li>{{ $item }}</li>
                @endforeach
              </ul>
            </div>
          </div>

          {{-- Apoyo financiero --}}
          <div class="section">
            <div class="section-title">
              <div class="icon">
                <img src="{{ asset("images/university.profession/icons/apoyo_financiero.jpg") }}" alt="">
              </div>
              <div class="s-title">
                Apoyo financiero
              </div>
            </div>
            <div class="section-content">
              <ul>
                @foreach ($universidad["apoyo_financiero"] as $item)
                    <li>{{ $item }}</li>
                @endforeach
              </ul>
            </div>
          </div>

          {{-- Internacionalización --}}
          @if ($universidad["intercambios"] !== false)
            <div class="section">
              <div class="section-title">
                <div class="icon">
                  <img src="{{ asset("images/university.profession/icons/internacional.jpg") }}" alt="">
                </div>
                <div class="s-title">
                  Internacionalización
                </div>
              </div>
              <div class="section-content">
                <p>
                  {{ $universidad["intercambios"][0] }}:
                </p>
                <ul>
                  @foreach ($universidad["intercambios"][1] as $item)
                    <li>{{ $item }}</li>
                  @endforeach
                </ul>
                <div class="btn">
                  <a
                    href="{{ $universidad["link_internacionalizacion"] }}"
                    target="_blank"
                    rel="noopener noreferrer" >
                    <span>Internacionalización</span>
                    <img src="{{ asset("images/university.profession/arrow-button-more.svg") }}" alt="Arrow" />
                  </a>
                </div>
              </div>
            </div>
          @endif
        </div>
      </div>
    </div>
    <div class="pensum">
      <div class="h">
        <h4 style="display: flex">
          <div style="margin-right: 15px">
            <img src="{{ asset("images/university.profession/icons/pensum.jpg") }}" alt="" />
          </div>
          <div>Pensum</div>
        </h4>
      </div>
      <div class="pen">
        <img 
          src="{{ env("API_URL") . "/pensums/" . $universidad["id_universidad"] . "." . $profesion["id_carrera"] . ".jpg" }}" 
          alt="Pensum"
          style="width: 100%"
        />
      </div>
    </div>
    <div class="buttons">
      <div class="contacto btn">
        <span class="btn_link">Quiero ser contactado</span>
      </div>
      <div class="btn">
        <a
          href="/profesiones"
          class="btn_link" >
          Regresar al listado de profesiones
        </a>
      </div>
      <div class="btn">
        <a
          href="/universidades"
          class="btn_link" >
          Regresar al listado de universidades
        </a>
      </div>
      @if ($universidad["web"])
        <div class="btn">
          <a
            href="{{ $universidad["web"] }}"
            target="_blank"
            rel="noopener noreferrer"
            class="btn_link">
            Ir al sitio web de la universidad
          </a>
        </div>
      @endif
      @if (isset($_SESSION["logged"]) && $_SESSION["state"] == 0)
        <div class="btn">
          <a to="/results/profile" class="btn_link">
            Regresar a favoritos
          </a>
        </div>
      @endif
    </div>
  </div>
@endsection

@section('scripts')
  <script>
    const contactoBtn = document.querySelectorAll(".contacto.btn");
    contactoBtn.forEach(function (btn) {
      btn.addEventListener("click", function () {
      Swal.fire({
        title: "Quiero ser contactado",
        html:
          '<form action="/registrar-contacto" method="POST" class="quiero-ser-contactado" id="quiero-ser-contactado-form">' +
          '@csrf' +
          '<input required type="text" class="contacto-input" placeholder="Escribe tu nombre completo" name="nombre" />' +
          '<input required type="text" class="contacto-input" placeholder="Escribe tu teléfono" name="tel" />' +
          '<input required type="email" class="contacto-input" placeholder="Escribe tu email" name="email" />' + 
          '<input type="hidden" name="universidad" value="{{ $universidad['nombre_universidad'] }}" />' + 
          '<input type="hidden" name="profesion" value="{{ $profesion['nombre_carrera'] }}" />' +
          '<button type="submit">Enviar</button>' + 
          '</form>',
        showConfirmButton: false
      });
    });
    })
  </script>
@endsection
