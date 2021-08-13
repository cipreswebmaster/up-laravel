<link rel="stylesheet" href="{{ asset("css/showcase-filter.css") }}">

@php
  function getCountry() {

  }
@endphp

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
    @if (Route::currentRouteName() != "profIndex")
      <div class="select-country" id="select-country">
        <div class="selected" id="selected-c">
          @php
            $pais = $paises[0];
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
