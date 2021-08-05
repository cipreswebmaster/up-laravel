@extends("base")

@section("title") Test @endsection

@section('styles')
  <link rel="stylesheet" href="{{ asset("css/test.css") }}">
@endsection

@section("body")
  <x-banner
    topText="Test"
    arrow="uni"
    img="test-back.jpg"
    :fromTop="true" />
  <x-preview-video
    videoId="IKeT_aP5fUg"
    text="Estos son algunos aspectos que podrás encontrar para hacer una selección de carrera según tu test premium de UP"
    example="test" />
    <div class="tests" style="display: flex">
      <div class="test-container">
        <div class="t-title">TEST GRATUITO</div>
        <div class="t-content">
          <div>
            <div class="img">
              <img src="{{ asset("images/test/vin.png") }}" alt="">
            </div>
            <span>Podrás realizar un test gratuito creado por un tercero</span>
          </div>
          <div class="t-iniciar">
            <a
              href="{{ isset($_SESSION["logged"]) ? "https://www.elegircarrera.net/test-vocacional/" : "/login" }}"
              @if (isset($_SESSION["logged"]))
                target="_blank"
                rel="noopener noreferrer"
              @endif
            >INICIAR TEST</a>
          </div>
        </div>
      </div>
      <div class="test-container">
        <div class="t-title">TEST PREMIUM</div>
        <div class="t-content">
          <div>
            <div class="img">
              <img src="{{ asset("images/test/vin.png") }}" alt="">
            </div>
            <span>
              Podrás realizar un test muy avanzado
              donde conocerás tus fortalezas, el
              lado menos eficiente, el desarrollo de
              competencias, tu personalidad,
              motivaciones
            </span>
          </div>
          <div>
            <div class="img">
              <img src="{{ asset("images/test/vin.png") }}" alt="">
            </div>
            <span>
            Descubrirás las carreras que se ajustan a tu perfil
            </span>
          </div>
          <div>
            <div class="img">
              <img src="{{ asset("images/test/vin.png") }}" alt="">
            </div>
            <span>
            Tendrás un porcentaje de afinidad nulo, bajo, alto y muy alto con las carreras seleccionadas
            </span>
          </div>
          <div>
            <div class="img">
              <img src="{{ asset("images/test/vin.png") }}" alt="">
            </div>
            <span>
            Podrás comparar y alinear tu perfil a más de 100 carreras
            </span>
          </div>
          <div>
            <div class="img">
              <img src="{{ asset("images/test/vin.png") }}" alt="">
            </div>
            <span>
            Obtendrás los resultados de tu test en PDF
            </span>
          </div>
          <div>
            <div class="img">
              <img src="{{ asset("images/test/vin.png") }}" alt="">
            </div>
            <span>
            Precio muy económico con grandes beneficos
            </span>
          </div>
          <div class="t-iniciar">
            <a href="{{ url("/membresias") }}">VER PLANES</a>
          </div>
        </div>
      </div>
    </div>
@endsection
