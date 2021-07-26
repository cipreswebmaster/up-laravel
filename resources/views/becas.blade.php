@extends('base')

@section('title')
  Becas
@endsection

@section('styles')
  <link rel="stylesheet" href="{{ asset("css/becas.css") }}">
@endsection

@section('body')
<div class="b-header">
  <div class="image">
    <img src={{ asset("images/becas/back.jpeg") }} alt="" />
  </div>
  <div class="text">BECAS</div>
</div>
<div class="content">
  @foreach (array_keys($becas) as $region)
    <div class="region_cards" key={idx}>
      <div class="region">{{ strtoupper($region) }}</div>
      <div class="cards">
        @foreach ($becas[$region] as $beca)
          <div class="b-card" >
            <div class="image">
              <img src="{{ env("API_URL") . "/images/becas/" . Str::slug($beca["nombre_beca"]) . ".jpg" }}" alt="" />
            </div>
            <div class="name_link">
              <div class="name">{{ $beca["nombre_beca"] }}</div>
              <a href="{{ $beca["link"] }}" target="_blank" rel="noopener noreferrer">
                <div class="link">Ver información</div>
              </a>
            </div>
          </div>
        @endforeach
      </div>
    </div>
  @endforeach
</div>
@endsection
