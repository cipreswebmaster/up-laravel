@php
  if (session_status() == 1)
    session_start();
@endphp
<!DOCTYPE html>
<html lang="en" prefix="og: http://ogp.me/ns#">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="keywords" content="@yield('keywords')">
  <meta name="description" content="@yield('description')">
  <meta property="og:url" content="{{ Request::url() }}" />
  <meta property="og:type" content="website" />
  <meta property="og:title" content="@yield('title') | Universidades y Profesiones UP ✅" />
  <meta property="og:description" content="@yield('description')" />
  <meta property="og:image" content="@yield('og_image_url')" />
  <meta property="og:image:alt" content="@yield('og_image_alt')">
  @yield('metatags')
  <title>@yield('title') | Elige qué estudiar en la universidad con UP ✅</title>

  @if (!env("APP_DEBUG"))
    <!-- Google Tag Manager -->
    <script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
    new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
    j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
    'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
    })(window,document,'script','dataLayer','GTM-MWKSX3V');</script>
    <!-- End Google Tag Manager -->
  @endif

  <link rel="stylesheet" href="{{ asset("css/bootstrap.min.css") }}">
  <link rel="stylesheet" href="{{ asset("css/swal.min.css") }}">
  <link rel="stylesheet" href="{{ mix("/css/general.css") }}">
  <link rel="stylesheet" href="{{ mix("/css/header.css") }}">
  <link rel="stylesheet" href="{{ mix("css/footer.css") }}">
  @yield('styles')
