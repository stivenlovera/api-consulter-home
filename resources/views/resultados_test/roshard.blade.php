<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>document</title>
    <link rel="stylesheet" href="{{ public_path('css/invoice-pdf.css') }}" media="all" />
</head>
<style>
    p {
        font-size: 15px;
    }

    h2 {
        font-size: 25px;
    }
</style>

<body>
    <x-pdf.header />
    <x-pdf.footer />
    <h2>Resultado Test {{ $resultado_test->nombreTest }}</h2>
    <div>
        <div>
            <p style="margin: 0"><strong>Nombres: </strong>{{ $postulante->nombre }} {{ $postulante->apellidos }}</p>
        </div>
        <div>
            <p style="margin: 0"><strong>Total: </strong> </p>
        </div>
        <div>
            <p style="margin: 0"><strong>Puesto: </strong> {{ $postulante->nombreCargo }}</p>
        </div>
        <div>
            <p style="margin: 0"><strong>Fecha de evaluacion: </strong>
                {{ date('d/m/Y H:m:s a', strtotime($resultado_test->fecha_inicio)) }}</p>
        </div>
        <table>
            <thead>
                <tr>
                    <th colspan="3" width="50" style="font-size: 15px;"></th>
                </tr>
            </thead>
            <tbody>
                @forelse ($resultado_test->preguntas as $i =>  $pregunta)
                    <tr>
                        <td class="desc" colspan="3">
                            <p><strong>{{ $i + 1 }}. {{ $pregunta->pregunta_nombre }}</Strong></p>
                        </td>
                    </tr>
                    <tr>
                        @forelse ($pregunta->respuestas as $key => $respuesta)
                            @if ($key == 0)
                                <td class="desc">
                                    <p><strong>
                                            Que es lo que ve?
                                        </strong></p>
                                    <p>
                                        {{ $respuesta->valor }}
                                        {{ $i == 1 ? 'SDASDASDASD ASDASDA ASDASD ASDA SASDASDA ASDASDA S' : '' }}
                                    </p>
                                </td>
                            @endif
                            @if ($key == 2)
                                <td class="desc">
                                    <p><strong>
                                            Donde lo ve?
                                        </strong></p>
                                    <p>
                                        {{ $respuesta->valor }}
                                    </p>
                                </td>
                            @endif
                            @if ($key == 1)
                                <td class="desc">
                                    <table>
                                        <tbody>
                                            @php
                                                $count = 0;
                                                $posiciones = explode(',', $respuesta->descripcion);
                                            @endphp
                                            @for ($i = 1; $i <= 3; $i++)
                                                <tr>
                                                    @for ($j = 1; $j <= 3; $j++)
                                                        {{ $count++ }}
                                                        @if (!empty($posiciones[$count - 1]))
                                                            <td
                                                                style="text-align: center;  border: 1px solid #000000; ">
                                                                X
                                                            </td>
                                                        @else
                                                            <td
                                                                style="text-align: center; height: 8px; width: 8px;border: 1px solid #000000;">
                                                            </td>
                                                        @endif
                                                    @endfor
                                                </tr>
                                            @endfor
                                        </tbody>
                                    </table>
                                </td>
                            @endif
                        @empty
                        @endforelse
                    </tr>
                @empty
                    <tr>
                        <td colspan="2"></td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</body>

</html>
