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
        /* Configuración de la página */
        @page {
            size: 65mm 115mm; /* Tamaño más pequeño adecuado para tickets */
            margin: 0; /* Sin márgenes para aprovechar todo el espacio */
        }
        .container {
            width: 100%; /* Usamos todo el ancho de la página */
            height: auto; /* Altura automática según el contenido */
            max-height: 114mm; /* Máxima altura de la página */
            background-color: #fff;
            padding: 5px; /* Reducimos el padding para maximizar el espacio */
            border-radius: 8px;
            box-shadow: 0 0 5px rgba(0, 0, 0, 0.1);
            text-align: center;
            box-sizing: border-box; /* Aseguramos que el padding no afecte el tamaño */
            page-break-inside: avoid; /* Evita que se divida el contenido entre páginas */
            border: none; /* Eliminamos el borde */
        }
        /* Aplicamos el salto de página solo a partir del segundo contenedor */
        .container + .container {
            page-break-before: always;
        }
        /* Estilos específicos para los elementos */
        .title-bar {
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 5px;
        }
        .title-bar img {
            width: 30px; /* Reducimos el tamaño del logo */
            height: auto;
        }
        .empresa-logo {
            text-align: center;
            margin-bottom: 5px;
        }
        .empresa-logo img {
            width: 55px; /* Ajustamos el tamaño del logo de la empresa */
            height: auto;
            max-width: 70px;
        }
        .header {
            text-align: center;
            margin-bottom: 5px;
        }
        .header h1 {
            margin: 0;
            font-size: 12px; /* Aumentamos un poco el tamaño del texto */
            color: #333;
            text-transform: uppercase;
            letter-spacing: 1px;
            font-weight: bold; /* Ponemos en negrita */
        }
        .event-logo {
            text-align: center;
            margin-bottom: 5px;
        }
        .event-logo img {
            width: 75px; /* Ajustamos el tamaño de la imagen */
            height: auto;
            max-width: 95px;
            border-radius: 10px;
        }
        .event-details {
            text-align: center;
            margin-bottom: 5px;
        }
        .event-details p {
            margin: 2px 0;
            font-size: 9px; /* Mantenemos el tamaño del texto */
            color: #666;
            font-weight: bold; /* Ponemos en negrita */
        }
        .ticket-details {
            text-align: center;
            margin-bottom: 5px;
            border-top: none; /* Eliminamos el borde superior */
            padding-top: 0;
        }
        .ticket-details p {
            margin: 2px 0;
            font-size: 9px; /* Mantenemos el tamaño del texto */
            color: #666;
            font-weight: bold; /* Ponemos en negrita */
        }
        .qr-code {
            text-align: center;
            margin-top: 10px; /* Ajustamos el margen superior */
        }
        .qr-code p {
            font-size: 9px; /* Igualamos el tamaño del texto con los demás */
            margin: 2px 0;
            font-weight: bold; /* Ponemos en negrita */
        }
        .qr-code img {
            width: 120px; /* Aumentamos significativamente el tamaño del QR */
            height: 120px;
            border: 1px solid #ddd;
            padding: 5px;
            border-radius: 10px;
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
                <p>{{ $entrada['eventDate'] }}</p>
            </div>
            @if(session('id_tipus_sala') != 2)
                <div class="ticket-details">
                    <p>Fila: {{ $entrada['row'] }}</p>
                    <p>Seient: {{ $entrada['seat'] }}</p>
                </div>
            @endif
            <div class="qr-code">
                <p>Escaneja el codi QR:</p>
                <img src="data:image/png;base64,{{ $entrada['qrCode'] }}" alt="Código QR">
            </div>
        </div>
    @endforeach
</body>
</html>