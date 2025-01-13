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
    public function generarEntrada($id)
    {
        // 1. Buscar el QR en la base de datos
        $qr = Qr::find($id);

        if (!$qr) {
            return response()->json(['error' => 'QR no encontrado'], 404);
        }

        // 2. Generar el contenido del QR (contendrá los datos del evento y el QR)
        $contenido = "Código: {$qr->codi}, Evento ID: {$qr->id_esdeveniment}, Usuario: {$qr->id_usuari}, Expiración: {$qr->data_expiracio}";

        // 3. Generar el QR dinámicamente (como base64 para la vista)
        $qrCode = QrCode::format('png')->size(200)->generate($contenido);
        $qrCodeBase64 = base64_encode($qrCode); // Convertir a base64 para integrarlo en la vista

        // 4. Preparar datos para el PDF
        $data = [
            'eventName' => 'Evento ID ' . $qr->id_esdeveniment, // Puedes personalizar el nombre del evento
            'eventDate' => '12/12/2025', // O personalizar con datos reales
            'eventTime' => '20:00', // Personaliza el horario
            'eventLocation' => 'Lugar del Evento', // Personaliza la ubicación
            'eventOrganizer' => 'Organizador del Evento', // Nombre del organizador
            'ticketPrice' => 50, // Precio real del evento
            'discount' => 10, // Descuento si es necesario
            'totalPrice' => 40, // Precio total después del descuento
            'row' => 'A', // Personaliza la fila
            'seat' => 12, // Asiento asignado
            'qrCode' => $qrCodeBase64, // El QR como base64
            'qr' => $qr, // Información completa del QR
        ];

        // 5. Crear el PDF usando la vista
        $pdf = PDF::loadView('pdf.pdf', $data);

        // 6. Devolver el PDF generado
        return $pdf->stream('entrada-' . $qr->codi . '.pdf');
    }

}