<?php

namespace App\Http\Controllers;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;

class userController extends Controller
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

        return view('users.index', compact('users', 'agricultores_deben', 'agricultores_no_deben', 'num_notificaciones', 'notifications'));
    }

    public function eliminar(Request $request, $id)
    {
        // Verificar si el usuario actual es el administrador
        if (Auth::user()->id === $id) {
            return redirect()->back()->with('error', 'No puedes eliminar tu propia cuenta.');
        }

        $user = User::find($id);
        if ($user) {
            $user->delete();
            return redirect()->back()->with('success', 'Usuario eliminado correctamente.');
        } else {
            return redirect()->back()->with('error', 'No se pudo encontrar el usuario.');
        }
    }

    public function editar($id)
    {
        $user = User::find($id);
        if ($user) {
            return view('users.edit', ['user' => $user]);
        } else {
            return redirect()->back()->with('error', 'No se pudo encontrar el usuario.');
        }
    }
    public function update(Request $request, $id)
{
    try {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,'.$id,
            'role' => 'required|in:Administrador,Asistente,Usuario',
            'profile_photo_path' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Validación de la imagen
            // Añade más validaciones según sea necesario
        ]);

        $user = User::find($id);
        if (!$user) {
            throw new \Exception('El usuario no pudo ser encontrado.');
        }

        $user->name = $request->nombre;
        $user->email = $request->email;
        $user->role = $request->role;
        // Actualiza otros campos según sea necesario

        // Manejo de la imagen de perfil
        if ($request->hasFile('profile_photo_path')) {
            // Si el usuario ya tiene una imagen de perfil, eliminarla
            if ($user->profile_photo_path) {
                // Eliminar la imagen anterior
                Storage::delete($user->profile_photo_path);
            }

            // Obtener el archivo cargado
            $imagen = $request->file('profile_photo_path');

            // Mover el archivo a la carpeta deseada y obtener la ruta relativa
            $ruta_imagen = $imagen->move(public_path('images'), $imagen->getClientOriginalName());

            // Almacenar la ruta relativa en el campo profile_photo_path del usuario
            $user->profile_photo_path = 'images/' . $imagen->getClientOriginalName();
        }



        $user->save();

        return redirect()->back()->with('success', 'Usuario actualizado correctamente.');
    } catch (\Exception $e) {
        // Manejo de la excepción
        Log::error('Error al actualizar usuario: ' . $e->getMessage());
        return redirect()->back()->with('error', 'Error al actualizar usuario: ' . $e->getMessage());
    }
}
}
