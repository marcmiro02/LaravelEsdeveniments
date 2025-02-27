<!-- resources/views/emails/ticket.blade.php -->
<!DOCTYPE html>
<html lang="ca">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Les teves entrades per a l'esdeveniment</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            color: #333;
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 600px;
            margin: 20px auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .header {
            text-align: center;
            padding-bottom: 20px;
            border-bottom: 1px solid #ddd;
        }

        .header h1 {
            color: #e53e3e;
        }

        .content {
            padding: 20px 0;
        }

        .content p {
            margin: 0 0 10px;
        }

        .content ul {
            list-style: none;
            padding: 0;
        }

        .content ul li {
            margin: 0 0 5px;
        }

        .footer {
            text-align: center;
            padding-top: 20px;
            border-top: 1px solid #ddd;
            font-size: 12px;
            color: #777;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="header">
            <h1>Les teves entrades per a l'esdeveniment</h1>
        </div>
        <div class="content">
            <p>Gràcies per la teva compra. Aquí tens les teves entrades per a l'esdeveniment:
                <strong>{{ $entradas[0]['eventName'] }}</strong>.</p>

            <p><strong>DETALLS ESDEVENIMENT:</strong></p>
            <ul>
                <li>Data: {{ $entradas[0]['eventDate'] }}</li>
            </ul>

            <p>Adjuntem les entrades en format PDF.</p>

            <p>Disfruta! Ens veiem fotent-li canya!</p>
        </div>
        <div class="footer">
            <p class="text-sm">&copy; {{ date('Y') }} DAM EVENTS (Aleix P - Marc M - Marc S). All rights reserved.
            </p>
        </div>
    </div>
</body>

</html>