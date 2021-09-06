@extends('base')

@section('metatags')
  <meta name="keywords" content="universidades, {{ $profession["nombre_carrera"] }}" />
@endsection

@section('title')
  {{ $profession["nombre_carrera"] }}
@endsection

@section('styles')
  <link rel="stylesheet" href="{{ mix("css/profesion.css") }}">
@endsection

@php
  $sidebarSections = [
    ["Acerca de", "acerca-de"],
    ["Dirigido a", "dirigido-a"],
    ["Habilidades que obtendrás", "habilidades"],
    ["¿En dónde te puedes desempeñar?", "especializar"],
    ["Habilidades para esta carrera", "requerimientos"],
    ["¿Por qué estudiar esta profesión?", "razon-estudio"],
    ["Áreas de especialización", "cargos"],
    ["Posgrados", "posgrados"],
    ["Otras carrereas relacionadas...", "carreras-rel"],
];
@endphp

@section('body')
  <x-banner
    :topText="$profession['nombre_carrera']"
    :img="$profession['imagen_carrera']"
    :isProfession="true"
    arrow="prof"
  />
  <div class="columns" style="margin-top: 25px">
    <div class="column">
      <x-youtube :videoId="$profession['codigo_video']" containerClass="video" class="frame" />
      <div class="side_menu only-pc">
        @foreach ($sidebarSections as $i => $sec)
          <div class="career_menu_section {{ !$i ? 'active' : ''}}" data-id="{{ $sec[1] }}">
            <div class="drawing">
              <div class="circle"></div>
              <div class="line"></div>
            </div>
            <div class="name">{{ $sec[0] }}</div>
          </div>
        @endforeach
      </div>
    </div>
    <div class="column">
      @if ($fourBeyondData)
        <div class="profit-graph">
          <div class="graph">
            <div class="wages">
              <div class="wages-title">
                Cuanto ganarás en los próximos 5 años:
              </div>
              <canvas id="lineChart" width="100" height="100"></canvas>
            </div>
            <div class="employability">
              <div class="donut">
                <div>
                  <div class="title">Empleabilidad</div>
                  <canvas id="doughnutChart" width="100" height="200"></canvas>
                </div>
                <div class="percentage">
                  {{ $fourBeyondData["empleabilidad"] }}%<div>de empleabilidad</div>
                </div>
              </div>
            </div>
          </div>
        </div>
      @endif
      <div class="sections">
        {{-- ACERCA DE LA PROFESION --}}
        <div class="single_section profession-section" id="acerca-de">
          <div class="style_line">
            <div class="point" style="border-color: rgb(250, 90, 76)">
              <div
                class="small_point"
                style="background-color: rgb(250, 90, 76)"
              ></div>
            </div>
            <div class="line"></div>
          </div>
          <div class="info">
            <div class="sec_title">
              <h2>Acerca de la profesión</h2>
            </div>
            <br />
            <div class="sec_content">
              {{ $profession["descripcion_carrera"] }}
            </div>
          </div>
        </div>

        {{-- DIRIGIDO A --}}
        <div class="single_section profession-section" id="dirigido-a">
          <div class="style_line">
            <div class="point" style="border-color: rgb(250, 90, 76)">
              <div
                class="small_point"
                style="background-color: rgb(250, 90, 76)"
              ></div>
            </div>
            <div class="line"></div>
          </div>
          <div class="info">
            <div class="sec_title">
              <h2>Dirigido a</h2>
            </div>
            <br />
            <div class="sec_content">
              {{ $profession["dirigido_a"] }}
            </div>
          </div>
        </div>

        {{-- HABILIDADES QUE OBTENDRAS --}}
        <div class="single_section profession-section" id="habilidades">
          <div class="style_line">
            <div class="point" style="border-color: rgb(250, 90, 76)">
              <div
                class="small_point"
                style="background-color: rgb(250, 90, 76)"
              ></div>
            </div>
            <div class="line"></div>
          </div>
          <div class="info">
            <div class="sec_title">
              <h2>Habilidades que obtendrás</h2>
            </div>
            <br />
            <div class="sec_content">
              <div class="catalogue">
                <div class="actual_phase" id="actual_phase">
                  <div class="p_img">
                    <img src="{{ env("API_URL") . "/images/habilidades/" . $profession["habilidades"][0]["image"] }}" />
                  </div>
                  <div class="p_info">
                    <div class="p_title">{{ $profession["habilidades"][0]["title"] }}</div>
                    <div class="p_descrip">{{ $profession["habilidades"][0]["content"] }}</div>
                  </div>
                </div>
                <div class="phases_list">
                  @foreach ($profession["habilidades"] as $i => $hab)
                    <div class="phase @if(!$i)active @endif" >
                      <div class="img">
                        <img src="{{ env("API_URL") . "/images/habilidades/" . $hab["image"] }}" />
                      </div>
                      <div class="title">{{ $hab["title"] }}</div>
                      <div class="description" style="display: none">{{ $hab["content"] }}</div>
                    </div>
                  @endforeach
                </div>
              </div>
            </div>
          </div>
        </div>

        {{-- ¿EN DÓNDE TE PUEDES DESEMPEÑAR? --}}
        <div class="single_section profession-section" id="especializar">
          <div class="style_line">
            <div class="point" style="border-color: rgb(250, 90, 76)">
              <div
                class="small_point"
                style="background-color: rgb(250, 90, 76)"
              ></div>
            </div>
            <div class="line"></div>
          </div>
          <div class="info">
            <div class="sec_title">
              <h2>¿En dónde te puedes desempeñar?</h2>
            </div>
            <br />
            <div class="sec_content">
              <div class="list">
                @foreach ($profession["especializar"] as $i)
                  <div class="item red">
                    {{ trim($i) }}
                  </div>
                @endforeach
              </div>
            </div>
          </div>
        </div>

        {{-- HABILIDADES A TENER EN CUENTA --}}
        <div class="single_section profession-section" id="requerimientos">
          <div class="style_line">
            <div class="point" style="border-color: rgb(250, 90, 76)">
              <div
                class="small_point"
                style="background-color: rgb(250, 90, 76)"
              ></div>
            </div>
            <div class="line"></div>
          </div>
          <div class="info">
            <div class="sec_title">
              <h2>Estas son algunas habilidades que debes tener para ser un buen profesional en {{ $profession["nombre_carrera"] }}</h2>
            </div>
            <br />
            <div class="sec_content">
              <div class="catalogue">
                <div class="actual_phase" id="actual_req">
                  <div class="p_img">
                    <img src="{{ env("API_URL") . "/images/habilidades/" . $profession["requerimientos_perfil"][0]["image"] }}" />
                  </div>
                  <div class="p_info">
                    <div class="p_title">{{ $profession["requerimientos_perfil"][0]["title"] }}</div>
                    <div class="p_descrip">{{ $profession["requerimientos_perfil"][0]["content"] }}</div>
                  </div>
                </div>
                <div class="phases_list" id="reqs_list">
                  @foreach ($profession["requerimientos_perfil"] as $i => $hab)
                    <div id="req" class="phase @if(!$i)active @endif" >
                      <div class="img">
                        <img src="{{ env("API_URL") . "/images/habilidades/" . $hab["image"] }}" />
                      </div>
                      <div class="title">{{ $hab["title"] }}</div>
                      <div class="description" style="display: none">{{ $hab["content"] }}</div>
                    </div>
                  @endforeach
                </div>
              </div>
            </div>
          </div>
        </div>

        {{-- ¿PORQUÉ ESTUDIAR ESTA CARRERA? --}}
        <div class="single_section profession-section" id="razon-estudio">
          <div class="style_line">
            <div class="point" style="border-color: rgb(57, 181, 74)">
              <div
                class="small_point"
                style="background-color: rgb(57, 181, 74)"
              ></div>
            </div>
            <div class="line"></div>
          </div>
          <div class="info">
            <div class="sec_title">
              <h2>¿Por qué estudiar {{ $profession["nombre_carrera"] }}?</h2>
            </div>
            <br />
            <div class="sec_content">
              <ul>
                @foreach ($profession["razon_estudio"] as $i)
                  <li>{{ $i }}</li>
                @endforeach
              </ul>
            </div>
          </div>
        </div>

        {{-- SECCIÓN DOBLE --}}
        <div class="doble_section">
          <div class="single_section profession-section" id="cargos">
            <div class="style_line">
              <div class="point" style="border-color: rgb(46, 99, 175)">
                <div
                  class="small_point"
                  style="background-color: rgb(46, 99, 175)"
                ></div>
              </div>
              <div class="line"></div>
            </div>
            <div class="info">
              <div class="sec_title">
                <h2>Áreas de especialización</h2>
              </div>
              <br />
              <div class="sec_content">
                <ul class="no_styled_list">
                  @foreach ($profession["areas_desempenio"] as $i)
                    <li>{{ $i }}</li>
                  @endforeach
                </ul>
              </div>
            </div>
          </div>
          <div class="single_section profession-section" id="posgrados">
            <div class="style_line no_line">
              <div class="point" style="border-color: rgb(46, 99, 175)">
                <div
                  class="small_point"
                  style="background-color: rgb(46, 99, 175)"
                ></div>
              </div>
              <div class="line"></div>
            </div>
            <div class="info">
              <div class="sec_title">
                <h2>Posgrados</h2>
              </div>
              <br />
              <div class="sec_content">
                <ul class="no_styled_list">
                  @foreach ($profession["posgrados"] as $i)
                    <li>{{ $i }}</li>
                  @endforeach
                </ul>
              </div>
            </div>
          </div>
        </div>

        {{-- OTRAS CARRERAS RELACIONADAS --}}
        <div class="single_section profession-section" id="carreras-rel">
          <div class="style_line">
            <div class="point" style="border-color: rgb(46, 99, 175)">
              <div
                class="small_point"
                style="background-color: rgb(46, 99, 175)"
              ></div>
            </div>
            <div class="line"></div>
          </div>
          <div class="info">
            <div class="sec_title">
              <h2>Otras carreras relacionadas con {{ $profession["nombre_carrera"] }}</h2>
            </div>
            <br />
            <div class="sec_content">
              <div class="list">
                @php
                  $exceptions = [
                    "Administración de Mercado y Logística Internacionales",
                    "Gestión Deportiva",
                    "Administración de Empresas y Gestión Ambiental",
                    "Matemáticas",
                    "Ingeniería en Ciencia de Datos",
                    "Ingeniería Biotecnológica",
                    "Agronomía"
                  ]
                @endphp
                @foreach ($profession["carreras_rel"] as $i)
                  @if (!in_array($i, $exceptions))
                    <div class="item blue">
                      <a href="{{ route("profession", ["professionName" => Str::slug($i)]) }}">{{ trim($i) }}</a>
                    </div>
                  @endif
                @endforeach
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="where_to_study">
    <div class="where">
      <div class="inner_content">
        <a href="/universidades/p/{{ Str::slug($professionName) }}">¿Dónde estudiar?</a>
      </div>
    </div>
  </div>
