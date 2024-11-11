<?php

namespace App\Http\Controllers;

use App\Models\campo;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Collection;
use Illuminate\Http\Request;
use App\Models\Transportista;
use App\Models\pago;


class FiltrosAvanzadosController extends Controller
{
    
    public function mostrarFiltrosAvanzados()
    {
        // Realiza la consulta SQL para obtener los datos necesarios
        $campos=campo::all();
        $pagos= pago::all();
        $transportistas=Transportista::all();
        $datos = DB::select('
        SELECT
    G.*,
    P.adelanto,
    P.precio_unitario,
    C.total_carga_bruta,
    C.total_carga_neta,
    C.total_material_extrano,
    C.km_origen,
    C.km_de_destino,
    C.fecha_carga,
    C.fecha_de_descarga,
    CAM.nombre_campo,
    CAM.ubigeo,
    CAM.zona,
    CAM.unidad_tecnica,
    T.codigo_mtc,
    T.campo,
    T.RUC,
    T.razon_social,
    T.codigo,
    T.nombre AS nombre_transportista,
    CH.nombre_apellidos AS datos_conductor,
    CH.dni AS dni_conductor,
    V.placa,
    V.codigo AS codigo_vehiculo,
    V.num_ejes,
    A.apellidos AS apellidos_agricultor,
    A.nombres AS nombres_agricultor,
    A.dni AS dni_agricultor
FROM
    guias G
LEFT JOIN
    pagos P ON G.pago_id = P.id
LEFT JOIN
    campos CAM ON G.campo_id = CAM.id
LEFT JOIN
    cargas C ON CAM.carga_id = C.id
LEFT JOIN
    transportistas T ON G.transportista_id = T.id
LEFT JOIN
    chofers CH ON C.id_conductor = CH.id
LEFT JOIN
    vehiculos V ON CH.id_vehiculo = V.id
LEFT JOIN
    agricultors A ON CAM.agricultor_id = A.id;

        ');
        $columnIds = ['id', 'ruc', 'razon_social', 'direccion', 'nro_guia', 'nro_viaje', 'adelanto', 'precio', 'carga_bruta', 'carga_neta', 'material_extrano', 'km_origen', 'km_destino', 'fecha_carga', 'fecha_descarga', 'nombre_campo', 'ubigeo', 'zona', 'unidad_tecnica', 'codigo_mtc', 'campo', 'transportista', 'conductor', 'dni_conductor', 'placa', 'codigo_vehiculo', 'numero_ejes', 'nombre_agricultor', 'apellidos_agricultor', 'dni_agricultor'];

         // Realiza la consulta SQL para obtener los datos necesarios
        $defaultColumns = ['id', 'ruc', 'razon_social','direccion', 'nro_guia', 'nro_viaje']; // Definir las columnas por defecto que deseas mostrar al iniciar la página
        $datosColeccion = Collection::make($datos);
        // Retorna la vista con los datos obtenidos
        return view('FiltrosAvanzados', compact('datos', 'columnIds', 'defaultColumns','datosColeccion','campos','pagos','transportistas'));
    }
    
    public function filtrar(Request $request)
    {
        $filtroRuc = $request->input('ruc');
        $filtroRazonSocial = $request->input('razon_social');
        $filtroDireccion = $request->input('direccion');
        $filtroNroGuia = $request->input('nro_guia');
        $filtroNroViaje = $request->input('nro_viaje');

        $datos = DB::select("
            SELECT
            G.*,
            P.adelanto,
            P.precio_unitario,
            C.total_carga_bruta,
            C.total_carga_neta,
            C.total_material_extrano,
            C.km_origen,
            C.km_de_destino,
            C.fecha_carga,
            C.fecha_de_descarga,
            CAM.nombre_campo,
            CAM.ubigeo,
            CAM.zona,
            CAM.unidad_tecnica,
            T.codigo_mtc,
            T.campo,
            T.RUC,
            T.razon_social,
            T.codigo,
            T.nombre AS nombre_transportista,
            CH.nombre_apellidos AS datos_conductor,
            CH.dni AS dni_conductor,
            V.placa,
            V.codigo AS codigo_vehiculo,
            V.num_ejes,
            A.apellidos AS apellidos_agricultor,
            A.nombres AS nombres_agricultor,
            A.dni AS dni_agricultor
            FROM
                guias G
            LEFT JOIN
                pagos P ON G.pago_id = P.id
            LEFT JOIN
                campos CAM ON G.campo_id = CAM.id
            LEFT JOIN
                cargas C ON CAM.carga_id = C.id
            LEFT JOIN
                transportistas T ON G.transportista_id = T.id
            LEFT JOIN
                chofers CH ON C.id_conductor = CH.id
            LEFT JOIN
                vehiculos V ON C.id_conductor = V.id
            LEFT JOIN
                agricultors A ON CAM.agricultor_id = A.id
            WHERE
                G.ruc LIKE '%$filtroRuc%'
                AND G.razon_social LIKE '%$filtroRazonSocial%'
                AND G.direccion LIKE '%$filtroDireccion%'
                AND G.nro_guia LIKE '%$filtroNroGuia%'
                AND G.nro_viaje LIKE '%$filtroNroViaje%'
        ");

         // Define el array de columnas
         $columnIds = ['id', 'ruc', 'razon_social', 'direccion', 'nro_guia', 'nro_viaje', 'adelanto', 'precio', 'carga_bruta', 'carga_neta', 'material_extrano', 'km_origen', 'km_destino', 'fecha_carga', 'fecha_descarga', 'nombre_campo', 'ubigeo', 'zona', 'unidad_tecnica', 'codigo_mtc', 'campo', 'transportista', 'conductor', 'dni_conductor', 'placa', 'codigo_vehiculo', 'numero_ejes', 'nombre_agricultor', 'apellidos_agricultor', 'dni_agricultor'];

         // Realiza la consulta SQL para obtener los datos necesarios
         $defaultColumns = ['id', 'ruc', 'razon_social','direccion', 'nro_guia', 'nro_viaje']; // Definir las columnas por defecto que deseas mostrar al iniciar la página
         $datosColeccion = Collection::make($datos);

         return view('FiltrosAvanzados', compact('datos', 'columnIds', 'defaultColumns','datosColeccion'));
    }

   
}