</head>
<body>

  @if (!env("APP_DEBUG"))
    <!-- Google Tag Manager (noscript) -->
    <noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-MWKSX3V"
    height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
    <!-- End Google Tag Manager (noscript) -->
  @endif

  <x-header />
  <main>
    @yield('body')
  </main>
  <x-footer />

  <script src="{{ asset("js/swal.min.js") }}"></script>
  <script src="{{ asset("js/popper.min.js") }}"></script>
  <script src="{{ asset("js/bootstrap.min.js") }}"></script>
  <script src="{{ asset("js/functions.js") }}"></script>

  @if (!isset($_SESSION["logged"]))
    <style>
      .swal2-popup{
        width: 875px !important;
      }

      .share_img {
        width: auto !important;
      }

      @media only screen and (max-width: 768px) {
        .share_img {
          width: 100% !important
        }
      }
    </style>

    <style>
      .financiero-container {
        position: relative;
      }

      .correcion {
        position: absolute;
        top: 0;
        left: 0;
        z-index: 100;
        width: 54%;
      }

      .financiero-container .formulario {
        position: absolute;
        z-index: 101;
        top: 32%;
        left: 0;
        width: 54%;
        margin-left: 15px;
        display: flex;
        flex-direction: column;
      }

      .financiero-container .formulario input,
      .financiero-container .formulario select {
        margin-bottom: 15px;
        width: 80%;
        outline: none;
        padding: 5px;
      } 

      .financiero-container .formulario .enviar {
        border: none;
        outline: none;
        background-color: rgba(255,200,87, 1);
        width: 80%;
        padding: 5px;
      }

      .financiero-container .close {
        position: absolute;
        z-index: 102;
        top: -2%;
        right: 1%;
        font-size: 30px;
        font-weight: bold;
        cursor: pointer;
      }

      @media only screen and (max-width: 768px) {
        #swal2-html-container {
          overflow: hidden;
        }

        .financiero-container {
          /* height: 75vh; */
        }
        
        .financiero-container .main-img {
          width: 184%;
          height: 100%;
        }

        .financiero-container .correcion {
          width: 100%;
          height: 30%;
        }

        .financiero-container .formulario {
          width: 90%;
        }

        .financiero-container .formulario input,
        .financiero-container .formulario select,
        .financiero-container .formulario .enviar {
          width: 100%;
          height: 30px;
          font-size: 11px;
        }
      }
    </style>
    <script>
      // if (!sessionStorage.getItem("share_popup_showed")) {
      //   setTimeout(function () {
      //     Swal.fire({
      //       html: 
      //         '<div style="position: relative;">' +
      //           '<img src="{{ asset('images/index/compartir.png') }}" class="share_img" />' +
      //           '<a href="whatsapp://send?text=¿Ya%20conoces%20UP%20La%20plataforma%20de%20orientación%20profesional%20más%20completa?%20Tienes%20que%20probarla: https://universidadesyprofesiones.com/" style="position: absolute; width: 40%; height: 14%; background-color: transparent; top: 53%; left: 3%; border: none; outline: none" target="_blank" rel="noopener noreferrer"></a>' +
      //         '</div>',
      //       showConfirmButton: false
      //     }).then(function () {
      //       sessionStorage.setItem("share_popup_showed", true);
      //     });
      //     ajustarEnVentanasGrandes();
      //   }, 180000);
      // }

      if (!sessionStorage.getItem("financiero_showed")) {
        setTimeout(function () {
          Swal.fire({
            html:
              '<div class="financiero-container">' +
                '<span class="close">&times;</span>' +
                '<img src="{{ asset('images/index/financiero.gif') }}" />' +
                '<img class="correcion" src="{{ asset('images/index/financiero-final.png') }}" />' +
                '<div class="formulario">' +
                  '<form action="{{ route("lead-financiero") }}" method="POST">' +
                    '@csrf' +
                    '<input type="text" placeholder="Nombre" id="nombre" name="nombre" required />' +
                    '<input type="email" placeholder="Correo" id="correo" name="correo" required />' +
                    '<select id="monto" name="monto" required>' +
                      '<option>Monto</option>' +
                      '<option value="$300.000 - $500.000">$300.000 - $500.000</option>' +
                      '<option value="$500.000 - $700.000">$500.000 - $700.000</option>' +
                      '<option value="$700.000 - $ 1\'000.000">$700.000 - $ 1\'000.000</option>' +
                      '<option value="$1\'000.000 - 3\'000.000">$1\'000.000 - 3\'000.000</option>' +
                    '</select>' +
                    '<select id="uso" name="uso" required>' +
                      '<option>¿Para qué lo usarías?</option>' +
                      '<option value="Pensión">Pensión</option>' +
                      '<option value="Matrícula">Matrícula</option>' +
                      '<option value="Útiles escolares">Útiles escolares</option>' +
                      '<option value="Cursos">Cursos</option>' +
                      '<option value="Excursiones">Excursiones</option>' +
                      '<option value="Uniformes">Uniformes</option>' +
                      '<option value="Tecnología">Tecnología</option>' +
                      '<option value="Otros">Otros</option>' +
                    '</select>' +
                    '<button type="submit" class="enviar">Enviar</button>' +
                  '</form>' +
                '</div>' +
              '</div>',
            showConfirmButton: false,
            didOpen: function () {
              const close = document.querySelector(".financiero-container .close");
              close.addEventListener("click", function () {
                Swal.close();
              });

              const submit = document.querySelector(".financiero-container .enviar");
              submit.addEventListener("click", function () {
                gtag('event', 'Click', {
                  'event_category': "Cipres Servicios Financieros",
                  "event_label": "{{ Request::url() }}"
                });
              });
            }
          }).then(function () {
            sessionStorage.setItem("financiero_showed", true);
          });
          ajustarEnVentanasGrandes();
        }, 30000);
      }

      if (!sessionStorage.getItem("financiero2_showed")) {
        setTimeout(function () {
          Swal.fire({
            html:
              '<div class="financiero-container">' +
                '<span class="close">&times;</span>' +
                '<img src="{{ asset('images/index/financiero.gif') }}" />' +
                '<img class="correcion" src="{{ asset('images/index/financiero-final.png') }}" />' +
                '<div class="formulario">' +
                  '<form action="{{ route("lead-financiero") }}" method="POST">' +
                    '@csrf' +
                    '<input type="text" placeholder="Nombre" id="nombre" name="nombre" required />' +
                    '<input type="email" placeholder="Correo" id="correo" name="correo" required />' +
                    '<select id="monto" name="monto" required>' +
                      '<option>Monto</option>' +
                      '<option value="$300.000 - $500.000">$300.000 - $500.000</option>' +
                      '<option value="$500.000 - $700.000">$500.000 - $700.000</option>' +
                      '<option value="$700.000 - $ 1\'000.000">$700.000 - $ 1\'000.000</option>' +
                      '<option value="$1\'000.000 - 3\'000.000">$1\'000.000 - 3\'000.000</option>' +
                    '</select>' +
                    '<select id="uso" name="uso" required>' +
                      '<option>¿Para qué lo usarías?</option>' +
                      '<option value="Pensión">Pensión</option>' +
                      '<option value="Matrícula">Matrícula</option>' +
                      '<option value="Útiles escolares">Útiles escolares</option>' +
                      '<option value="Cursos">Cursos</option>' +
                      '<option value="Excursiones">Excursiones</option>' +
                      '<option value="Uniformes">Uniformes</option>' +
                      '<option value="Tecnología">Tecnología</option>' +
                      '<option value="Otros">Otros</option>' +
                    '</select>' +
                    '<button type="submit" class="enviar">Enviar</button>' +
                  '</form>' +
                '</div>' +
              '</div>',
            showConfirmButton: false,
            didOpen: function () {
              const close = document.querySelector(".financiero-container .close");
              close.addEventListener("click", function () {
                Swal.close();
              });
              
              const submit = document.querySelector(".financiero-container .enviar");
              submit.addEventListener("click", function () {
                gtag('event', 'Click', {
                  'event_category': "Cipres Servicios Financieros",
                  "event_label": "{{ Request::url() }}"
                });
              });
            }
          }).then(function () {
            sessionStorage.setItem("financiero2_showed", true);
          });
          ajustarEnVentanasGrandes();
        }, 90000);
      }

      <?php if (isset($_GET["show_success"])): ?>
          Swal.fire({
            icon: "success",
            text: "Tu solicitud ha sido enviada con éxito. Pronto nos contactaremos contigo."
          });
      <?php endif; ?>

      // if (!sessionStorage.getItem("universidades_popup_showed")) {
      //   setTimeout(function () {
      //     Swal.fire({
      //       html: 
      //         '<div style="position: relative;">' +
      //           '<a href="https://universidadesyprofesiones.com/universidades" target="_blank" rel="noopener noreferrer" style="border: none;">' +
      //             '<img src="{{ asset('images/index/universidades-popup.png') }}" class="share_img" />' +
      //           '</a>' +
      //         '</div>',
      //       showConfirmButton: false
      //     }).then(function () {
      //       sessionStorage.setItem("universidades_popup_showed", true);
      //     });
      //     ajustarEnVentanasGrandes();
      //   }, 5000);
      // }

      function ajustarEnVentanasGrandes() {
        const top = document.documentElement.scrollTop;
        const swalContainer = document.querySelector(".swal2-container.swal2-center.swal2-backdrop-show");
        swalContainer.style.height = "100vh";
        swalContainer.style.position = "absolute";
        swalContainer.style.top = top + "px";
      }
    </script>
  @endif
  @if (!env("APP_DEBUG"))
    <!-- Global site tag (gtag.js) - Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-184506190-1"></script>
    <script>
      window.dataLayer = window.dataLayer || [];
      function gtag(){dataLayer.push(arguments);}
      gtag('js', new Date());

      gtag('config', 'UA-184506190-1');
    </script>
  @endif
  @yield('scripts')
  @yield("modal")
</body>
</html>