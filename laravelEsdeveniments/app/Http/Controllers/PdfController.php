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
use Illuminate\Support\Facades\Mail;
use App\Models\Empreses;
use Illuminate\Support\Facades\Session;
use App\Models\Reserves;

class PdfController extends Controller
{
    public function generarEntrada(Request $request)
    {
        if (!session()->has('id_esdeveniment')) {
            return redirect()->route('welcome');
        }

        $esdeveniment = Esdeveniments::find(session('id_esdeveniment'));
        if (!$esdeveniment) {
            throw new \Exception('El evento no existe.');
        }

        $imprimir_ticket = session()->has('imprimir_ticket');
        $dataTriada = session('fecha_seleccionada');

        // ✅ Recuperamos las entradas desde la sesión
        $selectedEntrades = session('selectedEntrades', []);
        if (empty($selectedEntrades)) {
            throw new \Exception('No hay entradas seleccionadas.');
        }

        $empresa = $esdeveniment->empresa;
        $entradasData = [];
        $qrCodes = []; // Guardaremos los QR generados aquí

        foreach ($selectedEntrades as $entrada) {
            foreach ($entrada['seients'] as $seient) {
                $qrController = new QrController();
                $qr = $qrController->generarQr($esdeveniment->id_esdeveniment);
                $qrCodes[] = $qr;

                // ✅ Guardamos la reserva en la BD
                Reserves::create([
                    'id_esdeveniment' => $esdeveniment->id_esdeveniment,
                    'id_usuari' => auth()->id(),
                    'fila' => $seient['fila'],
                    'columna' => $seient['columna'],
                    'estat' => 'confirmada',
                    'data_event' => $dataTriada,
                ]);

                $entradaData = [
                    'eventName' => $esdeveniment->nom,
                    'eventDate' => Carbon::parse($dataTriada)->format('\D\i\a d/m/Y \a \l\e\s H:i\h'),
                    'eventPhoto' => $esdeveniment->foto_portada,
                    'eventPhotoBackground' => $esdeveniment->foto_fons,
                    'row' => $seient['fila'],
                    'seat' => $seient['columna'],
                    'qrCode' => $qr->dibuix_qr,
                    'empresaLogo' => $empresa->logo,
                ];
                $entradasData[] = $entradaData;
            }
        }
        // ✅ Generamos el PDF dependiendo de si es un ticket o un PDF normal
        if ($imprimir_ticket) {
            $pdf = PDF::loadView('pdf.ticket', ['entradas' => $entradasData])->setPaper([0, 0, 65, 115], 'portrait');
        } else {
            $pdf = PDF::loadView('pdf.pdf', ['entradas' => $entradasData]);
        }

        // Convertimos el PDF a base64
        $pdfContent = $pdf->output();
        $pdfBase64 = base64_encode($pdfContent);

        // Guardamos el PDF en la base de datos
        $pdfModel = new PdfModel();
        $pdfModel->doc_pdf = $pdfBase64;
        $pdfModel->id_usuari = auth()->id();
        $pdfModel->save();

        // ✅ Actualizamos TODOS los QR con el mismo id_pdf
        foreach ($qrCodes as $qr) {
            $qr->id_pdf = $pdfModel->id_pdf;
            $qr->save();
        }

        // Limpiamos la sesión después de generar el ticket
        session()->forget(['id_esdeveniment', 'selectedEntrades']);

        if (!$imprimir_ticket) {
            // Enviar correo con el PDF adjunto
            $user = auth()->user();
            $pdfData = base64_decode($pdfModel->doc_pdf);

            Mail::send('emails.ticket', ['entradas' => $entradasData], function ($message) use ($user, $pdfData) {
                $message->to($user->email)
                        ->subject('Les teves entrades per l\'esdeveniment')
                        ->attachData($pdfData, 'entrada.pdf', ['mime' => 'application/pdf']);
            });
        }

        // Retornamos el PDF generado al navegador
        return $pdf->stream('entrada-' . $qr->codi_qr . '.pdf');
    }

    public function generarEntradaDisco(Request $request)
    {
        if (!session()->has('id_esdeveniment')) {
            return redirect()->route('welcome');
        }

        $esdeveniment = Esdeveniments::find(session('id_esdeveniment'));
        if (!$esdeveniment) {
            throw new \Exception('El evento no existe.');
        }

        $imprimir_ticket = session()->has('imprimir_ticket');
        $dataTriada = session('fecha_seleccionada');

        // ✅ Recuperamos las entradas desde la sesión
        $quantitat = session('quantitatEntrades');
        if (empty($quantitat)) {
            throw new \Exception('No hay entradas seleccionadas.');
        }

        $empresa = $esdeveniment->empresa;
        $entradasData = [];
        $qrCodes = []; // Guardaremos los QR generados aquí

        for ($i = 0; $i < $quantitat; $i++) {       
            $qrController = new QrController();
            $qr = $qrController->generarQr($esdeveniment->id_esdeveniment);
            $qrCodes[] = $qr;

            // ✅ Guardamos la reserva en la BD
            Reserves::create([
                'id_esdeveniment' => $esdeveniment->id_esdeveniment,
                'id_usuari' => auth()->id(),
                'estat' => 'confirmada',
                'data_event' => $dataTriada,
            ]);

            $entradaData = [
                'eventName' => $esdeveniment->nom,
                'eventDate' => Carbon::parse($dataTriada)->format('\D\i\a d/m/Y \a \l\e\s H:i\h'),
                'eventPhoto' => $esdeveniment->foto_portada,
                'eventPhotoBackground' => $esdeveniment->foto_fons,
                'qrCode' => $qr->dibuix_qr,
                'empresaLogo' => $empresa->logo,
            ];
            $entradasData[] = $entradaData;        
        }

        // ✅ Generamos el PDF dependiendo de si es un ticket o un PDF normal
        if ($imprimir_ticket) {
            $pdf = PDF::loadView('pdf.ticket', ['entradas' => $entradasData])->setPaper([0, 0, 65, 115], 'portrait');
        } else {
            $pdf = PDF::loadView('pdf.pdf', ['entradas' => $entradasData]);
        }

        // Convertimos el PDF a base64
        $pdfContent = $pdf->output();
        $pdfBase64 = base64_encode($pdfContent);

        // Guardamos el PDF en la base de datos
        $pdfModel = new PdfModel();
        $pdfModel->doc_pdf = $pdfBase64;
        $pdfModel->id_usuari = auth()->id();
        $pdfModel->save();

        // ✅ Actualizamos TODOS los QR con el mismo id_pdf
        foreach ($qrCodes as $qr) {
            $qr->id_pdf = $pdfModel->id_pdf;
            $qr->save();
        }

        // Limpiamos la sesión después de generar el ticket
        session()->forget(['id_esdeveniment', 'quantitat']);

        if (!$imprimir_ticket) {
            // Enviar correo con el PDF adjunto
            $user = auth()->user();
            $pdfData = base64_decode($pdfModel->doc_pdf);

            Mail::send('emails.ticket', ['entradas' => $entradasData], function ($message) use ($user, $pdfData) {
                $message->to($user->email)
                        ->subject('Les teves entrades per l\'esdeveniment')
                        ->attachData($pdfData, 'entrada.pdf', ['mime' => 'application/pdf']);
            });
        }

        // Retornamos el PDF generado al navegador
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
        $empresaId = Auth::user()->id_empresa;
        $esdeveniments = Esdeveniments::where('id_empresa', $empresaId)->get();

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