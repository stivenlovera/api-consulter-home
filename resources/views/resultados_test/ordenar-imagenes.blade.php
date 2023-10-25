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
                    <th colspan="1" width="50" style="font-size: 15px;"></th>
                </tr>
            </thead>
            <tbody>
                @forelse ($preguntas as $i =>  $pregunta)
                    <tr>
                        <td class="desc">
                            <p><strong>{{ $i + 1 }}. {{ $pregunta->pregunta_nombre }}</Strong></p>
                        </td>
                    </tr>
                    <tr>
                        {{-- {{dd('')}} --}}
                        <td class="desc">
                            Orden : 
                            @forelse ($pregunta->respuestas as $key => $respuesta)
                               {{ $respuesta->resultados_respuesta->descripcion }}
                            @empty
                            @endforelse
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="1"></td>
                    </tr>
                @endforelse
            </tbody>
        </table>

    </div>
</body>

</html>
