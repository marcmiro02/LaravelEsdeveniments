<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Entrades;
use App\Models\Seients;
use Stripe\Stripe;
use Stripe\Checkout\Session as StripeSession;
use App\Models\Esdeveniments;
use App\Models\Ticket;
use Illuminate\Support\Facades\Session;
use App\Notifications\PaymentReceived;
use App\Http\Controllers\PdfController;


class TicketController extends Controller
{
    public function __construct()
    {
        // Configurar la clau API de Stripe directament
        Stripe::setApiKey('sk_test_51QWan1DQSLCEGDSPs45f4Du1dS6HkKWNg5zqSTMgCe9KF8iz6M7tlXBdPMRVubJmwtpA9IiC6AWzyLO2Tj8faYOV00oKWs84ML');
    }

    public function showPaymentForm(Request $request)
    {
        $entrades = Entrades::all();
        return view('tickets.payment', compact('entrades'));
    }

    public function showOrderSummary(Request $request)
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        $selectedEntrades = json_decode($request->input('selectedEntrades'), true);
        return view('tickets.order-summary', compact('selectedEntrades'));
    }

    public function showSelectEntrades(Request $request)
    {
        $entrades = Entrades::all();
        $esdeveniment = Esdeveniments::find($request->query('id_esdeveniment')); // Rebre l'ID de l'esdeveniment des de la URL
        if (!$esdeveniment) {
            return redirect()->route('esdeveniments.index')->with('error', 'Esdeveniment no trobat');
        }
        $seients = Seients::where('id_esdeveniment', $esdeveniment->id_esdeveniment)->get();
        return view('tickets.select-entrades', compact('entrades', 'esdeveniment', 'seients'));
    }

    public function processPayment(Request $request)
    {
        $request->validate([
            'selectedEntrades' => 'required|string',
        ]);

        $selectedEntrades = json_decode($request->input('selectedEntrades'), true);

        // Guardamos las entradas seleccionadas en la sesión
        Session::put('selectedEntrades', $selectedEntrades);  // Esto es lo que asegurará que estén disponibles después

        $totalAmount = array_reduce($selectedEntrades, function ($carry, $entrada) {
            return $carry + $entrada['subtotal'];
        }, 0);

        // Calcular los costos adicionales
        $gestioCost = $totalAmount * 0.05;
        $ivaCost = $totalAmount * 0.21;
        $recarrecCost = $totalAmount * 0.02;
        $totalAmount += $gestioCost + $ivaCost + $recarrecCost;

        // Convertir el importe total a céntimos
        $totalAmountCents = intval(round($totalAmount * 100));

        // Crear la sesión de Stripe
        $session = StripeSession::create([
            'payment_method_types' => ['card'],
            'line_items' => [[
                'price_data' => [
                    'currency' => 'eur',
                    'product_data' => [
                        'name' => 'Entradas de cine',
                    ],
                    'unit_amount' => $totalAmountCents,
                ],
                'quantity' => 1,
            ]],
            'mode' => 'payment',
            'success_url' => route('tickets.success'),
        ]);

        // Redirigir al usuario a Stripe para que complete el pago
        return redirect($session->url);
    }


    public function handleSuccess(Request $request)
    {
        try {
            // Obtener las entradas seleccionadas desde la sesión
            $selectedEntrades = Session::get('selectedEntrades');

            // Verificamos si las entradas están vacías
            if (empty($selectedEntrades)) {
                return redirect()->route('tickets.success')->with('error', 'No se encontraron entradas seleccionadas.');
            }

            // Crear el ticket
            $ticket = new Ticket();
            $ticket->user_id = Auth::id();
            $ticket->event_name = 'Entradas de cine';
            $ticket->quantity = count($selectedEntrades);
            $ticket->price = array_reduce($selectedEntrades, function ($carry, $entrada) {
                return $carry + $entrada['subtotal'];
            }, 0);
            $ticket->stripe_payment_id = 'No aplicable';
            $ticket->save();

            // Llamar al método 'generarEntrada' de PdfController
            $pdfController = new PdfController();
            $pdfUrl = $pdfController->generarEntrada($request);

            // Limpiar las entradas seleccionadas de la sesión
            Session::forget('selectedEntrades');

            // Redirigir a la vista de éxito con el mensaje de confirmación
            return view('tickets.success', [
                'ticket' => $ticket,
                'message' => 'Pago realizado con éxito, tus entradas están en tu historial.',
                'pdfUrl' => $pdfUrl // Devolver la URL del PDF generado
            ]);
        } catch (\Exception $e) {
            return view('tickets.success', [
                'message' => 'Entrades generades correctament.',
            ]);
        }
    }



    public function success($session_id)
    {
        // Recibimos el session_id y lo usamos para verificar el pago
        try {
            $session = StripeSession::retrieve($session_id);

            // Verificamos que el pago ha sido completado
            if ($session->payment_status !== 'paid') {
                return redirect()->route('tickets.cancel')->with('error', 'El pago no se ha completado.');
            }

            // Aquí puedes continuar con la lógica para generar entradas o lo que sea necesario

            // Redirigimos a la vista de éxito
            return view('tickets.success', ['session' => $session]);

        } catch (\Exception $e) {
            return redirect()->route('tickets.cancel')->with('error', 'No se ha podido recuperar la sesión de pago.');
        }
    }


    public function cancel()
    {
        return view('tickets.cancel');
    }
}