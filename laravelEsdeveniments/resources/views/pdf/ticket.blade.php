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
            width: 100%;
            max-width: 300px; /* Reduce el ancho para simular un ticket */
            margin: 0 auto;
            background-color: #fff;
            padding: 10px;
            border-radius: 8px;
            box-shadow: 0 0 5px rgba(0, 0, 0, 0.1);
            border: 1px solid #333;
        }
        .title-bar {
            text-align: center;
            margin-bottom: 10px;
        }
        .title-bar img {
            width: 50px; /* Tamaño reducido del logo */
            height: auto;
        }
        .title-bar h2 {
            margin: 5px 0;
            font-size: 18px;
            color: #333;
        }
        .header {
            text-align: center;
            margin-bottom: 10px;
        }
        .header h1 {
            margin: 0;
            font-size: 16px;
            color: #333;
        }
        .event-logo img {
            width: 100%;
            height: auto;
            max-width: 100px; /* Ajustar la imagen */
            margin: 0 auto;
            display: block;
            margin-left: 26%;
        }
        .event-details,
        .ticket-details,
        .qr-code {
            text-align: center;
            margin-bottom: 10px;
        }
        .event-details h2, 
        .ticket-details p, 
        .qr-code p {
            margin: 5px 0;
            font-size: 14px;
            color: #555;
        }
        .qr-code img {
            width: 80px;
            height: 80px;
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
            <p>Preu: {{ $ticketPrice }} €</p>
            <p>Descompte: {{ $discount }} €</p>
            <p>Total: {{ $totalPrice }} €</p>
            <p>Fila: {{ $row }}</p>
            <p>Seient: {{ $seat }}</p>
        </div>
        <div class="qr-code">
            <p>Escaneja el codi QR:</p>
            <img src="data:image/png;base64,{{ $qrCode }}" alt="Codi QR">
        </div>
    </div>
</body>
</html>