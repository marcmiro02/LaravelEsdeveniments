<!DOCTYPE html>
<html>
<head>
    <title>Entrades d'Esdeveniment</title>
    <style>
        body {
            font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
        }
        .ticket {
            width: 100%;
            max-width: 600px;
            margin: 20px auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.2);
            border: 1px solid #ddd;
        }
        .ticket + .ticket {
            margin-top: 40px;
        }
        /* Reutiliza los estilos de la plantilla anterior */
    </style>
</head>
<body>
    @foreach ($tickets as $ticket)
        <div class="ticket">
            <!-- Barra de título -->
            <div class="title-bar">
                <img src="{{ public_path('img/Logos/' . $ticket['empresaLogo']) }}" alt="Logo de l'Empresa" style="width: 80px; height: auto;">
                <h2 style="margin: 0; font-size: 24px; color: #333; flex-grow: 1; text-align: center;">DAM EVENT PRODUCTION</h2>
            </div>

            <!-- Encabezado -->
            <div class="header">
                <h1 style="margin: 0; font-size: 28px; color: #333; text-transform: uppercase; letter-spacing: 1px; text-align: center;">Entrada d'Esdeveniment</h1>
            </div>

            <!-- Logo del Evento -->
            <div class="event-logo" style="text-align: center; margin-bottom: 20px;">
                <img src="data:image/jpeg;base64,{{ base64_encode(file_get_contents(public_path('storage/' . $ticket['eventPhoto']))) }}" alt="Foto de l'Esdeveniment" style="width: 100%; height: auto; max-width: 250px; border-radius: 10px;">
            </div>

            <!-- Detalles del Evento -->
            <div class="event-details" style="text-align: center; margin-bottom: 20px;">
                <h2>{{ $ticket['eventName'] }}</h2>
                <p>Data: {{ $ticket['eventDate'] }}</p>
                <p>Hora: {{ $ticket['eventTime'] }}</p>
            </div>

            <!-- Detalles del Ticket -->
            <div class="ticket-details" style="text-align: center; margin-bottom: 20px; border-top: 2px solid #333; padding-top: 10px;">
                <p>Preu de l'Entrada: {{ $ticket['ticketPrice'] }} €</p>
                <p>Descompte Aplicat: {{ $ticket['discount'] }} €</p>
                <p>Preu Total: {{ $ticket['totalPrice'] }} €</p>
                <p>Fila: {{ $ticket['row'] }}</p>
                <p>Seient: {{ $ticket['seat'] }}</p>
            </div>

            <!-- Código QR -->
            <div class="qr-code" style="text-align: center; margin-top: 20px;">
                <p>Escaneja el codi QR per accedir a l'esdeveniment:</p>
                <img src="data:image/png;base64,{{ $ticket['qrCode'] }}" alt="Codi QR" style="width: 120px; height: 120px; border: 1px solid #ddd; padding: 10px; border-radius: 10px;">
            </div>
        </div>
    @endforeach
</body>
</html>