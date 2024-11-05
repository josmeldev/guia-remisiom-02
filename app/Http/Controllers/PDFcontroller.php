<?php

namespace App\Http\Controllers;

use App\Models\agricultor;
use App\Models\chofer;
use App\Models\Guia;
use App\Models\vehiculo;
use App\Models\Transportista;

use Barryvdh\DomPDF\Facade\Pdf;
class PDFcontroller extends Controller
{
     // Datos para pasar a la vista
     public function generarPDF($id) {


        $guia = Guia::findOrFail($id);
        $vehiculo = vehiculo::findOrFail($guia->transportista_id);
        $agricultor = Agricultor::findOrFail($guia->agricultor_id);
        $transportista = Transportista::findOrFail($guia->transportista_id);
        $conductor = chofer::findOrFail($guia->transportista_id);

        $data = [
            'guia' => $guia,
            'agricultor' => $agricultor,
            'transportista' => $transportista,
            'vehiculo' => $vehiculo,
            'conductor' => $conductor,
        ];

        $pdf = Pdf::loadView('home', $data);

        $pdf->setPaper([0, 0, 595.28, 841.89]); // A4 por defecto, en milímetros (ancho, alto)

        // Datos para pasar a la vista
        return $pdf->stream();

    }
}
