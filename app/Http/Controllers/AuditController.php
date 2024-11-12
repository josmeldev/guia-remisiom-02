<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use OwenIt\Auditing\Models\Audit;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class AuditController extends Controller
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
        // Obtener todas las auditorías con paginación
        $audits = Audit::paginate(10); // Cambia el número 10 por la cantidad de registros que deseas por página

        // Obtener todos los usuarios y sus roles
        $usuarios = User::with('roles')->get();

        // Crear un mapeo de usuarios y roles
        $usuariosMapeo = $usuarios->pluck('name', 'id')->toArray();
        $rolesMapeo = $usuarios->mapWithKeys(function ($user) {
            return [$user->id => $user->roles->pluck('name')->join(', ')];
        })->toArray();

        // Array de traducción para los eventos
        $eventosMapeo = [
            'created' => 'Creado',
            'updated' => 'Actualizado',
            'deleted' => 'Eliminado',
            // Añade más eventos según sea necesario
        ];
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

        // Pasar las auditorías y los mapeos a la vista
        return view('auditorias.index', compact('audits', 'usuariosMapeo', 'rolesMapeo', 'eventosMapeo', 'num_notificaciones', 'notifications', 'agricultores_deben', 'agricultores_no_deben'));
    }

    public function buscar(Request $request)
    {
        // Obtener los criterios de búsqueda
        $usuario = $request->input('usuario');
        $accion = $request->input('accion');
        $modulo = $request->input('modulo');

        // Array de traducción para los eventos
        $eventosMapeo = [
            'created' => 'Creado',
            'updated' => 'Actualizado',
            'deleted' => 'Eliminado',
            // Añade más eventos según sea necesario
        ];

        // Invertir el mapeo de eventos
        $eventosMapeoInverso = array_flip($eventosMapeo);

        // Obtener todas las auditorías
        $audits = Audit::query();

        // Filtrar por usuario
        if ($usuario) {
            $userIds = User::where('name', 'like', '%' . $usuario . '%')->pluck('id');
            $audits->whereIn('user_id', $userIds);
        }

        // Filtrar por acción
        if ($accion) {
            $accionOriginal = $eventosMapeoInverso[$accion] ?? $accion;
            $audits->where('event', 'like', '%' . $accionOriginal . '%');
        }

        // Filtrar por módulo
        if ($modulo) {
            $audits->where('auditable_type', 'like', '%' . $modulo . '%');
        }

        $audits = $audits->paginate(10); // Cambia el número 10 por la cantidad de registros que deseas por página

        // Obtener todos los usuarios y sus roles
        $usuarios = User::with('roles')->get();

        // Crear un mapeo de usuarios y roles
        $usuariosMapeo = $usuarios->pluck('name', 'id')->toArray();
        $rolesMapeo = $usuarios->mapWithKeys(function ($user) {
            return [$user->id => $user->roles->pluck('name')->join(', ')];
        })->toArray();
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

        // Pasar las auditorías y los mapeos a la vista
        return view('auditorias.index', compact('audits', 'usuariosMapeo', 'rolesMapeo', 'eventosMapeo', 'num_notificaciones', 'notifications', 'agricultores_deben', 'agricultores_no_deben'));
    }

    public function eliminarSeleccionados(Request $request)
    {
        $ids = explode(',', $request->input('ids'));
        Audit::whereIn('id', $ids)->delete();

        return redirect()->route('auditorias.index')->with('success', 'Registros eliminados correctamente.');
    }
}