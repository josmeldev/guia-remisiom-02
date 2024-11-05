<?php

namespace App\Http\Controllers;
use Illuminate\Database\QueryException;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\campo;
use Illuminate\Http\Request;
use App\Models\Guia;
use App\Models\Pago;
use App\Models\transportista;
use App\Models\agricultor;
use App\Models\Carga;
use Illuminate\Support\Facades\DB;
use App\Models\factura;
use Carbon\Carbon;
use DaveJamesMiller\Breadcrumbs\Facades\Breadcrumbs;

class guiaController extends Controller
{


    private function consultaPagosPeriodo($inicio_periodo, $fin_periodo)
{
    return DB::table('agricultors as a')
        ->leftJoin('cargas as c', 'c.RUC_Agricultor', '=', 'a.id')
        ->leftJoin('guias as g', 'g.carga_id', '=', 'c.id')
        ->leftJoin('pagos as p', 'p.guia_id', '=', 'g.id')
        ->select(
            'a.id AS agricultor_id',
            'a.razon_social AS agricultor_nombre',
            DB::raw('COALESCE(SUM((c.total_carga_bruta - c.total_material_extrano - c.tara) * p.precio_unitario), 0) AS total_devengado'),
            DB::raw('COALESCE(SUM(p.adelanto), 0) AS adelanto_total'),
            DB::raw('COALESCE(SUM(p.monto), 0) AS monto_total'),
            DB::raw('COALESCE(SUM(p.monto - ((c.total_carga_bruta - c.total_material_extrano - c.tara) * p.precio_unitario - p.adelanto)), 0) AS saldo_pendiente'),
            DB::raw('COALESCE(SUM((c.total_carga_bruta - c.total_material_extrano - c.tara) * p.precio_unitario) - SUM(p.adelanto), 0) AS total_a_pagar')
        )
        ->whereBetween('c.fecha_de_descarga', [$inicio_periodo, $fin_periodo])
        ->groupBy('a.id', 'a.razon_social')
        ->get();
}
    public function index()
    {

        $totalGuias = Guia::count();
        $guiasPorEstado = [
            'Guía Facturada' => Guia::where('estado', 'guia_facturada')->count(),
            'Guía por Facturar' => Guia::where('estado', 'guia_por_facturar')->count(),
            'Factura Cancelada' => Guia::where('estado', 'factura_cancelada')->count(),
            'Factura por Cancelar' => Guia::where('estado', 'factura_por_cancelar')->count(),
        ];


        $guiasHoy = Guia::whereDate('fecha_emision', today())->count();

        $guiasPorEstadoConDetalles = [];

        foreach ($guiasPorEstado as $estado => $cantidad) {
            $guias = Guia::where('estado', $estado)->get();
            $guiasPorEstadoConDetalles[$estado] = $guias;
        }



        $guias = Guia::all();
        $pagos = Pago::all();
        $cargas = Carga::all();
        $campos = campo::all();
        $agricultores = Agricultor::all();
        $agricultor = Agricultor::first();
        $agricultorId = $agricultor ? $agricultor->id : null;

        $transportista = Transportista::first();
        $transportistaId = $transportista ? $transportista->id : null;


        Breadcrumbs::for('guia-remision.index', function ($trail) {
            $trail->push('Inicio', route('mostrar.menu'));
            $trail->push('Informacion de Guías de Remisión', route('guia-remision.index'));
        });


        $inicio_periodo = Carbon::now()->startOfWeek();
        $fin_periodo = Carbon::now()->endOfWeek();

        $agricultores_a_pagar = $this->consultaPagosPeriodo($inicio_periodo, $fin_periodo);

        $agricultores_deben = $agricultores_a_pagar->filter(function ($agricultor) {
            return $agricultor->saldo_pendiente > 0;
        });

        $agricultores_no_deben = $agricultores_a_pagar->filter(function ($agricultor) {
            return $agricultor->saldo_pendiente == 0;
        });
        $num_notificaciones = $agricultores_deben->count() + $agricultores_no_deben->count();

        $guiasPorSemana = DB::table('guias')
        ->select(DB::raw('YEARWEEK(fecha_emision) AS semana'), DB::raw('COUNT(*) AS total'))
        ->groupBy(DB::raw('YEARWEEK(fecha_emision)'))
        ->get();

    // Calcula el total general de guías emitidas
        $totalGuias = $guiasPorSemana->sum('total');

        $transportistas = transportista::all();

        $guiasPorAgricultor = DB::table('guias')
        ->join('agricultors', 'guias.agricultor_id', '=', 'agricultors.id')
        ->select('agricultors.razon_social AS agricultor', DB::raw('COUNT(*) AS total_guias'))
        ->groupBy('agricultors.id', 'agricultors.razon_social')
        ->orderBy('total_guias', 'desc')
        ->get();



        return view('guia_remision.index', compact('guias','pagos','campos','transportistas','agricultorId','transportistaId','agricultores','totalGuias','guiasPorEstado','guiasHoy',
        'guiasPorEstadoConDetalles', 'cargas', 'agricultores_a_pagar', 'agricultores_deben', 'agricultores_no_deben', 'num_notificaciones', 'totalGuias', 'guiasPorSemana', 'guiasPorAgricultor'));
    }


