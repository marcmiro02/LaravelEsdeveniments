<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Ticket;
use App\Models\Entrades;
use Stripe\Stripe;
use Stripe\Checkout\Session as StripeSession;

class TicketController extends Controller
{
    public function showPaymentForm(Request $request)
    {
        $entrades = Entrades::all();
        return view('tickets.payment', compact('entrades'));
    }

    public function showOrderSummary(Request $request)
    {
        $entrades = Entrades::all();
        return view('tickets.order-summary', compact('entrades'));
    }

    public function processPayment(Request $request)
    {
        $request->validate([
            'seats' => 'required|string',
            'discount' => 'required|numeric',
        ]);

        $user = Auth::user();
        $seats = json_decode($request->seats, true);
        $discount = $request->discount;

        $totalAmount = array_reduce($seats, function ($carry, $seat) {
            return $carry + $seat['preu'];
        }, 0);

        // Aplicar el descompte
        $discountedTotal = $totalAmount - ($totalAmount * ($discount / 100));

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
                    'unit_amount' => $discountedTotal * 100, // Stripe espera l'import en cèntims
                ],
                'quantity' => 1,
            ]],
            'mode' => 'payment',
            'success_url' => route('tickets.success'),
            'cancel_url' => route('tickets.cancel'),
        ]);

        return redirect($session->url);
    }
}