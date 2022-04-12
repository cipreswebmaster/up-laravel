<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Reporte actualizaciones universidades</title>
</head>
<body>
  <h1 align="center">Actualizaciones</h1>
  <table style="width: 100%">
    <thead>
      <tr>
        <th>Universidad</th>
        <th>Carrera</th>
        <th>Precio anterior</th>
        <th>Precio nuevo</th>
        <th>Fecha del cambio</th>
      </tr>
    </thead>
    <tbody>
      @foreach ($data as $actu)
        <tr>
          <td>{{ $actu["universidad"] }}</td>
          <td>{{ $actu["carrera"] }}</td>
          <td>{{ getPrice($actu["states"]["previous"]->precio_semestre) }}</td>
          <td>{{ getPrice($actu["states"]["new"]->precio_semestre) }}</td>
          <td>{{ $actu["fecha"] }}</td>
        </tr>
      @endforeach
    </tbody>
  </table>
</body>
</html>