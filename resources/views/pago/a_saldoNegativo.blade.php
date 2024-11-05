@extends('layouts.template')
@section('content')
<nav aria-label="breadcrumb" style="line-height: 0; padding-top: 0; padding-bottom: 0; ">
    <ol class="breadcrumb small" style="font-size: 1rem;">
        {{ Breadcrumbs::render('facturas.index') }}
    </ol>
</nav>
<link rel="stylesheet" href="{{ asset('css/pago.css') }}">
<link rel="stylesheet" href="{{ asset('css/styleTables.css') }}">




@foreach (auth()->user()->unreadNotifications as $notification)
    <div class="alert alert-info">
        {{ $notification->data['razon_social'] }} tiene un pago pendiente de {{ $notification->data['total_a_pagar'] }}
        <a href="{{ url('/agricultores/' . $notification->data['agricultor_id']) }}">Ver detalles</a>
    </div>
@endforeach


    <div class="container-fluid mb-3">
        <div class="row ">

           

            <div class="col-md-11">
                <div class="card overflow-auto">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>RUC</th>
                                <th>Razón Social</th>
                                <th>Dirección</th>
                                <th>Representante</th>
                                <th>Saldo Pendiente</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($agricultoresConSaldoNegativoT as $index => $agricultor)
                                <tr>
                                    <td>{{ $index + 1 }}</td>

                                    <td>{{ $agricultor->ruc }}</td>
                                    <td style="max-width: 200px; overflow: hidden; text-overflow: ellipsis; white-space: nowrap;">{{ $agricultor->razon_social }}</td>
                                    <td style="max-width: 250px; overflow: hidden; text-overflow: ellipsis; white-space: nowrap;">{{ $agricultor->direccion }}</td>
                                    <td>{{ $agricultor->representante }}</td>
                                    <td>S/ {{ $agricultor->saldo_pendiente }}</td>
                                    <td>
                                            <!-- Dentro de tu vista Blade -->
                                            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal{{ $agricultor->id }}" title="Agregar Pago">
                                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="16" height="16" color="#ffffff" fill="none">
                                                    <path d="M16.4407 21.3478L16.9929 20.6576C17.4781 20.0511 18.5085 20.1 18.9184 20.7488C19.4114 21.5295 20.6292 21.3743 20.9669 20.6562C20.9845 20.6189 20.9405 20.7123 20.9781 20.3892C21.0156 20.0661 21 19.9923 20.9687 19.8448L19.0456 10.7641C18.5623 8.48195 18.3206 7.34086 17.4893 6.67043C16.6581 6 15.4848 6 13.1384 6H10.8616C8.51517 6 7.34194 6 6.51066 6.67043C5.67937 7.34086 5.43771 8.48195 4.95439 10.7641L3.0313 19.8448C3.00004 19.9923 2.98441 20.0661 3.02194 20.3892C3.05946 20.7123 3.01554 20.6189 3.0331 20.6562C3.37084 21.3743 4.58856 21.5295 5.08165 20.7488C5.49152 20.1 6.52187 20.0511 7.00709 20.6576L7.55934 21.3478C8.25514 22.2174 9.70819 22.2174 10.404 21.3478L10.4908 21.2392C11.2291 20.3165 12.7709 20.3165 13.5092 21.2392L13.596 21.3478C14.2918 22.2174 15.7449 22.2174 16.4407 21.3478Z" stroke="currentColor" stroke-width="1.5" stroke-linejoin="round" />
                                                    <path d="M2.48336 9.5C1.89805 8.89199 2.00824 8.10893 2.00824 6.15176C2.00824 4.1946 2.00824 3.21602 2.59355 2.60801C3.17886 2 4.1209 2 6.00497 2L17.9952 2C19.8792 2 20.8213 2 21.4066 2.60801C21.9919 3.21602 21.9919 4.1946 21.9919 6.15176C21.9919 8.10893 22.1014 8.89199 21.5161 9.5" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" />
                                                    <path d="M12 10H9" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                                    <path d="M14 14L8 14" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                                </svg>
                                            </button>

                                            <!-- Modal -->
                                            <div class="modal fade" id="exampleModal{{ $agricultor->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="exampleModalLabel">Agregar Pago</h5>
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <form action="{{ route('agregar_pago', ['agricultor_id' => $agricultor->agricultor_id]) }}" method="POST">
                                                                @csrf
                                                                <input type="hidden" name="guia_id" value="{{ $agricultor->guia_id }}">
                                                                <div class="form-group mb-0">
                                                                    <label for="monto_pago" class="text-danger">
                                                                        Monto a Pagar: {{ abs($agricultor->saldo_pendiente) }}
                                                                    </label>
                                                                    <div class="input-group">
                                                                        <input type="number" name="monto_pago" id="monto_pago" step="0.01" class="form-control form-control-sm" placeholder="Ingrese...">
                                                                        <div class="input-group-append">
                                                                            <span class="input-group-text"><i class="fas fa-dollar-sign"></i></span>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <button type="submit" class="btn btn-success btn-sm mt-2"><i class="fas fa-plus-circle"></i> Agregar</button>
                                                            </form>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                    </td>
                                </tr>
                            @endforeach

                            <tr>

                                <td colspan="5"><strong>Total:</strong></td>
                                <td><strong>{{ $sumaSaldoNegativo->suma_saldo_negativo }}</strong></td>
                            </tr>
                        </tbody>
                    </table>
                </div>


            </div>

            <div class="col-auto col-md-1" >

                <div class="row p-0 " style="max-height: 300px; overflow:auto">
                    <div class="card mb-2">
                        Lorem ipsum, dolor sit amet consectetur adipisicing elit. Beatae tenetur illo ducimus necessitatibus officiis, perferendis ipsum aut quibusdam sed alias maxime, accusamus reprehenderit similique quaerat? Quasi quas ipsum ut id.
                <!-- Contenido fijo a la izquierda -->

                    </div>
                    <div class="card">
                        Lorem ipsum, dolor sit amet consectetur adipisicing elit. Beatae tenetur illo ducimus necessitatibus officiis, perferendis ipsum aut quibusdam sed alias maxime, accusamus reprehenderit similique quaerat? Quasi quas ipsum ut id.
                <!-- Contenido fijo a la izquierda -->

                    </div>

                </div>


            </div>


        </div>
    </div>

    <hr>











@endsection
