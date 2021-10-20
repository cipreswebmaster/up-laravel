@extends('base')

@section('title')
  Contáctanos
@endsection

@section('styles')
  <link rel="stylesheet" href="{{ mix("/css/contact.css") }}">
@endsection

@section('body')
  <x-banner arrow="prof" img="contacto.jpg" topText="Contacto" />
  @if (isset($_GET["success"]))
    <h1 align="center" style="margin-top: 15px; font-family: Poppins-SemiBold">Tu mensaje ha sido enviado con éxito. Nos pondremos en contacto</h1>
  @endif
  <div class="c-row">
    <div class="c-column">
      <div class="text">
        Nuestro equipo está a tu disposición para cualquier duda, llámanos, escríbenos o diligencia el formulario y nos pondremos en contacto contigo lo antes posible.
      </div>
      <div class="form-container">
        <form action="/contacto/contactar" method="POST">
          @csrf
          <input 
            type="text"
            class="input"
            placeholder="Nombre*"
            id="names"
            name="names"
            required>
          <input 
            type="text"
            class="input"
            placeholder="Institución/Empresa*"
            id="school"
            name="school"
            required>
          <input 
            type="text"
            class="input"
            placeholder="Email*"
            name="email"
            required>
          <input 
            type="text"
            class="input"
            placeholder="Celular*"
            name="phone"
            required>
          <textarea
            class="input textarea"
            placeholder="¿Cómo podemos ayudarte?*"
            name="message"
            rows="5"
            required
          ></textarea>
          <button type="submit" class="submit">Enviar</button>
        </form>
      </div>
    </div>
    <div class="c-column">
      <div class="contact-info">
        <div class="email">
          <div class="thumbnail">
            <img src="{{ asset("images/contacto/mail_UP.png") }}" alt="Email">
          </div>
          <div class="legend">
            contacto@universdadesyprofesiones.com
          </div>
        </div>
        <div class="area-comercial">
          <div class="thumbnail">
            <img src="{{ asset("images/contacto/cel_UP.png") }}" alt="Email">
          </div>
          <div class="legend">
            <div class="title">
              Contacto Comercial: Llámanos o escríbenos
            </div>
            <div class="number">
              (+57) 300 566 2412
            </div>
          </div>
        </div>
        <div class="area-comercial">
          <div class="thumbnail">
            <img src="{{ asset("images/contacto/cel_UP.png") }}" alt="Email">
          </div>
          <div class="legend">
            <div class="title">
              Cartera:
            </div>
            <div class="number">
              (+57) 318 381  8314
            </div>
          </div>
        </div>
      </div>
      <div class="image">
        <img src="{{ asset("images/contacto/imagen-contacto_UP.png") }}" alt="Imagen de contacto de UP">
      </div>
    </div>
  </div>
@endsection
