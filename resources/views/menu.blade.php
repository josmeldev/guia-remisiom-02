@extends('layouts.sidebar')

@extends('layouts.header')

@section('content')
    <div class="container">
        <h4>Registro de Guía de Remisión</h4>
        <form action="post">
            @csrf

            <div class="d-flex mb-3">
                <div class="input-group">
                    <input type="text" class="form-control pr-2" id="" placeholder="RUC">
                    <div class="input-group-append">
                        <button type="submit" style="background-color:#001F4B; color:white; border: solid 2px  #001F4B;border-radius:0 6px 6px 0 " ><i class="fas fa-search"></i> Consultar</button>
                    </div>
                </div>
                <div class="mr-4"></div>
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text"><i class="fas fa-user"></i></span>
                    </div>
                    <input type="text" class="form-control" id="" placeholder="Razon Social">
                </div>
            </div>

            <div class="input-group mb-3">
                <div class="input-group-prepend">
                    <span class="input-group-text"><i class="fas fa-map-marker-alt"></i></span>
                </div>
                <input type="text" class="form-control" id="" placeholder="Direccion">
            </div>

            <div class="d-flex mb-3">
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text"><i class="fas fa-file-alt"></i></span>
                    </div>
                    <input type="text" class="form-control" id="" placeholder="N° Guia de Remision">
                </div>
                <div class="mr-4"></div>
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text"><i class="fas fa-truck"></i></span>
                    </div>
                    <input type="text" class="form-control" id="" placeholder="N° de Viaje">
                </div>
            </div>

            <div class="text-center mb-3" >
                <button type="submit"  style="background-color:#1CA6D4; color:white; border: solid 2px  #1CA6D4;border-radius:5px 5px 5px 5px;height:40px;width:12% " > GUARDAR  <i class="fas fa-save"></i></button>
            </div>
        </form>

    </div>
    <div class="container">
        <div class="formulario-container active" id="formularios1">
           <!--- subsecciones de campo-->
                <div class="d-flex">
                    <div class="col-md-6">
                        <div class="card  card-info flex-fill "  >
                            <div class="card-header text-uppercase rounded-bottom border-info" style="background-color:#0003A3;color:white; display: flex; align-items: center;">
                                <h3 class="card-title" data-toggle="collapse" data-target="#campo-form">
                                    <i class="fas fa-lg fa-leaf"></i> Campo
                                </h3>
                                <div style="margin-left: auto;">
                                    <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                        <i class="fas fa-plus"></i>
                                    </button>
                                </div>
                            </div>
                            <div class="card-body collapse" id="campo-form">
                                <form action="post" class="form-horizontal">
                                    <div class="form-group row">
                                        <div class="col-md-6 mb-3">
                                            <input type="text" class="form-control mt-2" id="acopiadora" placeholder=" ">
                                            <label for="acopiadora" class="form-control-label">Acopiadora</label>
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <input type="text" class="form-control mt-2" id="ubigeo" placeholder=" " >
                                            <label for="ubigeo" class="form-control-label">Ubigeo:</label>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <div class="col-md-6 mb-3">
                                            <input type="text" class="form-control mt-2" id="zona" placeholder=" ">
                                            <label for="zona" class="form-control-label">Zona:</label>
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <input type="text" class="form-control mt-2" id="ingenio" placeholder=" ">
                                            <label for="ingenio" class="form-control-label">Ingenio:</label>

                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <div class="col-md-6 mb-3">
                                            <input type="text" class="form-control mt-2" id="unidad_tecnica" placeholder=" ">
                                            <label for="unidad_tecnica" class="form-control-label">Unidad Técnica:</label>
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <input type="text" class="form-control mt-2" id="campo" placeholder=" ">
                                            <label for="campo" class="form-control-label">Campo:</label>

                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col text-center">
                                            <button type="submit" class="btn btn-primary mt-3">
                                                <i class="fas fa-save"></i> Guardar
                                            </button>
                                        </div>
                                    </div>

                                </form>
                            </div>
                        </div>

                    </div>





                    <div class="col-md-6">
                        <div class="card  flex-fill" >
                            <div class="card-header text-uppercase rounded-bottom border-info" style="background-color:#0003A3;color:white; display: flex; align-items: center;">
                                <h3 class="card-title" data-toggle="collapse" data-target="#conductor-form">
                                    <i class="fas fa-lg fa-id-card"></i> Conductor
                                </h3>
                                <div style="margin-left: auto;">
                                    <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                        <i class="fas fa-plus"></i>
                                    </button>
                                </div>
                            </div>
                            <div class="card-body collapse conductor-form" id="conductor-form"> <!-- Agrega la clase "conductor-form" -->
                                <form action="post">
                                    <div class="form-group">
                                        <input type="text" class="form-control mt-2" id="dni" placeholder=" ">
                                        <label for="dni" class="form-control-label">DNI:</label>
                                    </div>

                                    <div class="form-group">
                                        <input type="text" class="form-control mt-2" id="nombre_apellidos" placeholder=" ">
                                        <label for="nombre_apellidos" class="form-control-label">Nombre y Apellidos:</label>
                                    </div>

                                    <div class="form-group">
                                        <input type="text" class="form-control mt-2 " id="telefono" placeholder=" ">
                                        <label for="telefono" class="form-control-label">Teléfono:</label>
                                    </div>

                                    <div class="form-group">
                                        <input type="text" class="form-control mt-2 " id="cantidad_bruta" placeholder=" ">
                                        <label for="cantidad_bruta" class="form-control-label">Cantidad Bruta:</label>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col text-center">
                                            <button type="submit" class="btn btn-primary mt-3">
                                                <i class="fas fa-save"></i> Guardar
                                            </button>
                                        </div>
                                    </div>

                                </form>
                            </div>
                        </div>
                    </div>





                </div>

        </div>

        <div class="formulario-container" id="formularios2">
            <div class="d-flex">
                <div class="col-md-6">
                    <div class="card card-info flex-fill">
                        <div class="card-header text-uppercase rounded-bottom border-info" style="background-color:#0003A3;color:white; display: flex; align-items: center;">
                            <h3 class="card-title" data-toggle="collapse" data-target="#carga-form">
                                <i class="fas fa-lg fa-truck"></i> Carga
                            </h3>
                            <div style="margin-left: auto;">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                    <i class="fas fa-plus"></i>
                                </button>
                            </div>
                        </div>
                        <div class="card-body collapse" id="conductor-form">

                                <form action="post">
                                    <div class="form-group row">
                                        <div class="col">
                                            <input type="text" class="form-control mt-2 " id="id_conductor" placeholder=" " >
                                            <label for="id_conductor" class="form-control-label">ID Conductor:</label>
                                        </div>

                                        <div class="col">
                                            <input type="text" class="form-control mt-2 " id="total_carga_bruta" placeholder=" ">
                                            <label for="total_carga_bruta" class="form-control-label">Total de Carga Bruta:</label>
                                        </div>

                                    </div>

                                    <div class="form-group row">
                                        <div class="col">
                                            <input type="text" class="form-control mt-2 " id="total_carga_neta"  placeholder=" ">
                                            <label for="total_carga_neta" class="form-control-label">Total de Carga Neta:</label>
                                        </div>
                                        <div class="col">
                                            <input type="text" class="form-control mt-2 " id="total_material_extrano" placeholder=" ">
                                            <label for="total_material_extrano" class="form-control-label">Total de Material Extraño:</label>
                                        </div>

                                    </div>

                                    <div class="form-group row">
                                        <div class="col">
                                            <input type="number" class="form-control mt-2 " id="km_origen" placeholder=" ">
                                            <label for="km_origen" class="form-control-label">Km Origen:</label>

                                        </div>
                                        <div class="col">
                                            <input type="number" class="form-control mt-2 "  id="km_de_destino" placeholder=" ">
                                            <label for="km_de_destino" class="form-control-label">Km de Destino:</label>

                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <div class="col">
                                            <label for="fecha_carga" class="col col-form-label" style="color:blue">Fecha Carga:</label>
                                            <input type="date" class="form-control mt-2" id="fecha_carga">

                                        </div>
                                        <div class="col">
                                            <label for="fecha_de_descarga" class="col col-form-label" style="color:blue">Fecha de Descarga:</label>

                                            <input type="date" class="form-control mt-2" id="fecha_de_descarga">

                                        </div>
                                    </div>


                                    <div class="text-center mb-3">
                                        <button type="submit" class="btn btn-primary mt-3">
                                            <i class="fas fa-save"></i> Guardar
                                        </button>
                                    </div>

                                </form>

                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card card-info flex-fill">
                        <div class="card-header text-uppercase rounded-bottom border-info" style="background-color:#0003A3;color:white; display: flex; align-items: center;">
                            <h3 class="card-title" data-toggle="collapse" data-target="#agricultor-form">
                                <i class="fas fa-lg fa-tractor"></i> Agricultor
                            </h3>
                            <div style="margin-left: auto;">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                    <i class="fas fa-plus"></i>
                                </button>
                            </div>
                        </div>
                        <div class="card-body collapse" id="agricultor-form">
                            <form action="post" class="form-horizontal">
                                    <div class="form-group row">
                                        <div class="col-md-6 mb-3">
                                            <input type="text" class="form-control mt-2" id="apellidos" placeholder=" ">
                                            <label for="apellidos" class="form-control-label">Apellidos</label>
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <input type="text" class="form-control mt-2" id="nombres" placeholder=" ">
                                            <label for="nombres" class="form-control-label">Nombres:</label>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <input type="text" class="form-control mt-2" id="dni" placeholder=" ">
                                        <label for="dni" class="form-control-label">DNI:</label>
                                    </div>

                                    <div class="form-group row">
                                        <div class="col-12 d-flex justify-content-center">
                                            <button type="submit" class="btn btn-primary mt-3">
                                                <i class="fas fa-save"></i> Guardar
                                            </button>
                                        </div>
                                    </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>


        <div class="formulario-container" id="formularios3">
            <div class="d-flex">
                <div class="col-md-6">
                    <div class="card card-info flex-fill">
                        <div class="card-header text-uppercase rounded-bottom border-info" style="background-color:#0003A3;color:white; display: flex; align-items: center;">
                            <h3 class="card-title" data-toggle="collapse" data-target="#transportista-form">
                                <i class="fas fa-lg fa-building"></i> Transportista
                            </h3>
                            <div style="margin-left: auto;">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                    <i class="fas fa-plus"></i>
                                </button>
                            </div>
                        </div>
                        <div class="card-body collapse" id="conductor-form">

                            <form action="post">
                                <div class="form-group row">
                                    <div class="col">
                                        <input type="text" class="form-control mt-2 " id="unidadTecnica" placeholder=" " >
                                        <label for="unidadTecnica" class="form-control-label">Unidad Tecnica:</label>
                                    </div>

                                    <div class="col">
                                        <input type="text" class="form-control mt-2 " id="campo" placeholder=" ">
                                        <label for="campo" class="form-control-label">Campo:</label>
                                    </div>

                                </div>

                                <div class="form-group row">
                                    <div class="col">
                                        <input type="text" class="form-control mt-2 " id="razonSocial"  placeholder=" ">
                                        <label for="razonSocial" class="form-control-label">Razon Social:</label>
                                    </div>
                                    <div class="col">
                                        <input type="text" class="form-control mt-2 " id="codigo" placeholder=" ">
                                        <label for="codigo" class="form-control-label">Codigo:</label>
                                    </div>

                                </div>

                                <div class="form-group row">
                                    <div class="col">
                                        <input type="text" class="form-control mt-2 " id="placas" placeholder=" ">
                                        <label for="placas" class="form-control-label">Placas:</label>

                                    </div>
                                    <div class="col">
                                        <input type="text" class="form-control mt-2 "  id="nombres" placeholder=" ">
                                        <label for="nombres" class="form-control-label">Nombres:</label>

                                    </div>
                                </div>

                                <div class="form-group row">
                                    <div class="col d-flex">
                                        <label for="ruc" class="col col-form-label">RUC:</label>
                                        <input type="text" class="form-control mt-2" id="ruc">

                                    </div>

                                    <div class="text-right mb-3">
                                        <button type="submit" class="btn btn-primary mt-2">
                                            <i class="fas fa-save"></i> Guardar
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card card-info flex-fill">
                        <div class="card-header text-uppercase rounded-bottom border-info" style="background-color:#0003A3;color:white; display: flex; align-items: center;">
                            <h3 class="card-title" data-toggle="collapse" data-target="#pagos-form">
                                <i class="fas fa-lg fa-coins"></i> Pagos
                            </h3>
                            <div style="margin-left: auto;">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                    <i class="fas fa-plus"></i>
                                </button>
                            </div>
                        </div>
                        <div class="card-body collapse" id="agricultor-form">
                            <form action="post" class="form-horizontal">
                                    <div class="form-group row">
                                        <div class="col-md-6 mb-3">
                                            <input type="text" class="form-control mt-2" id="adelanto" placeholder=" ">
                                            <label for="adelanto" class="form-control-label">Adelanto</label>
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <input type="text" class="form-control mt-2" id="total" placeholder=" ">
                                            <label for="total" class="form-control-label">Total:</label>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <div class="col-12 d-flex justify-content-center">
                                            <button type="submit" class="btn btn-primary mt-3">
                                                <i class="fas fa-save"></i> Guardar
                                            </button>
                                        </div>
                                    </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>


        
        <div class="formularios">
            <!-- Aquí van tus formularios adicionales -->
            <div class="card  card-info flex-fill">
                <div class="card-header text-uppercase rounded-bottom border-info" style="background-color:#0003A3;color:white; display: flex; align-items: center;">
                    <h3 class="card-title" data-toggle="collapse" data-target="#pagos-form">
                        <i class="fas fa-lg fa-calendar-alt"></i> Periodo
                    </h3>
                    <div style="margin-left: auto;">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse">
                            <i class="fas fa-plus"></i>
                        </button>
                    </div>
                </div>
                <div class="card-body collapse" id="periodo-form">
                    <form action="post">
                        <label for="">Semana</label>
                        <input type="date" class="form-control" id="" placeholder="Semana">
                        <div class="form-group row">
                            <div class="text-center">
                                <button type="submit" class="btn btn-primary mt-3">
                                    <i class="fas fa-save"></i> Guardar
                                </button>
                            </div>
                        </div>


                    </form>
                </div>
            </div>

        </div>


    </div>
@endsection

@section('css')
<style>
    .form-group {
        position: relative;
        margin-bottom: 1rem;
    }

    .form-control-label {
        position: absolute;
        top: 0.25rem;
        left: 1rem;
        transition: all 0.3s ease-in-out;
        pointer-events: none;
        color: #6c757d;
    }




    .form-control:focus + .form-control-label,
    .form-control:not(:placeholder-shown) + .form-control-label {
        font-size: 1rem;
        transform: translateY(-100%) translateX(0);
        color: blue;
    }

    .form-control:not(:placeholder-shown) {
        padding-top: 0;
    }


</style>

@section('js')

@stop

@stop

