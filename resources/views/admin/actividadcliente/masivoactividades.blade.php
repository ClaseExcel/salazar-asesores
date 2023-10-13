<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <link rel="icon" href="{{ asset('assets/images/logo.png') }}" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    {{-- <!-- Boostrap -->
    <link href="{{ asset('lib/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet"> --}}
    {{-- <!-- Jquery -->
    <script type="text/javascript" src="{{ asset('lib/jquery-3.6.1.min.js') }}"></script> --}}
    <title>Masivo Actividades</title>

</head>
<body>
    <table>
        <thead>
            <tr>  
                <th style="background-color: #3f83f8; color: #FFFFFF;  border: #080000 1px solid;  text-align: center; border: solid #080000 10px;">Nombre</th>
                <th style="background-color: #3f83f8; color: #FFFFFF;  border: #080000 1px solid;  text-align: center; border: solid #080000 10px;">Tipo actividad</th>  
                <th style="background-color: #3f83f8; color: #FFFFFF;  border: #080000 1px solid;  text-align: center; border: solid #080000 10px;">Progreso</th>   
                <th style="background-color: #3f83f8; color: #FFFFFF;  border: #080000 1px solid;  text-align: center; border: solid #080000 10px;">Prioridad alta</th> 
                <th style="background-color: #3f83f8; color: #FFFFFF;  border: #080000 1px solid;  text-align: center; border: solid #080000 10px;">Fecha vencimiento</th>
                <th style="background-color: #3f83f8; color: #FFFFFF;  border: #080000 1px solid;  text-align: center; border: solid #080000 10px;">Periodicidad</th>
                <th style="background-color: #3f83f8; color: #FFFFFF;  border: #080000 1px solid;  text-align: center; border: solid #080000 10px;">Cantidad recordatorios</th>
                <th style="background-color: #3f83f8; color: #FFFFFF;  border: #080000 1px solid;  text-align: center; border: solid #080000 10px;">Cantidad dias entre recordatorios</th>
                <th style="background-color: #3f83f8; color: #FFFFFF;  border: #080000 1px solid;  text-align: center; border: solid #080000 10px;">Observación</th>
                <th style="background-color: #3f83f8; color: #FFFFFF;  border: #080000 1px solid;  text-align: center; border: solid #080000 10px;">Responsable Actividad</th>
                <th style="background-color: #3f83f8; color: #FFFFFF;  border: #080000 1px solid;  text-align: center; border: solid #080000 10px;">Empresa</th>
                <th style="background-color: #3f83f8; color: #FFFFFF;  border: #080000 1px solid;  text-align: center; border: solid #080000 10px;">Responsable</th>
                <th style="background-color: #3f83f8; color: #FFFFFF;  border: #080000 1px solid;  text-align: center; border: solid #080000 10px;">Cliente</th>
            </tr>
        </thead>
        <tbody>
                <tr>    
                    <td></td> 
                    <td>
                        <select>
                            @foreach ($actividades as $id => $nombre)
                                <option value="{{ $id }}">{{ $nombre }}</option>
                            @endforeach
                        </select>
                    </td>
                    {{-- <td>{{ $limite->nivel_de_transito}} </td>   
                    <td>{{ $limite->art }} </td>                                
                    <td>{{ $limite->tipo_material}} </td>
                    <td>{{ $limite->id_formato}} </td>
                    <td>{{ $limite->nombre_del_ensayo}} </td>
                    <td>{{ $limite->capa}} </td>
                    <td>{{ $limite->condicion}} </td>
                    <td>{{ $limite->id_medicion}} </td>
                    <td>{{ $limite->descripcion_de_la_medicion}} </td>
                    <td>{{ $limite->tamiz_mm}} </td>
                    <td>{{ $limite->tamiz_astm}} </td>
                    <td>{{ $limite->rango_inferior }} </td>
                    <td>{{ $limite->rango_superior }} </td>
                    <td>{{ $limite->porcentaje_tolerancia}} </td> --}}
                </tr>               
        </tbody>
    </table>
</body>
</html>