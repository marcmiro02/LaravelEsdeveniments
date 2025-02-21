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
            width: 170px;
            background-color: #fff;
            padding: 10px;
            border-radius: 8px;
            box-shadow: 0 0 5px rgba(0, 0, 0, 0.1);
            border: 1px solid #333;
            margin-left: -10px;
            margin-top: -25px;
            text-align: center;
        }
        .title-bar {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 10px;
            padding-bottom: 10px;
        }
        .title-bar img {
            width: 40px;
            height: auto;
        }
        .title-bar h2 {
            margin: 0;
            font-size: 14px;
            color: #333;
            flex-grow: 1;
            text-align: center;
        }
        .header {
            text-align: center;
            margin-bottom: 10px;
        }
        .header h1 {
            margin: 0;
            font-size: 12px;
            color: #333;
            text-transform: uppercase;
            letter-spacing: 1px;
        }
        .event-logo {
            text-align: center;
            margin-bottom: 10px;
        }
        .event-logo img {
            width: 100%;
            height: auto;
            max-width: 80px;
            border-radius: 10px;
        }
        .event-details {
            text-align: center;
            margin-bottom: 10px;
        }
        .event-details h2 {
            margin: 0;
            font-size: 12px;
            color: #555;
        }
        .event-details p {
            margin: 5px 0;
            font-size: 12px;
            color: #666;
        }
        .ticket-details {
            text-align: center;
            margin-bottom: 10px;
            border-top: 2px solid #333;
            padding-top: 10px;
        }
        .ticket-details p {
            margin: 5px 0;
            font-size: 12px;
            color: #666;
        }
        .qr-code {
            text-align: center;
            margin-top: 10px;
        }
        .qr-code img {
            width: 60px;
            height: 60px;
            border: 1px solid #ddd;
            padding: 5px;
            border-radius: 10px;
        }
        .empresa-logo {
            text-align: center;
            margin-bottom: 10px;
        }
        .empresa-logo img {
            width: 100%;
            height: auto;
            max-width: 60px;
        }
    </style>
</head>
<body>
    @foreach ($entradas as $entrada)
        <div class="container">
            <div class="title-bar">
                <img src="{{ public_path('img/Logos/Clar.png') }}" alt="Logo">
            </div>
            <div class="empresa-logo">
                <img src="data:image/jpeg;base64,{{ $entrada['empresaLogo'] }}" alt="Event Logo">
            </div>
            <div class="header">
                <h1>{{ $entrada['eventName'] }}</h1>
            </div>
            <div class="event-logo">
                <img src="data:image/jpeg;base64,{{ $entrada['eventPhoto'] }}" alt="Event Logo">
            </div>
            <div class="event-details">
                <p>Data: {{ $entrada['eventDate'] }}</p>
                <p>Hora: {{ $entrada['eventTime'] }}</p>
            </div>
            <div class="ticket-details">
                <p>Fila: {{ $entrada['row'] }}</p>
                <p>Seient: {{ $entrada['seat'] }}</p>
            </div>
            <div class="qr-code">
                <p>Escaneja el codi QR:</p>
                <img src="data:image/png;base64,{{ $entrada['qrCode'] }}" alt="Código QR">
            </div>
        </div>
    @endforeach
</body>
</html>