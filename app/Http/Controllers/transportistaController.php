<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Models\transportista;
use App\Models\agricultor;
use App\Models\Guia;
use App\Models\Pago;
use App\Models\Chofer;
use App\Models\Carga;
use App\Models\campo;
use App\Models\User;
use Carbon\Carbon;
use DaveJamesMiller\Breadcrumbs\Facades\Breadcrumbs;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class transportistaController extends Controller

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


        Breadcrumbs::for('transportista.index', function ($trail) {
            $trail->push('Inicio', route('mostrar.menu'));
            $trail->push('Seccion de Transportistas', route('transportista.index'));

        });

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

        $guias = Guia::all();
        $choferes = Chofer::all();
        $cargas = Carga::all();
        $pagos = Pago::all();
        $agricultores = Agricultor::all();
        $campos = campo::all();
        $transportistas = Transportista::paginate(5);
        return view('transportista.index', compact('guias','pagos','campos','transportistas','agricultores','cargas','choferes'
    ,'num_notificaciones','notifications','agricultores_a_pagar','agricultores_deben','agricultores_no_deben'));
    }

    public function store(Request $request)
    {
        try {
            // Validar los datos del formulario
            $validatedData = $request->validate([
                'codigo_mtc' => 'required',
                'telefono' => 'unique:transportistas|nullable',
                'razon_social' => 'nullable',
                'direccion' => 'nullable',
                //'zona' => 'nullable',


                'correo_electronico' => 'nullable|email|max:255',
                'RUC' => [
                    'required',
                    Rule::unique('transportistas')->where(function ($query) use ($request) {
                        return $query->where('RUC', $request->RUC);
                    }),
                ],
            ], [
                'RUC.unique' => 'El RUC ya está registrado.', // Mensaje personalizado para la regla unique
            ]);

            // Crear un nuevo objeto Transportista con los datos del formulario
            Transportista::create($validatedData);

            // Redireccionar a alguna vista después de guardar los datos
            return redirect()->back()->with('success', 'Transportista registrado exitosamente.');
        } catch (QueryException $e) {
            // Capturar excepciones de base de datos y manejarlas
            return redirect()->back()->with('error', 'Error al registrar el transportista: ' . $e->getMessage());
        }
    }



    public function update(Request $request, $id)
    {
        $transportista = transportista::findOrFail($id);
        $transportista->codigo_mtc = $request->codigo_mtc;
        $transportista->telefono = $request->telefono;
        $transportista->RUC = $request->RUC;
        $transportista->razon_social = $request->razon_social;
        $transportista->direccion = $request->direccion;
        //$transportista->zona = $request->zona;
        $transportista->correo_electronico = $request->correo_electronico;


        // Guardar los cambios
        $transportista->save();

        // Redirigir de vuelta al formulario de edición con un mensaje de éxito
        return redirect()->back()->with('success', 'Trasportista actualizado correctamente');
    }

    public function destroy($id)
    {
        try {
            $transportista = transportista::findOrFail($id);
            $transportista->delete();

            return redirect()->back()->with('success', 'Transportista eliminado correctamente');
        } catch (\Exception $e) {
            // Manejo de errores si la guía no se encuentra o hay otros problemas
            return redirect()->back()->with('error', 'Error al eliminar transportista: ' . $e->getMessage());
        }
    }

    public function borrarSeleccionados(Request $request)
    {
        try {
            $transportistaIdsString = $request->input('transportista_ids');

            // Convertir la cadena de IDs en un array
            $transportistaIds = explode(',', $transportistaIdsString);

            // Verificar si se recibieron IDs de guías
            if (!empty($transportistaIds)) {
                // Borrar las guías de remisión seleccionadas
                Transportista::whereIn('id', $transportistaIds)->delete();

                return redirect()->back()->with('success', 'Los transportistas seleccionados se han borrado correctamente.');
            } else {
                return redirect()->back()->with('error', 'No se han seleccionado ningun transportista para borrar.');
            }
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Ocurrió un error al intentar borrar transportistas seleccionados: ' . $e->getMessage());
        }
    }



public function buscarTransportista(Request $request)
{
    Breadcrumbs::for('transportista.index', function ($trail) {
        $trail->push('Inicio', route('mostrar.menu'));
        $trail->push('Seccion de Transportistas', route('transportista.index'));

    });
    // Inicializar la consulta de transportistas
    $query = Transportista::query();

    // Aplicar filtros si existen
    if ($request->filled('codigo_mtc')) {
       $query->where('codigo_mtc', 'like', '%' . $request->input('codigo_mtc') . '%');
    }

    if ($request->filled('telefono')) {
       $query->where('telfono', 'like', '%' . $request->input('telefono') . '%');
    }

    if ($request->filled('ruc')) {
        $query->where('RUC', 'like', '%' . $request->input('ruc') . '%');
    }

    if ($request->filled('razon_social')) {
        $query->where('razon_social', 'like', '%' . $request->input('razon_social') . '%');
    }


    //if ($request->filled('zona')) {
    //    $query->where('zona', 'like', '%' . $request->input('zona') . '%');
    //}

    if ($request->filled('correo_electronico')) {
        $query->where('correo_electronico', 'like', '%' . $request->input('correo_electronico') . '%');
    }

    // Obtener los transportistas que cumplen con los criterios de búsqueda
    $transportistas = $query->paginate(5); // Paginar los resultados

    $users = User::all(); // Recupera todos los usuarios

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

    // Devolver la vista con los resultados de la búsqueda
    return view('transportista.index', compact('transportistas', 'users', 'num_notificaciones', 'agricultores_deben', 'agricultores_no_deben'));
}



}
