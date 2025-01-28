<!DOCTYPE html>
<html>
<head>
    <title>Entrada d'Esdeveniment</title>
    <style>
        body {
            font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
        }
        .container {
            width: 170px; /* Ancho del ticket */
            background-color: #fff;
            padding: 10px;
            border-radius: 8px;
            box-shadow: 0 0 5px rgba(0, 0, 0, 0.1);
            border: 1px solid #333;
            margin-left: -10px; /* Ajuste más sutil hacia la izquierda */
            margin-top: -25px; /* Ajuste más sutil hacia arriba */
            text-align: center;
        }

        .title-bar {
            margin-bottom: 10px;
        }
        .title-bar img {
            width: 40px; /* Tamaño reducido del logo */
            height: auto;
        }

        .title-bar h2 {
            margin: 5px 0;
            font-size: 14px;
            color: #333;
        }

        .header {
            margin-bottom: 10px;
        }
        .header h1 {
            margin: 0;
            font-size: 12px;
            color: #333;
        }

        .event-logo img {
            width: 100%;
            height: auto;
            max-width: 80px;
            display: block;
            margin: 0 auto;
        }

        .event-details,
        .ticket-details,
        .qr-code {
            margin-bottom: 10px;
        }

        .event-details h2 {
            margin: 5px 0;
            font-size: 12px;
            color: #555;
        }

        .ticket-details {
            font-size: 12px;
            color: #555;
        }

        .ticket-details b {
            font-weight: bold;
        }

        .ticket-details div {
            margin-bottom: 5px;
        }

        .qr-code p {
            margin: 5px 0;
            font-size: 12px;
            color: #555;
        }

        .qr-code img {
            width: 60px;
            height: 60px;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="title-bar">
            <img src="{{ public_path('img/Logos/Clar.png') }}" alt="Logo">
            <h2>DAM EVENT PRODUCTION</h2>
        </div>
        <div class="header">
            <h1>Entrada d'Esdeveniment</h1>
        </div>
        <div class="event-logo">
            <img src="data:image/jpeg;base64,{{ $eventPhoto }}" alt="Event Logo">
        </div>
        <div class="event-details">
            <h2>Nom: {{ $eventName }}</h2>
            <p>Data: {{ $eventDate }}</p>
            <p>Hora: {{ $eventTime }}</p>
        </div>
        <div class="ticket-details">
            <div><b>Preu:</b> {{ $ticketPrice }} €</div>
            <div><b>Descompte:</b> {{ $discount }} €</div>
            <div><b>Total:</b> {{ $totalPrice }} €</div>
            <div><b>Fila:</b> {{ $row }}</div>
            <div><b>Seient:</b> {{ $seat }}</div>
        </div>
        <div class="qr-code">
            <p>Escaneja el codi QR:</p>
            <img src="data:image/png;base64,{{ $qrCode }}" alt="Codi QR">
        </div>
    </div>
</body>
</html>
