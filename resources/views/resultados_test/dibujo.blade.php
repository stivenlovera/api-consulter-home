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
    <div>
        <h2>Resultado Test {{ $resultado_test->nombreTest }}</h2>
    
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
    </div>
    <hr>
    @forelse ($resultado_test->preguntas as $i => $pregunta)
        <main>
            <table>
                <tbody>
                    <tr>
                        <td class="desc">
                            <p><Strong>{{ $i + 1 }}. {{ $pregunta->pregunta_nombre }}</Strong></p>
                        </td>
                    </tr>
                    @forelse ($pregunta->respuestas as $key => $respuesta)
                        <tr>
                            <td style="text-align: center; padding:10px; background: #fff;">
                                <img src='{{ public_path('assets/resultado_respuesta/' . $respuesta->descripcion . '') }}'
                                    style="display:block; width: 70%; height:auto">
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td width="40%" style="text-align: center; padding:10px; background: #fff;">
                                No hay respuestas registradas
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </main>
    @empty
        <main>
            <table>
                <tbody>
                    <tr>
                        <td class="desc">
                            <p><Strong>No registrado</Strong></p>
                        </td>
                    </tr>
                </tbody>
            </table>
        </main>
    @endforelse

</body>

</html>
