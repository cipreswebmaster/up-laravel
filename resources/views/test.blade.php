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
    text="Estos son algunos aspectos que podrás encontrar para hacer una selección de carrera según tu test UP"
    example="test" />
  <div class="tests">
    <div class="test-container">
      <div class="t-title">TEST GRATUITO</div>
      <div class="t-content">
        <p>
          Podrás realizar un test gratuito creado por un tercero
        </p>
        <div class="t-iniciar">
          <a href="http://" target="_blank" rel="noopener noreferrer">INICIAR TESTS</a>
        </div>
      </div>
    </div>
  </div>
@endsection
