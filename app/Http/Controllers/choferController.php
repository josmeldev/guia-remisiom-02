<?php

namespace App\Http\Controllers;
use App\Models\Chofer;
use App\Models\Guia;
use App\Models\Pago;
use App\Models\transportista;
use App\Models\agricultor;
use App\Models\Carga;
use App\Models\campo;
use App\Models\vehiculo;
use Carbon\Carbon;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class choferController extends Controller
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

        $vehiculos = vehiculo::all();
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

        return view('conductor.index', compact('guias','pagos','campos','transportistas','agricultores','cargas','choferes','vehiculos',
            'agricultores_deben','agricultores_no_deben','num_notificaciones'));
    }

    public function store(Request $request)
    {
        try {
            // Validar los datos del formulario
            $validatedData = $request->validate([
                'dni' => [
                    'required',
                    Rule::unique('chofers')->where(function ($query) use ($request) {
                        return $query->where('dni', $request->dni);
                    }),
                ],
                'nombre_apellidos' => 'required',
                'telefono' => 'required',
                'brevete' => 'nullable|unique:chofers,brevete',
            ], [
                'dni.unique' => 'El DNI ya está registrado.', // Mensaje personalizado para la regla unique
            ]);

            // Hacer la solicitud a la API para obtener los datos del usuario basados en el DNI
            $response = Http::get('https://dniruc.apisperu.com/api/v1/dni/' . $request->dni, [
                'token' => 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJlbWFpbCI6ImFuZ2VsLmlnbGVzaWFzQHRlY3N1cC5lZHUucGUifQ.1fb2rVCJsMs18E2rWBHXqtCC2j2NYXrG_BkU9LUDLss'
            ]);

            // Verificar si la solicitud fue exitosa
            if ($response->successful()) {
                // Obtener los datos de la respuesta
                $data = $response->json();

                // Verificar si la respuesta contiene la clave 'nombres'
                if (isset($data['nombres'])) {
                    // Llenar los campos del formulario con los datos obtenidos
                    $validatedData['nombre_apellidos'] = $data['nombres'] . ' ' . $data['apellidoPaterno'] . ' ' . $data['apellidoMaterno'];
                } else {
                    // Si la respuesta no contiene la clave 'nombres', tomar el nombre ingresado manualmente en el formulario
                    $validatedData['nombre_apellidos'] = $request->nombre_apellidos;
                }
                // Puedes agregar más campos aquí si la API devuelve más información
            } else {
                // Si la solicitud no fue exitosa, toma el nombre ingresado manualmente en el formulario
                $validatedData['nombre_apellidos'] = $request->nombre_apellidos;
            }

            // Crear una nueva instancia de conductor con los datos validados y guardarla en la base de datos
            Chofer::create($validatedData);

            // Redireccionar de vuelta a la página del formulario con un mensaje de éxito
            return redirect()->back()->with('success', 'Conductor registrado exitosamente.');
        } catch (\Exception $e) {
            // Capturar excepciones de base de datos y manejarlas
            return redirect()->back()->with('error', 'Error al registrar el conductor: ' . $e->getMessage());
        }


    }



    public function update(Request $request, $id)
    {
        try {
            // Encontrar el conductor por su ID
            $chofer = Chofer::findOrFail($id);

            // Actualizar los campos con los datos del formulario
            $chofer->dni = $request->dni;
            $chofer->nombre_apellidos = $request->nombre_apellidos;
            $chofer->telefono = $request->telefono;
            $chofer->brevete = $request->brevete; // Agregar el campo 'brevete' actualizado

            // Guardar los cambios
            $chofer->save();

            // Redirigir de vuelta al formulario de edición con un mensaje de éxito
            return redirect()->back()->with('success', 'Conductor actualizado correctamente');
        } catch (\Exception $e) {
            // Capturar excepciones de base de datos y manejarlas
            return redirect()->back()->with('error', 'Error al actualizar el conductor: ' . $e->getMessage());
        }
    }

    public function destroy($id)
    {
        try {
            $guia = Chofer::findOrFail($id);
            $guia->delete();

            return redirect()->back()->with('success', 'Conductor eliminado correctamente');
        } catch (\Exception $e) {
            // Manejo de errores si la guía no se encuentra o hay otros problemas
            return redirect()->back()->with('error', 'Error al eliminar conductor: ' . $e->getMessage());
        }
    }

    public function mostrarFormularioAsignacion($choferId)
    {
        $chofer = Chofer::findOrFail($choferId);
        $vehiculos = Vehiculo::all();
        return view('formulario_asignacion', compact('chofer', 'vehiculos'));
    }

    public function asignarVehiculo(Request $request)
    {
        $request->validate([
            'chofer_id' => 'required|exists:chofers,id',
            'vehiculos' => 'required|array',
            'vehiculos.*' => 'exists:vehiculos,id',
        ]);

        $chofer = Chofer::findOrFail($request->chofer_id);
        $chofer->vehiculos()->sync($request->vehiculos);

        return redirect()->back()->with('success', 'Vehículos asignados correctamente al chofer.');
    }

    public function buscar(Request $request)
    {
        // Obtener los parámetros de búsqueda del formulario
        $dni = $request->input('dni');
        $nombreApellidos = $request->input('nombre_apellidos');
        $telefono = $request->input('telefono');
        $brevete = $request->input('brevete');

        // Consultar la base de datos para obtener los choferes según los filtros aplicados
        $query = Chofer::query();

        if ($dni) {
            $query->where('dni', 'like', '%' . $dni . '%');
        }

        if ($nombreApellidos) {
            $query->where('nombre_apellidos', 'like', '%' . $nombreApellidos . '%');
        }

        if ($telefono) {
            $query->where('telefono', 'like', '%' . $telefono . '%');
        }

        if ($brevete) {
            $query->where('brevete', 'like', '%' . $brevete . '%');
        }

        $choferes = $query->get();
        $vehiculos = vehiculo::all();

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

        // Retornar la vista con los resultados de la búsqueda
        return view('conductor.index', compact('choferes', 'vehiculos', 'agricultores_deben', 'agricultores_no_deben', 'num_notificaciones', 'notifications'));
    }

}
