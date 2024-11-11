<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Notification;
use Illuminate\Http\Request;
use App\Models\Pago;
use App\Models\Guia;
use App\Models\campo;
use App\Models\chofer;
use App\Models\transportista;
use App\Models\vehiculo;
use App\Models\agricultor;
use App\Models\Carga;
use App\Notifications\PagoProximoNotification;
use App\Notifications\PagoRealizadoNotification;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\QueryException;
use DaveJamesMiller\Breadcrumbs\Facades\Breadcrumbs;

class pagoController extends Controller
{
    private function consultaPagosPeriodo($inicio_periodo, $fin_periodo)
    {
        return DB::table('agricultors as a')
            ->leftJoin('cargas as c', 'c.RUC_Agricultor', '=', 'a.id')
            ->leftJoin('guias as g', 'g.carga_id', '=', 'c.id')
            ->leftJoin('pagos as p', 'p.guia_id', '=', 'g.id')
            ->select(
                'p.id',
                'a.id AS agricultor_id',
                'a.razon_social AS agricultor_nombre',
                'g.id AS guia_id',
                DB::raw('COALESCE(SUM((c.total_carga_bruta - c.total_material_extrano - c.tara) * p.precio_unitario), 0) AS total_devengado'),
                DB::raw('COALESCE(SUM(p.adelanto), 0) AS adelanto_total'),
                DB::raw('COALESCE(SUM(p.monto), 0) AS monto_total'),
                DB::raw('COALESCE(SUM(p.monto - ((c.total_carga_bruta - c.total_material_extrano - c.tara) * p.precio_unitario - p.adelanto)), 0) AS saldo_pendiente'),
                DB::raw('COALESCE(SUM((c.total_carga_bruta - c.total_material_extrano - c.tara) * p.precio_unitario) - SUM(p.adelanto), 0) AS total_a_pagar')
            )
            ->whereBetween('c.fecha_de_descarga', [$inicio_periodo, $fin_periodo])
            ->groupBy('a.id', 'a.razon_social', 'g.id', 'p.id')
            ->paginate(10);
    }

    private function consultaPago($inicio_periodo, $fin_periodo)
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


