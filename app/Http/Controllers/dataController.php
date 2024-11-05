<?php

namespace App\Http\Controllers;

use App\Models\agricultor;
use App\Models\campo;
use App\Models\carga;
use App\Models\chofer;
use App\Models\guia;
use App\Models\transportista;
use App\Models\User;
use App\Models\vehiculo;
use Carbon\Carbon;
use DaveJamesMiller\Breadcrumbs\Facades\Breadcrumbs;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class dataController extends Controller
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
    public function index(){


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

        $diasSemana = ['Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday'];
        $saldosPendientesDeben = [];
        $saldosPendientesNoDeben = [];

        foreach ($diasSemana as $dia) {
            $saldosPendientesDeben[] = isset($datosPorDia[$dia]['deben']) ? $datosPorDia[$dia]['deben'] : 0;
            $saldosPendientesNoDeben[] = isset($datosPorDia[$dia]['no_deben']) ? $datosPorDia[$dia]['no_deben'] : 0;
        }

        $totalAgricultores = agricultor::count();
        $totalGuias = guia::count();
        $totalTransportistas = transportista::count();
        $totalVehiculos = vehiculo::count();
        $totalCampos = campo::count();
        $totalCarga = carga::count();
        $totalChofer = chofer::count();
        $totalUsuarios = User::count();


        $agricultores = DB::table('agricultors as a')
        ->leftJoin('cargas as c', 'c.RUC_Agricultor', '=', 'a.id')
        ->leftJoin('guias as g', 'g.carga_id', '=', 'c.id')
        ->leftJoin('pagos as p', 'p.guia_id', '=', 'g.id')
        ->select(
            'a.razon_social AS agricultor',
            DB::raw('SUM(p.monto) AS monto_total')
        )
        ->groupBy('a.id', 'a.razon_social')
        ->orderByDesc('monto_total')
        ->limit(8)
        ->get();

    // Obtener los nombres de los agricultores y montos para el gráfico
    $agricultoresLabels = $agricultores->pluck('agricultor')->toArray();
    $montosTotales = $agricultores->pluck('monto_total')->toArray();

    Breadcrumbs::for('info', function ($trail) {
        $trail->push('Inicio', route('mostrar.menu'));
        $trail->push('Información Relevante', route('info'));
    });

        return view('data.index', compact('agricultores_deben', 'agricultores_no_deben', 'num_notificaciones', 'notifications', 'saldosPendientesDeben', 'saldosPendientesNoDeben'
    , 'totalAgricultores', 'totalGuias', 'totalTransportistas', 'totalVehiculos', 'totalCampos', 'totalCarga', 'totalChofer', 'totalUsuarios',
    'agricultoresLabels', 'montosTotales'));

    }

    public function obtenerDatosAgricultores()
    {
        $inicio_periodo = Carbon::now()->startOfWeek();
        $fin_periodo = Carbon::now()->endOfWeek();

        $agricultores_a_pagar = $this->consultaPagosPeriodo($inicio_periodo, $fin_periodo);

        $agricultores_deben = $agricultores_a_pagar->filter(function ($agricultor) {
            return $agricultor->saldo_pendiente > 0;
        });

        $agricultores_no_deben = $agricultores_a_pagar->filter(function ($agricultor) {
            return $agricultor->saldo_pendiente == 0;
        });

        return response()->json([
            'deben' => $agricultores_deben->count(),
            'no_deben' => $agricultores_no_deben->count(),
        ]);
    }


}
