<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Guía de Remisión #{{ $guia->id }}</title>
  
</head>
<body>
    <div class="container mt-5">
        <h2>Guía de Remisión #{{ $guia->id }}</h2>
        <p>Fecha de Emisión: {{ $guia->fecha_emision }}</p>
        <p>N° de Guía: {{ $guia->nro_guia }}</p>
        <p>N° de Ticket: {{ $guia->nro_ticket }}</p>
        <p>Fecha de Partida: {{ $guia->fecha_partida }}</p>
        <p>Punto de Partida: {{ $guia->punto_partida }}</p>
        <p>Punto de Llegada: {{ $guia->punto_llegada }}</p>
        <p>Producto: {{ $guia->producto }}</p>
        <p>Peso Bruto: {{ $guia->peso_bruto }}</p>
        <p>Estado: {{ ucwords(str_replace('_', ' ', $guia->estado)) }}</p>
    </div>
</body>
</html>
