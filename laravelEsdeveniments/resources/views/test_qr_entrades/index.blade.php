<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Generar Entrada</title>
</head>
<body>
    <h1>Generar Entrada para un Evento</h1>

    <!-- Cambiar la acción del formulario para que apunte a la ruta correcta -->
    <form action="{{ route('test_qr_entrades.index') }}" method="GET">
        <button type="submit">Generar y Ver Entrada</button>
    </form>
</body>
</html>
