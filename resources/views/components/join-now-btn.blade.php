@if (!isset($_SESSION["logged"]))
  <a
    href="{{ route("registrate") }}"
    class="join_now @if ($big) 'big' @endif">
    Regístrate gratis
  </a>

  <style>
  .join_now {
    display: inline-block;
    background-color: #f65a4d;
    color: #fff;
    font-weight: bold;
    padding: 15px 25px;
    margin-top: 15px;
    border-radius: 5px;
    margin-bottom: 15px;
  }

  .join_now:hover {
    color: #fff;
  }

  .join_now.big {
    font-size: 1.5rem;
  }
  </style>
@endif