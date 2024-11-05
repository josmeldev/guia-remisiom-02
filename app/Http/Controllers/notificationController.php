<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Notification;
use App\Notifications\PagoPendienteNotification;
use App\Models\Agricultor;
use App\Models\User;
use App\Notifications\pagosnotificacion;
use Illuminate\Support\Facades\DB;
class notificationController extends Controller
{
    public function enviarNotificaciones()
    {
        $agricultores = Agricultor::all();

        foreach ($agricultores as $agricultor) {
            // Calcular el total a pagar
            $total_a_pagar = DB::table('cargas as c')
                ->join('guias as g', 'g.carga_id', '=', 'c.id')
                ->join('pagos as p', 'p.guia_id', '=', 'g.id')
                ->where('c.RUC_Agricultor', $agricultor->id)
                ->select(DB::raw('COALESCE(SUM((c.total_carga_bruta - c.total_material_extrano - c.tara) * p.precio_unitario) - SUM(p.adelanto), 0) AS total_a_pagar'))
                ->value('total_a_pagar');

            // Asignar el total a pagar al agricultor
            $agricultor->setAttribute('total_a_pagar', $total_a_pagar);

            // Enviar la notificación
            Notification::send($agricultor, new PagoPendienteNotification($agricultor));
        }

        return response()->json(['message' => 'Notificaciones enviadas con éxito']);
    }


        public function enviarNotificacion()
    {
        $usuario = User::find(1); // Cambia esto según tu lógica para obtener el usuario
        $usuario->notify(new pagosnotificacion());

        return redirect()->back()->with('success', 'Notificación enviada correctamente');
    }

}

