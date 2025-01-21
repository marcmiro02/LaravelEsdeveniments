<?php

namespace App\Http\Controllers;

use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Carbon\Carbon;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use App\Models\Qr;
use App\Models\Esdeveniments;

class PdfController extends Controller
{
    public function generarEntrada(Request $request)
    {
        $esdeveniment = $request->input('id_esdeveniment');
        $esdeveniment = Esdeveniments::find($esdeveniment);

        $qrController = new QrController();
        $qr = $qrController->generarQr($esdeveniment->id_esdeveniment);

        $data = [
            'eventName' => $esdeveniment->nom,
            'eventDate' => Carbon::parse($esdeveniment->data_estrena)->format('d/m/Y'),
            'eventTime' => Carbon::parse($esdeveniment->duracio)->format('H:i'),
            'eventPhoto' => $esdeveniment->foto_portada,
            'eventPhotoBackground' => $esdeveniment->foto_fons,  
            'ticketPrice' => 50,
            'discount' => 10,
            'totalPrice' => 40,
            'row' => 'A',
            'seat' => 12,
            'qrCode' => $qr->dibuix_qr,
        ];
        
       //$pdf = PDF::loadView('pdf.pdf', $data);
        $pdf = PDF::loadView('pdf.ticket', $data)->setPaper([0, 0, 226.77, 560], 'portrait'); // 80 mm x altura ajustable
        return $pdf->stream('entrada-' . $qr->codi_qr . '.pdf');
    }

    public function showEventSelection()
    {
        $esdeveniments = Esdeveniments::all();
        return view('pdf.index', compact('esdeveniments'));
    }

    public function indexValidar()
    {
        // Obtener los eventos disponibles
        $esdeveniments = Esdeveniments::all();

        // Pasar los eventos a la vista
        return view('pdf.indexValidar', compact('esdeveniments'));
    }

    public function pestanyaValidar()
    {
        return view('pdf.validacio');
    }
}