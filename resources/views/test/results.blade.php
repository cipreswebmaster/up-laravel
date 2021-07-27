@extends('base')

@section('styles')
  <link rel="stylesheet" href="{{ asset("css/results.css") }}">
@endsection

@php
    $icons = [
      [
        "title" => "Tu fortaleza",
        "icon" => "images/test/icons/fortaleza.svg",
        "descrip" =>
          "Aquí encontrarás una descripción y aspectos asociados a tu fortaleza natural, es decir, aquello en lo que naturalmente eres bueno.",
      ],
      [
        "title" => "Lado menos eficiente",
        "icon" => "images/test/icons/menos-eficiente.svg",
        "descrip" =>
          "Te permitirá identificar y conocer aquello que requerirá mayor esfuerzo, lo que si realizas en mayor propoción te hará sentirte cansado, poco motivado y frustrado.",
      ],
      [
        "title" => "Desarrollo de competencias",
        "icon" => "images/test/icons/competencias.svg",
        "descrip" =>
          "Podrás conocer cuáles son las habilidades que hoy tienes presentes y desarrolladas, seguramente están asociadas a cosas o tareas que realizas con frecuencia.",
      ],
      [
        "title" => "Tu personalidad",
        "icon" => "images/test/icons/personalidad.svg",
        "descrip" =>
          "Esta sección del reporte te permitirá conocer en mayor detalle cómo te ves y te perciben otras personas.",
      ],
      [
        "title" => "Tareas que te motivan",
        "icon" => "images/test/icons/motivacion.svg",
        "descrip" =>
          "Es claro que no todo puede motivarte, las tareas y actividades que te motivan están asociadas a tu fortaleza natural, situaciones en las que puedas poner a prueba el desarollo.",
      ],
    ];

    $descriptions = [
      [ "title" => $results["fortaleza"], "description" => $results["desc_fortaleza"] ],
      [ "title" => $results["opuesto"], "description" => $results["desc_opuesto"] ],
      [ "title" => $results["perfil"], "description" => $results["descripcion"] ],
      [ "description" => $results["personalidad"] ],
      [ "description" => $results["tareas_motivan"] ],
    ];
@endphp

@section('body')
<div class="before_begin">
  <div class="img">
    <img src="{{ asset("images/test/results-boy.png") }}" alt="" />
  </div>
  <div class="text">
    <div class="title">Antes de comenzar:</div>
    <div class="desciption">
      En esta etapa encontrarás información acerca de:
      <br />
      <br />
      <ul>
        <li>Tu fortaleza: Lo que se te facilita</li>
        <li>Tu lado menos eficiente: lo que se te dificulta</li>
        <li>
          Tu desarrollo de competencias: Podrás conocer cuáles con las
          habilidades que hoy tienes presentes y desarrolladas, seguramente
          están asociadas a cosas o tareas que realizas con frecuencia
        </li>
      </ul>
    </div>
  </div>
</div>

<div class="results">
  <h1 class="title">¿Qué dicen los resultados de ti?</h1>
  <div class="icons only-pc">
    @foreach ($icons as $icon)
      <div class="icon">
        <img src="{{ asset($icon["icon"]) }}" alt="Esto dicen los resultados de ti" />
        <div class="title">{{ $icon["title"] }}</div>
      </div>
    @endforeach
  </div>
  <div class="descriptions">
    @foreach ($descriptions as $i => $desc)
      <div class="descrip">
        <div class="info">
          <div class="title">
            {{$icons[$i]["title"]}}
            @if (isset($desc["title"]))
              {{ $desc["title"] }}
            @endif
          </div>
          <div class="text" >
          {!! $desc["description"] !!}
        </div>
        </div>
        <div class="res_desc">
          <div class="icon">
            <img src="{{ asset($icons[$i]["icon"]) }}" alt="{{ $icons[$i]["title"] }}" />
          </div>
          <div class="title">{{ $icons[$i]["title"] }}</div>
          <div class="desc">{{ $icons[$i]["descrip"] }}</div>
        </div>
      </div>
    @endforeach
  </div>
</div>
@endsection
