<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Ticket;
use Stripe\Stripe;
use Stripe\Checkout\Session as StripeSession;

class TicketController extends Controller
{
    public function showPaymentForm()
    {
        
        return view('tickets.payment');
    }

    public function processPayment(Request $request)
    {
        $request->validate([
            'seats' => 'required|string',
        ]);

        $user = Auth::user();
        $seats = json_decode($request->seats, true);
        $totalAmount = array_reduce($seats, function ($carry, $seat) {
            return $carry + $seat['preu'];
        }, 0);

        // Configura la clau d'API de Stripe directament
        Stripe::setApiKey('sk_test_51QWan1DQSLCEGDSPs45f4Du1dS6HkKWNg5zqSTMgCe9KF8iz6M7tlXBdPMRVubJmwtpA9IiC6AWzyLO2Tj8faYOV00oKWs84ML');

        $lineItems = array_map(function ($seat) {
            return [
                'price_data' => [
                    'currency' => 'usd',
                    'product_data' => [
                        'name' => 'Seat ' . $seat['fila'] . '-' . $seat['columna'],
                    ],
                    'unit_amount' => $seat['preu'] * 100,
                ],
                'quantity' => 1,
            ];
        }, $seats);

        $session = StripeSession::create([
            'payment_method_types' => ['card'],
            'line_items' => [$lineItems],
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