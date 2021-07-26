@php
    $tabs = [
      [ "name" => "Inicio", "to" => "/", "color" => "#f65a4d" ],
      [ "name" => "Test", "to" => "/test", "color" => "#90278c" ],
      [ "name" => "Profesiones", "to" => "/profesiones", "color" => "#99dce5" ],
      [ "name" => "Universidades", "to" => "/universidades", "color" => "#ffe25a" ],
      [ "name" => "Becas", "to" => "/becas", "color" => "#38b148" ],
      // [ "name" => "Actualidad", "to" => "/actualidad", "color" => "#90278c" ],
      // [ "name" => "Contacto", "to" => "/contacto", "color" => "#cf1459" ],
    ]
@endphp

<header class="header" style="width: 100%">
  <div class="ref logo">
    <a href="/">
      <img src="{{ asset("images/header/up-logotipo.gif") }}" alt="Logotipo de UP" />
    </a>
  </div>
  <nav class="tabvar x">
    <div class="responsive_btn_close" id="responsive_btn_close">
      <div class="btn_close_logo">
        <img src="{{ asset("images/header/up-logotipo.gif") }}" alt="" />
      </div>
      <div class="btn_close_x">
        <img src="{{ asset("images/header/up-menu-icon-close.jpg") }}" alt="" />
      </div>
    </div>
    @foreach ($tabs as $tab)
      <div
        class="ref tab link"
        style="border-bottom: 3px solid {{ $tab["color"] }}"
      >
        <a href="{{ $tab["to"] }}">
          {{ $tab["name"] }}
        </a>
      </div>
    @endforeach
  </nav>
  <div class="session">
    @if (isset($_SESSION["logged"]))  
        <div class="ref login link">
          <a href="{{ url("logout") }}" class="logginout">
            Cerrar Sesión
          </a>
        </div>
      @else
        <div class="planes-btn">
          <a href="/plans">Conoce nuestros planes</a>
        </div>
        <div class="ref login link">
          <a href="{{ url("login") }}" class="logginout">
            Iniciar Sesión
          </a>
        </div>
      @endif
      <x-register-btn />
  </div>
  {{-- <div class="responsive_btn" onClick={handleMenuOpen}>
    <img src={menu} alt="" />
  </div> --}}
</header>
