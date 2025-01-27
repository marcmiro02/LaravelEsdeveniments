<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Entrades;
use App\Models\Seients;
use Stripe\Stripe;
use Stripe\Checkout\Session as StripeSession;
use App\Models\Esdeveniments;

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

        // Aquí pots continuar amb el procés de pagament amb Stripe o qualsevol altre servei de pagament
        Stripe::setApiKey('sk_test_51QWan1DQSLCEGDSPs45f4Du1dS6HkKWNg5zqSTMgCe9KF8iz6M7tlXBdPMRVubJmwtpA9IiC6AWzyLO2Tj8faYOV00oKWs84ML');

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
            'success_url' => route('tickets.success'),
            'cancel_url' => route('tickets.cancel'),
        ]);

        return redirect($session->url);
    }

    public function success()
    {
        return view('tickets.success');
    }

    public function cancel()
    {
        return view('tickets.cancel');
    }
}