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

class TicketController extends Controller
{
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

        $selectedEntrades = json_decode($request->input('selectedEntrades', '[]'), true);
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

        $totalAmount = array_reduce($selectedEntrades, function ($carry, $entrada) {
            return $carry + $entrada['subtotal'];
        }, 0);

        // Calcular els costos addicionals
        $gestioCost = $totalAmount * 0.05; // Gastos de gestió (5% del total)
        $ivaCost = $totalAmount * 0.21; // IVA (21% del total)
        $recarrecCost = $totalAmount * 0.02; // Recàrrecs (2% del total)
        $totalAmount += $gestioCost + $ivaCost + $recarrecCost;

        // Convertir l'import total a cèntims
        $totalAmountCents = intval(round($totalAmount * 100));

        // Configurar la clau API de Stripe
        Stripe::setApiKey(env('STRIPE_SECRET'));

        $session = StripeSession::create([
            'payment_method_types' => ['card'],
            'line_items' => [[
                'price_data' => [
                    'currency' => 'eur',
                    'product_data' => [
                        'name' => 'Entrades de cinema',
                    ],
                    'unit_amount' => $totalAmountCents, // Stripe espera l'import en cèntims
                ],
                'quantity' => 1,
            ]],
            'mode' => 'payment',
            'success_url' => url('/tickets/success/{CHECKOUT_SESSION_ID}'),
            'cancel_url' => route('tickets.cancel'),
        ]);
        return redirect($session->url);
    }

    public function handleSuccess(Request $request, $session_id)
    {
        try {
            // Verificar que la sesión de pago existe y ha sido completada
            $session = StripeSession::retrieve($session_id);

            if ($session->payment_status !== 'paid') {
                return redirect()->route('tickets.success')->with('error', 'El pago no se ha completado.');
            }

            // Obtener las entradas seleccionadas desde la sesión
            $selectedEntrades = Session::get('selectedEntrades');

            if (empty($selectedEntrades)) {
                return redirect()->route('tickets.success')->with('error', 'El pago no se ha completado.');
            }

            // Llamar a generarEntrada() para crear el PDF
            $pdfController = app(PdfController::class);
            $pdfUrl = $pdfController->generarEntrada(new Request(['selectedSeats' => $selectedEntrades]));

            if ($pdfUrl) {
                // Limpiar las entradas seleccionadas de la sesión
                Session::forget('selectedEntrades');

                // Redirigir al usuario al PDF generado
                return redirect($pdfUrl)->with('success', 'Entrada(s) generada(s) correctamente.');
            }

        } catch (\Exception $e) {
            // En caso de error, redirigir al usuario con un mensaje de error
            return redirect()->route('tickets.success')->with('error', 'El pago no se ha completado.');
        }
        return redirect()->route('tickets.success')->with('error', 'El pago no se ha completado.');
    }

    public function success(Request $request)
    {
        return view('tickets.success');
    }

    public function cancel()
    {
        return view('tickets.cancel');
    }
}