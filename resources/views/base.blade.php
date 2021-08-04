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
  <link rel="stylesheet" href="{{ asset("css/general.css") }}">
  <link rel="stylesheet" href="{{ asset("css/header.css") }}">
  <link rel="stylesheet" href="{{ asset("css/footer.css") }}">
  @yield('styles')
</head>
<body>
  <x-header />
  <main>
    @yield('body')
  </main>
  <x-footer />

  <script src="{{ asset("js/popper.min.js") }}"></script>
  <script src="{{ asset("js/bootstrap.min.js") }}"></script>
  <script src="{{ asset("js/functions.js") }}"></script>
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