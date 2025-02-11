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
        // Obtener los datos enviados desde el formulario o la sesión
        $selectedSeats = $request->input('selectedSeats') ?? Session::get('selectedSeats');
        if (empty($selectedSeats)) {
            throw new \Exception('No se han seleccionado asientos.');
        }

        // Recuperar el evento correspondiente
        $esdevenimentId = $selectedSeats[0]['fila']; // Suponemos que todos los asientos pertenecen al mismo evento
        $esdeveniment = Esdeveniments::find($esdevenimentId);

        if (!$esdeveniment) {
            throw new \Exception('El evento no existe.');
        }

        // Array para almacenar los datos de todas las entradas
        $ticketData = [];

        foreach ($selectedSeats as $seat) {
            // Crear un QR único para cada entrada
            $qrController = new QrController();
            $qr = $qrController->generarQr($esdeveniment->id_esdeveniment);

            // Datos dinámicos del asiento seleccionado
            $data = [
                'eventName' => $esdeveniment->nom,
                'eventDate' => Carbon::parse($esdeveniment->data_estrena)->format('d/m/Y'),
                'eventTime' => Carbon::parse($esdeveniment->duracio)->format('H:i'),
                'eventPhoto' => $esdeveniment->foto_portada,
                'eventPhotoBackground' => $esdeveniment->foto_fons,
                'ticketPrice' => $seat['price'], // Precio dinámico del asiento
                'discount' => 0, // Descuento (puedes ajustarlo según tu lógica)
                'totalPrice' => $seat['price'], // Precio total (sin descuento en este caso)
                'row' => $seat['fila'], // Fila dinámica del asiento
                'seat' => $seat['columna'], // Columna dinámica del asiento
                'qrCode' => $qr->dibuix_qr,
                'empresaLogo' => Auth::user()->empresa->logo, // Logo de la empresa del usuario autenticado
            ];

            // Agregar los datos de la entrada al array
            $ticketData[] = $data;

            // Guardar el QR generado
            $qr->save();
        }

        // Generar un único PDF con todas las entradas
        $pdf = PDF::loadView('pdf.multiple_tickets', ['tickets' => $ticketData])->setPaper([0, 0, 218, 541], 'portrait');

        // Convertir el PDF a base64
        $pdfContent = $pdf->output();
        $pdfBase64 = base64_encode($pdfContent);

        // Guardar el PDF en la base de datos
        $pdfModel = new PdfModel();
        $pdfModel->doc_pdf = $pdfBase64;
        $pdfModel->id_usuari = auth()->id(); // Asumiendo que el usuario está autenticado
        $pdfModel->save();

        // Devolver la URL del PDF generado
        return route('pdf.show', $pdfModel->id);
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