@extends('base')

@section('styles')
  <link rel="stylesheet" href="{{ asset("css/membresias.css") }}">
  <style>
    @media only screen and (max-width: 768px) {
      .mem {
        left: unset !important;
        transform: unset !important;
      }
    }
  </style>
@endsection

@section('title')
  Membresias
@endsection

@php
  session_start();
  $route = isset($_SESSION["logged"]) ? "pagar" : "registrate";
@endphp

@section('body')
<div>
  <div class="memberships">
    <div class="title">Elige UP Premium</div>
    <div class="premium_mem">
      {{-- <div class="mem">
        <div class="time">1 mes</div>
        <div class="price offer_active">
          <div class="money_sign">COP$</div>
          <div class="money">50.000</div>
          <div class="iva"> + IVA</div>
        </div>
        <div class="cobro">Cobro por estudiante</div>
        <div class="mem_list">
          <div class="item">
            <div class="list_indicator">
              <img src={{ asset("images/test/check.svg") }} alt="" />
            </div>
            <div class="text">
              Acceso al test durante 1 mes.
            </div>
          </div>
          <div class="item">
            <div class="list_indicator">
              <img src={{ asset("images/test/check.svg") }} alt="" />
            </div>
            <div class="text">
              Acceso a todas las carreras.
            </div>
          </div>
          <div class="item">
            <div class="list_indicator">
              <img src={{ asset("images/test/check.svg") }} alt="" />
            </div>
            <div class="text">
              Acceso a todas la universidades a nivel nacional y de EEUU
            </div>
          </div>
          <div class="item">
            <div class="list_indicator">
              <img src={{ asset("images/test/check.svg") }} alt="" />
            </div>
            <div class="text">
              Podrás presentar hasta 2 veces el test.
            </div>
          </div>
          <div class="item">
            <div class="list_indicator">
              <img src={{ asset("images/test/check.svg") }} alt="" />
            </div>
            <div class="text">
              Acceso a toda la información de becas
            </div>
          </div>
          <div class="item">
            <div class="list_indicator">
              <img src={{ asset("images/test/check.svg") }} alt="" />
            </div>
            <div class="text">
              Información de weebinars (próximamente)
            </div>
          </div>
        </div>
        <div class="start_now">
          <div class="btn">
            <a href="{{ route($route, ["plan" => 1]) }}">
              Empezar ahora
            </a>
          </div>
          <div class="small_letters">
            Nuestras membresías son autorenovables
          </div>
        </div>
      </div>
      <div class="mem">
        <div class="time">3 meses</div>
        <div class="price offer_active">
          <div class="money_sign">COP$</div>
          <div class="money">100.000</div>
          <div class="iva"> + IVA</div>
        </div>
        <div class="cobro">Cobro por estudiante</div>
        <div class="mem_list">
          <div class="item">
            <div class="list_indicator">
              <img src={{ asset("images/test/check.svg") }} alt="" />
            </div>
            <div class="text">
              Acceso al test durante 3 meses.
            </div>
          </div>
          <div class="item">
            <div class="list_indicator">
              <img src={{ asset("images/test/check.svg") }} alt="" />
            </div>
            <div class="text">
              Acceso a todas las carreras.
            </div>
          </div>
          <div class="item">
            <div class="list_indicator">
              <img src={{ asset("images/test/check.svg") }} alt="" />
            </div>
            <div class="text">
              Acceso a todas la universidades a nivel nacional y de EEUU
            </div>
          </div>
          <div class="item">
            <div class="list_indicator">
              <img src={{ asset("images/test/check.svg") }} alt="" />
            </div>
            <div class="text">
              Podrás presentar hasta 4 veces el test.
            </div>
          </div>
          <div class="item">
            <div class="list_indicator">
              <img src={{ asset("images/test/check.svg") }} alt="" />
            </div>
            <div class="text">
              Acceso a toda la información de becas
            </div>
          </div>
          <div class="item">
            <div class="list_indicator">
              <img src={{ asset("images/test/check.svg") }} alt="" />
            </div>
            <div class="text">
              Información de weebinars (próximamente)
            </div>
          </div>
        </div>
        <div class="start_now">
          <div class="btn">
            <a href="{{ route($route, ["plan" => 2]) }}">
              Empezar ahora
            </a>
          </div>
          <div class="small_letters">
            Nuestras membresías son autorenovables
          </div>
        </div>
      </div> --}}
      <div class="mem" style="position: relative; left: 50%; transform: translateX(-50%)" >
        <div class="time">6 meses</div>
        <div class="price offer_active">
          <div class="money_sign">COP$</div>
          <div class="money">150.000</div>
          <div class="iva"> + IVA</div>
        </div>
        <div class="cobro">Cobro por estudiante</div>
        <div class="mem_list">
          <div class="item">
            <div class="list_indicator">
              <img src={{ asset("images/test/check.svg") }} alt="" />
            </div>
            <div class="text">
              Acceso a todas las carreras.
            </div>
          </div>
          <div class="item">
            <div class="list_indicator">
              <img src={{ asset("images/test/check.svg") }} alt="" />
            </div>
            <div class="text">
              Acceso a todas la universidades a nivel nacional y de EEUU
            </div>
          </div>
          <div class="item">
            <div class="list_indicator">
              <img src={{ asset("images/test/check.svg") }} alt="" />
            </div>
            <div class="text">
              Podrás presentar hasta 2 veces el test premium.
            </div>
          </div>
          <div class="item">
            <div class="list_indicator">
              <img src={{ asset("images/test/check.svg") }} alt="" />
            </div>
            <div class="text">
              Podrás entender que carreras se alinean a tu perfil.
            </div>
          </div>
          <div class="item">
            <div class="list_indicator">
              <img src={{ asset("images/test/check.svg") }} alt="" />
            </div>
            <div class="text">
              Acceso a toda la información de becas
            </div>
          </div>
          <div class="item">
            <div class="list_indicator">
              <img src={{ asset("images/test/check.svg") }} alt="" />
            </div>
            <div class="text">
              Acceso a información de actualidad universitaria
            </div>
          </div>
          <div class="item">
            <div class="list_indicator">
              <img src={{ asset("images/test/check.svg") }} alt="" />
            </div>
            <div class="text">
              Información de webinars (próximamente)
            </div>
          </div>
          <div class="item">
            <div class="list_indicator">
              <img src={{ asset("images/test/check.svg") }} alt="" />
            </div>
            <div class="text">
              Financiación (próximamente)
            </div>
          </div>
        </div>
        <div class="start_now">
          <div class="btn">
            <a href="{{ route($route, ["plan" => 3]) }}">
              Empezar ahora
            </a>
          </div>
          <div class="small_letters">
            Nuestras membresías son autorenovables
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="intro">
    <div class="back">
      <img src="{{ asset("images/test/banner-slide-planes.png") }}" alt="" />
    </div>
    <div class="content">
      <div class="text">
        <p>
          Transforma tu futuro con acceso a carreras, universidades, becas y
          mentorías.
        </p>
        <div class="low_letter">
          Tienes información completa de +100 carreras y +300 universidades
          para mantenerte actualizado, para encontrar tu mejor opción.
        </div>
        <x-join-now-btn />
      </div>
      <div class="carreras_min">
        <img src="{{ asset("images/test/carreras-min.png") }}" alt="" />
      </div>
    </div>
    {{-- {isMobile() && (
      <div class="carreras_min">
        <img src="{{ asset("images/test/carreras-min.png") }}" alt="" />
      </div>
    )} --}}
  </div>
</div>
@endsection
