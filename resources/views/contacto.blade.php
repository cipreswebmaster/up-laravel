@extends('base')

@section('title')
  Contáctanos
@endsection

@section('styles')
  <link rel="stylesheet" href="{{ asset("css/contact.css") }}">
@endsection

@section('body')
  <x-banner arrow="prof" img="contacto.jpg" topText="Contacto" />
  @if (isset($_GET["success"]))
    <h1 align="center" style="margin-top: 15px; font-family: Poppins-SemiBold">Tu mensaje ha sido enviado con éxito. Nos pondremos en contacto</h1>
  @endif
  <div class="contact">
    <div class="title">
      ¿Tienes alguna duda o pregunta? ¡Envíanos un mensaje!
    </div>
    <div class="form_info">
      <div class="info">
        <div class="info_title">Información de contacto</div>
        <div class="info_text">
          Completa el formulario y nuestro equipo se pondrá en contacto
          contigo en menos de 24 horas
        </div>
        <div class="info_email">
          contacto@universidadesyprofesiones.com
        </div>
        {{-- {!isMobile() && (
          <div class="info_img">
            <img src={arrows} alt="Arrows" />
          </div>
        )} --}}
      </div>
      <div class="form">
        <form action="/contacto/contactar" method="POST">
          @csrf
          <div class="row">
            <div class="input_label">
              <label>Nombre completo</label>
              <input
                type="text"
                placeholder="Escribe tu nombre completo aqui"
                class="input"
                name="names"
              />
            </div>
            <div class="input_label">
              <label>Institución Educativa</label>
              <input
                type="text"
                placeholder="Escribe el colegio"
                class="input"
                name="school"
              />
            </div>
          </div>
          <div class="row">
            <div class="input_label">
              <label>Email</label>
              <input
                type="email"
                placeholder="Escribe tu email"
                class="input"
                name="email"
              />
            </div>
            <div class="input_label">
              <label>Celular</label>
              <input
                type="number"
                placeholder="Escribe tu celular"
                class="input"
                name="phone"
              />
            </div>
          </div>
          <div class="row texta">
            <label>Mensaje</label>
            <textarea
              class="input textarea"
              placeholder="Escribe tu consulta aquí"
              name="message"
            ></textarea>
          </div>
          <button class="submit">Enviar mensaje</button>
        </form>
      </div>
    </div>
  </div>
@endsection
