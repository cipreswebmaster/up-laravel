<!DOCTYPE html>
<html lang="es">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Código de verificación</title>
    <link rel="preconnect" href="https://fonts.gstatic.com" />
    <link
      href="https://fonts.googleapis.com/css2?family=Poppins:wght@500&display=swap"
      rel="stylesheet"
    />
  </head>
  <body
    style="
      padding: 0;
      margin: 0;
      box-sizing: border-box;
      font-family: 'Poppins', sans-serif;
    "
  >
    <div
      style="
        width: 600px;
        background-color: #f5f5f7;
        padding: 15px;
        position: relative;
        left: 50%;
        transform: translate(-50%);
        margin-top: 25px;
      "
    >
      <div style="display: flex; justify-content: center">
        <img src="{{ asset("images/mail_templates/logo-ppl.jpg") }}" alt="Logo" style="width: 60%; margin: 50px" />
      </div>
      <div style="background-color: #fff; text-align: center">
        <div
          style="
            font-size: 32px;
            padding: 25px;
            color: #ff4c64;
            font-style: italic;
          "
        >
          Código de confirmación
        </div>
        <div
          style="
            background-color: #f5f5f7;
            padding: 15px;
            margin: 10px 50px;
            font-weight: bold;
          "
        >
          <div style="font-size: 20px; font-weight: normal; font-size: 1rem">
            Por favor ingresa el siguiente código en la plataforma:
          </div>
          <div style="font-size: 48px; padding: 25px">{{ $code }}</div>
        </div>
        <div style="font-size: 20px; padding: 15px">
          Este código vencerá dentro de
          <span style="font-weight: bold">10 minutos</span> a partir de la hora
          de iniciada la sesión
        </div>
        <div style="padding-bottom: 10px">Equipo de UP</div>
      </div>
    </div>
  </body>
</html>
