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
    <div style="display:flex; justify-content:center; margin-top:50px; align-items:center;">
        <img style="display: block; margin-left: auto; margin-right:auto;" src="https://firebasestorage.googleapis.com/v0/b/salazarasesores-d8362.appspot.com/o/logo_salazar.svg?alt=media&token=e0cbc7ce-ddc8-42ad-8f20-ddc298e11e2d" alt="" width="400px" height="120px">
    </div>

    @if ($estado_requerimiento == 3)
        <div class="content" style="text-align:center;">
            <h2 style="color:#0900C3;">Requerimiento {{ $consecutivo }}</h2>
            <p style="color:#616161;">Querido/a {{ $usuario_cliente }}, nos complace informarte que tu requerimiento con
                consecutivo {{ $consecutivo }} ha sido rechazado por el siguiente motivo:</p>
            <p>
                <b>{{ $observacion }}</b>
            </p>

            <p style="color:#616161;">
                Agradecemos tu colaboración y compromiso en este proceso hasta ahora. Esperamos seguir trabajando
                contigo para lograr nuestros objetivos mutuos.
            </p>
        </div><br>
    @else
        <div class="content" style="text-align:center;">
            <h2 style="color:#0900C3;">Requerimiento {{ $consecutivo }}</h2>
            @if ($estado_requerimiento == 4)
                <p style="color:#616161;">Querido/a {{ $usuario_cliente }}, nos complace informarte que tu requerimiento
                    con
                    consecutivo {{ $consecutivo }} se encuentra en <b>{{$estado}}</b>, a continuación obtendras
                    observaciones acerca del proceso de tu requerimiento:</p>
            @else
                <p style="color:#616161;">Querido/a {{ $usuario_cliente }}, nos complace informarte que tu requerimiento
                    con
                    consecutivo {{ $consecutivo }} ha sido <b>{{ $estado}}</b>, a continuación obtendras
                    observaciones acerca del proceso de tu requerimiento:</p>
            @endif

            <p>
                <b>{{ $observacion }}</b>
            </p>

            <p style="color:#616161;">
                Agradecemos tu colaboración y compromiso en este proceso hasta ahora. Esperamos seguir trabajando
                contigo para lograr nuestros objetivos mutuos.
            </p>
        </div><br>
    @endif

    <small style="display:flex; justify-content:center; margin-top:50px; align-items:center;">
        Este correo es exclusivamente informativo. <br>
        Saludos, Salzar Asesores
    </small>
</body>

</html>
