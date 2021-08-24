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
  <link rel="stylesheet" href="{{ mix("/css/general.css") }}">
  <link rel="stylesheet" href="{{ mix("/css/header.css") }}">
  <link rel="stylesheet" href="{{ asset("css/footer.css") }}">
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
    <script>
      if (!sessionStorage.getItem("share_popup_showed")) {
        setTimeout(function () {
          Swal.fire({
            html: 
              '<div style="position: relative;">' +
                '<img src="{{ asset('images/index/compartir.png') }}" class="share_img" />' +
                '<a href="whatsapp://send?text=¿Ya%20conoces%20UP%20La%20plataforma%20de%20orientación%20profesional%20más%20completa?%20Tienes%20que%20probarla: https://universidadesyprofesiones.com/" style="position: absolute; width: 40%; height: 14%; background-color: transparent; top: 53%; left: 3%; border: none; outline: none" target="_blank" rel="noopener noreferrer"></a>' +
              '</div>',
            showConfirmButton: false
          }).then(function () {
            sessionStorage.setItem("share_popup_showed", true);
          });
        }, 180000)
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
</body>
</html>