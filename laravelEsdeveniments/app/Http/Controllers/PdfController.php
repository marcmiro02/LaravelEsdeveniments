<?php

namespace App\Http\Controllers;

use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Carbon\Carbon;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use App\Models\Qr;
use App\Models\Esdeveniments;
use App\Models\PdfModel;
use Illuminate\Support\Facades\Auth;

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

        // Generar el PDF
        if ($request->has('imprimir_ticket')) {
            $pdf = PDF::loadView('pdf.ticket', $data)->setPaper([0, 0, 218, 541], 'portrait'); // Ticket
        } else {
            $pdf = PDF::loadView('pdf.pdf', $data); // PDF normal
        }

        // Convertir el PDF a base64
        $pdfContent = $pdf->output();
        $pdfBase64 = base64_encode($pdfContent);

        // Crear una nueva instancia del modelo Pdf
        $pdfModel = new PdfModel();
        $pdfModel->doc_pdf = $pdfBase64;
        $pdfModel->id_usuari = auth()->id(); // Asumiendo que el usuario está autenticado

        // Guardar el PDF en la base de datos
        $pdfModel->save();

        // Actualizar el campo id_pdf en la tabla qr
        $qr->id_pdf = $pdfModel->id_pdf; // Asegúrate de usar el nombre correcto del campo
        $qr->save();

        // Enviar el PDF al navegador
        return $pdf->stream('entrada-' . $qr->codi_qr . '.pdf');
    }

    public function showEventSelection()
    {
        $empresaId = Auth::user()->id_empresa;
        $esdeveniments = Esdeveniments::where('id_empresa', $empresaId)->get();
        return view('pdf.index', compact('esdeveniments'));
    }

    public function indexValidar()
    {
        // Obtener los eventos disponibles
        $esdeveniments = Esdeveniments::all();

        // Pasar los eventos a la vista
        return view('pdf.indexValidar', compact('esdeveniments'));
    }

    public function pestanyaValidar(Request $request)
    {
        // Validar que se envía un evento
        $idEsdeveniment = $request->input('id_esdeveniment');
        if (!$idEsdeveniment) {
            return redirect()->back()->with('error', 'Por favor selecciona un evento.');
        }
        echo"<script>console.log('ID esdeveniment: ".$idEsdeveniment."')</script>";
        // Guardar el evento seleccionado en la sesión
        session(['id_del_esdeveniment' => $idEsdeveniment]);
        $idEsdeveniment = session('id_del_esdeveniment');
        echo"<script>console.log('ID esdeveniment llegit del session: ".$idEsdeveniment."')</script>";

        return view('pdf.validacio');
    }

    public function show($id)
    {
        $pdf = PdfModel::findOrFail($id);
        $pdfContent = base64_decode($pdf->doc_pdf);

        return response($pdfContent)->header('Content-Type', 'application/pdf');
    }

    public function download($id)
    {
        $pdf = PdfModel::findOrFail($id);
        $pdfContent = base64_decode($pdf->doc_pdf);
        $filename = 'entrada-' . $id . '.pdf';

        return response($pdfContent)
            ->header('Content-Type', 'application/pdf')
            ->header('Content-Disposition', 'attachment; filename="' . $filename . '"');
    }
}