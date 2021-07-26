<link rel="stylesheet" href="{{ asset("css/showcase-filter.css") }}">

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
    <Select name="country" id="country" class="only-pc">
      <option>
        Colombia
      </option>
    </Select>
    <Select name="order" id="order">
      <option value="1">Ordenar por A-Z</option>
      <option value="-1">Ordenar por Z-A</option>
    </Select>
  </div>
</div>
