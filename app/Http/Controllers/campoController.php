<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Campo;
use App\Models\Guia;
use App\Models\Pago;
use App\Models\transportista;
use App\Models\agricultor;
use App\Models\Carga;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class campoController extends Controller
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
        $cargas = Carga::all();
        $pagos = Pago::all();
        $agricultores = Agricultor::all();
        $campos = campo::all();
        $transportistas = transportista::all();

        $camposAgricultor = $this->obtenerCamposPorAgricultor();

        $camposLista = $this->obtenerAgricultoresPorCampo();

        $totalCampos = Campo::count();

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

        return view('campo.index', compact('guias','pagos','campos','transportistas','agricultores','cargas','camposAgricultor','camposLista','totalCampos',
            'notifications','agricultores_a_pagar','agricultores_deben','agricultores_no_deben','num_notificaciones'));
    }
    public function store(Request $request)
    {
        // Validar los datos del formulario
        $request->validate([
            'acopiadora' => 'required|string',
            'ubigeo' => 'required|string',
            'zona' => 'required|string',
            'ingenio' => 'required|string',

        ]);

        // Crear un nuevo campo
        Campo::create([
            'acopiadora' => $request->acopiadora,
            'ubigeo' => $request->ubigeo,
            'zona' => $request->zona,
            'ingenio' => $request->ingenio,

        ]);

        // Redireccionar a una ruta después de guardar el campo (opcional)
        return redirect()->back()->with('success', '¡El campo ha sido registrado correctamente!');
    }

    public function update(Request $request, $id)
    {
        // Valida los datos del formulario
        $request->validate([
            'acopiadora' => 'required|string|max:100',
            'ubigeo' => 'required|string|max:50',
            'zona' => 'required|string|max:50',
            'ingenio' => 'required|string|max:50',
        ]);

        // Encuentra el campo a actualizar
        $campo = Campo::findOrFail($id);

        // Actualiza los campos con los datos del formulario
        $campo->acopiadora = $request->acopiadora;
        $campo->ubigeo = $request->ubigeo;
        $campo->zona = $request->zona;
        $campo->ingenio = $request->ingenio;
        $campo->save();

        // Redirecciona a la página de destino después de la actualización
        return redirect()->back()->with('success', '¡El campo ha sido actualizado correctamente!');
    }


    public function destroy($id)
    {
        try {
            $campo = Campo::findOrFail($id);
            $campo->delete();

            return redirect()->back()->with('success', 'Campo eliminado correctamente');
        } catch (\Exception $e) {
            // Manejo de errores si la guía no se encuentra o hay otros problemas
            return redirect()->back()->with('error', 'Error al eliminar campo: ' . $e->getMessage());
        }
    }

    private function obtenerCamposPorAgricultor()
    {
        return DB::table('agricultors')
            ->join('cargas', 'agricultors.id', '=', 'cargas.RUC_Agricultor')
            ->join('campos', 'cargas.campo_id', '=', 'campos.id')
            ->select(
                'agricultors.ruc AS ruc_agricultor',
                'agricultors.razon_social AS razon_social_agricultor',
                'campos.acopiadora',
                'campos.ubigeo',
                'campos.zona',
                'campos.ingenio'
            )
            ->get();
    }

    private function obtenerAgricultoresPorCampo()
    {
        return DB::table('campos')
            ->join('cargas', 'campos.id', '=', 'cargas.campo_id')
            ->join('agricultors', 'cargas.RUC_Agricultor', '=', 'agricultors.id')
            ->select(
                'campos.id AS id_campo',
                'campos.acopiadora',
                'campos.ubigeo',
                'campos.zona',
                'campos.ingenio',
                DB::raw('GROUP_CONCAT(agricultors.razon_social SEPARATOR \', \') AS agricultors')
            )
            ->groupBy('campos.id', 'campos.acopiadora', 'campos.ubigeo', 'campos.zona', 'campos.ingenio')
            ->get();
    }

    public function buscar(Request $request)
    {
        // Obtener todos los campos
        $query = Campo::query();

        // Aplicar filtros si se proporcionan
        if ($request->filled('acopiadora')) {
            $query->where('acopiadora', 'like', '%' . $request->input('acopiadora') . '%');
        }
        if ($request->filled('ubigeo')) {
            $query->where('ubigeo', 'like', '%' . $request->input('ubigeo') . '%');
        }
        if ($request->filled('zona')) {
            $query->where('zona', 'like', '%' . $request->input('zona') . '%');
        }
        if ($request->filled('ingenio')) {
            $query->where('ingenio', 'like', '%' . $request->input('ingenio') . '%');
        }

        // Obtener los campos que cumplen con los filtros
        $campos = $query->get();

        $camposAgricultor = $this->obtenerCamposPorAgricultor();

        $camposLista = $this->obtenerAgricultoresPorCampo();

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

        // Retornar la vista con los campos encontrados
        return view('campo.index', compact('campos','camposAgricultor','camposLista', 'agricultores_deben', 'agricultores_no_deben', 'num_notificaciones'));
    }


}
