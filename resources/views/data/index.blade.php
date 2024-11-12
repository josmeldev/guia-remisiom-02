@extends('layouts.template')

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<link rel="stylesheet" href="{{asset("/css/data.css")}}">
@section('content')


<nav aria-label="breadcrumb" style="line-height: 0; padding-top: 0; padding-bottom: 0; ">
    <ol class="breadcrumb small" style="font-size: 1rem;">
        {{ Breadcrumbs::render('info') }}
    </ol>
</nav>


<div class="container">
    <div class="row">
        <div class="col-md-2">

            <div class="p-3 mb-2 bg-primary text-white rounded " title="Cantidad de guias emitidas">
                <div class="d-flex justify-content-center align-items-center mb-2">
                    <i class="fas fa-file-alt fa-2x"></i>
                </div>
                <div style="font-size: 20px; text-align: center; ">
                    <span id="circle">{{$totalGuias}}</span>
                </div>
                @php
                $text = "Guias Emitidas Total";
                $limitedText = strlen($text) > 18 ? substr($text, 0, 18) . '...' : $text;
                @endphp

                <div class="text-container" style="border-bottom: 1px solid white">
                    <p >{{ $limitedText }}</p>
                </div>
                <a href="/guia-remision" class="more-link text-white">
                    Ver más <i class="fas fa-chevron-right"></i>
                </a>
            </div>

        </div>
        <div class="col-md-2">

            <div class="p-3 mb-2 bg-secondary text-white rounded" title="Total de agricultores">
                <div class="d-flex justify-content-center align-items-center mb-2">
                    <i class="fas fa-users fa-2x"></i>
                </div>
                <div style="font-size: 20px; text-align: center;">
                    <span>{{$totalAgricultores}}</span>
                </div>
                @php
                $text = "Agricultores Registrados";
                $limitedText = strlen($text) > 15 ? substr($text, 0, 15) . '...' : $text;
                @endphp

                <div class="text-container" style="border-bottom: 1px solid white">
                    <p>{{ $limitedText }}</p>
                </div>
                <a href="/agricultores" class="more-link text-white">
                    Ver más <i class="fas fa-chevron-right"></i>
                </a>
            </div>

        </div>
        <div class="col-md-2">
            <div class="p-3 mb-2 bg-success text-white rounded" title="Total de Transportistas registrados">
                <div class="d-flex justify-content-center align-items-center mb-2">
                    <i class="fas fa-building fa-2x"></i>
                </div>
                <div style="font-size: 20px; text-align: center;">
                    <span>{{$totalTransportistas}}</span>
                </div>
                @php
                $text = "Transportistas Registrados";
                $limitedText = strlen($text) > 15 ? substr($text, 0, 15) . '...' : $text;
                @endphp

                <div class="text-container " style="border-bottom: 1px solid white">
                    <p>{{ $limitedText }}</p>
                </div>
                <a href="/transportistas" class="more-link text-white">
                    Ver más <i class="fas fa-chevron-right"></i>
                </a>

            </div>

        </div>
        <div class="col-md-2">
            <div class="p-3 mb-2 bg-info text-white rounded" title="Vehiculos Registrados">
                <div class="d-flex justify-content-center align-items-center mb-2">
                    <i class="fas fa-truck fa-2x"></i>
                </div>
                <div style="font-size: 20px; text-align: center;">
                    <span>{{$totalVehiculos}}</span>
                </div>
                @php
                $text = "Vehículos Registrados";
                $limitedText = strlen($text) > 15 ? substr($text, 0, 15) . '...' : $text;
                @endphp

                <div class="text-container" style="border-bottom: 1px solid white">
                    <p>{{ $limitedText }}</p>
                </div>
                <a href="/vehiculos" class="more-link text-white">
                    Ver más <i class="fas fa-chevron-right"></i>
                </a>
            </div>
        </div>
        <div class="col-md-2">
            <div class="p-3 mb-2 bg-danger text-white rounded" title="Campos registrados">
                <div class="d-flex justify-content-center align-items-center mb-2">
                    <i class="fas fa-map-marker fa-2x"></i>
                </div>
                <div style="font-size: 20px; text-align: center;">
                    <span>{{$totalCampos}}</span>
                </div>
                @php
                $text = "Campos Registrados";
                $limitedText = strlen($text) > 15 ? substr($text, 0, 15) . '...' : $text;
                @endphp

                <div class="text-container" style="border-bottom: 1px solid white">
                    <p>{{ $limitedText }}</p>
                </div>
                <a href="/campos" class="more-link text-white">
                    Ver más <i class="fas fa-chevron-right"></i>
                </a>
            </div>
        </div>
        <div class="col-md-2">
            <div class="p-3 mb-2 bg-warning text-white rounded" title="Cargas registradas">
                <div class="d-flex justify-content-center align-items-center mb-2">
                    <i class="fas fa-truck-loading icon fa-2x"></i>
                </div>
                <div style="font-size: 20px; text-align: center;">
                    <span>{{$totalCarga}}</span>
                </div>
                @php
                    $text = "Cargas Registradas";
                    $limitedText = strlen($text) > 15 ? substr($text, 0, 15) . '...' : $text;
                @endphp

                <div class="text-container" style="border-bottom: 1px solid white">
                    <p>{{ $limitedText }}</p>
                </div>
                <a href="/cargas" class="more-link text-white">
                    Ver más <i class="fas fa-chevron-right"></i>
                </a>
            </div>
        </div>
    </div>




