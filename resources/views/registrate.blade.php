@extends('base');

@section('title')
  Regístrate
@endsection

@section('styles')
  <link rel="stylesheet" href="{{ asset("css/registrate.css") }}">
@endsection

@php
  $months = [
    "Enero",
    "Febrero",
    "Marzo",
    "Abril",
    "Mayo",
    "Junio",
    "Julio",
    "Agosto",
    "Septiembre",
    "Octubre",
    "Noviembre",
    "Diciembre",
  ];
@endphp

@section('body')
  @if (isset($_GET["user_exists"]))
    <div class="error_msg" style="color: red; font-size: 1rem; text-align: center">El correo o documento que intentaste usar ya pertence a un usuario</div>
  @endif
  <div class="r-container">
    <form action="{{ route("registrar") }}" method="POST" id="form">
      @csrf
      <div class="r-row">
        <input
          class="text"
          placeholder="Nombres"
          autoComplete="off"
          required
          name="nombres"
        />
        <input
          class="text"
          placeholder="Apellidos"
          autoComplete="off"
          required
          name="apellidos"
        />
      </div>
      <div class="r-row">
        <input
          class="text"
          type="number"
          placeholder="Número de celular"
          autoComplete="off"
          min="1111111111"
          max="9999999999"
          name="tel"
          required
        />
        <input
          class="text"
          placeholder="Email"
          autoComplete="off"
          required
          name="email"
          @if (isset($_GET["email"])) value="{{ $_GET["email"] }}" @endif
        />
      </div>
      <div class="born_date">
        <div class="title">Fecha de nacimiento</div>
        <div class="form">
          <select class="select" name="day" id="day" required>
            <option>Selecciona el día</option>
            @for ($i = 1; $i < 31; $i++)
              <option value="{{ $i + 1 }}">{{ $i + 1 }}</option>
            @endfor
          </select>
          <select class="select" name="month" id="month" required>
            <option>Selecciona el mes</option>
            @for ($i = 0; $i < count($months); $i++)
              <option value="{{ $i + 1 }}">{{ $months[$i] }}</option>
            @endfor
          </select>
          <select class="select" name="year" id="year" required>
            <option>Selecciona el año</option>
            @for ($i = 2006; $i >= 1950; $i--)
              <option value="{{ $i }}">{{ $i }}</option>
            @endfor
          </select>
        </div>
        <div class="error_msg" id="date_wrong" style="display: none">La fecha seleccionada está erronea.</div>
      </div>
      <div class="r-row">
        <input
          class="text"
          placeholder="Documento de identidad"
          maxLength="10"
          minLength="8"
          autoComplete="off"
          required
          name="documento"
        />
        <select type="text" class="select" required name="gender">
          <option>Selecciona tu género</option>
          <option value="1">Mujer</option>
          <option value="2">Hombre</option>
        </select>
      </div>
      <div class="r-row">
        <input
          type="text"
          class="text"
          id="favorita_in"
          name="favorita"
          style="width: 100%"
          placeholder="Dinos la carrera que más te llama la atención"
          list="favorita"
          required
        />
        <datalist id="favorita">
          <option>No sé</option>
          @foreach ($profesiones as $prof)
            <option value="{{ $prof->nombre_carrera }}" />
          @endforeach
        </datalist>
      </div>
      <div class="p-container">
        <div class="inputs">
          <input
            class="text"
            type="password"
            placeholder="Contraseña"
            required
            name="password"
            id="pass"
          />
          <input
            class="text"
            type="password"
            placeholder="Confirmar contraseña"
            required
            name="password_confirm"
            id="confirm_pass"
          />
        </div>
        <p class="pass_error" id="pass_error" style="display: none">Las contraseñas no coinciden</p>
      </div>
      <div class="terms_conditions">
        Al hacer click en <i>Registrarse</i>, indicas que has leído y
        aceptas los Términos del servicio y el Aviso de privacidad.
      </div>
      <button
        type="submit"
        class="submitBtn"
      >
        REGISTRARSE
      </button>
    </form>
  </div>
@endsection

@section('scripts')
  <script>
    const form = document.getElementById("form");
    form.addEventListener("submit", function (e) {
      const dia = document.getElementById("day").value,
            mes = document.getElementById("month").value,
            anio = document.getElementById("year").value;

      if (
        (dia != "00" && mes !== "00" && anio !== "00") &&
        ((mes % 2 == 0 && dia == 31) || (mes === 2 && dia > 29))
      ) {
        e.preventDefault();
        document.getElementById("date_wrong").style.display = "block";
      } else {
        document.getElementById("date_wrong").style.display = "none";
      }

      const pass = document.getElementById("pass").value;
      const confirm_pass = document.getElementById("confirm_pass").value;
      if (pass != confirm_pass) {
        e.preventDefault();
        document.getElementById("pass_error").style.display = "block";
      } else {
        document.getElementById("pass_error").style.display = "none";
      }
    });
  </script>
@endsection