    public function store(Request $request)
{
    try {
        // Validar los datos del formulario
        $validatedData = $request->validate([
            'fecha_emision' => 'required|date',
            'nro_ticket' => 'required',
            'fecha_partida' => 'required|date',
            'punto_partida' => 'required',
            'punto_llegada' => 'required',
            'producto' => 'required',
            'nro_factura' => 'nullable',
            'estado' => 'required',
            'ruc_agricultor' => 'required',
            'ruc_transportista' => 'required',
            'carga_id' => 'required|exists:cargas,id',
        ]);

        // Verificar si la factura ya existe en la tabla de facturas
        $factura = factura::where('nro_factura', $request->nro_factura)->first();

        // Si la factura no existe, crearla
        if (!$factura) {
            $factura = Factura::create([
                'nro_factura' => $request->nro_factura,
                // Otros campos de factura
            ]);
        }

        // Obtener el ID del agricultor y del transportista
        $agricultorId = Agricultor::where('ruc', $request->ruc_agricultor)->value('id');
        $transportistaId = Transportista::where('RUC', $request->ruc_transportista)->value('id');

        // Verificar si se encontraron los IDs
        if (!$agricultorId || !$transportistaId) {
            return redirect()->back()->with('error', 'No se encontró un agricultor o transportista con el RUC proporcionado.');
        }

        // Asignar los IDs encontrados y el ID de la factura
        $validatedData['agricultor_id'] = $agricultorId;
        $validatedData['transportista_id'] = $transportistaId;
        $validatedData['nro_factura'] = $factura->id;

        // Crear una nueva instancia de GuiaRemision con los datos del formulario
        Guia::create($validatedData);

        // Redireccionar al usuario a la página deseada después de guardar la guía de remisión
        return redirect()->back()->with('success', '¡La guía de remisión se ha creado exitosamente!');
    } catch (QueryException $e) {
        // Capturar excepciones de base de datos y manejarlas
        return redirect()->back()->with('error', 'Error al guardar la guía de remisión: ' . $e->getMessage());
    } catch (\Exception $e) {
        // Capturar otras excepciones y manejarlas
        return redirect()->back()->with('error', 'Error desconocido al guardar la guía de remisión: ' . $e->getMessage());
    }
}

    public function edit($id)
    {

    }


    public function update(Request $request, $id)
    {
        try {
            // Validar los datos del formulario
            $validatedData = $request->validate([
                'fecha_emision' => 'required|date',
                'nro_guia' => 'required|unique:guias,nro_guia,'.$id,
                'nro_ticket' => 'required',
                'fecha_partida' => 'required|date',
                'punto_partida' => 'required',
                'punto_llegada' => 'required',
                'producto' => 'required',
                'peso_bruto' => 'required',
                'estado' => 'required',
                'ruc_agricultor' => 'required',
                'ruc_transportista' => 'required',

            ]);

            // Obtener el ID del agricultor y del transportista
            $agricultorId = Agricultor::where('ruc', $request->ruc_agricultor)->value('id');
            $transportistaId = Transportista::where('RUC', $request->ruc_transportista)->value('id');

            // Verificar si se encontraron los IDs
            if (!$agricultorId || !$transportistaId) {
                return redirect()->back()->with('error', 'No se encontró un agricultor o transportista con el RUC proporcionado.');
            }

            // Asignar los IDs encontrados
            $validatedData['agricultor_id'] = $agricultorId;
            $validatedData['transportista_id'] = $transportistaId;

            // Buscar la guía de remisión por su ID
            $guia = Guia::findOrFail($id);

            // Actualizar los datos de la guía de remisión
            $guia->update($validatedData);

            // Redireccionar al usuario a la página deseada después de actualizar la guía de remisión
            return redirect()->back()->with('success', '¡La guía de remisión se ha actualizado exitosamente!');
        } catch (QueryException $e) {
            // Capturar excepciones de base de datos y manejarlas
            return redirect()->back()->with('error', 'Error al actualizar la guía de remisión: ' . $e->getMessage());
        } catch (\Exception $e) {
            // Capturar otras excepciones y manejarlas
            return redirect()->back()->with('error', 'Error desconocido al actualizar la guía de remisión: ' . $e->getMessage());
        }
    }

