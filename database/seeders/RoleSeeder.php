<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleSeeder extends Seeder
{
    public function run()
    {
        // Permisos para Guías
        Permission::create(['name' => 'ver-guias']);
        Permission::create(['name' => 'crear-guias']);
        Permission::create(['name' => 'editar-guias']);
        Permission::create(['name' => 'eliminar-guias']);
        Permission::create(['name' => 'imprimir-guias']);
        Permission::create(['name' => 'descargar-guias']);

        // Permisos para Pagos
        Permission::create(['name' => 'ver-pagos']);
        Permission::create(['name' => 'crear-pagos']);
        Permission::create(['name' => 'editar-pagos']);
        Permission::create(['name' => 'eliminar-pagos']);
        Permission::create(['name' => 'agregar-pagos']);
        Permission::create(['name' => 'ver-saldos-negativos']);

        // Permisos para Campos
        Permission::create(['name' => 'ver-campos']);
        Permission::create(['name' => 'crear-campos']);
        Permission::create(['name' => 'editar-campos']);
        Permission::create(['name' => 'eliminar-campos']);

        // Permisos para Conductores
        Permission::create(['name' => 'ver-conductores']);
        Permission::create(['name' => 'crear-conductores']);
        Permission::create(['name' => 'editar-conductores']);
        Permission::create(['name' => 'eliminar-conductores']);
        Permission::create(['name' => 'asignar-vehiculos']);

        // Permisos para Transportistas
        Permission::create(['name' => 'ver-transportistas']);
        Permission::create(['name' => 'crear-transportistas']);
        Permission::create(['name' => 'editar-transportistas']);
        Permission::create(['name' => 'eliminar-transportistas']);
        Permission::create(['name' => 'verificar-ruc-transportista']);

        // Permisos para Agricultores
        Permission::create(['name' => 'ver-agricultores']);
        Permission::create(['name' => 'crear-agricultores']);
        Permission::create(['name' => 'editar-agricultores']);
        Permission::create(['name' => 'eliminar-agricultores']);
        Permission::create(['name' => 'verificar-ruc-agricultor']);

        // Permisos para Vehículos
        Permission::create(['name' => 'ver-vehiculos']);
        Permission::create(['name' => 'crear-vehiculos']);
        Permission::create(['name' => 'editar-vehiculos']);
        Permission::create(['name' => 'eliminar-vehiculos']);

        // Permisos para Cargas
        Permission::create(['name' => 'ver-cargas']);
        Permission::create(['name' => 'crear-cargas']);
        Permission::create(['name' => 'editar-cargas']);
        Permission::create(['name' => 'eliminar-cargas']);

        // Permisos para Facturas
        Permission::create(['name' => 'ver-facturas']);
        Permission::create(['name' => 'crear-facturas']);

        // Permisos para Usuarios
        Permission::create(['name' => 'ver-usuarios']);
        Permission::create(['name' => 'crear-usuarios']);
        Permission::create(['name' => 'editar-usuarios']);
        Permission::create(['name' => 'eliminar-usuarios']);

        // Permisos especiales
        Permission::create(['name' => 'ver-filtros-avanzados']);
        Permission::create(['name' => 'enviar-notificaciones']);
        Permission::create(['name' => 'obtener-peso-bruto']);
        Permission::create(['name' => 'ver-dashboard']);

        // Crear roles y asignar permisos
        $admin = Role::create(['name' => 'Administrador']);
        $admin->givePermissionTo(Permission::all());

        $asistente = Role::create(['name' => 'Asistente']);
        $asistente->givePermissionTo([
            // Guías
            'ver-guias', 'crear-guias', 'editar-guias', 'eliminar-guias', 
            'imprimir-guias', 'descargar-guias',
            
            // Pagos
            'ver-pagos', 'crear-pagos', 'editar-pagos', 'eliminar-pagos',
            'agregar-pagos', 'ver-saldos-negativos',
            
            // Campos
            'ver-campos', 'crear-campos', 'editar-campos', 'eliminar-campos',
            
            // Conductores
            'ver-conductores', 'crear-conductores', 'editar-conductores', 
            'eliminar-conductores', 'asignar-vehiculos',
            
            // Transportistas
            'ver-transportistas', 'crear-transportistas', 'editar-transportistas',
            'eliminar-transportistas', 'verificar-ruc-transportista',
            
            // Agricultores
            'ver-agricultores', 'crear-agricultores', 'editar-agricultores',
            'eliminar-agricultores', 'verificar-ruc-agricultor',
            
            // Vehículos
            'ver-vehiculos', 'crear-vehiculos', 'editar-vehiculos', 'eliminar-vehiculos',
            
            // Cargas
            'ver-cargas', 'crear-cargas', 'editar-cargas', 'eliminar-cargas',
            
            // Facturas
            'ver-facturas', 'crear-facturas',
            
            // Especiales
            'ver-filtros-avanzados', 'enviar-notificaciones', 
            'obtener-peso-bruto', 'ver-dashboard'
        ]);

        $usuario = Role::create(['name' => 'Usuario']);
        $usuario->givePermissionTo([
            'ver-guias',
            'ver-pagos',
            'ver-campos',
            'ver-conductores',
            'ver-transportistas',
            'ver-agricultores',
            'ver-vehiculos',
            'ver-cargas',
            'ver-facturas',
            'ver-filtros-avanzados',
            'ver-dashboard'
        ]);
    }
}