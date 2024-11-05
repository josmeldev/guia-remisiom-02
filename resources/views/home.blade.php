<!DOCTYPE html>
<html>
<head>

    <title>Guía de Remisión #{{ $guia->id }}</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <style>
        body {

            font-family: 'Arial', sans-serif;
            padding: 0 20px 0 0px;
            background-color: #f5f5f5;
            height: 100vh;
        }
        .container {
            max-width: auto;
            margin: 0 auto;
            border: 1px solid #ccc;
            padding: 10px 10px 10px 10px;
            background-color: #fff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            height: 100vh;
        }
        .header {
            color: #fff;
            padding: 10px 10px 10px 0;
            height: 210px;


        }

        .logo img {
            width: 150px; height: 150px;

        }

        .logo-container{
            height: auto;
            width: 30%;

        }
        .header h6 {
            font-family: 'Georgia', serif;
            color: #4CAF50;

        }
        .section {
            margin-bottom: 5px;
            border: 1px solid #ccc;
            padding: 10px;
            background-color: #f9f9f9;
            width: 45%;
            border-radius:5px;
            font-size: 11px;

        }

        .section-destinatario{
            float: right;
            margin-top: -206px;
        }
        .section-title {
            font-weight: bold;
            margin-bottom: 5px;
            color: #4CAF50;
            text-align: center;
        }
        .ruc {
            position: absolute;
            float: right;
            top: 25px;
            border-radius: 5px;
            width: 30%;
            height: auto;
            margin-right: -10px;


        }
        .options {
            margin-top: 20px;
            border-top: 1px solid #ccc;
            padding-top: 10px;
            font-size: 11px;
        }
        .notes {
            margin-top: 20px;
            border-top: 1px solid #ccc;
            padding-top: 10px;
            font-size: 11px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            padding: 8px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }
        .logo {
            display: inline-block;
            vertical-align: middle;
            margin-right: 10px;
        }
        .data{
            font-size: 13px;
            position: absolute;
            float: right;
            top: 25px;
            margin-right: 200px;
            padding: 0 20px;
            width: 250px;
            height: 170px;
        }
        .date{
            font-size: 11px;
        }



        .card-partida{
        width:45%;
        font-size: 11px;
        padding: 0 10px;

        }

        .card-llegada{
        width:45%;
        float: right;
        margin-top: -73px;
        font-size: 11px;
        padding: 0 10px;
        }

        .section-vehiculo{
            width: 97%;
            height: 80px;
        }

        .section-carga{
            width: 97%;
        }

            .text-in {
                float: left;
            }
            .text-fi {
                float: right;
                text-align:left;


            }
            .checkbox-list {
            display: grid;
            grid-template-columns: repeat(2, 1fr); /* 2 columnas */
            gap: 0.5rem; /* Espacio entre los elementos */
            list-style-type: none; /* Eliminar viñetas */
            padding: 0;
        }
        .checkbox-list li {
            position: relative;
            padding-left: 2rem; /* Espacio para el checkbox */
            display: flex;
            align-items: center;
        }
        .checkbox-list li::before {
            content: '';
            position: absolute;
            left: 0;
            width: 0.8rem;
            height: 0.8rem;
            border: 1px solid #000;
            background-color: #fff;
            border-radius: 3px;
        }
        .checkbox-list li::after {
            content: ' ';
            position: absolute;
            left: 0.25rem;
            width: 0.5rem;
            height: 0.5rem;
            background-color: #000;
            opacity: 0; /* Inicialmente invisible */
        }
        .checkbox-list li.checked::after {
            opacity: 1; /* Visible si está marcado */
        }

        .section-traslate{
            float: right;
            margin-top:-180px;
        }

        .list-check{
            float: right;
            margin-top:-85px;
        }

        .card-date{

            height:180px ;
        }

    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <div class = "logo-container text-center">
                <span class="logo">
                    <img src="https://i.pinimg.com/736x/0d/f7/d7/0df7d7809deb55e136611adeee8d0554.jpg" alt="Logo de la Empresa" >
                </span>
                <h6>SISTEMA DE GUIAS</h6>

            </div>
            <div class="data text-dark">
                <h6 class="text-center rounded border bg-success text-white">COMPUSIS E.I.R.L.</h6>
                <p class ="text-center">Somos una empresa dedicada al servicio de Desarrollo de Software</p>
                <p class ="text-center"   >
                    <strong>Dirección:</strong> Av. Nicolas de Pierola # 123<br>
                    <strong>Correo electrónico:</strong> info@empresa.com <br>
                    <strong>Teléfono:</strong> +123456789 <br>
                    <strong>Página web:</strong> <a href="https://www.empresa.com">www.empresa.com</a>
                </p>


            </div>

            <div class="ruc">
                <div class="card">
                    <div class="card-header text-dark">
                        <span>R.U.C.: 20609999620</span>
                    </div>
                    <div class="card-body text-dark">
                        <span>GUIA DE REMISION</span>
                    </div>
                    <div class="card-footer text-dark text-center">
                        <strong>N° {{$guia->id}}</strong>
                    </div>

                </div>

            </div>

            <div class="col text-dark text-left ml-2 " style="padding:0 10px; " >
                <p class="date"><strong> Fecha de Emision: </strong>{{$guia->fecha_emision}}
                <strong> Fecha de Inicio de Traslado: </strong>{{$guia->fecha_partida}}</p>
            </div>

        </div>
        <div class="fechas">

        </div>
        <div class="card card-partida ">
                <div class="section-title">PUNTO DE PARTIDA</div>
                <p><strong>Dirección: </strong>{{$guia->punto_partida}}</p>
                <hr>

        </div>
        <div class="card card-llegada">
                <div class="section-title">PUNTO DE LLEGADA</div>
                <p><strong>Dirección: </strong>{{$guia->punto_llegada}}</p>
                <hr>
        </div>

        <div class="section mt-1 card-date">
            <div class="section-title">REMITENTE (AGRICULTOR):</div>
            <table>

                <tr>
                    <th>R.U.C.:</th>
                    <td>
                        {{ strlen($agricultor->ruc) > 50 ? substr($agricultor->ruc, 0, 50) . '...' : $agricultor->ruc }}
                    </td>
                </tr>

                <tr>
                    <th>Razón Social:</th>
                    <td>
                        {{ strlen($agricultor->razon_social) > 50 ? substr($agricultor->razon_social, 0, 50) . '...' : $agricultor->razon_social }}
                    </td>
                </tr>

                <tr>
                    <th>Dirección:</th>
                    <td >
                        {{ strlen($agricultor->direccion) > 50 ? substr($agricultor->direccion, 0, 50) . '...' : $agricultor->direccion }}
                    </td>
                </tr>

            </table>
        </div>
        <div class="section section-destinatario card-date">
            <div class="section-title">DESTINATARIO:</div>
            <table>
                <tr>
                    <th>R.U.C.:</th>
                    <td>{{$transportista->RUC}}</td>
                </tr>
                <tr>
                    <th>Razón Social:</th>
                    <td>
                        {{ strlen($transportista->razon_social) > 50 ? substr($transportista->razon_social, 0, 50) . '...' : $transportista->razon_social }}
                    </td>
                </tr>
                <tr>
                    <th>Dirección:</th>
                    <td>
                        {{ strlen($transportista->direccion) > 50 ? substr($transportista->direccion, 0, 50) . '...' : $transportista->direccion }}
                    </td>
                </tr>

            </table>
        </div>

        <div class="section section-vehiculo">
            <div class="section-title">UNIDAD DE TRANSPORTE / CONDUCTOR</div>
            <p>
                <span class="text-in"><strong>N° de placa del vehículo: </strong> {{ optional($guia->transportista->vehiculo)->placa ?? 'N/A' }}</span>
                <span class="text-fi text-left"><strong>N° de placa de la carreta: </strong>{{ optional($guia->transportista->vehiculo)->placa1 ?? 'N/A' }} </span>
            </p><br>
            <p>
                <span class="text-in"><strong>Apellidos y Nombres: </strong> {{ optional($guia->carga->chofer)->nombre_apellidos ?? 'N/A' }} </span>
                <span class="text-fi text-left"><strong>N° de brevete: </strong>{{ optional($guia->carga->chofer)->brevete ?? 'N/A' }} </span>
            </p>

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
                    <td>Caña</td>
                    <td>2000 kg</td>
                </tr>
                <tr>
                    <td>Sacos de patatas</td>
                    <td>1000 kg</td>
                </tr>

            </table>
        </div>

        <div class="section ">
            <div class="section-title">DATOS DEL TRANSPORTISTA:</div>
            <table>
                <tr>
                    <th>R.U.C.:</th>
                    <td>{{$transportista->RUC}}</td>
                </tr>
                <tr>
                    <th>Razón Social:</th>
                    <td>{{$transportista->razon_social}}</td>
                </tr>
                <tr>
                    <th>Dirección:</th>
                    <td>
                        {{ strlen($transportista->direccion) > 80 ? substr($transportista->direccion, 0, 80) . '...' : $transportista->direccion }}
                    </td>
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
