@php
    $instructions = [
      ["title" => "Registrate",
        "content" => "Si tienes el código de tu colegio, ponlo para poder iniciar el test, si no lo tienes, pídele ayuda a tus papás para poder realizar el pago y empezar a disfrutar de UP."],
      ["title" => "Realiza el test",
        "content" => "Responde las preguntas con la mayor sinceridad para que los resultados sean lo más certeros posible."],
      ["title" => "¿Cuál es mi perfil?",
        "content" => "Una vez terminado el test, conocerás cuáles son tus fortalezas y cuál es tu lado menos eficiente. Con esto, podrás hacer una elección de carrera con mayor claridad."],
      ["title" => "¿A qué carrera se ajusta mi perfil?",
        "content" => "Acá podrás explorar la información de las diferentes áreas profesionales y cuáles se ajustan a tu perfil."],
      ["title" => "Elijo la carrera",
        "content" => "En esta sección conocerás a fondo todo sobre cada carrera que se ajusta a tu perfil."],
      ["title" => "Elijo dónde estudiar",
        "content" => "Aquí encontrarás el listado de las diferentes universidades en donde puedes estudiar la carrera que elegiste, con su información."],
      ["title" => "Comparar universidades",
        "content" => "Una vez hayas elegido dos o más universidades, podrás compararlas para tomar la mejor decisión."]
    ]
@endphp

<div class="index-video-instruction">
  <x-youtube videoId="mFym9A2YKLY" containerClass="video" />
  <x-youtube videoId="GBpvs-Kd35g" containerClass="video" />
  <div class="carousel-instructions">
    <div class="slides">
      <div class="slide active">
        <div class="title">{{ $instructions[0]["title"] }}</div>
        <div class="info">
          <div class="img">
            <img src="images/index/instructions/gpts01.png">
          </div>
          <div class="text">
            {{ $instructions[0]["content"] }}
          </div>
        </div>
      </div>
      @for ($i = 1; $i < count($instructions); $i++)
        <div class="slide">
          <div class="title">{{ $instructions[$i]["title"] }}</div>
          <div class="info">
            <div class="img">
              <img src="{{ "images/index/instructions/gpts0".($i+1).".png" }}">
            </div>
            <div class="text">
              {{ $instructions[$i]["content"] }}
            </div>
          </div>
        </div>
      @endfor
    </div>
    <div class="control" id="slide-control">
      <img src="{{ asset("images/index/instructions/flecha.png") }}">
    </div>
  </div>
</div>

<script>
  const slides = [...document.querySelectorAll(".carousel-instructions .slide")];
  const slidesControl = document.getElementById("slide-control");
  slidesControl.addEventListener("click", function () {
    let activeIndex = slides.findIndex(function (el) { return el.classList.contains("active") });
    const nextActiveIndex = activeIndex == 6 ? 0 : activeIndex + 1;

    slides[activeIndex].classList.remove("active");
    slides[nextActiveIndex].classList.add("active");
  });
</script>
