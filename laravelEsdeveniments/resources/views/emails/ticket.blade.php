<!-- resources/views/emails/ticket.blade.php -->

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tus entradas para el evento</title>
</head>
<body>
    <p>Gracias por tu compra. Aquí tienes tus entradas para el evento <strong>{{ $entradas[0]['eventName'] }}</strong>.</p>
    
    <p><strong>Detalles del evento:</strong></p>
    <ul>
        <li>Fecha: {{ $entradas[0]['eventDate'] }}</li>
        <li>Hora: {{ $entradas[0]['eventTime'] }}</li>
    </ul>

    <p>Adjuntamos tu entrada en formato PDF.</p>

    <p>¡Gracias por asistir! Nos vemos en el evento.</p>
</body>
</html>
