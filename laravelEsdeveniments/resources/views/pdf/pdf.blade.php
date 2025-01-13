<!DOCTYPE html>
<html>
<head>
    <title>Entrada d'Esdeveniment</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
        }
        .container {
            width: 100%;
            max-width: 600px;
            margin: 20px auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            border: 2px dashed #333;
        }
        .title-bar {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 20px;
        }
        .title-bar img {
            width: 80px;
            height: auto;
        }
        .title-bar h2 {
            margin: 0;
            font-size: 24px;
            color: #333;
            flex-grow: 1;
            text-align: center;
        }
        .header {
            text-align: center;
            margin-bottom: 20px;
        }
        .header h1 {
            margin: 0;
            font-size: 20px;
            color: #333;
        }
        .event-logo {
            text-align: center;
            margin-bottom: 20px;
        }
        .event-logo img {
            width: 100%;
            height: auto;
            max-width: 200px;
        }
        .event-details {
            text-align: center;
            margin-bottom: 20px;
        }
        .event-details h2 {
            margin: 0;
            font-size: 18px;
            color: #555;
        }
        .event-details p {
            margin: 5px 0;
            font-size: 14px;
            color: #666;
        }
        .ticket-details {
            text-align: center;
            margin-bottom: 20px;
        }
        .ticket-details p {
            margin: 5px 0;
            font-size: 14px;
            color: #666;
        }
        .qr-code {
            text-align: center;
            margin-top: 20px;
        }
        .qr-code img {
            width: 100px;
            height: 100px;
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
            <img src="{{ public_path('img/Logos/comic-book-cover-vertical-banner-design-vector.jpg') }}" alt="Event Logo">
        </div>
        <div class="event-details">
            <h2>Nom de l'Esdeveniment: {{ $eventName }}</h2>
            <p>Data: {{ $eventDate }}</p>
            <p>Hora: {{ $eventTime }}</p>
            <p>Lloc: {{ $eventLocation }}</p>
            <p>Organitzat per: {{ $eventOrganizer }}</p>
        </div>
        <div class="ticket-details">
            <p>Preu de l'Entrada: {{ $ticketPrice }} €</p>
            <p>Descompte de Codi Promocional: {{ $discount }} €</p>
            <p>Preu Total: {{ $totalPrice }} €</p>
            <p>Fila: {{ $row }}</p>
            <p>Seient: {{ $seat }}</p>
        </div>
        <div class="qr-code">
            <p>Escaneja el codi QR per accedir a l'esdeveniment:</p>
            <img src="data:image/png;base64,{{ $qrCode }}" alt="Código QR">
        </div>
    </div>
</body>
</html>