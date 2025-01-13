<?php

namespace App\Http\Controllers;

use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Carbon\Carbon;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use App\Models\Qr;

class PdfController extends Controller
{
    public function generarEntrada()
    {
        $qrController = new QrController();
        $qr = $qrController->generarQr();

        $data = [
            'eventName' => 'Evento ID ' . $qr->id_esdeveniment,
            'eventDate' => '12/12/2025',
            'eventTime' => '20:00',
            'eventLocation' => 'Lugar del Evento',
            'eventOrganizer' => 'Organizador del Evento',
            'ticketPrice' => 50,
            'discount' => 10,
            'totalPrice' => 40,
            'row' => 'A',
            'seat' => 12,
            'qrCode' => $qr->dibuix_qr,
        ];

        $pdf = PDF::loadView('pdf.pdf', $data);
        return $pdf->stream('entrada-' . $qr->codi_qr . '.pdf');
    }


}