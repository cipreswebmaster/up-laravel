@php
  if (session_status() == 1)
    session_start();
@endphp
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  @yield('metatags')
  <title>@yield('title') | Elige qué estudiar en la universidad con UP ✅</title>
  <link rel="stylesheet" href="{{ asset("css/bootstrap.min.css") }}">
  <link rel="stylesheet" href="{{ mix("/css/general.css") }}">
  <link rel="stylesheet" href="{{ mix("/css/header.css") }}">
  <link rel="stylesheet" href="{{ asset("css/footer.css") }}">
  @yield('styles')
</head>
<body>
  <x-header />
  <main>
    @yield('body')
  </main>
  <x-footer />

  <script src="{{ asset("js/swal.min.js") }}"></script>
  <script src="{{ asset("js/popper.min.js") }}"></script>
  <script src="{{ asset("js/bootstrap.min.js") }}"></script>
  <script src="{{ asset("js/functions.js") }}"></script>
  @if (Request::is("/"))
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
  @endif
  <script>
    if (!sessionStorage.getItem("share_popup_showed")) {
      setTimeout(function () {
        Swal.fire({
          html: 
            '<div style="position: relative;">' +
              '<img src="{{ asset('images/index/compartir.png') }}" class="share_img" />' +
              '<a href="whatsapp://send?text=¿Ya%20conoces%20UP%20La%20plataforma%20de%20orientación%20profesional%20más%20completa!%20Tienes%20que%20probarla: https://universidadesyprofesiones.com/" style="position: absolute; width: 40%; height: 14%; background-color: transparent; top: 53%; left: 3%; border: none; outline: none" target="_blank" rel="noopener noreferrer"></a>' +
            '</div>',
          showConfirmButton: false
        }).then(function () {
          sessionStorage.setItem("share_popup_showed", true);
        });
      }, 180000)
    }
  </script>
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
</body>
</html>