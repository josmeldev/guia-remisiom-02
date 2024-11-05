@extends('layouts.template')

@section('content')

<nav aria-label="breadcrumb" style="line-height: 0; padding-top: 0; padding-bottom: 0; ">
    <ol class="breadcrumb small" style="font-size: 1rem;">
        {{ Breadcrumbs::render('facturas.index') }}
    </ol>
</nav>







<ul class="nav nav-tabs" id="myTab" role="tablist">
    <li class="nav-item">
        <a class="nav-link active" id="tab1-tab" data-toggle="tab" href="#tab1" role="tab" aria-controls="tab1" aria-selected="true">Registro de Facturas</a>
    </li>
    <li class="nav-item">
        <a class="nav-link" id="tab2-tab" data-toggle="tab" href="#tab2" role="tab" aria-controls="tab2" aria-selected="false">Edición de Facturas</a>
    </li>
    <li class="nav-item">
        <a class="nav-link" id="tab3-tab" data-toggle="tab" href="#tab3" role="tab" aria-controls="tab3" aria-selected="false">Mas Información</a>
    </li>
</ul>
<div class="tab-content" id="myTabContent">
    <div class="tab-pane fade show active" id="tab1" role="tabpanel" aria-labelledby="tab1-tab">

        <div class="col mb-3">

        </div>
        <div class="card border-primary">
            <div class="card-header bg-primary text-white">
                <h5 class="card-title mb-0">Registrar Factura</h5>
            </div>
            <div class="card-body">
                <form action="/guardar_factura" method="POST">
                    @csrf
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="nro_factura" class="form-label">Número de Factura:</label>
                            <input type="number" class="form-control" id="nro_factura" name="nro_factura" required>
                        </div>
                        <div class="col-md-6">
                            <label for="razon_social" class="form-label">Razón Social:</label>
                            <input type="text" class="form-control" id="razon_social" name="razon_social">
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="ruc" class="form-label">RUC:</label>
                            <input type="text" class="form-control" id="ruc" name="ruc">
                        </div>
                        <div class="col-md-6">
                            <label for="direccion" class="form-label">Dirección:</label>
                            <input type="text" class="form-control" id="direccion" name="direccion">
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="descripcion_producto" class="form-label">Descripción del Producto:</label>
                        <textarea class="form-control" id="descripcion_producto" name="descripcion_producto" rows="3"></textarea>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="precio_unitario" class="form-label">Precio Unitario:</label>
                            <input type="number" class="form-control" id="precio_unitario" name="precio_unitario" step="0.01">
                        </div>
                        <!-- Puedes continuar agregando los campos restantes según tu preferencia -->
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <button type="submit" class="btn btn-success"><i class="bi bi-save"></i> Guardar</button>
                        </div>
                        <div class="col-md-6">
                            <button type="reset" class="btn btn-danger"><i class="bi bi-x-circle"></i> Limpiar</button>
                        </div>
                    </div>
                </form>
            </div>
            <div class="card-footer bg-primary text-white">
                <!-- Pie de página del card -->
            </div>
        </div>



    </div>
    <div class="tab-pane fade" id="tab2" role="tabpanel" aria-labelledby="tab2-tab">
        Contenido de la pestaña 2
    </div>
    <div class="tab-pane fade" id="tab3" role="tabpanel" aria-labelledby="tab3-tab">
        Contenido de la pestaña 3
    </div>
</div>





<!-- Botón con el icono para alternar el formulario -->
<button class="btn btn-primary" type="button" id="toggleForm">
    <i class="fas fa-plus-circle"></i> Registrar
</button>

<!-- Formulario de registro de factura -->
<div id="formularioFactura" style="max-height: 0; overflow: hidden; transition: max-height 2s;">
    <div class="card card-body">
        <form action="{{ route('facturas.store') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="nro_factura">Número de Factura</label>
                <input type="text" class="form-control" id="nro_factura" name="nro_factura">
            </div>
            <!-- Otros campos del formulario -->
            <button type="submit" class="btn btn-primary">Guardar</button>
        </form>
    </div>
</div>



<script>
    // Obtener el botón y el formulario
    var toggleButton = document.getElementById('toggleForm');
    var form = document.getElementById('formularioFactura');

    // Agregar un event listener al botón para alternar la visualización del formulario
    toggleButton.addEventListener('click', function() {
        if (form.style.maxHeight === '0px') {
            form.style.maxHeight = form.scrollHeight + 'px';
        } else {
            form.style.maxHeight = '0px';
        }
    });
</script>


<div class="gradient-box"></div>

<div class="circular-gradient-box"></div>

<style>
    .gradient-box {
  width: 200px;
  height: 200px;
  background-image: linear-gradient(to right, #ff0000, #00ff00, #0000ff);
}

.circular-gradient-box {
  width: 200px;
  height: 200px;
  background-image: radial-gradient(circle, #972929, #ff0000);
}


</style>

<style>
    .container-fluid {
        position: relative;
        padding: 20px;
        height: 100vh;
        box-sizing: border-box;
    }
    .content-oculto {
        background-color: #f0f0f0;
        width: 200px;
        position: absolute;
        top: 0;
        right: -200px; /* Oculto fuera del viewport a la derecha */
        height: 100%; /* Se ajusta al tamaño del contenedor */
        transition: right 0.3s ease-in-out;
        z-index: 1000; /* Asegura que esté sobre otros contenidos */
    }
    .show {
        right: 0; /* Mover dentro del viewport */
    }
    .main-content {
        height: 100%;
        overflow-y: auto;
    }

</style>




@endsection
