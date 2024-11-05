<!-- resources/views/guias/pdf.blade.php -->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Guía de Remisión #{{ $guia->id }}</title>
    <style>
        body {
            font-family: 'DejaVu Sans', sans-serif;
        }
        .container {
            width: 100%;
            margin: 0 auto;
        }
        .text-center {
            text-align: center;
        }
        .text-left {
            text-align: left;
        }
        .text-right {
            text-align: right;
        }
        .text-dark {
            color: #000;
        }
        .bg-success {
            background-color: #28a745;
        }
        .text-white {
            color: #fff;
        }
        .border {
            border: 1px solid #000;
        }
        .rounded {
            border-radius: .25rem;
        }
        .card {
            border: 1px solid #000;
            border-radius: .25rem;
            padding: .75rem;
            margin-bottom: 1rem;
        }
        .card-header, .card-body, .card-footer {
            margin-bottom: .75rem;
        }
        .section-title {
            font-weight: bold;
            text-decoration: underline;
            margin-bottom: .5rem;
        }
        .section {
            margin-bottom: 1rem;
        }
        table {
            width: 100%;
            margin-bottom: 1rem;
            border-collapse: collapse;
        }
        th, td {
            border: 1px solid #000;
            padding: .5rem;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <div class="logo-container text-center">
                <span class="logo">
                    <img src="https://i.pinimg.com/736x/0d/f7/d7/0df7d7809deb55e136611adeee8d0554.jpg" alt="Logo de la Empresa" >
                </span>
                <h6>SISTEMA DE GUIAS</h6>
            </div>
            <div class="data text-dark">
                <h6 class="text-center rounded border bg-success text-white">COMPUSIS E.I.R.L.</h6>
                <p class="text-center">Somos una empresa dedicada al servicio de Desarrollo de Software</p>
                <p class="text-center">
                    <strong>Dirección:</strong> Av. Nicolas de Pierola # 123<br>
                    <strong>Correo electrónico:</strong> info@empresa.com <br>
                    <strong>Teléfono:</strong> +123456789 <br>
                    <strong>Página web:</strong> <a href="https://www.empresa.com">www.empresa.com</a>
                </p>
            </div>
            <div class="ruc">
                <div class="card">
                    <div class="card-header text-dark">
                        <span>R.U.C. {{ $agricultor->ruc }}</span>
                    </div>
                    <div class="card-body text-dark">
                        <span>GUIA DE REMISION</span>
                    </div>
                    <div class="card-footer text-dark text-center">
                        <strong>N° {{ $guia->nro_guia }}</strong>
                    </div>
                </div>
            </div>
            <div class="col text-dark text-left ml-2" style="padding:0 10px;">
                <p class="date">
                    <strong>Fecha de Emisión:</strong> {{ $guia->fecha_emision }}
                    <strong>Fecha de Inicio de Traslado:</strong> {{ $guia->fecha_partida }}
                </p>
            </div>
        </div>
        <div class="fechas"></div>
        <div class="card card-partida">
            <div class="section-title">PUNTO DE PARTIDA</div>
            <p><strong>Dirección:</strong> {{ $guia->punto_partida }}</p>
            <hr>
        </div>
        <div class="card card-llegada">
            <div class="section-title">PUNTO DE LLEGADA</div>
            <p><strong>Dirección:</strong> {{ $guia->punto_llegada }}</p>
            <hr>
        </div>
        <div class="section mt-1">
            <div class="section-title">REMITENTE (AGRICULTOR):</div>
            <table>
                <tr>
                    <th>Razón Social:</th>
                    <td>{{ $agricultor->razon_social }}</td>
                </tr>
                <tr>
                    <th>Dirección:</th>
                    <td>{{ $agricultor->direccion }}</td>
                </tr>
            </table>
        </div>
        <div class="section section-destinatario">
            <div class="section-title">DESTINATARIO:</div>
            <table>
                <tr>
                    <th>R.U.C.:</th>
                    <td>{{ $transportista->RUC }}</td>
                </tr>
                <tr>
                    <th>Razón Social:</th>
                    <td>{{ $transportista->razon_social }}</td>
                </tr>
                <tr>
                    <th>Dirección:</th>
                    <td>{{ $transportista->direccion }}</td>
                </tr>
            </table>
        </div>
        <div class="section section-vehiculo">
            <div class="section-title">UNIDAD DE TRANSPORTE / CONDUCTOR</div>
            <p>
                <span class="text-in"><strong>N° de placa del vehículo:</strong> </span>
                <span class="text-fi text-left"><strong>N° de placa de la carreta:</strong> </span>
            </p><br>
            <p>
                <span class="text-in"><strong>Apellidos y Nombres:</strong> </span>
                <span class="text-fi text-left"><strong>N° de brevete:</strong> </span>
            </p><br>
            <hr>
        </div>
        <div class="section section-carga">
            <div class="section-title">DESCRIPCION DE LA MERCANCIA:</div>
            <table>
                <tr>
                    <th>Producto</th>
                    <th>Cantidad</th>
                </tr>
                <tr>
                    <td>Cajas de manzanas</td>
                    <td>500 kg</td>
                </tr>
                <tr>
                    <td>Sacos de patatas</td>
                    <td>300 kg</td>
                </tr>
            </table>
        </div>
        <div class="section">
            <div class="section-title">DATOS DEL TRANSPORTISTA:</div>
            <table>
                <tr>
                    <th>R.U.C.:</th>
                    <td>{{ $transportista->RUC }}</td>
                </tr>
                <tr>
                    <th>Razón Social:</th>
                    <td>{{ $transportista->razon_social }}</td>
                </tr>
                <tr>
                    <th>Dirección:</th>
                    <td>{{ $transportista->direccion }}</td>
                </tr>
            </table>
        </div>
        <div class="section section-traslate">
            <div class="section-title">MOTIVO DEL TRASLADO:</div>
            <div>
                <ul class="checkbox-list">
                    <li>Venta</li>
                    <li>Sujeta a Firma</li>
                    <li>Compra</li>
                    <li>Consignación</li>
                </ul>
                <ul class="checkbox-list list-check">
                    <li>Devolución</li>
                    <li>Importación</li>
                    <li>Exportación</li>
                    <li>Otros</li>
                </ul>
            </div>
        </div>
    </div>
</body>
</html>