@endsection

@php
  $empleabilidad = $fourBeyondData["empleabilidad"] ?? [];
@endphp

@section('scripts')
  <script src="{{ asset("js/chartjs.js") }}"></script>
  <script src="{{ mix("/js/profession-events.js") }}"></script>
  @if ($fourBeyondData)
    <script>
      /** CHARTJS CONFIG */
      const lineChartCtx = document.getElementById('lineChart').getContext('2d');
      new Chart(lineChartCtx, {
        type: 'line',
        data: {
          "labels": ["", "1er año: {{ $fourBeyondData['uno'] }}", "5to año: {{ $fourBeyondData['cinco'] }}"],
          "datasets": [
            {
              "fill": false,
              "borderColor": "#fff",
              "pointBorderColor": "#fff",
              "data": [0, {{ $fourBeyondData['uno'] }}, {{ $fourBeyondData['cinco'] }}]
            }
          ]
        },
        options: {
          "maintainAspectRatio": false,
          "responsive": true,
          "legend": {
            "display": false
          },
          "scales": {
            "xAxes": [
              {
                "ticks": {
                  "fontColor": "#fff"
                },
                "gridLines": {
                  "display": false
                }
              }
            ],
            "yAxes": [
              {
                "ticks": {
                  "fontColor": "#fff",
                  "precision": 1,
                  "beginAtZero": true,
                  "maxTicksLimit": 6,
                  stepSize: {{ ($fourBeyondData['cinco'] - $fourBeyondData['uno']) / 5 }}
                },
                "gridLines": {
                  "color": "#fff",
                  "borderDash": [5, 10]
                }
              }
            ]
          }
        }
      });

      const doughnutChartCtx = document.getElementById("doughnutChart").getContext("2d"); 
      new Chart(doughnutChartCtx, {
        type: "doughnut",
        data: {
          "labels": ["% de desempleados", "% de empleados"],
          "datasets": [
            {
              "data": [100 - {{ $empleabilidad }}, {{ $empleabilidad }}],
              "backgroundColor": ["rgb(151,177,215)", "white"]
            }
          ]
        },
        options: {
          "maintainAspectRatio": false,
          "responsive": true,
          "legend": {
            "display": false
          },
          "cutoutPercentage": 50
        }
      });
    </script>
  @endif
@endsection
