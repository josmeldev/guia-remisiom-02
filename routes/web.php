<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\transportistaController;
use App\Http\Controllers\vehiculoController;
use App\Http\Controllers\agricultorController;
use App\Http\Controllers\Auth\LogoutController;
use App\Http\Controllers\choferController;
use App\Http\Controllers\cargaController;
use App\Http\Controllers\campoController;
use App\Http\Controllers\dataController;
use App\Http\Controllers\FiltrosAvanzadosController;
use App\Http\Controllers\guiaController;
use App\Http\Controllers\PagoController;
use App\Models\pago;
use App\Http\Controllers\userController;
use App\Http\Controllers\facturaController;
use App\Http\Controllers\notificationController;
use App\Http\Controllers\PDFController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/



// Ruta protegida por un Middleware
Route::middleware('auth')->group(function () {
    // Ruta para mostrar el menú (GET)
    Route::get('/', [VehiculoController::class, 'mostrarMenu'])->name('mostrar.menu');

    // Ruta para almacenar un nuevo transportista (POST)
    Route::post('/transportista', [TransportistaController::class, 'store'])->name('transportistas.store');

    // Ruta para almacenar un nuevo vehículo (POST)
    Route::post('/vehiculo', [VehiculoController::class, 'store'])->name('vehiculo.store');

    Route::get('agricultor/create', [AgricultorController::class, 'create'])->name('agricultor.create');
    Route::post('agricultor/store', [AgricultorController::class, 'store'])->name('agricultor.store');

    Route::post('conductor/store', [choferController::class, 'store'])->name('conductor.store');
    Route::post('carga/store', [cargaController::class, 'store'])->name('carga.store');

    Route::get('/buscar-choferes', [ChoferController::class, 'buscar'])->name('choferes.buscar');

    Route::post('campo/store', [CampoController::class, 'store'])->name('campo.store');

    Route::post('/crear-pago', [PagoController::class, 'store'])->name('pagos.store');

    Route::post('/guia_remision/store', [guiaController::class, 'store'])->name('guia_remision.store');

    Route::get('/guia-remision', [GuiaController::class, 'index'])->name('guia-remision.index');


    Route::get('/guias/{guia}', [GuiaController::class, 'show'])->name('guias.show');

    // Rutas para crear una nueva guía de remisión
    Route::get('/guias/create', [GuiaController::class, 'create'])->name('guias.create');
    Route::post('/guias', [GuiaController::class, 'store'])->name('guias.store');

    // Rutas para editar una guía de remisión existente
    Route::get('/guias/{guia}/edit', [GuiaController::class, 'edit'])->name('guias.edit');
    Route::put('/guias/{guia}', [GuiaController::class, 'update'])->name('guias.update');

    // Rutas para eliminar una guía de remisión existente
    Route::delete('/guias/{guia}', [GuiaController::class, 'destroy'])->name('guias.destroy');

    Route::delete('borrar-guias-seleccionadas', [GuiaController::class, 'borrarSeleccionados'])->name('guia_remision.borrar_seleccionados');
    Route::get('/pagos', [pagoController::class, 'index'])->name('pago.index');
    Route::get('/pagos/{pago}/edit', [PagoController::class, 'edit'])->name('pago.edit');
    Route::put('/pagos/{pago}', [pagoController::class, 'update'])->name('pago.update');
    Route::get('/pago/buscar', [pagoController::class, 'buscarPago'])->name('pago.buscar');

    // Rutas para eliminar una guía de remisión existente
    Route::delete('/pagos/{pago}', [pagoController::class, 'destroy'])->name('pago.destroy');
    Route::delete('borrar-pagos-seleccionados', [PagoController::class, 'borrarSeleccionados'])->name('pago.borrar_seleccionados');



    Route::post('/agregar_pago/{agricultor_id}', [PagoController::class, 'agregarPago'])->name('agregar_pago');






    Route::get('/campos', [campoController::class, 'index'])->name('campo.index');
    Route::get('/campos/{campo}/edit', [campoController::class, 'edit'])->name('campo.edit');
    Route::put('/campos/{campo}', [campoController::class, 'update'])->name('campo.update');
    Route::get('/campos/buscar', [campoController::class, 'buscar'])->name('campo.buscar');

    // Rutas para eliminar una guía de remisión existente
    Route::delete('/campos/{campo}', [campoController::class, 'destroy'])->name('campo.destroy');

    Route::get('/conductores', [choferController::class, 'index'])->name('conductor.index');
    Route::get('/conductores/{conductor}/edit', [choferController::class, 'edit'])->name('conductor.edit');
    Route::put('/conductores/{conductor}', [choferController::class, 'update'])->name('conductor.update');

    // Rutas para eliminar una guía de remisión existente
    Route::delete('/conductores/{conductor}', [choferController::class, 'destroy'])->name('conductor.destroy');

    Route::get('/transportistas', [transportistaController::class, 'index'])->name('transportista.index');
    Route::get('/transportistas/{transportista}/edit', [transportistaController::class, 'edit'])->name('transportista.edit');
    Route::put('/transportistas/{transportista}', [transportistaController::class, 'update'])->name('transportista.update');

    Route::get('/transportistas/filtrar', [TransportistaController::class, 'buscarTransportista'])->name('transportista.buscar');

    // Rutas para eliminar una guía de remisión existente
    Route::delete('/transportistas/{transportista}', [transportistaController::class, 'destroy'])->name('transportista.destroy');
    Route::delete('borrar-transportistas-seleccionados', [transportistaController::class, 'borrarSeleccionados'])->name('transportista.borrar_seleccionados');

    Route::get('/agricultores', [agricultorController::class, 'index'])->name('agricultor.index');
    Route::get('/agricultores/{agricultor}/edit', [agricultorController::class, 'edit'])->name('agricultor.edit');
    Route::put('/agricultores/{agricultor}', [agricultorController::class, 'update'])->name('agricultor.update');

    // Rutas para eliminar una guía de remisión existente
    Route::delete('/agricultores/{agricultor}', [agricultorController::class, 'destroy'])->name('agricultor.destroy');
    Route::get('/agricultores/buscar', [AgricultorController::class, 'buscar'])->name('agricultores.buscar');


    Route::middleware(['auth', 'can:ver vehículos'])->group(function () {
        Route::get('/vehiculos', [VehiculoController::class, 'index'])->name('vehiculo.index');
    });
    Route::get('/vehiculos/{vehiculo}/edit', [vehiculoController::class, 'edit'])->name('vehiculo.edit');
    Route::put('/vehiculos/{vehiculo}', [vehiculoController::class, 'update'])->name('vehiculo.update');

    // Rutas para eliminar una guía de remisión existente
    Route::delete('/vehiculos/{vehiculo}', [vehiculoController::class, 'destroy'])->name('vehiculo.destroy');
    Route::get('/vehiculos/buscar', [VehiculoController::class, 'buscar'])->name('vehiculo.buscar');

    Route::get('/cargas', [cargaController::class, 'index'])->name('carga.index');
    Route::get('/cargas/{carga}/edit', [cargaController::class, 'edit'])->name('carga.edit');
    Route::put('/cargas/{carga}', [cargaController::class, 'update'])->name('carga.update');

    // Rutas para eliminar una guía de remisión existente
    Route::delete('/cargas/{carga}', [cargaController::class, 'destroy'])->name('carga.destroy');

    Route::get('/cargas/filtrar', [CargaController::class, 'buscarCarga'])->name('carga.buscar');

    Route::delete('borrar-cargas-seleccionadas', [cargaController::class, 'borrarSeleccionados'])->name('carga.borrar_seleccionadas');


    Route::get('/filtros-avanzados', [FiltrosAvanzadosController::class, 'mostrarFiltrosAvanzados'])->name('filtros.avanzados');

    Route::get('/filtro-avanzado', [FiltrosAvanzadosController::class, 'filtrar'])->name('filtro.avanzado');

    Route::get('/verificar-ruc', [GuiaController::class, 'verificarRuc']);

    Route::post('/buscar-transportista', [TransportistaController::class, 'buscarPorRUC'])->name('transportista.buscarPorRUC');

    Route::get('/crear-guia-remision', [guiaController::class, 'create'])->name('crear_guia_remision');



    Route::get('/asignar-vehiculo', [ChoferController::class, 'index'])->name('asignar-vehiculo');
    Route::post('/asignar-vehiculo', [ChoferController::class, 'asignarVehiculo']);


    Route::get('/obtener-peso-bruto', [guiaController::class, 'obtenerPesoBruto']);



    Route::get('/usuarios', [UserController::class, 'index'])->name('users.index');

    Route::get('/usuarios', [UserController::class, 'index'])->name('usuarios.index');
    Route::delete('/usuarios/{id}', [UserController::class, 'eliminar'])->name('usuarios.eliminar');
    Route::get('/usuarios/{id}/editar', [UserController::class, 'editar'])->name('usuarios.editar');
    Route::put('/usuarios/{id}', [UserController::class, 'update'])->name('usuarios.actualizar');

    Route::get('/facturas', [FacturaController::class, 'index'])->name('facturas.index');
    Route::post('/facturas', [FacturaController::class, 'store'])->name('facturas.store');

    Route::get('/plantilla', function () {
        return view('layouts.template');
    });
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');



    Route::get('/home', function () {
        return view('home');
    });

    Route::get('/guia-remision/detalles', function () {
        return view('guia_remision.detalles');
    });


    Route::get('/politicas-de-privacidad', function () {
        return view('polites');
    });

    Route::get('/generar-pdf/{id}', [PDFcontroller::class, 'generarPDF']);

    Route::get('/agricultores_saldo_negativo', [pagocontroller::class, 'consultaSaldoNegativo'])->name('pagos.agricultores_saldo_negativo');

    Route::get('/guias/{id}/print', [GuiaController::class, 'print'])->name('guias.print');

    Route::get('/guias/download/{id}', [GuiaController::class, 'downloadPDF'])->name('guias.download');

    Route::post('/logout', [LogoutController::class, 'logout'])->name('logout.perform');


    Route::get('/enviar-notificaciones', [notificationController::class, 'enviarNotificaciones']);

    Route::get('/info', [dataController::class, 'index'])->name('info');

    Route::get('/obtener-datos-agricultores', [dataController::class, 'obtenerDatosAgricultores'])->name('obtenerDatosAgricultores');

    Route::post('/verificar-ruc-transportista', [GuiaController::class, 'verificarRucTransportista'])->name('ruc.transportista');
    Route::post('/verificar-ruc-agricultor', [GuiaController::class, 'verificarRucAgricultor'])->name('ruc.agricultor');
});




Route::get('/logout', function () {
    return view('user-logout');
})->name('logout');










