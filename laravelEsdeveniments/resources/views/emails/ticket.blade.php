<!-- resources/views/emails/ticket.blade.php -->

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tus entradas para el evento</title>
</head>
<body>
    <p>Gràcies per la teva compra. Aquí tens les teves entrades per a l'esdeveniment:  <strong>{{ $entradas[0]['eventName'] }}</strong>.</p>
    
    <p><strong>DETALLS ESDEVENIMENT:</strong></p>
    <ul>
        <li>Fecha: {{ $entradas[0]['eventDate'] }}</li>
        <li>Hora: {{ $entradas[0]['eventTime'] }}</li>
    </ul>

    <p>Adjuntem les entrades en format PDF.</p>

    <p>Disfruta! Ens veiem fotent-li canya!</p>
</body>
</html>
