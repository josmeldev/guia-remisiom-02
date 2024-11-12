<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Carga;
use App\Models\Chofer;
use App\Models\Guia;
use App\Models\Pago;
use App\Models\agricultor;
use App\Models\campo;
use App\Models\transportista;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class cargaController extends Controller
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
        $guias = Guia::all();
        $choferes = Chofer::all();
        $cargas = Carga::all();
        $pagos = Pago::all();
        $agricultores = Agricultor::all();
        $campos = campo::all();
        $transportistas = transportista::all();

        $user = Auth::user();
        $notifications = $user->notifications;

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

        return view('carga.index', compact('guias','pagos','campos','transportistas','agricultores','cargas','choferes',
            'agricultores_deben','agricultores_no_deben','num_notificaciones'));
    }




    public function store(Request $request)
{
    try {
        // Validar los datos del formulario
        $validatedData = $request->validate([
            'chofer_id' => 'required|exists:chofers,id',
            'total_carga_bruta' => 'required',
            'total_material_extrano' => 'required',
            'tara' => 'required',
            'nro_ticket' => 'required',
            'km_origen' => 'required',
            'km_de_destino' => 'required',
            'fecha_carga' => 'required|date',
            'fecha_de_descarga' => 'required|date',
            'RUC_Agricultor' => 'required|exists:agricultors,id',
            
        ]);

        // Crear una nueva instancia de carga con los datos validados y guardarla en la base de datos
        Carga::create($validatedData);

        // Redireccionar de vuelta a la página del formulario con un mensaje de éxito
        return redirect()->back()->with('success', 'Carga registrada exitosamente.');
    } catch (\Exception $e) {
        // Manejar cualquier excepción y mostrar un mensaje de error
        return redirect()->back()->with('error', 'Error al registrar la carga: ' . $e->getMessage());
    }
}


    public function update(Request $request, $id)
    {
        // Validar los datos del formulario
        $validatedData = $request->validate([
            'chofer_id' => 'required|exists:chofers,id',
            'total_carga_bruta' => 'required',
            'total_material_extrano' => 'required',
            'tara' => 'required',
            'nro_ticket' => 'required',
            'km_origen' => 'required',
            'km_de_destino' => 'required',
            'fecha_carga' => 'required|date',
            'fecha_de_descarga' => 'required|date',
        ]);

        // Obtener la carga a actualizar
        $carga = Carga::findOrFail($id);

        // Actualizar los campos de la carga con los datos validados
        $carga->update($validatedData);

        // Redireccionar de vuelta a la página del formulario con un mensaje de éxito
        return redirect()->back()->with('success', 'Carga actualizada exitosamente.');
    }

    public function destroy($id)
    {
        try {
            $carga = transportista::findOrFail($id);
            $carga->delete();

            return redirect()->back()->with('success', 'Carga eliminada correctamente');
        } catch (\Exception $e) {
            // Manejo de errores si la guía no se encuentra o hay otros problemas
            return redirect()->back()->with('error', 'Error al eliminar carga: ' . $e->getMessage());
        }
    }

    public function buscarCarga(Request $request)
{
    // Inicializar la consulta de cargas
    $query = Carga::query();

    // Aplicar filtros si existen
    if ($request->filled('total_carga_bruta')) {
        $query->where('total_carga_bruta', 'like', '%' . $request->input('total_carga_bruta') . '%');
    }



    if ($request->filled('total_material_extrano')) {
        $query->where('total_material_extrano', 'like', '%' . $request->input('total_material_extrano') . '%');
    }

    if ($request->filled('chofer_id')) {
        $query->where('chofer_id', $request->input('chofer_id'));
    }

    if ($request->filled('km_origen')) {
        $query->where('km_origen', 'like', '%' . $request->input('km_origen') . '%');
    }

    if ($request->filled('km_de_destino')) {
        $query->where('km_de_destino', 'like', '%' . $request->input('km_de_destino') . '%');
    }

    if ($request->filled('fecha_carga')) {
        $query->whereDate('fecha_carga', $request->input('fecha_carga'));
    }

    if ($request->filled('fecha_de_descarga')) {
        $query->whereDate('fecha_de_descarga', $request->input('fecha_de_descarga'));
    }

    // Obtener las cargas que cumplen con los criterios de búsqueda
    $cargas = $query->get();

    // Obtener la lista de conductores para el campo de selección
    $choferes = Chofer::all();

    $agricultores = Agricultor::all();
    

    // Devolver la vista con los resultados de la búsqueda y la lista de conductores
    return view('carga.index', compact('cargas', 'choferes', 'agricultores'));
}
    public function borrarSeleccionados(Request $request)
    {
        try {
            $cargaIdsString = $request->input('carga_ids');

            // Convertir la cadena de IDs en un array
            $cargaIds = explode(',', $cargaIdsString);


            if (!empty($cargaIds)) {

                Carga::whereIn('id', $cargaIds)->delete();

                return redirect()->back()->with('success', 'Los registros de la tabla Carga  seleccionados se han borrado correctamente.');
            } else {
                return redirect()->back()->with('error', 'No se han seleccionado registros para borrar.');
            }
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Ocurrió un error al intentar borrar los registros seleccionados: ' . $e->getMessage());
        }
    }

}
