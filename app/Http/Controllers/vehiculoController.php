<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;


use App\Models\agricultor;
use Illuminate\Http\Request;
use App\Models\vehiculo;
use App\Models\Transportista;
use App\Models\chofer;
use App\Models\Carga;
use App\Models\Pago;
use App\Models\campo;
use App\Models\Guia;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;


class vehiculoController extends Controller
{
    public function index()
    {
        if (!Gate::allows('ver-vehiculos')) {
            abort(403); // Devuelve un error 403 - Prohibido si no tiene el permiso
        }

        // Si el usuario tiene el permiso, carga los vehículos y otras variables necesarias
        $guias = Guia::all();
        $choferes = Chofer::all();
        $vehiculos = Vehiculo::all();
        $cargas = Carga::all();
        $pagos = Pago::all();
        $agricultores = Agricultor::all();
        $campos = Campo::all();
        $transportistas = Transportista::all();
        $user = Auth::user();
        $message = '¡Hola! ' . $user->name;
        $totalVehiculos = Vehiculo::count();
        $totalVehiculosConCarreta = Vehiculo::whereNotNull('placa1')->count();

        return view('vehiculos.index', compact(
            'guias', 'pagos', 'campos', 'transportistas', 'agricultores',
            'cargas', 'choferes', 'vehiculos', 'message', 'totalVehiculos',
            'totalVehiculosConCarreta'
        ));
    }


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

    public function mostrarMenu()
    {
        $transportistas = Transportista::all();
        $agricultores = Agricultor::all();
        $cargas = Carga::all();
        $vehiculos = vehiculo::all();
        $pagos = Pago::all();
        $campos = campo::all();
        $conductores = chofer::all(); // Obtener todos los conductores

        $user = User::first();
        $message = '¡Hola! ' . $user->name;

        $agricultor = Agricultor::first();
        $agricultorId = $agricultor ? $agricultor->id : null;

        $transportista = Transportista::first();
        $transportistaId = $transportista ? $transportista->id : null;

        $carga = carga::first();
        $cargaId = $carga ? $carga->id : null;

        $guias = Guia::all();


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

        $guiasP = Guia::with('carga')->get();


        return view('menu', compact('transportistas', 'conductores', 'agricultores', 'cargas', 'vehiculos', 'pagos', 'campos', 'message', 'agricultorId', 'transportistaId', 'cargaId','guiasP', 'guias',
    'notifications', 'agricultores_a_pagar', 'agricultores_deben', 'agricultores_no_deben', 'num_notificaciones'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'placa' => 'required|unique:vehiculos', // Agrega la regla 'unique' para validar que la placa sea única en la tabla 'vehiculos'
            'placa1' => 'nullable|unique:vehiculos',
            'dueño' => 'required',
            'id_transportista' => 'required'
        ]);

        try {
            $vehiculo = new Vehiculo();

            $vehiculo->placa = $request->placa;
            $vehiculo->placa1 = $request->placa1;
            $vehiculo->dueño = $request->dueño;
            $vehiculo->id_transportista = $request->id_transportista;

            $vehiculo->save();

            return redirect()->back()->with('success', 'Vehículo guardado correctamente');
        } catch (QueryException $e) {
            if ($e->errorInfo[1] == 1062) { // El código 1062 indica una violación de clave única
                return redirect()->back()->with('error', 'No se puede registrar el vehículo porque la placa ya ha sido registrada.');
            } else {
                return redirect()->back()->with('error', 'Error al guardar el vehículo: ' . $e->getMessage());
            }
        }
    }


    public function update(Request $request, $id)
    {
        $vehiculo = vehiculo::findOrFail($id);
        $vehiculo->placa = $request->placa;
        $vehiculo->placa1 = $request->placa1;
        $vehiculo->dueño = $request->dueño;
        $vehiculo->id_transportista = $request->id_transportista;



        // Guardar los cambios
        $vehiculo->save();

        // Redirigir de vuelta al formulario de edición con un mensaje de éxito
        return redirect()->back()->with('success', 'Vehiculo actualizado correctamente');
    }

    public function destroy($id)
    {
        try {
            $vehiculo = vehiculo::findOrFail($id);
            $vehiculo->delete();

            return redirect()->back()->with('success', 'Vehiculo eliminado correctamente');
        } catch (\Exception $e) {
            // Manejo de errores si la guía no se encuentra o hay otros problemas
            return redirect()->back()->with('error', 'Error al eliminar Vehiculo: ' . $e->getMessage());
        }
    }


    public function buscar(Request $request)
{
    // Inicializar la consulta de vehículos
    $query = Vehiculo::query();

    // Verificar si se proporciona algún valor en los campos de búsqueda y agregar condiciones where correspondientes
    if ($request->filled('placa')) {
        $query->where('placa', 'LIKE', '%' . $request->input('placa') . '%');
    }

    if ($request->filled('placa1')) {
        $query->where('placa1', 'LIKE', '%' . $request->input('placa1') . '%');
    }


    if ($request->filled('dueño')) {
        $query->where('dueño', 'LIKE', '%' . $request->input('dueño') . '%');
    }

    if ($request->filled('id_transportista')) {
        $query->where('id_transportista', $request->input('id_transportista'));
    }

    // Obtener los resultados de la búsqueda
    $vehiculos = $query->get();
    $transportistas = Transportista::all();
    $totalVehiculos = Vehiculo::count();
    $totalVehiculosConCarreta = Vehiculo::whereNotNull('placa1')->count();

    // Retornar los resultados a la vista
    return view('vehiculos.index', compact('vehiculos', 'transportistas', 'totalVehiculos', 'totalVehiculosConCarreta'));
}




}
