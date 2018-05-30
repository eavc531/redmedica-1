<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <meta http-equiv="X-UA-Compatible" content="ie=edge">
   <title>Document</title>
</head>
<body>

  <h2>"Notificación de Cambio de Cita Medicossi"</h2>

    <p>Un Cordial saludo: {{$patient->name}} {{$patient->lastName}}, le notificamos que el Profesional Médico: {{$medico->name}} {{$medico->lastName}}, Especialista en: {{$medico->specialty}}, a cambiado la fecha de su Cita estipulada para: {{$before_date}} por la Fecha:{{\Carbon\Carbon::parse($event->start)->format('d-m-Y')}}, Hora:{{\Carbon\Carbon::parse($event->start)->format('H:i')}}. Feliz Dia.

</body>
</html>
