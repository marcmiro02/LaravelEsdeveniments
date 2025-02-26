<!-- resources/views/emails/ticket.blade.php -->

<!DOCTYPE html>
<html lang="ca">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Les teves entrades per a l'esdeveniment</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        p, h1 {
            color: white;
        }
        .blur {
            filter: blur(5px);
            transition: filter 0.3s ease;
            cursor: pointer;
        }
        .blur.clicked {
            filter: blur(0);
            cursor: default;
        }
    </style>
</head>
<body class="d-flex align-items-center justify-content-center" style="height: 65vh; background-color:#212529;">
    <div class="container text-center">
        <div class="row">
            <div class="col-md-8 offset-md-2 mt-100">
                <h1 class="mt-5">Les teves entrades per a l'esdeveniment</h1>
                <p>Gràcies per la teva compra. Aquí tens les teves entrades per a l'esdeveniment: <strong class="blur" onclick="this.classList.add('clicked')">{{ $entrades[0]['eventName'] }}</strong>.</p>
                <p><strong>DETALLS ESDEVENIMENT:</strong></p>
                <ul>
                    <li class="blur" onclick="this.classList.add('clicked')">Data: {{ $entrades[0]['eventDate'] }}</li>
                </ul>
                <p>Adjuntem les entrades en format PDF.</p>
                <p>Disfruta! Ens veiem fotent-li canya!</p>
            </div>
        </div>
    </div>
</body>
</html>