</div>

<hr>

<div id="carouselExample" class="carousel slide" data-ride="carousel">
    <div class="carousel-inner">
        <div class="carousel-item active">
            <div class="container ">
                <div class="d-flex justify-content-center align-items-center" style="height: auto;">
                    <div class="container border rounded bg-white ">
                        <h5 class="text-center card-title">Tendencias de Pago de Agricultores</h5>
                        <hr>
                        <canvas id="lineChart" width="800" height="300"></canvas>
                    </div>
                </div>
            </div>
        </div>
        <div class="carousel-item">
            <div class="container ">
                <div class="d-flex justify-content-center align-items-center" style="height: auto;">
                    <div class="container border rounded bg-white ">
                        <h5 class="text-center card-title">Gráfico de Monto Total por Agricultor</h5>
                        <hr>
                        <canvas id="graficoMontoTotal" width="800" height="300"></canvas>
                    </div>



                </div>
            </div>
            <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            var ctx = document.getElementById('graficoMontoTotal').getContext('2d');
            var chart = new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: {!! json_encode($agricultoresLabels) !!},
                    datasets: [{
                        label: 'Monto Total',
                        data: {!! json_encode($montosTotales) !!},
                        backgroundColor: [
                            'rgba(255, 99, 132, 0.2)',
                            'rgba(54, 162, 235, 0.2)',
                            'rgba(255, 206, 86, 0.2)',
                            'rgba(75, 192, 192, 0.2)',
                            'rgba(153, 102, 255, 0.2)',
                            'rgba(255, 159, 64, 0.2)',
                            'rgba(255, 99, 132, 0.2)',
                            'rgba(54, 162, 235, 0.2)'
                        ],
                        borderColor: [
                            'rgba(255, 99, 132, 1)',
                            'rgba(54, 162, 235, 1)',
                            'rgba(255, 206, 86, 1)',
                            'rgba(75, 192, 192, 1)',
                            'rgba(153, 102, 255, 1)',
                            'rgba(255, 159, 64, 1)',
                            'rgba(255, 99, 132, 1)',
                            'rgba(54, 162, 235, 1)'
                        ],
                        borderWidth: 1
                    }]
                },
                options: {
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            });
        });
    </script>
        </div>

    </div>
    <a class="carousel-control-prev" href="#carouselExample" role="button" data-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="sr-only">Previous</span>
    </a>
    <a class="carousel-control-next" href="#carouselExample" role="button" data-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="sr-only">Next</span>
    </a>
</div>

<div class="container  mt-3">
    <div class="row">
        <div class="col-md-3">

            <div class="card">
                <div class="card-header">

                </div>
                <div class="card-header">

                </div>
                <div class="card-footer">

                </div>

            </div>



        </div>
        <div class="col-md-3">
            <div class="card">
                <div class="card-header">

                </div>
                <div class="card-header">

                </div>
                <div class="card-footer">

                </div>

            </div>
        </div>
        <div class="col-md-3">
            <div class="card">
                <div class="card-header">

                </div>
                <div class="card-header">

                </div>
                <div class="card-footer">

                </div>

            </div>
        </div>
        <div class="col-md-3">
            <div class="card">
                <div class="card-header">

                </div>
                <div class="card-header">

                </div>
                <div class="card-footer">

                </div>

            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    // Obtener los datos pasados desde el controlador
    var saldosPendientesDeben = {!! json_encode($saldosPendientesDeben) !!};
    var saldosPendientesNoDeben = {!! json_encode($saldosPendientesNoDeben) !!};
    var diasSemana = {!! json_encode(['Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday']) !!};

    // Configurar el gráfico
    var ctx = document.getElementById('lineChart').getContext('2d');
    var lineChart = new Chart(ctx, {
        type: 'line',
        data: {
            labels: diasSemana,
            datasets: [{
                label: 'Saldo Pendiente de los que Deben',
                data: saldosPendientesDeben,
                borderColor: 'rgba(75, 192, 192, 1)', // Color de la línea
                backgroundColor: 'rgba(75, 192, 192, 0.2)', // Color del fondo
                fill: false,
                tension: 0.1 // Curvatura de la línea
            }, {
                label: 'Saldo Pendiente de los que No Deben',
                data: saldosPendientesNoDeben,
                borderColor: 'rgba(255, 99, 132, 1)', // Color de la línea
                backgroundColor: 'rgba(255, 99, 132, 0.2)', // Color del fondo
                fill: false,
                tension: 0.1 // Curvatura de la línea
            }]
        },
        options: {
            responsive: true,
            scales: {
                y: {
                    beginAtZero: true, // Empezar el eje Y en 0
                    title: {
                        display: true,
                        text: 'Saldo Pendiente (en Soles)'
                    }
                },
                x: {
                    title: {
                        display: true,
                        text: 'Día de la Semana'
                    }
                }
            }
        }
    });
</script>


@endsection