    public function destroy($id)
    {
        try {
            $guia = Guia::findOrFail($id);
            $guia->delete();

            return redirect()->back()->with('success', 'Guía de remisión eliminada correctamente');
        } catch (\Exception $e) {
            // Manejo de errores si la guía no se encuentra o hay otros problemas
            return redirect()->back()->with('error', 'Error al eliminar la guía de remisión: ' . $e->getMessage());
        }
    }

    public function borrarSeleccionados(Request $request)
    {
        try {
            $guiaIdsString = $request->input('guia_ids');

            // Convertir la cadena de IDs en un array
            $guiaIds = explode(',', $guiaIdsString);

            // Verificar si se recibieron IDs de guías
            if (!empty($guiaIds)) {
                // Borrar las guías de remisión seleccionadas
                Guia::whereIn('id', $guiaIds)->delete();

                return redirect()->back()->with('success', 'Las guías de remisión seleccionadas se han borrado correctamente.');
            } else {
                return redirect()->back()->with('error', 'No se han seleccionado guías de remisión para borrar.');
            }
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Ocurrió un error al intentar borrar las guías de remisión seleccionadas: ' . $e->getMessage());
        }
    }

    public function verificarRuc(Request $request)
{
    // Obtiene el RUC del parámetro de la solicitud
    $ruc = $request->get('ruc');

    // Busca un agricultor con el RUC dado en la base de datos
    $agricultor = Agricultor::where('RUC', $ruc)->first();

    // Busca un transportista con el RUC dado en la base de datos
    $transportista = Transportista::where('RUC', $ruc)->first();

    // Verifica si se encontró un agricultor o un transportista con el RUC dado
    if ($agricultor || $transportista) {
        // Si se encuentra, devuelve una respuesta JSON con 'registrado' como verdadero
        return response()->json(['registrado' => true]);
    } else {
        // Si no se encuentra, devuelve una respuesta JSON con 'registrado' como falso
        return response()->json(['registrado' => false]);
    }
}



    public function buscarPorRUC(Request $request)
    {
        $ruc = $request->ruc;
        // Realiza la búsqueda en la base de datos por el RUC proporcionado
        $transportista = Transportista::where('ruc', $ruc)->first();

        if ($transportista) {
            return response()->json(['success' => true, 'transportista_id' => $transportista->id]);
        } else {
            return response()->json(['success' => false, 'error' => 'No se encontró ningún transportista con el RUC proporcionado.']);
        }
    }

    public function obtenerPesoBruto(Request $request)
    {
        // Obtener el RUC del transportista enviado desde la solicitud AJAX
        $ruc_transportista = $request->input('ruc_transportista');

        // Buscar el peso bruto asociado al RUC del transportista en la base de datos
        $peso_bruto = Carga::join('vehiculos', 'cargas.id_vehiculo', '=', 'vehiculos.id')
                            ->join('transportistas', 'vehiculos.id_transportista', '=', 'transportistas.id')
                            ->where('transportistas.RUC', $ruc_transportista)
                            ->value('cargas.total_carga_bruta');

        // Devolver el peso bruto como respuesta a la solicitud AJAX
        return response()->json($peso_bruto);
    }

    public function print($id)
    {
        $guia = Guia::findOrFail($id);

        // Retornar la vista con los datos de la guía
        return view('guias', compact('guia'));
    }

     public function downloadPDF($id)
    {
        $guia = Guia::findOrFail($id);
        $agricultor = Agricultor::findOrFail($guia->agricultor_id); // Ajusta según tu modelo
        $transportista = Transportista::findOrFail($guia->transportista_id); // Ajusta según tu modelo


        $pdf = PDF::loadView('home', compact('guia', 'agricultor', 'transportista'));

        return $pdf->download('guia_' . $guia->id . '.pdf');
    }

    public function verificarRucTransportista(Request $request)
    {
        $ruc = $request->input('ruc_transportista');

        $datos = Transportista::where('RUC', $ruc)->first();
        if ($datos) {
            return response()->json([
                'razon_social' => $datos->razon_social,
                'direccion' => $datos->direccion,
                'RUC' => $datos->RUC,
            ]);
        } else {
            return response()->json(['error' => 'No se encontraron datos para el RUC proporcionado'], 404);
        }
        
    }

    public function verificarRucAgricultor(Request $request)
    {
        $ruc = $request->input('ruc_agricultor');

        $datos = Agricultor::where('ruc', $ruc)->first();
        if ($datos) {
            return response()->json([
                'razon_social' => $datos->razon_social,
                'direccion' => $datos->direccion,
                'ruc' => $datos->ruc,
            ]);
        } else {
            return response()->json(['error' => 'No se encontraron datos para el RUC proporcionado'], 404);
        }
        
    }

}
