@extends('base')

@section('title')
  Perfil de usuario
@endsection

@section('styles')
  <link rel="stylesheet" href="{{ asset("css/perfil.css") }}">
@endsection

@php
  $unknow_image = $user["id_gender"] == 1 ? "unknow-woman" : "unknow-man";
@endphp

@section('body')
  <div class="left only-pc">
    <div class="profile_pic">
      <div class="pic">
        <img
          src="{{ asset("images/perfil/$unknow_image.jpg") }}"
          alt="Profile pic"
        />
      </div>
      <div class="name">
        <span style="color: gray">Mi perfil</span>
        <span>{{ $user["nombres"] }}</span>
      </div>
    </div>
    <div class="configs"></div>
  </div>
  <div class="right">
    {{-- <ActionButtons /> --}}
    <h1>Información de tu cuenta</h1>
    <div class="fields">
      <div class="field">
        <div class="title">Nombre (s)</div>
        <input
          type="text"
          placeholder="Escribe tus nombres aquí"
          class="field_input"
          disabled
          autoComplete="off"
          value="{{ $user["nombres"] }}"
        />
      </div>
      <div class="field">
        <div class="title">Apellido (s)</div>
        <input
          type="text"
          placeholder="Escribe tus apellidos aquí"
          class="field_input"
          disabled
          autoComplete="off"
          value="{{ $user["apellidos"] }}"
        />
      </div>
      <div class="field">
        <div class="title">Email</div>
        <input
          type="email"
          class="field_input"
          disabled
          autoComplete="off"
          value="{{ $user["email"] }}"
        />
      </div>
      <div class="field">
        <div class="title">Celular</div>
        <input
          type="number"
          class="field_input"
          disabled
          autoComplete="off"
          value="{{ $user["celular"] }}"
        />
      </div>
      <div class="field">
        <div class="title">Fecha de nacimiento</div>
        <input
          type="date"
          class="field_input"
          disabled
          autoComplete="off"
          value="{{ $user["nacimiento"] }}"
        />
      </div>
    </div>
    <div class="buttons">
      <button
        class="button"
        disabled
      >
        Actualizar datos
      </button>
      <button
      class="button"
      disabled
      >
        <a href="{{ route("logout") }}" style="color: white">Cerrar sesión</a>
      </button>
    </div>
  </div>
@endsection
