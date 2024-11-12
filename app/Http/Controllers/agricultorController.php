<?php

namespace App\Http\Controllers;
use App\Models\agricultor;
use App\Models\Guia;
use App\Models\Pago;
use App\Models\Chofer;
use App\Models\Carga;
use App\Models\Transportista;
use App\Models\campo;

use App\Exports\AgricultoresExport;
use Carbon\Carbon;
use DaveJamesMiller\Breadcrumbs\Facades\Breadcrumbs;
use Maatwebsite\Excel\Facades\Excel;

use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class agricultorController extends Controller
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

        $user = Auth::user();
        $notifications = $user->notifications;

        $guias = Guia::all();
        $choferes = Chofer::all();
        $cargas = Carga::all();
        $pagos = Pago::all();
        $agricultores = Agricultor::all();
        $campos = campo::all();
        $transportistas = transportista::all();
        $totalAgricultores = Agricultor::count();

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

        Breadcrumbs::for('agricultor.index', function ($trail) {
            $trail->push('Inicio', route('mostrar.menu'));
            $trail->push('Sección de Agricultores', route('agricultor.index'));
        });

        return view('agricultor.index', compact('guias','pagos','campos','transportistas','agricultores','cargas','choferes','totalAgricultores',
        'notifications', 'agricultores_deben', 'agricultores_no_deben', 'num_notificaciones'));
    }


    public function store(Request $request)
    {
        try {
            // Validar los datos del formulario
            $validatedData = $request->validate([
                'representante' => 'required',
                'ruc' => 'unique:agricultors,ruc|nullable',
                'razon_social' => 'required',
                'direccion' => 'required',
                'dni' => 'unique:agricultors,dni|nullable',
                'numero_cuenta' => 'required|unique:agricultors,numero_cuenta|nullable',
                'banco' => 'required|nullable',
                'cci' => 'required|nullable',
                'correo_electronico' => 'required|email|max:255|nullable',
                'telefono' => 'required|nullable',
                'campo_id' => 'required|exists:campos,id',
            ], [
                'ruc.unique' => 'El RUC ya está registrado.',
                'dni.unique' => 'El DNI ya está registrado.',
                'numero_cuenta.unique' => 'El número de cuenta ya está registrado.',
            ]);

            // Crear una nueva instancia de agricultor con los datos validados y guardarla en la base de datos
            Agricultor::create([
                'representante' => $validatedData['representante'],
                'ruc' => $validatedData['ruc'],
                'razon_social' => $validatedData['razon_social'],
                'direccion' => $validatedData['direccion'],
                'dni' => $validatedData['dni'],
                'numero_cuenta' => $validatedData['numero_cuenta'],
                'banco' => $validatedData['banco'],
                'cci' => $validatedData['cci'],
                'correo_electronico' => $validatedData['correo_electronico'],
                'telefono' => $validatedData['telefono'],
                'campo_id' => $validatedData['campo_id'],

            ]);

            // Redireccionar de vuelta a la página del formulario con un mensaje de éxito
            return redirect()->back()->with('success', 'Agricultor registrado exitosamente.');
        } catch (\Exception $e) {
            // Capturar excepciones de base de datos y manejarlas
            return redirect()->back()->with('error', 'Error al registrar el agricultor: ' . $e->getMessage());
        }
    }


    public function update(Request $request, $id)
    {
        try {
            // Encontrar el agricultor por su ID
            $agricultor = Agricultor::findOrFail($id);

            // Actualizar los campos del agricultor con los datos del formulario
            $agricultor->representante = $request->representante;
            $agricultor->ruc = $request->ruc;
            $agricultor->razon_social = $request->razon_social;
            $agricultor->direccion = $request->direccion;
            $agricultor->dni = $request->dni;
            $agricultor->numero_cuenta = $request->numero_cuenta;
            $agricultor->banco = $request->banco;
            $agricultor->cci = $request->cci;
            $agricultor->correo_electronico = $request->correo_electronico;
            $agricultor->telefono = $request->telefono;
            $agricultor->campo_id = $request->campo_id;
            // Actualiza los demás campos aquí...

            // Guardar los cambios
            $agricultor->save();

            // Redirigir de vuelta al formulario de edición con un mensaje de éxito
            return redirect()->back()->with('success', 'Agricultor actualizado correctamente');
        } catch (\Exception $e) {
            // Manejar excepciones si ocurre algún error
            return redirect()->back()->with('error', 'Error al actualizar el agricultor: ' . $e->getMessage());
        }
    }

    public function destroy($id)
    {
        try {
            $agricultor = transportista::findOrFail($id);
            $agricultor->delete();

            return redirect()->back()->with('success', 'Agricultor eliminado correctamente');
        } catch (\Exception $e) {
            // Manejo de errores si la guía no se encuentra o hay otros problemas
            return redirect()->back()->with('error', 'Error al eliminar agricultor: ' . $e->getMessage());
        }
    }

    public function buscar(Request $request)
    {
        // Filtrar agricultores basados en los parámetros de búsqueda
        $query = Agricultor::query();

        if ($request->filled('ruc')) {
            $query->where('ruc', 'LIKE', '%' . $request->input('ruc') . '%');
        }

        if ($request->filled('razon_social')) {
            $query->where('razon_social', 'LIKE', '%' . $request->input('razon_social') . '%');
        }

        if ($request->filled('direccion')) {
            $query->where('direccion', 'LIKE', '%' . $request->input('direccion') . '%');
        }

        if ($request->filled('representante')) {
            $query->where('representante', 'LIKE', '%' . $request->input('representante') . '%');
        }

        if ($request->filled('dni')) {
            $query->where('dni', 'LIKE', '%' . $request->input('dni') . '%');
        }

        if ($request->filled('numero_cuenta')) {
            $query->where('numero_cuenta', 'LIKE', '%' . $request->input('numero_cuenta') . '%');
        }

        if ($request->filled('banco')) {
            $query->where('banco', 'LIKE', '%' . $request->input('banco') . '%');
        }

        if ($request->filled('cci')) {
            $query->where('cci', 'LIKE', '%' . $request->input('cci') . '%');
        }

        if ($request->filled('correo_electronico')) {
            $query->where('correo_electronico', 'LIKE', '%' . $request->input('correo_electronico') . '%');
        }

        if ($request->filled('telefono')) {
            $query->where('telefono', 'LIKE', '%' . $request->input('telefono') . '%');
        }

        if ($request->filled('campo_id')) {
            $query->where('campo_id', $request->input('campo_id'));
        }



        // Obtener los resultados de la búsqueda
        $agricultores = $query->get();
        $totalAgricultores = Agricultor::count();

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

        $campos = campo::all();

        // Retornar los resultados a la vista
        return view('agricultor.index', compact('agricultores', 'totalAgricultores', 'agricultores_deben', 'agricultores_no_deben', 'num_notificaciones', 'notifications', 'campos'));
    }





}
