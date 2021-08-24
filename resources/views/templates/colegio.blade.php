<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Bienvenido a UP</title>
</head>
<body>
  <p>
    Hola {{ $name }}, te damos la bienvenida a <a href="https://universidadesyprofesiones.com">UP, la mejor plataforma de orientación profesional digital</a>.
    <br>
    Para poder ingresar a UP, haz clic <a href="https://universidadesyprofesiones.com/login">en este enlace</a>
    <br>

    A continuación te compartimos tus credenciales para que puedas ingresar: <br>

    <ul>
      <li>Correo: {{ $email }}</li>
      <li>Contraseña: {{ $pass }}</li>
    </ul>
    <br>
    Si tienes alguna duda o consulta, puedes visitar <a href="https://universidadesyprofesiones.com/contacto">nuestro apartado de contacto</a> y con gusto te ayudaremos.
  </p>
</body>
</html>