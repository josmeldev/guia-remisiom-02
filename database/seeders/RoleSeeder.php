<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleSeeder extends Seeder
{
    public function run()
    {
        // Lista de todos los permisos basados en las rutas disponibles
        $allPermissions = [
            'mostrar.menu', 'guia-remision.index', 'guias.show', 'pago.index', 
            'campo.index', 'conductor.index', 'transportista.index', 'agricultor.index', 
            'vehiculo.index', 'carga.index', 'facturas.index', 'info', 'choferes.buscar', 
            'transportista.buscar', 'agricultores.buscar', 'vehiculo.buscar', 'carga.buscar', 
            'pago.buscar', 'campo.buscar', 'filtros.avanzados', 'filtro.avanzado', 
            'transportista.buscarPorRUC', 'guias.print', 'guias.download', 'generar-pdf', 
            'obtenerDatosAgricultores', 'transportistas.store', 'vehiculo.store', 'agricultor.store', 
            'conductor.store', 'carga.store', 'campo.store', 'pagos.store', 'guia_remision.store', 
            'facturas.store', 'guias.edit', 'guias.update', 'pago.edit', 'pago.update', 'campo.edit', 
            'campo.update', 'conductor.edit', 'conductor.update', 'transportista.edit', 
            'transportista.update', 'agricultor.edit', 'agricultor.update', 'vehiculo.edit', 
            'vehiculo.update', 'carga.edit', 'carga.update', 'ruc.transportista', 'ruc.agricultor', 
            'verificar-ruc', 'guias.destroy', 'guia_remision.borrar_seleccionados', 'pago.destroy', 
            'pago.borrar_seleccionados', 'campo.destroy', 'conductor.destroy', 
            'transportista.destroy', 'transportista.borrar_seleccionados', 'agricultor.destroy', 
            'vehiculo.destroy', 'carga.destroy', 'carga.borrar_seleccionadas', 'obtener-peso-bruto', 
            'asignar-vehiculo', 'enviar-notificaciones', 'agregar_pago', 'pagos.agricultores_saldo_negativo'
        ];

        // Crear permisos en la base de datos
        foreach ($allPermissions as $perm) {
            Permission::create(['name' => $perm]);
        }

        // Crear roles y asignar permisos
        $admin = Role::create(['name' => 'Administrador']);
        $admin->givePermissionTo(Permission::all());

        $asistente = Role::create(['name' => 'Asistente']);
        $asistentePermissions = array_diff($allPermissions, [
            'users.index', 'usuarios.eliminar', 'usuarios.editar', 'usuarios.actualizar',
            'auditorias.index', 'auditorias.buscar', 'auditorias.eliminarSeleccionados'
        ]);
        $asistente->givePermissionTo($asistentePermissions);

        $usuario = Role::create(['name' => 'Usuario']);
        $usuario->givePermissionTo([
            'mostrar.menu', 'guia-remision.index', 'guias.show', 'pago.index', 
            'campo.index', 'conductor.index', 'transportista.index', 'agricultor.index', 
            'vehiculo.index', 'carga.index', 'facturas.index', 'info', 'choferes.buscar', 
            'transportista.buscar', 'agricultores.buscar', 'vehiculo.buscar', 'carga.buscar', 
            'pago.buscar', 'campo.buscar', 'filtros.avanzados', 'filtro.avanzado'
        ]);
    }
}