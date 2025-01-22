<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Notificación de asignación de PQRS</title>
<style>
  .tabla-solicitudes {
    width: 100%;
    border-collapse: collapse;
  }
  .tabla-solicitudes, .tabla-solicitudes th, .tabla-solicitudes td {
    border: 1px solid black;
  }
  .tabla-solicitudes th, .tabla-solicitudes td {
    padding: 10px;
    text-align: left;
  }
</style>
</head>
<body>
  <h2>Notificación {{$rad}} </h2>
  <br><p> Sr (a): {{$res}}, la oficina {{$ofic}} le ha asignado una PQRS para su gestión. A continuación el detalle de la misma:</p></br>


  <table class="tabla-solicitudes">
    <tr>
      <th>radicado</th>
      <th>fec_rad</th>
      <th>entidad</th>
      <th>peticionario</th>
      <th>fec_resp.</th>
      <th>dias_pen.</th>
    </tr>
    <tr>
      <td>{{$rad}}</td>
      <td>{{$fecrad}}</td>
      <td>{{$ent}}</td>
      <td>{{$pet}}</td>
      <td>{{$fecres}}</td>
      <td>{{$dias}}</td>
    </tr>
  </table>
<p> Agradecemos enviar a este mismo correo copia de la respuesta a la PQRS para registrarla en  la plataforma </p>
<P> Nota: {{$obs}}
</body>
</html>
