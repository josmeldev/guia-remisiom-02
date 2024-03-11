@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/admin-lte/3.1.0/css/adminlte.min.css">

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

<style>
    .parte-selector-container {
        display: flex;
        justify-content: space-around;
        background-color: #007bff;
        color: #fff;
        padding: 10px 0;
        cursor: pointer;
        border-radius: 50px;
        margin-top: 20px;
    }
    .parte-selector.active {
        background-color: #28a745;
    }
    .formulario-container {
        display: flex;
        justify-content: space-between;
        margin-top: 20px;
        display: none;
    }
    .formulario-container.active {
        display: flex;
    }
    .form-group {
        flex: 1;
        margin-right: 10px;
    }
    .cinta {
        border-top-left-radius: 50px;
        border-top-right-radius: 50px;
        background-color: #1B62FF;
        color: #fff;
        padding: 10px 0;
        text-align: center;
        cursor: pointer;
    }
    .cinta.active {
        background-color: #0003A3;
    }
    .mas-partes {
        display: flex;
        justify-content: center;
        align-items: center;
        background-color: #007bff;
        color: #fff;
        border-bottom-left-radius: 50px;
        border-bottom-right-radius: 50px;
        cursor: pointer;
        margin-top: 20px;
    }
    .mas-partes:hover {
        background-color: #1B62FF;
    }
    .formularios {
    display: none; /* Oculta los formularios adicionales inicialmente */
}
   

</style>
@stop

@section('content')


    

   
    


    <div class="container">
        <h4>Registro de Guía de Remisión</h4>
        <form action="post">
            @csrf
                    
            <div class="d-flex mb-3">
                <div class="input-group">
                    <input type="text" class="form-control pr-2" id="" placeholder="RUC">
                    <div class="input-group-append">
                        <button type="submit" style="background-color:#0003A3; color:white; border: solid 2px  #0003A3;border-radius:0 6px 6px 0 " ><i class="fas fa-search"></i> Consultar</button>
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
        <div class="row">
            <div class="col">
                <div class="cinta active" id="parte1">CAMPO - CONDUCTOR</div>
            </div>
            <div class="col">
                <div class="cinta" id="parte2">CARGA - AGRICULTOR</div>
            </div>
            
        </div>

        <div class="formulario-container active" id="formularios1">
           <!--- subsecciones de campo-->
                <div class="d-flex w-100 h-100">
                    <div class="col-md-6">
                        <div class="card  card-info flex-fill "  >
                            <div class="card-header text-uppercase rounded-bottom border-info" style="background-color:#0003A3;color:white">
                                <h3 class="card-title" data-toggle="collapse" data-target="#campo-form"><i class="fas fa-lg fa-leaf"></i> Campo</h3>
                                <div class="card-tools">
                                    <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
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
                            <div class="card-header text-uppercase rounded-bottom border-info" style="background-color:#0003A3;color:white">
                                <h3 class="card-title" data-toggle="collapse" data-target="#conductor-form"><i class="fas fa-lg fa-id-card"></i> Conductor</h3>
                                <div class="card-tools">
                                    <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
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
            <div class="d-flex w-100 h-100">
                <div class="col-md-6">
                    <div class="card card-info flex-fill">
                        <div class="card-header text-uppercase rounded-bottom border-info" style="background-color:#0003A3;color:white">
                            <h3 class="card-title" data-toggle="collapse" data-target="#conductor-form"><i class="fas fa-lg fa-truck"></i> Carga</h3>
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
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
                                    
                                    <div class="form-group row">
                                        <div class="text-center mb-3">
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
                    <div class="card card-info flex-fill">
                        <div class="card-header text-uppercase rounded-bottom border-info" style="background-color:#0003A3;color:white">
                            <h3 class="card-title" data-toggle="collapse" data-target="#agricultor-form"><i class="fas fa-lg fa-tractor"></i> Agricultor</h3>
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
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


        <div class="mas-partes" style="margin-bottom:20PX ">
            <i class="fas fa-plus"></i> Más Partes
        </div>

        <div class="formularios" style="display: none;">
            <!-- Aquí van tus formularios adicionales -->
            <div class="card  card-info flex-fill">
                <div class="card-header text-uppercase rounded-bottom border-info">
                    <h3 class="card-title" data-toggle="collapse" data-target="#periodo-form"><i class="fas fa-lg fa-calendar-alt"></i> Período</h3>
                    <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
                    </div>
                </div>
                <div class="card-body collapse" id="periodo-form">
                    <form action="post">
                        <label for="">Semana</label>
                        <input type="date" class="form-control" id="" placeholder="Semana">
                        <div class="form-group row">
                            <div class="text-center mb-3">
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




    
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
@stop

@section('js')
    <script> console.log('Hi!'); </script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const inputs = document.querySelectorAll('.form-control.custom-input');
            inputs.forEach(input => {
                input.addEventListener('focus', function () {
                    const label = this.nextElementSibling;
                    label.style.fontSize = '0.75rem';
                    label.style.transform = 'translateY(-100%) translateX(0)';
                    label.style.color = '#495057';
                });
                input.addEventListener('blur', function () {
                    const label = this.nextElementSibling;
                    if (!this.value) {
                        label.style.fontSize = '';
                        label.style.transform = '';
                        label.style.color = '#6c757d';
                    }
                });
            });
        });
    </script>
    <script>
        const parte1 = document.getElementById('parte1');
        const parte2 = document.getElementById('parte2');
        const formularios1 = document.getElementById('formularios1');
        const formularios2 = document.getElementById('formularios2');
      

        parte1.addEventListener('click', () => {
            parte1.classList.add('active');
            parte2.classList.remove('active');
            
            formularios1.classList.add('active');
            formularios2.classList.remove('active');
            
        });

        parte2.addEventListener('click', () => {
            parte2.classList.add('active');
            parte1.classList.remove('active');
            
            formularios2.classList.add('active');
            formularios1.classList.remove('active');
            
        });

        
    </script>
   
    <script>
    $(document).ready(function() {
        $(".mas-partes").click(function() {
            $(".formularios").slideToggle(); // Alternar la visibilidad de los formularios al hacer clic en el elemento
        });
    });
    </script>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
@stop