@extends('base')

@section('title')
  {{ $universidad["nombre_universidad"] }}
@endsection

@section('styles')
  <link rel="stylesheet" href="{{ mix("css/extranjero.css") }}">
  <link rel="stylesheet" href="{{ asset("css/profession-card.css") }}">
@endsection

@php
  $uniImg = str_replace(".","-banner.",$universidad["img_name"]);

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
    topText="Universidades en EEUU"
    img="eeuu.jpg"
    arrow="uni"
  />
  <div class="uni-content">
    <div class="uni_info">
      <div class="info">
        <div class="pic">
          <img src="{{ env("API_URL") . "/images/unis/logo/" . $universidad["img_name"] }}" alt="" />
        </div>
        <div class="name">{{ $universidad["nombre_universidad"] }}</div>
        <div class="description">{{ $universidad["descripcion_uni"] }}</div>
      </div>
      <div class="video">
        <x-youtube
          :videoId="$universidad['video_pres']"
          class="video_frame"
          containerClass="video_container"
        />
      </div>
    </div>
    <div class="career-info column-container" style="margin-top: 25px">
      <div class="column" style="position: relative">
        <div class="presentation-card">
          <div class="uni-img">
            @php
              $bannerImg = str_replace(".", "-banner.", $universidad["img_name"]);
            @endphp
            <img src="{{ env("API_URL") . "/images/unis/banners/$bannerImg" }}" alt="" />
          </div>
          <div class="ver-carreras">
            <a href="{{ $universidad["web"] }}"
              target="_blank" rel="noopener noreferrer"
            >Ir al sitio web</a>
          </div>
        </div>
        <div class="sticky">
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
                  <li style="word-break: break-all">
                    {{ $c }}
                  </li>
                @endforeach
              </ul>
            </div>
          </div>
          <div class="contacto btn">
            <a href="{{ $universidad["link_admision"] }}" class="btn_link" target="_blank" rel="noopener noreferrer">
              Ir a Admisiones
            </a>
          </div>
          <div class="general-info">
            <div class="item">
              <div>
                <img src="{{ asset("images/university.profession/icons/precio_semestre.jpg") }}" alt="">
              </div>
              <div style="margin-left: 15px;">Costos aproximadas</div>
            </div>
            <div class="item">
              Matrícula y cuotas: {{ $universidad["matricula_cuotas"] }}
            </div>
            <div class="item" style="font-family: Poppins; font-size: 15px; text-align: left">
              {{ $universidad["vida_campus"] }}
            </div>
          </div>
        </div>
      </div>
      <div class="column">
        <div class="carreer-pre">

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
              {{implode("", $universidad["proceso_admision"])}}
            </div>
            <div class="btn">
              <a
                href="{{ $universidad["link_admision"] }}"
                target="_blank"
                rel="noopener noreferrer" >
                <span>Conoce todo el proceso aquí</span>
                <img src="{{ asset("images/university.profession/arrow-button-more.svg") }}" alt="Arrow" />
              </a>
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
            <div class="btn">
              <a
                href="{{ $universidad["link_apoyo"] }}"
                target="_blank"
                rel="noopener noreferrer" >
                <span>Conoce todo el proceso aquí</span>
                <img src="{{ asset("images/university.profession/arrow-button-more.svg") }}" alt="Arrow" />
              </a>
            </div>
          </div>

          {{-- Becas --}}
          <div class="section">
            <div class="section-title">
              <div class="icon">
                <img style="width: 36px" src="{{ asset("images/university.profession/icons/becas.png") }}" alt="">
              </div>
              <div class="s-title">
                Becas
              </div>
            </div>
            <div class="section-content">
              <p>
                {{ $universidad["becas"] }}:
              </p>
              <div class="btn">
                <a
                  href="{{ $universidad["link_becas"] }}"
                  target="_blank"
                  rel="noopener noreferrer" >
                  <span>Ir a becas</span>
                  <img src="{{ asset("images/university.profession/arrow-button-more.svg") }}" alt="Arrow" />
                </a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <x-horizontal-ad />
    <x-showcase 
      title="Profesiones"
      :samples="$profesiones"
      cardComponent="professions"
      imageFieldName="imagen_carrera"
      cardTitle="nombre_carrera"
    />
    <x-horizontal-ad />
    <div class="section">
      <div class="section-title">
        <div class="icon">
          <img style="width: 36px" src="{{ asset("images/university.profession/icons/cursos_online.png") }}" alt="">
        </div>
        <div class="s-title">
          Cursos gratuitos
        </div>
      </div>
      <div class="section-content">
        {{ $universidad["cursos_online"] }}
      </div>
    </div>
  </div>
@endsection