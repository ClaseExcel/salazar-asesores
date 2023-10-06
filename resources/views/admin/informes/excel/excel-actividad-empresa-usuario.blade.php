<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <link rel="icon" href="{{ asset('img/logo_1.png') }}" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- Boostrap -->
    <link href="{{ asset('lib/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
    <!-- Jquery -->
    <script type="text/javascript" src="{{ asset('lib/jquery-3.6.1.min.js') }}"></script>
    <title>actividades empleado empresa</title>
    <!-- CSS -->
    <link rel="stylesheet" href="{{ asset('assets/css/actareintegro/acta.css') }}" />

</head>

<body>
    <table>
        <thead>
            <tr>
                <th style="background-color: #0900C3; color: #FFFFFF;  border: #080000 1px solid;  text-align: center; border: solid #080000 10px;">
                    Empresa</th>
                <th style="background-color: #0900C3; color: #FFFFFF;  border: #080000 1px solid;  text-align: center; border: solid #080000 10px;">
                    Tipo de actividad</th>
                <th
                    style="background-color: #0900C3; color: #FFFFFF;  border: #080000 1px solid;  text-align: center; border: solid #080000 10px; width:300px">
                    Cantidad</th>
                <th
                    style="background-color: #0900C3; color: #FFFFFF;  border: #080000 1px solid;  text-align: center; border: solid #080000 10px; width:300px">
                    Porcentaje</th>
            </tr>
        </thead>

        @php
        $cnt = 0;
         @endphp
        <tbody>
            @foreach ($cantidadActividades as $actividad)
            @php
            $cnt += $actividad['cantidad']
             @endphp
                <tr>
                    <td>{{ $actividad['empresa']}} </td>
                    <td>{{ $actividad['tipo_actividad']}} </td>
                    <td>{{ $actividad['cantidad'] }} </td>
                    <td>{{ $actividad['porcentaje'] }} </td>
                </tr>
            @endforeach
            <tr> 
                <td style="background-color: #0900C3; color: #FFFFFF;">Total Actividades</td>
                <td> {{ $cnt }} </td>
            </tr>
        </tbody>
    </table>

    <table>
        <thead>
            <tr>
                <th style="background-color: #0900C3; color: #FFFFFF;  border: #080000 1px solid;  text-align: center; border: solid #080000 10px;">
                    Empresa</th>
                <th style="background-color: #0900C3; color: #FFFFFF;  border: #080000 1px solid;  text-align: center; border: solid #080000 10px;">
                    Estado</th>
                <th
                    style="background-color: #0900C3; color: #FFFFFF;  border: #080000 1px solid;  text-align: center; border: solid #080000 10px; width:300px">
                    Cantidad</th>
                <th
                    style="background-color: #0900C3; color: #FFFFFF;  border: #080000 1px solid;  text-align: center; border: solid #080000 10px; width:300px">
                    Porcentaje</th>
            </tr>
        </thead>

        @php
        $cnt_estado = 0;
         @endphp
        <tbody>
            @foreach ($cantidadActividadesEstado as $actividad)
            @php
            $cnt_estado += $actividad['cantidad']
             @endphp
                <tr>
                    <td>{{ $actividad['empresa']}} </td>
                    <td>{{ $actividad['estado'] }} </td>
                    <td>{{ $actividad['cantidad'] }} </td>
                    <td>{{ $actividad['porcentaje'] }} </td>
                </tr>
            @endforeach
            <tr> 
                <td style="background-color: #0900C3; color: #FFFFFF;">Total Actividades</td>
                <td> {{ $cnt_estado }} </td>
            </tr>
        </tbody>
    </table>
</body>

</html>
<script src="{{ asset('lib/bootstrap/js/bootstrap.bundle.min.js') }}"></script>