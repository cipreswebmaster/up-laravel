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

  $bannerText = "Universidades en " . $universidad["abreviatura_pais"];
  $banner = $universidad["abreviatura_pais"] . ".jpg";

  $paisesNoFromTopBanner = ["eeuu", "españa"];
  $bannerFromTop = !in_array($universidad["abreviatura_pais"], $paisesNoFromTopBanner);
@endphp

@section('body')
  <x-banner
    :topText="$bannerText"
    :img="$banner"
    :fromTop="$bannerFromTop"
    arrow="uni"
  />
  <div class="uni-content">
    <div class="uni_info">
      <div class="info">
        <div class="pic">
          <img src="{{ asset("/images/universidades/logo/" . $universidad["img_name"]) }}" alt="" />
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
            <img src="{{ asset("/images/universidades/campus/" . $bannerImg) }}" alt="" />
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
              <div style="margin-left: 15px;">Costos aproximados(USD)</div>
            </div>
            <div class="item">
              Matrícula y cuotas por carrera completa: {{ $universidad["matricula_cuotas"] }}
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
    <div class="buttons">
      <div class="btn">
        <a
          href="/profesiones"
          class="btn_link" >
          Regresar al listado de profesiones
        </a>
      </div>
      <div class="btn">
        <a
          href="/universidades/c/2/estados-unidos"
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
    </div>
  </div>
  @if ($universidad["testimonios"])
    <div class="section testimonios">
      <div class="section-title">
        <div class="icon">
          <img style="width: 36px" src="{{ asset("images/university.profession/icons/testimonios.png") }}" alt="">
        </div>
        <div class="s-title">
          Testimonios
        </div>
      </div>
      <div class="section-content">
        <iframe
          width="560"
          height="315"
          src="https://www.youtube.com/embed/videoseries?list={{ $universidad["testimonios"] }}"
          title="YouTube video player"
          frameborder="0"
          allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
          allowfullscreen
        ></iframe>
      </div>
    </div>
  @endif
@endsection
