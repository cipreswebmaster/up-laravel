@extends("base")

@section('title')
  {{ $profesion["nombre_carrera"] }} | {{ $universidad["nombre_universidad"] }}
@endsection

@section('styles')
  <link rel="stylesheet" href="{{ asset("css/universidad.profesion.css") }}">
@endsection

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
      <div class="column">
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
        <div class="general-info">
          <div class="item">
            Precio semestre
          </div>
          <div class="item">
            ${{ $prof_uni["precio_semestre"] }}
          </div>
        </div>
        <div class="section" style="padding: 0px; margin-top: 35px">
          <div class="section-title"> Ubicación </div>
          <div class="section-content" style="overflow: hidden; padding: 0px">
            {!! $universidad["mapa"] !!}
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
            @if ($profesion["codigo_video"])
              <x-youtube
                :videoId="$profesion['codigo_video']"
                containerClass="video"
                class="frame"
              />
            @endif
          </div>
          
          {{-- Proposito de la carrera --}}
          <div class="section">
            <div class="section-title">
              {{ $profesion["nombre_carrera"] }}
            </div>
            <div class="section-content">
              {{ $prof_uni["proposito_carrera"] }}
            </div>
          </div>

          {{-- Perfil de aspirante --}}
          <div class="section">
            <div class="section-title">Perfil del aspirante</div>
            <div class="section-content">
              {{ $prof_uni["perfil_aspirante"] }}
            </div>
          </div>

          {{-- Proceso de admision --}}
          <div class="section">
            <div class="section-title">Proceso de admisión</div>
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
            <div class="section-title">Apoyo financiero</div>
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
              <div class="section-title">Internacionalización</div>
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
          {{-- <div style="margin-right: 15px">
            <img src={pensum} alt="" />
          </div> --}}
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
      {{-- <div class="btn">
        <a href="/" class="btn_link">
          Quiero ser contactado
        </a>
      </div> --}}
      <div class="btn">
        <a
          href="/universidades"
          class="btn_link" >
          Regresar al listado de universidades
        </a>
      </div>
      {{-- <div class="btn">
        <span
          onClick={handleReturnToUniversitiesClick}
          class="btn_link"
        >
          Ir al sitio web de la universidad
        </span>
      </div> --}}
      {{-- <div class="btn">
        <a to="/results/profile" class="btn_link">
          Regresar a favoritos
        </a>
      </div> --}}
    </div>
  </div>
@endsection
