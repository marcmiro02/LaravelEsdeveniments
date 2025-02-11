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
use App\Models\Empreses;
use Illuminate\Support\Facades\Session;

class PdfController extends Controller
{
    public function generarEntrada(Request $request)
    {
        // Verificar si el id_esdeveniment existe en la sesión
        if (!session()->has('id_esdeveniment')) {
            // Redirigir a la página principal si el evento ya fue procesado
            return redirect()->route('welcome'); // O cualquier otra ruta que prefieras
        }

        // Ahora podemos continuar con la lógica original
        $esdeveniment = $request->input('id_esdeveniment');
        $esdeveniment = Esdeveniments::find($esdeveniment);

        if (!$esdeveniment) {
            throw new \Exception('El evento no existe.');
        }

        // Generar el QR
        $qrController = new QrController();
        $qr = $qrController->generarQr($esdeveniment->id_esdeveniment);

        $empresa = Empreses::findOrFail(Auth::user()->id_empresa);

        // Datos para el PDF
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
            'empresaLogo' => $empresa->logo,
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

        // Guardamos el PDF en la base de datos
        $pdfModel = new PdfModel();
        $pdfModel->doc_pdf = $pdfBase64;
        $pdfModel->id_usuari = auth()->id(); // Asumimos que el usuario está autenticado

        $pdfModel->save();

        // Actualizamos el QR
        $qr->id_pdf = $pdfModel->id_pdf;
        $qr->save();

        // Ahora eliminamos el id_esdeveniment de la sesión
        session()->forget('id_esdeveniment');

        // Retornar el PDF generado al navegador
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