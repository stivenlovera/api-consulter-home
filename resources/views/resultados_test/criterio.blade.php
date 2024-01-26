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
                    <th></th>
                    <th width="50"  style="font-size: 15px;">0</th>
                    <th width="50"  style="font-size: 15px;">1</th>
                    <th width="50"  style="font-size: 15px;">2</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($resultado_test->preguntas as $i =>  $pregunta)
                    <tr>
                        <td class="desc">
                            <p><Strong>{{ $i + 1 }}. {{ $pregunta->pregunta_nombre }}</Strong></p>
                            @forelse ($pregunta->respuestas as $key => $respuesta)
                                <p> {{ $respuesta->descripcion }}</p>
                            @empty
                                <p>
                                    <br>
                                </p>
                            @endforelse
                        </td>
                        <td class="desc" style="  border: 1px solid #000000; "></td>
                        <td class="desc" style="  border: 1px solid #000000; "></td>
                        <td class="desc" style="  border: 1px solid #000000; "></td>
                    </tr>
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
