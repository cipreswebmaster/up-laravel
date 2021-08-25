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
            <span style="font-family: Poppins-ExtraBold; font-size: 20px; cursor: pointer" id="test-gratis" class="test-btn">INICIAR TEST</span>
          </div>
        </div>
      </div>
      <div class="test-container">
        <div class="t-title">TEST UP PREMIUM</div>
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
            <a href="{{ url("/membresias") }}" class="test-btn" id="ver-planes">VER PLANES</a>
          </div>
        </div>
      </div>
    </div>
@endsection

@section('scripts')
  <script>
    const testGratis = document.getElementById("test-gratis");
    testGratis.addEventListener("click", function () {
      Swal.fire({
        html: "<div style='display: flex; justify-content: center' > <img style='width: 25%' src='{{ asset("images/test/mano-stop.png") }}' /> </div>" +
              "<p>Estás siendo redireccionado a otra página, vuelve cuando termines el test gratuito para encontrar toda la información de carreras y universidades que UP tiene para ti</p>",
        showConfirmButton: false,
        didOpen: function () {
          setTimeout(function () {
            window.open("https://www.elegircarrera.net/test-vocacional/");
          }, 5000);
        }
      });

      gtag('event', 'Click', {
        'event_category': "INICIAR TEST",
        "event_label": "{{ Request::url() }}"
      });
    });

    const verPlanes = document.getElementById("ver-planes");
    verPlanes.addEventListener("click", function () {
      gtag('event', 'Click', {
        'event_category': "VER PLANES",
        "event_label": "{{ Request::url() }}"
      });
    });
  </script>
@endsection
