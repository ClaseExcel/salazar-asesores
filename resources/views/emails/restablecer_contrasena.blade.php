<!doctype html>
<html>

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat" rel="stylesheet">

    <style>
        body {
            font-family: 'Montserrat', sans-serif !important;
        }

        .button {
            padding: 0.7em 2em;
            font-size: 16px;
            background: #222222;
            color: #fff;
            cursor: pointer;
            text-decoration: none;
            border-radius: 50px;
        }
    </style>
</head>

<body>
    <div style="display:flex; justify-content:center;">
        <img src="https://firebasestorage.googleapis.com/v0/b/estrategia-contributo.appspot.com/o/Logo_1.png?alt=media&token=74b384f8-020c-4416-bf04-5a401679cf86" alt="" width="400px" height="120px">
    </div>

    <div class="content" style="text-align:center;">
        <h2 style="color:#0900C3;">Bienvenido a Estrategia Contributo!</h2>
        <p style="color:#616161;">Te notificamos que ha sido creada tu cuenta en nuestro sitio web con las siguientes
            credenciales:</p>
        <p>
            <b>Correo eléctronico:</b> {{ $email }}
        </p>
        <p>
            <b>Contraseña:</b> {{ $password }}
        </p>
    </div><br>

    <p style="text-align:center;"> Te invitamos a que restablezcas tu contraseña en el siguiente link: </p>

    <div style="display:flex; justify-content:center;">
        <a class='button' href="{{ route('password.reset', ['token' => $token]) }}">Reestablece tu contraseña aquí</a>
    </div>

    <br><br>

    <small>
        Este correo es exclusivamente informativo. <br>
        Saludos, Estrategia Contributo
    </small>
</body>

</html>
