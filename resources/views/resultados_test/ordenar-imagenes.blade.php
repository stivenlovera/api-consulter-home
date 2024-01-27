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
                    
                </tr>
            </thead>
            <tbody>
                @forelse ($resultado_test->preguntas as $i =>  $pregunta)
                    <tr>
                        <td class="desc" colspan="{{ count($pregunta->respuestas) }}">
                            <p><strong>{{ $i + 1 }}. {{ $pregunta->pregunta_nombre }}</Strong></p>
                        </td>
                    </tr>
                    <tr>
                        @forelse ($pregunta->respuestas as $key => $respuesta)
                            <td class="desc">
                                <img src='{{ public_path('assets/respuestas/' . $respuesta->imagen . '') }}'
                                    style="display:block; width: 70%; height:auto border-color: #1976d2; border-style: solid;">
                            </td>
                        @empty
                        @endforelse
                    </tr>
                    <tr>
                        <td class="desc" colspan="{{ count($pregunta->respuestas)  }}">
                            Orden :
                            @forelse ($pregunta->respuestas as $key => $respuesta)
                                {{ $respuesta->descripcion }}
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
