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
    <h2>Resultado Test {{ $test->nombreTest }}</h2>
    <div>
        <div>
            <p style="margin: 0"><strong>Nombres: </strong>{{ $test->nombre }} {{ $test->apellidos }}</p>
        </div>
        <div>
            <p style="margin: 0"><strong>Total: </strong> </p>
        </div>
        <div>
            <p style="margin: 0"><strong>Puesto: </strong> {{ $test->nombreCargo }}</p>
        </div>
        <div>
            <p style="margin: 0"><strong>Fecha de evaluacion: </strong>
                {{ date('d/m/Y H:m:s a', strtotime($test->resultados_test->fecha_inicio)) }}</p>
        </div>
        <table>
            <thead>
                <tr>
                    <th colspan="2" width="50" style="font-size: 15px;"></th>
                </tr>
            </thead>
            <tbody>
                @forelse ($preguntas as $i =>  $pregunta)
                    <tr>
                        <td class="desc">
                            <p><strong>{{ $i + 1 }}. {{ $pregunta->pregunta_nombre }}</Strong></p>
                        </td>
                        @forelse ($pregunta->respuestas as $key => $respuesta)
                            <td class="desc">
                                @if ($key > 0)
                                    <p style="padding-left: 15%;"><strong>
                                            {{ $respuesta->descripcion }}
                                        </strong></p>
                                    <p style="padding-left: 15%;"> {{ $respuesta->resultados_respuesta->descripcion }}
                                    </p>
                                @else
                                    <table>
                                        <tbody>
                                            <tr>
                                                <td  style="text-align: center;  border: 1px solid #000000; ">
                                                    
                                                </td>
                                                <td  style="text-align: center;  border: 1px solid #000000; ">

                                                </td>
                                                <td  style="text-align: center;  border: 1px solid #000000; ">

                                                </td>
                                            <tr>
                                                <td  style="text-align: center;  border: 1px solid #000000; ">

                                                </td>
                                                <td  style="text-align: center;  border: 1px solid #000000; ">

                                                </td>
                                                <td  style="text-align: center;  border: 1px solid #000000; ">

                                                </td>
                                            <tr>
                                                <td  style="text-align: center;  border: 1px solid #000000; ">

                                                </td>
                                                <td  style="text-align: center;  border: 1px solid #000000; ">

                                                </td>
                                                <td  style="text-align: center;  border: 1px solid #000000; ">

                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                @endif
                            </td>
                    </tr>
                @empty
                    <p>
                        <br>
                    </p>
                @endforelse
            @empty
                <tr>
                    <td colspan="4"></td>
                </tr>
                @endforelse
            </tbody>
        </table>

    </div>
</body>

</html>
