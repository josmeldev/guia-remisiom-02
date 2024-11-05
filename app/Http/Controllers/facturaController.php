<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;

use DaveJamesMiller\Breadcrumbs\Facades\Breadcrumbs;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class facturaController extends Controller
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
        // Define las migas de pan para la página de inicio de las facturas
        Breadcrumbs::for('facturas.index', function ($trail) {
            $trail->push('Inicio', route('mostrar.menu'));
            $trail->push('Facturas', route('facturas.index'));
        });

        return view('facturas.index', compact('agricultores_deben', 'agricultores_no_deben', 'num_notificaciones', 'notifications'));
    }
}
