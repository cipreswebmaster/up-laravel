<link rel="stylesheet" href="{{ mix("/css/showcase-filter.css") }}">

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
      @if (in_array(Route::currentRouteName(), ["uniIndex", "uniIndexCountry"]))
        <div class="select-country" id="select-country">
          <div class="selected" id="selected-c">
            @php
              if (Route::currentRouteName() == "uniIndex") {
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
            @endforeach
          </div>
        </div>
      @endif
      <div>
        <select name="order" id="order">
          <option value="1">Ordenar por A-Z</option>
          <option value="-1">Ordenar por Z-A</option>
        </select>
      </div>
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
  </script>
@endif
