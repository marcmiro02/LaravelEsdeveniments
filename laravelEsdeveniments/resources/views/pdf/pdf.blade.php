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
            max-width: 600px;
            margin: 20px auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.2);
            border: 1px solid #ddd;
        }
        .title-bar {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 20px;
            border-bottom: 2px solid #333;
            padding-bottom: 10px;
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
            font-size: 28px;
            color: #333;
            text-transform: uppercase;
            letter-spacing: 1px;
        }
        .event-logo {
            text-align: center;
            margin-bottom: 20px;
        }
        .event-logo img {
            width: 100%;
            height: auto;
            max-width: 250px;
            border-radius: 10px;
        }
        .event-details {
            text-align: center;
            margin-bottom: 20px;
        }
        .event-details h2 {
            margin: 0;
            font-size: 22px;
            color: #555;
        }
        .event-details p {
            margin: 5px 0;
            font-size: 16px;
            color: #666;
        }
        .ticket-details {
            text-align: center;
            margin-bottom: 20px;
            border-top: 2px solid #333;
            padding-top: 10px;
        }
        .ticket-details p {
            margin: 5px 0;
            font-size: 16px;
            color: #666;
        }
        .qr-code {
            text-align: center;
            margin-top: 20px;
        }
        .qr-code img {
            width: 120px;
            height: 120px;
            border: 1px solid #ddd;
            padding: 10px;
            border-radius: 10px;
        }
    </style>
</head>
<body>
    @foreach ($entradas as $entrada)
        <div class="container">
            <div class="title-bar">
                <img src="{{ public_path('img/Logos/Clar.png') }}" alt="Logo">
                <h2>DAM EVENT PRODUCTION</h2>
            </div>
            <div class="header">
                <h1>Entrada d'Esdeveniment</h1>
            </div>
            <div class="event-logo">
                <img src="data:image/jpeg;base64,{{ $entrada['eventPhoto'] }}" alt="Event Logo">
            </div>
            <div class="event-details">
                <h2>{{ $entrada['eventName'] }}</h2>
                <p>Data: {{ $entrada['eventDate'] }}</p>
                <p>Hora: {{ $entrada['eventTime'] }}</p>
            </div>
            <div class="ticket-details">
                <p>Fila: {{ $entrada['row'] }}</p>
                <p>Seient: {{ $entrada['seat'] }}</p>
            </div>
            <div class="qr-code">
                <p>Escaneja el codi QR per accedir a l'esdeveniment:</p>
                <img src="data:image/png;base64,{{ $entrada['qrCode'] }}" alt="Código QR">
            </div>
        </div>
    @endforeach
</body>
</html>
