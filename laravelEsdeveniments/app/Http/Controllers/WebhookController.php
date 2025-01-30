<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use App\Models\Ticket;
use App\Notifications\PaymentReceived;
use Stripe\Stripe;
use Stripe\Webhook;
use Stripe\Checkout\Session as StripeSession;

class WebhookController extends Controller
{
    public function handleWebhook(Request $request)
    {
        $payload = $request->getContent();
        $sig_header = $request->header('Stripe-Signature');
        $endpoint_secret = env('STRIPE_WEBHOOK_SECRET');

        try {
            $event = Webhook::constructEvent(
                $payload, $sig_header, $endpoint_secret
            );
        } catch (\UnexpectedValueException $e) {
            // Invalid payload
            return response()->json(['error' => 'Invalid payload'], 400);
        } catch (\Stripe\Exception\SignatureVerificationException $e) {
            // Invalid signature
            return response()->json(['error' => 'Invalid signature'], 400);
        }

        // Handle the event
        if ($event->type == 'checkout.session.completed') {
            $session = $event->data->object;

            // Obtenir l'usuari autenticat
            $user = Auth::user();

            // Crear un nou registre de ticket
            $ticket = new Ticket();
            $ticket->user_id = $user->id;
            $ticket->event_name = 'Entrades de cinema';
            $ticket->quantity = 1; // Pots ajustar això segons les teves necessitats
            $ticket->price = $session->amount_total / 100; // Convertir de cèntims a euros
            $ticket->stripe_payment_id = $session->payment_intent;
            $ticket->save();

            // Enviar la notificació de correu electrònic
            $user->notify(new PaymentReceived($ticket->price));
        }

        return response()->json(['status' => 'success'], 200);
    }
}