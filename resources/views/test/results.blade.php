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

    $starsClasses = ["lowest", "low", "high", "highest"];
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
<div class="profile">
  <div class="before_begin">
    <div class="img">
      <img src="{{ asset("images/test/results/image.jpg") }}" alt="" />
    </div>
    <div class="text">
      <h2>Antes de comenzar</h2>
      <p>
        En esta sección podrás explotar la información de las diferentes áreas
        profesionales, al final podrás seleccionar las 5 carreras de tu
        interés las cuales sugerimos estén marcadas con estrellas azules y
        verdes. <br />
        <br />
        Por favor, sigue los pasos y lee cada indicación.
      </p>
    </div>
  </div>
  <div class="sections">
    <div class="section">
      <div class="number">1</div>
      <div class="content">
        <div class="select_area">
          <h2 class="select_area_title">
            Selecciona un área de estudio:
          </h2>
          <div class="selec_tag_container">
            <select name="areas">
              @foreach ($areas as $area)
                <option value="{{ $area["id_area"] }}">
                  {{ $area["nombre_area"] }}
                </option>
              @endforeach
            </select>
          </div>
        </div>
      </div>
    </div>
    <div class="instructions">
      <div class="title">¿Qué significan las estrellas?</div>
      <div class="descript">
        Porcentaje de afinidad con las carreras seleccionadas
      </div>
      <img src="{{ asset("images/test/results/stars.jpg") }}" alt="" />
    </div>

    {{-- Explorar carreras --}}
    <div class="section">
      <div class="number">2</div>
      <div class="content">
        <div class="explore">
          <div class="description">
            <div class="title">Explora las carreras</div>
            <p class="text">
              Frente a cada carrera verás estrellas de colores: Las azules y
              verdes son las que tienen mayor ajuste a tus fortalezas
              naturales, las amarillas las que presentan un ajuste medio de
              acuerdo a tus resultados y las rojas las que no y por tanto, no
              recomendamos que estudies.
            </p>
          </div>
          <div class="careers">
            <div class="stars_description">
              <div class="instructions">
                Añade o elimina hasta 5 carreras favoritas
              </div>
              <div class="instruc_descrip">
                Para seleccionar tus 5 carreras favoritas, haz click en el
                corazón. Para retirarla de tu lista de favoritas, vuelve a dar
                click en el corazón.
              </div>
            </div>
            <div class="list">
              @foreach ($profesiones as $prof)
                <div class="stars_container">
                  <div class="icon" >
                    <img
                      src="{{ asset("images/test/results/heart-select.svg") }}"
                      alt=""
                    />
                  </div>
                  <div class="name">{{ $prof["nombre_carrera"] }}</div>
                  <div class="stars">
                    @for ($i = 0; $i < intval($prof["afinidad"]); $i++)
                      <span class="star {{ $starsClasses[intval($prof["afinidad"]) - 1] }}" >
                        &#9733;
                      </span>
                    @endfor
                  </div>
                </div>
              @endforeach
            </div>
          </div>
        </div>
      </div>
    </div>

   <div class="section">
    <div class="number">3</div>
    <div class="content">
      <div class="favourite">
        <div class="description">
          <div class="title">Favoritos</div>
          <p class="text">
            Estas son tus carreras escogidas como "favoritas". Para conocer
            más información sobre ella, haz click sobre la carrera de
            interés. Estas carreras se verán reflejadas en tu reporte.
          </p>
        </div>
        <div class="careers_favs">
          <div class="list">
            @foreach ($favs as $fav)
              <div class="stars_container">
                <div class="icon">
                  <img src="{{ asset("images/test/results/heart-select.svg") }}" alt="" />
                </div>
                <div class="name">{{ $fav["nombre_carrera"] }}</div>
                <div class="stars">
                  @for ($i = 0; $i < intval($fav["afinidad"]); $i++)
                    <span class="star {{ $starsClasses[intval($fav["afinidad"]) - 1] }}" >
                      &#9733;
                    </span>
                  @endfor
                </div>
                <div class="see_career">
                  <a href="{{ route("profession", ["professionName" => Str::slug($fav["nombre_carrera"])]) }}">
                    ver carrera
                  </a>
                </div>
              </div>
            @endforeach
          </div>
        </div>
      </div>
    </div>
  </div>
  <a
      class="pdf"
      href="https://apps4beyond.com/REST/TeOrienta/pdf_integracion.php?tokenId={{ $token }}"
      target="_blank"
      rel="noopener noreferrer"
    >
      <div class="icon">
        <img src="{{ asset("images/test/results/pdf.svg") }}" alt="PDF Icon" />
      </div>
      <div class="text">Descarga tu reporte</div>
    </a>
  </div>
</div>
@endsection