    private function consultaPagosPeriodoPasado($inicio_periodo_pasado, $fin_periodo_pasado)
    {
        return DB::select('
            SELECT
                p.id,
                a.id AS agricultor_id,
                a.razon_social AS agricultor_nombre,
                COALESCE(SUM((c.total_carga_bruta - c.total_material_extrano - c.tara) * p.precio_unitario), 0) AS total_devengado,
                COALESCE(SUM(p.adelanto), 0) AS adelanto_total,
                COALESCE(SUM(p.monto), 0) AS monto_total,
                COALESCE(SUM(p.monto - ((c.total_carga_bruta - c.total_material_extrano - c.tara) * p.precio_unitario - p.adelanto)), 0) AS saldo_pendiente,
                COALESCE(SUM((c.total_carga_bruta - c.total_material_extrano - c.tara) * p.precio_unitario) - SUM(p.adelanto), 0) AS total_a_pagar
            FROM
                agricultors a
            LEFT JOIN
                cargas c ON c.RUC_Agricultor = a.id
            LEFT JOIN
                guias g ON g.carga_id = c.id
            LEFT JOIN
                pagos p ON p.guia_id = g.id
            WHERE
                c.fecha_de_descarga >= ? AND c.fecha_de_descarga <= ?
            GROUP BY
                a.id, a.razon_social, p.id
        ', [$inicio_periodo_pasado, $fin_periodo_pasado]);
    }

    private function consultaAgricultoresConSaldoNegativo()
    {
        return DB::select('
            SELECT
                a.razon_social AS agricultor_nombre,
                SUM(p.monto - ((c.total_carga_bruta - c.total_material_extrano - c.tara) * p.precio_unitario - p.adelanto)) AS saldo_pendiente
            FROM
                agricultors a
            LEFT JOIN
                cargas c ON a.id = c.RUC_Agricultor
            LEFT JOIN
                guias g ON c.id = g.carga_id
            LEFT JOIN
                pagos p ON g.id = p.guia_id
            GROUP BY
                a.id, a.razon_social
            HAVING
                saldo_pendiente < 0
            ORDER BY
                saldo_pendiente
            LIMIT
                5
        ');
    }

    private function consultaAgricultoresConSaldoNegativoDetallada()
    {
        return DB::select('
        SELECT
        agricultor_id,
        id,
        ruc,
        razon_social,
        direccion,
        representante,
        dni,
        numero_cuenta,
        banco,
        cci,
        correo_eletronico,
        telefono,
        guia_id,
        saldo_pendiente
    FROM (
        SELECT
            a.id AS agricultor_id,
            a.id,
            a.ruc,
            a.razon_social,
            a.direccion,
            a.representante,
            a.dni,
            a.numero_cuenta,
            a.banco,
            a.cci,
            a.correo_eletronico,
            a.telefono,
            g.id AS guia_id,
            SUM(p.monto - ((c.total_carga_bruta - c.total_material_extrano - c.tara) * p.precio_unitario - p.adelanto)) AS saldo_pendiente
        FROM
            agricultors a
        LEFT JOIN
            cargas c ON a.id = c.RUC_Agricultor
        LEFT JOIN
            guias g ON c.id = g.carga_id
        LEFT JOIN
            pagos p ON g.id = p.guia_id
        GROUP BY
            a.id, a.ruc, a.razon_social, a.direccion, a.representante, a.dni, a.numero_cuenta, a.banco, a.cci, a.correo_electronico, a.telefono g.id
        HAVING
            SUM(p.monto - ((c.total_carga_bruta - c.total_material_extrano - c.tara) * p.precio_unitario - p.adelanto)) < 0
    ) AS subquery
    ORDER BY
        saldo_pendiente

        ');
    }

    private function consultaSumaSaldoNegativo()
    {
        return DB::selectOne('
            SELECT SUM(saldo_pendiente) AS suma_saldo_negativo
            FROM (
                SELECT
                    COALESCE(SUM(p.monto - ((c.total_carga_bruta - c.total_material_extrano - c.tara) * p.precio_unitario - p.adelanto)), 0) AS saldo_pendiente
                FROM
                    agricultors a
                LEFT JOIN
                    cargas c ON c.RUC_Agricultor = a.id
                LEFT JOIN
                    guias g ON g.carga_id = c.id
                LEFT JOIN
                    pagos p ON p.guia_id = g.id
                GROUP BY
                    a.id, a.razon_social
            ) AS saldo_agricultores
            WHERE saldo_pendiente < 0;
        ');
    }

    private function consultaSumaSaldoNegativo5()
    {
        return DB::selectOne('
            SELECT SUM(saldo_pendiente) AS suma_total_saldo_negativo
            FROM (
                SELECT SUM(p.monto - ((c.total_carga_bruta - c.total_material_extrano - c.tara) * p.precio_unitario - p.adelanto)) AS saldo_pendiente
                FROM agricultors a
                LEFT JOIN cargas c ON a.id = c.RUC_Agricultor
                LEFT JOIN guias g ON c.id = g.carga_id
                LEFT JOIN pagos p ON g.id = p.guia_id
                GROUP BY a.id, a.razon_social
                HAVING saldo_pendiente < 0
                ORDER BY saldo_pendiente
                LIMIT 5
            ) AS agricultores_con_saldo_negativo;
        ');
    }

    private function consultaTotalAgricultoresConSaldoNegativo()
    {
        return DB::selectOne('
            SELECT COUNT(*) AS total_agricultores_con_saldo_negativo
            FROM (
                SELECT a.id
                FROM agricultors a
                LEFT JOIN cargas c ON a.id = c.RUC_Agricultor
                LEFT JOIN guias g ON c.id = g.carga_id
                LEFT JOIN pagos p ON g.id = p.guia_id
                GROUP BY a.id
                HAVING SUM(p.monto - ((c.total_carga_bruta - c.total_material_extrano - c.tara) * p.precio_unitario - p.adelanto)) < 0
            ) AS agricultores_con_saldo_negativo
        ');
    }

    private function consultaAgricultoresConSaldoNegativoLimit10()
    {
        return DB::select('
            SELECT
                a.razon_social AS agricultor_nombre,
                SUM(p.monto - ((c.total_carga_bruta - c.total_material_extrano - c.tara) * p.precio_unitario - p.adelanto)) AS saldo_pendiente
            FROM
                agricultors a
            LEFT JOIN
                cargas c ON a.id = c.RUC_Agricultor
            LEFT JOIN
                guias g ON c.id = g.carga_id
            LEFT JOIN
                pagos p ON g.id = p.guia_id
            GROUP BY
                a.id, a.razon_social
            HAVING
                saldo_pendiente < 0
            ORDER BY
                saldo_pendiente DESC
            LIMIT
                10
        ');
    }

    public function index()
    {

        $user = Auth::user();
        $notifications = $user->notifications;

        $inicio_periodo = Carbon::now()->startOfWeek();
        $fin_periodo = Carbon::now()->endOfWeek();

        $agricultores_a_pagar = $this->consultaPago($inicio_periodo, $fin_periodo);

        $agricultores_deben = $agricultores_a_pagar->filter(function ($agricultor) {
            return $agricultor->saldo_pendiente > 0;
        });

        $agricultores_no_deben = $agricultores_a_pagar->filter(function ($agricultor) {
            return $agricultor->saldo_pendiente == 0;
        });
        $num_notificaciones = $agricultores_deben->count() + $agricultores_no_deben->count();

        // Obtener todos los modelos necesarios
        $guias = Guia::all();
        $pagos = Pago::paginate(5);
        $agricultores = Agricultor::all();
        $campos = Campo::all();
        $transportistas = Transportista::all();



        Breadcrumbs::for('pago.index', function ($trail) {
            $trail->push('Inicio', route('mostrar.menu'));
            $trail->push('Información de Pagos', route('pago.index'));
        });


        // Calcular el total pagado sumando el adelanto de todos los pagos
        $totalPagado = Pago::sum('adelanto');

        // Obtener la fecha actual y los extremos de la semana
        $fechaActual = Carbon::now();
        $fechaInicioSemana = $fechaActual->startOfWeek()->toDateString(); // Convertir a formato de fecha
        $fechaFinSemana = $fechaActual->endOfWeek()->toDateString(); // Convertir a formato de fecha

        // Consulta para obtener datos por período (lunes a domingo)




    //Periodo actual
    $inicio_periodo = Carbon::now()->startOfWeek();
    $fin_periodo = Carbon::now()->endOfWeek();

        // Período futuro (por ejemplo, la próxima semana)
    $inicio_periodo_futuro = $inicio_periodo->copy()->addWeek();
    $fin_periodo_futuro = $fin_periodo->copy()->addWeek();

    // Período pasado (por ejemplo, la semana pasada)
    $inicio_periodo_pasado = now()->subWeeks(2)->subWeeks(2);

    $fin_periodo_pasado = $fin_periodo->copy()->subWeek();

   // Ejecutar la consulta SQL para obtener los pagos del período actual
    $pagosPeriodo = $this->consultaPagosPeriodo($inicio_periodo, $fin_periodo);





    $pagosPeriodoFuturo = pagoController::PagosPeriodoFuturo($inicio_periodo_futuro, $fin_periodo_futuro);



    $totalPagos = Pago::count();
    $totalPagadoAgricultor = Pago::sum('monto');


        $pagosPorDiaAgricultor = DB::select("
        SELECT DAYNAME(created_at) AS dia_semana,
            DATE(created_at) AS fecha,
            SUM(monto) AS total_pagado
        FROM pagos
        WHERE YEARWEEK(created_at) = YEARWEEK(NOW()) -- Cambia NOW() por la fecha de inicio de la semana deseada
        GROUP BY DAYNAME(created_at), DATE(created_at)
        ORDER BY fecha;
    ");

    $pagosPeriodoPasado = $this->consultaPagosPeriodoPasado($inicio_periodo_pasado, $fin_periodo_pasado);



    $agricultoresConSaldoNegativo = $this->consultaAgricultoresConSaldoNegativo();


    $agricultoresConSaldoNegativoT = $this->consultaAgricultoresConSaldoNegativoDetallada();


    $sumaSaldoNegativo = $this->consultaSumaSaldoNegativo();


    $sumaSaldoNegativo5 = $this->consultaSumaSaldoNegativo5();

    $totalAgricultoresConSaldoNegativo = $this->consultaTotalAgricultoresConSaldoNegativo();

    $agricultoresConSaldoNegativo10 = $this->consultaAgricultoresConSaldoNegativoLimit10();




            // Obtener nombres de agricultores y saldos negativos para el gráfico
            $nombresAgricultores = [];
            $saldosNegativos = [];
            foreach ($agricultoresConSaldoNegativo as $agricultor) {
                $nombresAgricultores[] = $agricultor->agricultor_nombre;
                $saldosNegativos[] = $agricultor->saldo_pendiente;
            }


            $totalAgricultoresConSaldoPositivo = DB::selectOne('
            SELECT COUNT(*) AS total_agricultores_con_saldo_positivo
            FROM (
                SELECT a.id
                FROM agricultors a
                LEFT JOIN cargas c ON a.id = c.RUC_Agricultor
                LEFT JOIN guias g ON c.id = g.carga_id
                LEFT JOIN pagos p ON g.id = p.guia_id
                GROUP BY a.id
                HAVING SUM(p.monto - ((c.total_carga_bruta - c.total_material_extrano - c.tara) * p.precio_unitario - p.adelanto)) >= 0
            ) AS agricultores_con_saldo_positivo
            ');

            $PagoTotalAgri = DB::selectOne('
            SELECT
            SUM((c.total_carga_bruta - c.total_material_extrano - c.tara) * p.precio_unitario - p.adelanto) AS total_pago
        FROM
            pagos p
        JOIN
            guias g ON p.guia_id = g.id
        JOIN
            cargas c ON g.carga_id = c.id;
        ');

        $SumMonto = Pago::sum('monto');


        $TotalFaltaPagar = DB::selectOne('
        SELECT
        SUM(((c.total_carga_bruta - c.total_material_extrano - c.tara) * p.precio_unitario - p.adelanto)-p.Monto) AS total_falta_pagar
    FROM
        pagos p
    JOIN
        guias g ON p.guia_id = g.id
    JOIN
        cargas c ON g.carga_id = c.id;');


        $user = Auth::user();
        $notifications = $user->notifications;


        return view('pago.index', compact('guias', 'pagos', 'campos', 'transportistas', 'agricultores',
             'fechaActual', 'fechaInicioSemana',
            'fechaFinSemana', 'inicio_periodo', 'fin_periodo', 'pagosPeriodo',
                    'inicio_periodo_futuro', 'fin_periodo_futuro','inicio_periodo_pasado', 'fin_periodo_pasado',
                'totalPagos','totalPagadoAgricultor','pagosPorDiaAgricultor','pagosPeriodoFuturo', 'pagosPeriodoPasado','agricultoresConSaldoNegativo',
            'agricultoresConSaldoNegativoT', 'sumaSaldoNegativo', 'sumaSaldoNegativo5', 'totalAgricultoresConSaldoNegativo',
            'agricultoresConSaldoNegativo10', 'nombresAgricultores', 'saldosNegativos', 'totalAgricultoresConSaldoPositivo',
            'PagoTotalAgri','SumMonto','TotalFaltaPagar','notifications','num_notificaciones', 'agricultores_deben', 'agricultores_no_deben'));
            }











    public function store(Request $request)
    {
        try {
            // Validar los datos del formulario
            $request->validate([
                'Adelanto' => 'required|numeric',
                'Metodo_Pago' => 'required|string',
                'Nro_Operacion' => 'string|nullable',
                'Tipo_Pago' => 'string|nullable',
                'Monto' => 'numeric|nullable',
                'Precio_Unitario' => 'required|numeric',
                'guia_id' => 'required|exists:guias,id'
            ]);

            // Crear un nuevo pago
            Pago::create([
                'Adelanto' => $request->Adelanto,
                'Metodo_Pago' => $request->Metodo_Pago,
                'Nro_Operacion' => $request->Nro_Operacion,
                'Tipo_Pago' => $request->Tipo_Pago,
                'Monto' => $request->Monto,
                'Precio_Unitario' => $request->Precio_Unitario,
                'guia_id' => $request->guia_id
            ]);

            // Redireccionar con mensaje de éxito
            return redirect()->back()->with('success', '¡El pago ha sido registrado correctamente!');
        } catch (QueryException $e) {
            // Manejar cualquier error de base de datos
            Log::error('Error al guardar el pago en la base de datos: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Ocurrió un error al guardar el pago en la base de datos. Por favor, inténtalo de nuevo.');
        } catch (\Exception $e) {
            // Manejar cualquier otra excepción
            Log::error('Error inesperado al guardar el pago: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Ocurrió un error inesperado. Por favor, inténtalo de nuevo o contacta al administrador.');
        }
    }


    public function borrarSeleccionados(Request $request)
    {
        try {
            $pagoIdsString = $request->input('pago_ids');

            // Convertir la cadena de IDs en un array
            $pagoIds = explode(',', $pagoIdsString);

            // Verificar si se recibieron IDs de guías
            if (!empty($pagoIds)) {
                // Borrar las guías de remisión seleccionadas
                Pago::whereIn('id', $pagoIds)->delete();

                return redirect()->back()->with('success', 'Los pagos  seleccionados se han borrado correctamente.');
            } else {
                return redirect()->back()->with('error', 'No se han seleccionado pagos para borrar.');
            }
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Ocurrió un error al intentar borrar los pagos seleccionadas: ' . $e->getMessage());
        }
    }
public function edit($id)
{

}

    public function update(Request $request, $id)
    {
        try {
            // Primero, validamos los datos enviados por el formulario
            $request->validate([
                'Adelanto' => 'required|numeric',
                'Metodo_Pago' => 'required|string',
                'Tipo_Pago' => 'nullable|string',
                'Nro_Operacion' => 'nullable|string',
                'Monto' => 'required|numeric',
                'Precio_Unitario' => 'required|numeric',
                'guia_id' => 'required|exists:guias,id',
            ]);

            // Luego, obtenemos el pago que se desea actualizar
            $pago = Pago::findOrFail($id);

            // Actualizamos los campos del pago con los nuevos valores
            $pago->Adelanto = $request->Adelanto;
            $pago->Metodo_Pago = $request->Metodo_Pago;
            $pago->Tipo_Pago = $request->Tipo_Pago;
            $pago->Nro_Operacion = $request->Nro_Operacion;
            $pago->Monto = $request->Monto;
            $pago->Precio_Unitario = $request->Precio_Unitario;
            $pago->guia_id = $request->guia_id;

            // Guardamos los cambios en la base de datos
            $pago->save();

            // Redirigimos de vuelta a la página de detalles del pago
            return redirect()->back()->with('success', 'Pago actualizado correctamente.');
        } catch (\Exception $e) {
            // Manejo de excepciones: redirigir a la página anterior con un mensaje de error
            return back()->withInput()->withErrors(['error' => 'Error al actualizar el pago: ' . $e->getMessage()]);
        }
    }


    public function destroy($id)
    {
        try {
            $guia = Pago::findOrFail($id);
            $guia->delete();

            return redirect()->back()->with('success', 'Pago eliminado correctamente');
        } catch (\Exception $e) {
            // Manejo de errores si la guía no se encuentra o hay otros problemas
            return redirect()->back()->with('error', 'Error al pago: ' . $e->getMessage());
        }
    }

    public function addAdditionalAmount(Request $request, $id = null)
    {
        try {
            // Primero, validamos el monto adicional enviado por el formulario
            $request->validate([
                'monto_adicional' => 'required|numeric',
            ]);

            // Lógica para manejar diferentes escenarios
            if ($id) {
                // Si se proporciona un ID de pago, actuamos sobre ese pago en particular
                $pago = Pago::findOrFail($id);
                $this->agregarMontoAdicional($pago, $request->monto_adicional);
                return redirect()->back()->with('success', 'Monto adicional agregado correctamente al pago.');
            } else {
                // Si no se proporciona ningún ID de pago, realizamos una acción general, como agregar un monto adicional a todos los pagos que cumplan ciertos criterios
                // Agregar lógica aquí...
                return redirect()->back()->with('success', 'Monto adicional agregado a todos los pagos que cumplen ciertos criterios.');
            }
        } catch (\Exception $e) {
            // Manejo de excepciones: redirigir a la página anterior con un mensaje de error
            return back()->withInput()->withErrors(['error' => 'Error al agregar monto adicional al pago: ' . $e->getMessage()]);
        }
    }



    // Método privado para agregar un monto adicional a un pago específico
    private function agregarMontoAdicional(Pago $pago, $monto_adicional)
    {
        // Calculamos el nuevo monto sumando el monto adicional al monto existente
        $nuevoMonto = $pago->Monto + $monto_adicional;

        // Actualizamos el campo del monto con el nuevo valor
        $pago->Monto = $nuevoMonto;

        // Guardamos los cambios en la base de datos
        $pago->save();
    }


    public function buscarPago(Request $request)
{


    Breadcrumbs::for('pago.index', function ($trail) {
        $trail->push('Inicio', route('mostrar.menu'));
        $trail->push('Información de Pagos', route('pago.index'));
    });

    // Inicializar la consulta de pagos
    $query = Pago::query();

    // Aplicar filtros si existen
    if ($request->filled('Adelanto')) {
        $query->where('Adelanto', 'like', '%' . $request->input('Adelanto') . '%');
    }

    if ($request->filled('Metodo_Pago')) {
        $query->where('Metodo_Pago', 'like', '%' . $request->input('Metodo_Pago') . '%');
    }

    if ($request->filled('Tipo_Pago')) {
        $query->where('Tipo_Pago', 'like', '%' . $request->input('Tipo_Pago') . '%');
    }

    if ($request->filled('Nro_Operacion')) {
        $query->where('Nro_Operacion', 'like', '%' . $request->input('Nro_Operacion') . '%');
    }

    if ($request->filled('Monto')) {
        $query->where('Monto', 'like', '%' . $request->input('Monto') . '%');
    }

    if ($request->filled('Precio_Unitario')) {
        $query->where('Precio_Unitario', 'like', '%' . $request->input('Precio_Unitario') . '%');
    }

    if ($request->filled('agricultor_id')) {
        // Cambia 'agricultor_id' por el nombre correcto de la columna si es diferente
        $query->whereHas('guia', function ($query) use ($request) {
            $query->where('agricultor_id', $request->input('agricultor_id'));
        });
    }

    // Obtener los pagos que cumplen con los criterios de búsqueda

    $pagos = Pago::paginate(5); // Adjust the number per page as needed

    // Obtener la lista de agricultores para el campo de selección
    $guias = Guia::all();

    $choferes = Chofer::all();

    $cargas = Carga::all();

    // Redirigir de vuelta a la página anterior con los resultados y los agricultores

    $totalPagos = Pago::count();
    $totalPagadoAgricultor = Pago::sum('monto');


        $pagosPorDiaAgricultor = DB::select("
        SELECT DAYNAME(created_at) AS dia_semana,
            DATE(created_at) AS fecha,
            SUM(monto) AS total_pagado
        FROM pagos
        WHERE YEARWEEK(created_at) = YEARWEEK(NOW()) -- Cambia NOW() por la fecha de inicio de la semana deseada
        GROUP BY DAYNAME(created_at), DATE(created_at)
        ORDER BY fecha;
    ");

    $totalAgricultoresConSaldoPositivo = DB::selectOne('
            SELECT COUNT(*) AS total_agricultores_con_saldo_positivo
            FROM (
                SELECT a.id
                FROM agricultors a
                LEFT JOIN cargas c ON a.id = c.RUC_Agricultor
                LEFT JOIN guias g ON c.id = g.carga_id
                LEFT JOIN pagos p ON g.id = p.guia_id
                GROUP BY a.id
                HAVING SUM(p.monto - ((c.total_carga_bruta - c.total_material_extrano - c.tara) * p.precio_unitario - p.adelanto)) >= 0
            ) AS agricultores_con_saldo_positivo
            ');


            $totalAgricultoresConSaldoNegativo = DB::selectOne('
            SELECT COUNT(*) AS total_agricultores_con_saldo_negativo
            FROM (
                SELECT a.id
                FROM agricultors a
                LEFT JOIN cargas c ON a.id = c.RUC_Agricultor
                LEFT JOIN guias g ON c.id = g.carga_id
                LEFT JOIN pagos p ON g.id = p.guia_id
                GROUP BY a.id
                HAVING SUM(p.monto - ((c.total_carga_bruta - c.total_material_extrano - c.tara) * p.precio_unitario - p.adelanto)) < 0
            ) AS agricultores_con_saldo_negativo
            ');

            $PagoTotalAgri = DB::selectOne('
            SELECT
            SUM((c.total_carga_bruta - c.total_material_extrano - c.tara) * p.precio_unitario - p.adelanto) AS total_pago
        FROM
            pagos p
        JOIN
            guias g ON p.guia_id = g.id
        JOIN
            cargas c ON g.carga_id = c.id;
        ');


        $SumMonto = Pago::sum('monto');


        $TotalFaltaPagar = DB::selectOne('
        SELECT
        SUM(((c.total_carga_bruta - c.total_material_extrano - c.tara) * p.precio_unitario - p.adelanto)-p.Monto) AS total_falta_pagar
    FROM
        pagos p
    JOIN
        guias g ON p.guia_id = g.id
    JOIN
        cargas c ON g.carga_id = c.id;');

        $agricultores = Agricultor::all();


        $totalAgricultoresConSaldoNegativo = DB::selectOne('
        SELECT COUNT(*) AS total_agricultores_con_saldo_negativo
        FROM (
            SELECT a.id
            FROM agricultors a
            LEFT JOIN cargas c ON a.id = c.RUC_Agricultor
            LEFT JOIN guias g ON c.id = g.carga_id
            LEFT JOIN pagos p ON g.id = p.guia_id
            GROUP BY a.id
            HAVING SUM(p.monto - ((c.total_carga_bruta - c.total_material_extrano - c.tara) * p.precio_unitario - p.adelanto)) < 0
        ) AS agricultores_con_saldo_negativo
        ');


        $agricultoresConSaldoNegativo10 = DB::select('
    SELECT
        a.razon_social AS agricultor_nombre,
        SUM(p.monto - ((c.total_carga_bruta - c.total_material_extrano - c.tara) * p.precio_unitario - p.adelanto)) AS saldo_pendiente
    FROM
        agricultors a
    LEFT JOIN
        cargas c ON a.id = c.RUC_Agricultor
    LEFT JOIN
        guias g ON c.id = g.carga_id
    LEFT JOIN
        pagos p ON g.id = p.guia_id
    GROUP BY
        a.id, a.razon_social
    HAVING
        saldo_pendiente < 0
    ORDER BY
        saldo_pendiente DESC
    LIMIT
        10
');

$agricultoresConSaldoNegativo = DB::select('
SELECT
    a.razon_social AS agricultor_nombre,
    SUM(p.monto - ((c.total_carga_bruta - c.total_material_extrano - c.tara) * p.precio_unitario - p.adelanto)) AS saldo_pendiente
FROM
    agricultors a
LEFT JOIN
    cargas c ON a.id = c.RUC_Agricultor
LEFT JOIN
    guias g ON c.id = g.carga_id
LEFT JOIN
    pagos p ON g.id = p.guia_id
GROUP BY
    a.id, a.razon_social
HAVING
    saldo_pendiente < 0
ORDER BY
    saldo_pendiente
LIMIT
    5;
');

$sumaSaldoNegativo5 = DB::selectOne('
SELECT SUM(saldo_pendiente) AS suma_total_saldo_negativo
FROM (
    SELECT SUM(p.monto - ((c.total_carga_bruta - c.total_material_extrano - c.tara) * p.precio_unitario - p.adelanto)) AS saldo_pendiente
    FROM agricultors a
    LEFT JOIN cargas c ON a.id = c.RUC_Agricultor
    LEFT JOIN guias g ON c.id = g.carga_id
    LEFT JOIN pagos p ON g.id = p.guia_id
    GROUP BY a.id, a.razon_social
    HAVING saldo_pendiente < 0
    ORDER BY saldo_pendiente
    LIMIT 5
) AS agricultores_con_saldo_negativo;
');

        $agricultoresConSaldoNegativoT = $this->consultaAgricultoresConSaldoNegativoDetallada();

        $sumaSaldoNegativo = DB::selectOne('
            SELECT SUM(saldo_pendiente) AS suma_saldo_negativo
            FROM (
                SELECT
                    COALESCE(SUM(p.monto - ((c.total_carga_bruta - c.total_material_extrano - c.tara) * p.precio_unitario - p.adelanto)), 0) AS saldo_pendiente
                FROM
                    agricultors a
                LEFT JOIN
                    cargas c ON c.RUC_Agricultor = a.id
                LEFT JOIN
                    guias g ON g.carga_id = c.id
                LEFT JOIN
                    pagos p ON p.guia_id = g.id
                GROUP BY
                    a.id, a.razon_social
            ) AS saldo_agricultores
            WHERE saldo_pendiente < 0;
        ');

        $nombresAgricultores = [];
        $saldosNegativos = [];
        foreach ($agricultoresConSaldoNegativo as $agricultor) {
            $nombresAgricultores[] = $agricultor->agricultor_nombre;
            $saldosNegativos[] = $agricultor->saldo_pendiente;
        }

        //Periodo actual
    $inicio_periodo = Carbon::now()->startOfWeek();
    $fin_periodo = Carbon::now()->endOfWeek();

        // Período futuro (por ejemplo, la próxima semana)
    $inicio_periodo_futuro = $inicio_periodo->copy()->addWeek();
    $fin_periodo_futuro = $fin_periodo->copy()->addWeek();

    // Período pasado (por ejemplo, la semana pasada)
    $inicio_periodo_pasado = $inicio_periodo->copy()->subWeek();
    $fin_periodo_pasado = $fin_periodo->copy()->subWeek();

    $pagosPeriodo = $this->consultaPagosPeriodo($inicio_periodo, $fin_periodo);






    $totalPagos = Pago::count();
    $totalPagadoAgricultor = Pago::sum('monto');


        $pagosPorDiaAgricultor = DB::select("
        SELECT DAYNAME(created_at) AS dia_semana,
            DATE(created_at) AS fecha,
            SUM(monto) AS total_pagado
        FROM pagos
        WHERE YEARWEEK(created_at) = YEARWEEK(NOW()) -- Cambia NOW() por la fecha de inicio de la semana deseada
        GROUP BY DAYNAME(created_at), DATE(created_at)
        ORDER BY fecha;
    ");


    $pagosPeriodoPasado = DB::select('
    SELECT
        p.id,
        a.id AS agricultor_id,
        a.razon_social AS agricultor_nombre,
        COALESCE(SUM((c.total_carga_bruta - c.total_material_extrano - c.tara) * p.precio_unitario), 0) AS total_devengado,
        COALESCE(SUM(p.adelanto), 0) AS adelanto_total,
        COALESCE(SUM(p.monto), 0) AS monto_total,
        COALESCE(SUM(p.monto - ((c.total_carga_bruta - c.total_material_extrano - c.tara) * p.precio_unitario - p.adelanto)), 0) AS saldo_pendiente,
        COALESCE(SUM((c.total_carga_bruta - c.total_material_extrano - c.tara) * p.precio_unitario) - SUM(p.adelanto), 0) AS total_a_pagar
    FROM
        agricultors a
    LEFT JOIN
        cargas c ON c.RUC_Agricultor = a.id
    LEFT JOIN
        guias g ON g.carga_id = c.id
    LEFT JOIN
        pagos p ON p.guia_id = g.id
    WHERE
        c.fecha_de_descarga >= ? AND c.fecha_de_descarga <= ?
    GROUP BY
        a.id, a.razon_social, p.id
', [$inicio_periodo_pasado, $fin_periodo_pasado]);

$user = Auth::user();
$notifications = $user->notifications;

$inicio_periodo = Carbon::now()->startOfWeek();
$fin_periodo = Carbon::now()->endOfWeek();

$agricultores_a_pagar = $this->consultaPago($inicio_periodo, $fin_periodo);

$agricultores_deben = $agricultores_a_pagar->filter(function ($agricultor) {
    return $agricultor->saldo_pendiente > 0;
});

$agricultores_no_deben = $agricultores_a_pagar->filter(function ($agricultor) {
    return $agricultor->saldo_pendiente == 0;
});
$num_notificaciones = $agricultores_deben->count() + $agricultores_no_deben->count();

$this->PagosPeriodoFuturo($inicio_periodo_futuro, $fin_periodo_futuro);

    return view('pago.index', compact('pagos', 'guias', 'choferes', 'cargas', 'totalPagos', 'totalPagadoAgricultor', 'pagosPorDiaAgricultor', 'totalAgricultoresConSaldoPositivo',
        'totalAgricultoresConSaldoNegativo', 'PagoTotalAgri', 'SumMonto', 'TotalFaltaPagar', 'agricultores', 'totalAgricultoresConSaldoNegativo', 'agricultoresConSaldoNegativo10',
        'agricultoresConSaldoNegativo', 'sumaSaldoNegativo5', 'agricultoresConSaldoNegativoT', 'sumaSaldoNegativo',
        'nombresAgricultores', 'saldosNegativos', 'inicio_periodo', 'fin_periodo', 'inicio_periodo_futuro', 'fin_periodo_futuro', 'inicio_periodo_pasado', 'fin_periodo_pasado',
        'totalPagos', 'totalPagadoAgricultor', 'totalAgricultoresConSaldoPositivo', 'totalAgricultoresConSaldoNegativo','pagosPeriodo','num_notificaciones','agricultores_deben','agricultores_no_deben'));
}

private function PagosPeriodoFuturo($inicio_periodo_futuro, $fin_periodo_futuro)
{
    $pagosPeriodoFuturo = DB::select('
        SELECT
            p.id,
            a.id AS agricultor_id,
            a.razon_social AS agricultor_nombre,
            COALESCE(SUM((c.total_carga_bruta - c.total_material_extrano - c.tara) * p.precio_unitario), 0) AS total_devengado,
            COALESCE(SUM(p.adelanto), 0) AS adelanto_total,
            COALESCE(SUM(p.monto), 0) AS monto_total,
            COALESCE(SUM(p.monto - ((c.total_carga_bruta - c.total_material_extrano - c.tara) * p.precio_unitario - p.adelanto)), 0) AS saldo_pendiente,
            COALESCE(SUM((c.total_carga_bruta - c.total_material_extrano - c.tara) * p.precio_unitario) - SUM(p.adelanto), 0) AS total_a_pagar
        FROM
            agricultors a
        LEFT JOIN
            cargas c ON c.RUC_Agricultor = a.id
        LEFT JOIN
            guias g ON g.carga_id = c.id
        LEFT JOIN
            pagos p ON p.guia_id = g.id
        WHERE
            c.fecha_de_descarga >= ? AND c.fecha_de_descarga <= ?
        GROUP BY
            a.id, a.razon_social, p.id
    ', [$inicio_periodo_futuro, $fin_periodo_futuro]);

    return $pagosPeriodoFuturo;
}


public function agregarPago(Request $request, $agricultor_id)
{
    // Validar el formulario
    $request->validate([
        'guia_id' => 'required|exists:guias,id',
        'monto_pago' => 'required|numeric|min:0',
    ]);

    // Buscar el pago actual para la guía especificada
    $pagoActual = Pago::where('guia_id', $request->guia_id)->first();

    if ($pagoActual) {
        // Si ya existe un pago para esta guía, sumar el monto ingresado al monto existente
        $pagoActual->Monto += $request->monto_pago;
        $pagoActual->save();
    } else {
        // Si no existe un pago para esta guía, crear uno nuevo con el monto ingresado
        $pago = new Pago();
        $pago->Monto = $request->monto_pago;
        $pago->guia_id = $request->guia_id;
        $pago->Adelanto = 0; // o el valor que corresponda
        $pago->Metodo_Pago = null; // Puedes ajustar esto según tus necesidades
        $pago->Tipo_Pago = null; // Puedes ajustar esto según tus necesidades
        $pago->Nro_Operacion = null; // Puedes ajustar esto según tus necesidades
        $pago->Precio_Unitario = 0; // ajusta esto según tus necesidades
        $pago->save();
    }

    // Redirigir o realizar alguna acción
    return redirect()->back()->with('success', 'Pago agregado exitosamente.');
}

    public function consultaSaldoNegativo()
    {
         // Define las migas de pan para la página de inicio de las facturas
         Breadcrumbs::for('facturas.index', function ($trail) {
            $trail->push('Inicio', route('mostrar.menu'));
            $trail->push('Pagos', route('pago.index'));
            $trail->push('Agricultores con saldo negativo', route('pagos.agricultores_saldo_negativo'));
        });
        $agricultoresConSaldoNegativoT = $this->consultaAgricultoresConSaldoNegativoDetallada();
        $sumaSaldoNegativo = $this->consultaSumaSaldoNegativo();

        return view('pago.a_saldoNegativo', compact('agricultoresConSaldoNegativoT', 'sumaSaldoNegativo'));

    }


    public function realizarPago(Request $request)
{
    $pago = Pago::find($request->pago_id);

    if ($pago) {
        $agricultores = Agricultor::all();

        foreach ($agricultores as $agricultor) {
            $pendiente = $agricultor->calcularPagoPendiente(); // Método hipotético para calcular el pago pendiente para el agricultor

            $agricultor->notify(new PagoRealizadoNotification($pago, $pendiente));
        }

        return redirect()->back()->with('success', 'Pago realizado exitosamente.');
    } else {
        return redirect()->back()->with('error', 'No se encontró el pago.');
    }
}


    private function consultaPagos($inicio_periodo, $fin_periodo)
    {
        return DB::table('agricultors as a')
            ->leftJoin('cargas as c', 'c.RUC_Agricultor', '=', 'a.id')
            ->leftJoin('guias as g', 'g.carga_id', '=', 'c.id')
            ->leftJoin('pagos as p', 'p.guia_id', '=', 'g.id')
            ->select(
                'a.id AS agricultor_id',
                'a.razon_social AS agricultor_nombre',
                DB::raw('COALESCE(SUM(p.monto - ((c.total_carga_bruta - c.total_material_extrano - c.tara) * p.precio_unitario - p.adelanto)), 0) AS saldo_pendiente')
            )
            ->whereBetween('c.fecha_de_descarga', [$inicio_periodo, $fin_periodo])
            ->groupBy('a.id', 'a.razon_social')
            ->get();
    }

    public function notificarPagosProximos()
    {
        // Paso 1: Obtener la lista de agricultores que serán pagados el próximo domingo
        $agricultores = $this->consultaPagosPeriodo(Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek());

        // Paso 2: Obtener el próximo domingo
        $proximoDomingo = Carbon::now()->startOfWeek()->addDays(6);

        // Paso 3: Notificar a cada agricultor sobre los pagos próximos
        foreach ($agricultores as $agricultor) {
            $agricultor->notify(new PagoProximoNotification($proximoDomingo, $agricultor->agricultor_nombre, $agricultor->saldo_pendiente));
        }

        // Opcional: Redireccionar a alguna vista o página
        return redirect()->route('notificaciones')->with('success', 'Notificaciones de pagos próximos enviadas.');
}

}


