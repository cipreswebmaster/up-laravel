@extends('login.base')

@section('form')
  <div class="code_form">
    <div class="title">Te enviamos un código a {{ $_SESSION["email"] }}</div>
    <div class="return_login">
      <a href="{{ route("login") }}">¿Este no es tu correo?</a>
    </div>
    <form action="{{ route("comprobar_codigo") }}" method="POST">
      @csrf
      <input type="text" placeholder="Código de verificación" class="code_input" name="code" />
      <br />
      <button type="submit" class="verify">
        Verificar
      </button>
    </form>
    <div class="time">
      Tu código vence en: <span class="num">10:00</span> <br />
      <span style="font-size: 0.75rem">
        Si el correo no te ha llegado, revisa la bandeja de
        <i>Correos no deseados</i> o vuelve a iniciar sesión
      </span>
    </div>
  </div>

  <script>
    const timer = setInterval(countTime, 1000);
    let time = 600000;

    setTimeout(() => {
      clearInterval(timer);
      location.href = location.protocol + "//" + location.host + '/login';
    }, time);

    function countTime() {
      const numTag = document.querySelector(".time .num");
      time -= 1000;
      numTag.innerHTML = getTimeInMinutes(time);
      console.log(time);
    }

    function getTimeInMinutes(timeInMs) {
    const inMinutes = timeInMs / 60000;
    const integerPart = Math.trunc(inMinutes);
    // Obteniendo la parte decimal
    const numberFixed = inMinutes.toFixed(2);
    const numberAsString = numberFixed.toString();
    const decimalpart = parseInt(numberAsString.split(".")[1]);
    const decimalPartAsSeconds = Math.round((decimalpart * 60) / 100);

    let timeAsString = `${integerPart}:`;
    timeAsString +=
      decimalPartAsSeconds < 10
        ? `0${decimalPartAsSeconds}`
        : decimalPartAsSeconds;
    return timeAsString;
    }
  </script>
@endsection
