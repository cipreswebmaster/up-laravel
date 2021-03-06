@php
  session_start();
@endphp
<div class="what-is-up">
  <div class="description">
    <h1 class="title">¿Qué es <span class="up-target">UP</span> ?</h1>
    <p>
      UP Es una Plataforma Universitaria, diseñada para guiarte en la elección de tu carrera profesional y en qué universidad puedes estudiarla. <br>
      Por medio de la plataforma "Te Orienta" de 4-Beyond, te ayudamos a tomar una mejor decisión acerca de qué estudiar. Por medio de un test, te mostraremos cuáles son tus habilidades y neuro fortalezas (aquello en lo que eres realmente bueno) y te las asociamos con las carreras profesionales afines.
    </p>
  </div>
  @if (!isset($_SESSION["logged"]))
    {{-- <div class="contact-form">
      <h2 class="title">Empieza a crear tu futuro:</h2>
      <form action="/registrate" class="form" id="index-form">
        <input
          type="email"
          placeholder="tuemail@mail.com"
          name="email"
          required
        /><br>
        <button type="submit">Regístrate gratis</button>
      </form>
      <div class="login">
        ¿Ya tienes cuenta? <a href="/login" style="color: #fff">Inicia sesión</a>
      </div>
    </div> --}}
    <div class="logo">
      <img src="{{ asset("images/index/navega-gratis.png") }}" alt="">
    </div>
  @else
    <div class="logo">
      <img src="{{ asset("images/index/logo-up.png") }}" alt="Universidades y profesiones">
    </div>
  @endif
</div>
