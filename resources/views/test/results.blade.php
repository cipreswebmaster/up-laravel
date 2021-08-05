@extends('base')

@section('styles')
  <link rel="stylesheet" href="{{ asset("css/results.css") }}">
@endsection

@section('title')
  Resultados del test
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

    function isInFavs($id_carrera, $favorites) {
      foreach ($favorites as $fav) {
        if ($fav["id_carrera"] == $id_carrera)
          return true;
      }
      return false;
    }
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

@if (Route::currentRouteName() != "results")
  <h2 align="center" style="margin-top: 15px; color: #fd0034; font-family: Poppins-ExtraBold; font-size: 40px">ESTE ES UN EJEMPLO DE TEST PREMIUM NO FUNCIONAL</h2>
@endif

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

  @if (Route::currentRouteName() != "results")
    <h2 align="center" style="margin: 50px; color: #fd0034; font-family: Poppins-ExtraBold; font-size: 40px">ESTE ES UN EJEMPLO DE TEST PREMIUM NO FUNCIONAL</h2>
  @endif
  
  <div class="sections">
    <div class="section">
      <div class="number">1</div>
      <div class="content">
        <div class="select_area">
          <h2 class="select_area_title">
            Selecciona un área de estudio:
          </h2>
          <div class="selec_tag_container">
            <select name="areas" id="areas">
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
                <div
                  class="stars_container selec"
                  area="{{ $prof["id_area"] }}"
                  id="prof-{{ $prof["id_carrera_4beyond"] }}"
                >
                  <div class="icon heart-icon">
                    <img
                      src="@if (isInFavs($prof["id_carrera_4beyond"], $favs))
                        {{ asset("images/test/results/heart-select.svg") }}
                      @else
                        {{ asset("images/test/results/heart-no-select.svg") }}
                      @endif"
                      id="heart-icon-img"
                      selected="{{ isInFavs($prof["id_carrera_4beyond"], $favs) }}"  
                    />
                  </div>
                  <div class="name">{{ $prof["nombre_carrera"] }}</div>
                  <div class="stars" af="{{ $prof["afinidad"] }}">
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
              <div class="stars_container" id="fav-{{ $fav["id_carrera"] }}">
                <div class="icon heart-icon">
                  <img 
                    src="{{ asset("images/test/results/heart-select.svg") }}"
                    selected="1"
                    alt="" />
                </div>
                <div class="name">{{ $fav["nombre_carrera"] }}</div>
                <div class="stars" af="{{ $fav["afinidad"] }}">
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
      @if (Route::currentRouteName() == "results")
        <div class="text">Descarga tu reporte</div>
      @else
        <div class="text">Descarga un ejemplo del test premium</div>
      @endif
    </a>
  </div>
</div>
@endsection

@if (Route::currentRouteName() == "results")
  @section('scripts')
  <script>
    const areas = document.getElementById("areas");
    hide(areas.value);

    areas.addEventListener("change", function (e) {
        hide(e.target.value);
    });

    const heartContainers = document.querySelectorAll(".icon.heart-icon");
    heartContainers.forEach((el) => {
        el.addEventListener("click", handleClick);
    });

    function hide(id_area) {
        const profs = document.querySelectorAll(".stars_container.selec");
        profs.forEach(function (el) {
            const area = el.getAttribute("area");
            if (area != id_area) el.classList.add("hide");
            else el.classList.remove("hide");
        });
    }

    function handleClick(e) {
        const favourites = document.querySelector(".careers_favs .list");
        const heart = e.target;
        if (heart.tagName !== "IMG") return;
        const id = heart.parentNode.parentNode.id.split("-")[1];
        const afinidad = heart.parentNode.parentNode.children[2].getAttribute("af");
        const isSelected = parseInt(heart.getAttribute("selected"));
        const heartUrl =
            location.protocol + "//" + location.host + "/images/test/results/";

        console.log(afinidad);
        if (isSelected) {
            editFavourite("DEL", afinidad, id).then(function (res) {
                heart.src = heartUrl + "heart-no-select.svg";
                heart.setAttribute("selected", "0");

                const favorite = document.getElementById("fav-" + id);
                favorite.parentNode.removeChild(favorite);

                // Cambiando icono en apartado de todas las carreras
                const carId = favorite.id.split("-")[1];
                const carEl = document.getElementById("prof-" + carId);
                const carElImg = carEl.children[0].children[0];
                carElImg.src = heartUrl + "heart-no-select.svg";
                carElImg.setAttribute("selected", "0");
            });
        } else {
            if (favourites.children.length == 5) return;
            editFavourite("ADD", afinidad, id).then(function (res) {
              heart.src = heartUrl + "heart-select.svg";
              heart.setAttribute("selected", "1");

              const heartParent = heart.parentNode.parentNode;
              const newFav = heartParent.cloneNode(true);
              newFav.id = "fav-" + id;

              // Creando botón de ver carrera
              const see_career = document.createElement("div");
              see_career.classList.add("see_career");
              const a = document.createElement("a");
              a.href =
                  location.protocol +
                  "//" +
                  location.host +
                  "/profesiones/" +
                  slug(newFav.childNodes[3].innerText);
              a.innerText = "ver carrera";

              see_career.appendChild(a);
              newFav.appendChild(see_career);
              newFav.removeEventListener("click", handleClick);
              newFav.addEventListener("click", handleClick);

              favourites.appendChild(newFav);
            });
        }
    }

    function slug(title = "") {
        // prettier-ignore
        const chars = ["á","é","í","ó","ú","ü","ñ","Á","É","Í","Ó","Ú","Ü","Ñ", ","];
        // prettier-ignore
        const replace = ["a","e","i","o","u","u","n","A","E","I","O","U","U","N", ""];

        let newWord = "";
        for (let i = 0; i < title.length; i++) {
            const curr = title.charAt(i);
            const charIndex = chars.indexOf(curr);
            newWord += charIndex > -1 ? replace[charIndex] : curr;
        }

        return newWord.trim().replaceAll(" ", "-").toLowerCase();
    }

    async function editFavourite(action, puntutation, id) {
        return fetch("https://apps4beyond.com/REST/api/editFavoritas", {
            method: "POST",
            headers: {
                token: "4bcgp-bgyt",
                "Content-Type": "application/json",
            },
            body: JSON.stringify({
                token_id: "{{ $token }}",
                puntuacion: puntutation,
                id_carrera: id,
                accion: action,
            }),
        }).then((res) => res.json());
    }
  </script>
  @endsection
@endif
