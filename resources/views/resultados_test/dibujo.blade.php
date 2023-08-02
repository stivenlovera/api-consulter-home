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
    </div>
    @forelse ($preguntas as $pregunta)
        <main>
            @forelse ($pregunta->respuestas as $i => $respuesta)
                <table style="width: 100%">
                    <tr>
                        <td>
                            <p><Strong>{{ $i + 1 }}. {{ $pregunta->pregunta_nombre }}</Strong></p>
                        </td>
                    </tr>
                    <tr>
                        <td width="40%" style="text-align: center; padding:10px; background: #fff;">
                            <img src='{{ public_path('assets/resultado_respuesta/' . $respuesta->resultados_respuesta->descripcion . '') }}'
                                style="display:block; width: 87%; height:auto">
                        </td>
                    </tr>
                </table>
            @empty
                <table style="width: 100%">
                    <tr>
                        <td width="40%" style="text-align: center; padding:10px; background: #fff;">
                            No hay respuestas registradas
                        </td>
                    </tr>
                </table>
            @endforelse
        </main>
    @empty
        <h4 style="text-align:center">No registrado</h4>
    @endforelse

</body>

</html>
