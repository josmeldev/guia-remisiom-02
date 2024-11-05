<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use App\Models\Agricultor;
use App\Models\Carga;
use App\Notifications\PagoPendienteNotification;
use Illuminate\Support\Facades\Notification;

class EnviarNotificacionesPagoPendiente extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'notificaciones:pagos-pendientes';

    /**
     * The console command description.
     *
     * @var string
     */

    protected $description = 'Enviar notificaciones sobre pagos pendientes a los agricultores';
    /**
     * Execute the console command.
     */
    public function handle()
{
    $agricultores = Agricultor::whereHas('guias.pagos', function ($query) {
        $query->where('monto', '>', 0)
              ->whereRaw('pagos.monto < (cargas.total_carga_bruta - cargas.total_material_extrano - cargas.tara)');
    })->get();

    foreach ($agricultores as $agricultor) {
        // Calcular el total a pagar
        $total_a_pagar = Carga::join('guias', 'cargas.id', '=', 'guias.carga_id')
                              ->join('pagos', 'guias.id', '=', 'pagos.guia_id')
                              ->where('cargas.RUC_Agricultor', $agricultor->id)
                              ->selectRaw('COALESCE(SUM((cargas.total_carga_bruta - cargas.total_material_extrano - cargas.tara) * pagos.precio_unitario) - SUM(pagos.adelanto), 0) AS total_a_pagar')
                              ->value('total_a_pagar');

        // Asignar el total a pagar al agricultor usando setAttribute
        $agricultor->setAttribute('total_a_pagar', $total_a_pagar);

        // Enviar la notificación
        Notification::send($agricultor, new PagoPendienteNotification($agricultor));
    }

    $this->info('Notificaciones enviadas correctamente.');
}


    public function __construct()
    {
        parent::__construct();
    }
}
