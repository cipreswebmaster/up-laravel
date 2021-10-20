<link rel="stylesheet" href="{{ mix("/css/showcase-filter.css") }}">

@php
  if (session_status() == PHP_SESSION_NONE)
    session_start();

  $routeName = Route::currentRouteName();
@endphp

@if (Route::currentRouteName() == "uniCountry")
  <h2 style="font-family: Poppins-SemiBold; text-align: center">Estas son algunas de las carreras ofertadas en esta universidad. Para conocerlas todas, visita el sitio web de la universidad.</h2>
@else
  <div class="filter">
    <div class="title only-pc">{{ $title }}</div>
    <input
      type="text"
      id="search"
      class="search"
      placeholder="Buscar por nombre"
      autoComplete="off"
    />
    <div class="order">
      @if (in_array($routeName, ["uniIndex", "uniIndexCountry"]) && isset($_SESSION["logged"]))
        <div class="select-country" id="select-country">
          <div class="selected" id="selected-c">
            @php
              if ($routeName == "uniIndex") {
                $i = 0;
              } else {
                $i = explode("/", str_replace("//", "", Request::url()))[3] - 1;
              }
              $pais = $paises[$i];
            @endphp
            <div class="option">
              <div class="img">
                <img src="{{ asset("images/paises/" . $pais["imagen"]) }}" alt="">
              </div>
              <div class="text"> {{ $pais["nombre_pais"] }} </div>
            </div>
          </div>
          <div class="options">
            @foreach ($paises as $pais)
              @if ($pais["nombre_pais"] == "Colombia")
                <div class="option">
                  <a href="{{ route("uniIndex") }}">
                    <div class="img">
                      <img src="{{ asset("images/paises/" . $pais["imagen"]) }}" alt="">
                    </div>
                    <div class="text"> {{ $pais["nombre_pais"] }} </div>
                  </a>
                </div>
              @else
                <div class="option">
                  <a href="{{ route("uniIndexCountry", [
                    "idCountry" => $pais["id_pais"],
                    "uniCountry" => Str::slug($pais["nombre_pais"])
                  ]) }}">
                    <div class="img">
                      <img src="{{ asset("images/paises/" . $pais["imagen"]) }}" alt="">
                    </div>
                    <div class="text"> {{ $pais["nombre_pais"] }} </div>
                  </a>
                </div>
              @endif
            @endforeach
          </div>
        </div>
        <div class="arrow-icon">
          <img src="{{ asset("images/flecha.png") }}" alt="">
        </div>
      @endif
      <div>
        <select name="order" id="order">
          <option value="1">Ordenar por A-Z</option>
          <option value="-1">Ordenar por Z-A</option>
        </select>
      </div>
      @if ($routeName == "uniIndex")
        <div>
          <select name="orderCiudad" id="orderCiudad">
            <option value="0">Todos</option>
            <option value="1">Bogotá</option>
            <option value="2">Medellín</option>
          </select>
        </div>
      @endif
    </div>
  </div>

  <script>
    const orderSelect = document.getElementById("order");
    orderSelect.addEventListener("change", function (e) {
      let cards = [...document.querySelectorAll(".card")];
      cards = cards.reverse();

      const parent = cards[0].parentNode;
      cards.forEach(function (c) {
        parent.removeChild(c);
        parent.appendChild(c);
      });
    });

    const selectedCountry = document.getElementById("selected-c");
    selectedCountry.addEventListener("mouseover", showOptions);
    selectedCountry.addEventListener("mouseout", hideOptions);

    const options = document.getElementsByClassName("options")[0];
    options.addEventListener("mouseover", showOptions);
    options.addEventListener("mouseout", hideOptions);


    function showOptions() {
      options.classList.add("show");
    }

    function hideOptions() {
      options.classList.remove("show");
    }

    // Ciudad
    const ciudadSelect = document.getElementById("orderCiudad");
    ciudadSelect.addEventListener("change", function (e) {
      document.querySelectorAll(".card").forEach(function (c, i) {
        const id = c.dataset.ciudad;
        if (e.target.value == "0")
          c.classList.remove("non");
        else {
          if (id != e.target.value)
            c.classList.add("non");
          else
            c.classList.remove("non");
        }
      });
    });
  </script>
@endif
