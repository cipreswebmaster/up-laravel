@extends('base')

@section('styles')
  <link rel="stylesheet" href="{{ asset("css/membresias.css") }}">
@endsection

@section('title')
  Membresias
@endsection

@section('body')
<div>
  <div class="memberships">
    <div class="title">Elige tu plan premium</div>
    <div class="premium_mem">
      <div class="mem">
        <div class="time">1 mes</div>
        <div class="price offer_active">
          <div class="money_sign">COP$</div>
          <div class="money">30.000</div>
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
              Acceso a todas la universidades a nivel nacional e internacional (próximamente).
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
        </div>
        <div class="start_now">
          <div class="btn">
            <a href="/register">
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
          <div class="money">45.000</div>
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
              Acceso a todas la universidades a nivel nacional e internacional (próximamente).
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
        </div>
        <div class="start_now">
          <div class="btn">
            <a href="/register">
              Empezar ahora
            </a>
          </div>
          <div class="small_letters">
            Nuestras membresías son autorenovables
          </div>
        </div>
      </div>
      <div class="mem">
        <div class="time">6 meses</div>
        <div class="price offer_active">
          <div class="money_sign">COP$</div>
          <div class="money">55.000</div>
          <div class="iva"> + IVA</div>
        </div>
        <div class="cobro">Cobro por estudiante</div>
        <div class="mem_list">
          <div class="item">
            <div class="list_indicator">
              <img src={{ asset("images/test/check.svg") }} alt="" />
            </div>
            <div class="text">
              Acceso al test durante 5 meses.
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
              Acceso a todas la universidades a nivel nacional e internacional (próximamente).
            </div>
          </div>
          <div class="item">
            <div class="list_indicator">
              <img src={{ asset("images/test/check.svg") }} alt="" />
            </div>
            <div class="text">
              Podrás presentar hasta 6 veces el test.
            </div>
          </div>
        </div>
        <div class="start_now">
          <div class="btn">
            <a href="/register">
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
