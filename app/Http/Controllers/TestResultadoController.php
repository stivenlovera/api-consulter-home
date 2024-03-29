<?php

namespace App\Http\Controllers;

use DateTime;
use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Image;
//use App\Models\User;

class TestResultadoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }
    public function ejemplo(Request $request, $test_id, $postulante_id, $evaluacion_id)
    {
        $test = DB::table('test')
            ->select(
                'test.*'
            )
            ->where('test.test_id', $test_id)
            ->first();

        $test->completado = 'no';

        $preguntas = DB::table('pregunta')
            ->where('pregunta.test_id', $test->test_id)
            ->get();

        $procedimientos = DB::table('procedimiento')
            ->where('procedimiento.test_id', $test->test_id)
            ->get();

        foreach ($preguntas as $key => $pregunta) {
            $respuestas = DB::table('respuesta')
                ->where('respuesta.pregunta_id', $pregunta->pregunta_id)
                ->get();
            $pregunta->respuestas = $respuestas;
        }

        $test->activarTiempo = false;
        $test->tiempoTranscurrido = 0;

        $test->resultado_test_id = 0;
        //////////
        $test->preguntas = $preguntas;
        $test->pasos = $procedimientos;
        $test->resultado_test_id = 0;
        $test->fecha_inicio = 0;
        $test->fecha_sistema = date('Y-m-d H:i:s');
        return response()->json([
            'status' => 1,
            'message' => 'Test de ejemplo',
            'data' => $test,
        ], 200);
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request, $test_id, $postulante_id, $evaluacion_id)
    {
        $evaluacion = DB::table('postulante_evaluacion')
            ->where('postulante_id', $postulante_id)
            ->first();
        $test = DB::table('test_evaluacion')
            ->select(
                'test.*',
                'test_evaluacion_id'
            )
            ->join('test', 'test.test_id', 'test_evaluacion.test_id')
            ->where('test_evaluacion.test_id', $test_id)
            ->where('evaluacion_id', $evaluacion_id)
            ->first();

        $verificar_test = DB::table('resultado_test')
            ->where('resultado_test.test_evaluacion_id', $test->test_evaluacion_id)
            ->where('resultado_test.postulante_id', $request->user()->postulante_id)
            ->first();

        if ($verificar_test) {
            if ($verificar_test->estado == 0) {
                $test->completado = 'no';
            } else {
                $test->completado = 'si';
            }
        } else {
            $test->completado = 'no';
        }
        $preguntas = DB::table('pregunta')
            ->where('pregunta.test_id', $test->test_id)
            ->get();

        $procedimientos = DB::table('procedimiento')
            ->where('procedimiento.test_id', $test->test_id)
            ->get();

        foreach ($preguntas as $key => $pregunta) {
            $respuestas = DB::table('respuesta')
                ->where('respuesta.pregunta_id', $pregunta->pregunta_id)
                ->get();
            $pregunta->respuestas = $respuestas;
        }
        //validar si existe
        $resultado_test_id;
        if ($verificar_test) {
            $resultado_test_id = $verificar_test->resultado_test_id;
            $test->fecha_inicio = $verificar_test->fecha_inicio;
        } else {
            $creacionTetsResultado = DB::table('resultado_test')->insertGetId([
                'test_evaluacion_id' => $test->test_evaluacion_id,
                'fecha_inicio' => date('Y-m-d H:i:s'),
                'resultado_test.postulante_id' => $request->user()->postulante_id,
            ]);
            $resultado_test_id = $creacionTetsResultado;
            $test->fecha_inicio = date('Y-m-d H:i:s');
        }

        $test->preguntas = $preguntas;
        $test->pasos = $procedimientos;
        $test->resultado_test_id = $resultado_test_id;
        if ($test->tiempo_total == 0) {
            $test->activarTiempo = false;
            $test->tiempoTranscurrido = 0;
        } else {
            $test->activarTiempo = true;
            $tiempoTranscurrido = $this->TimeTrasncurridoToMinute($test->fecha_inicio);
            if ($tiempoTranscurrido > ($test->tiempo_total)) {
                $test->tiempoTranscurrido = 0;
            } else {
                $test->tiempoTranscurrido = ($test->tiempo_total) - $tiempoTranscurrido;
            }
        }
        //dd( $test);
        $test->fecha_sistema = date('Y-m-d H:i:s');
        return response()->json([
            'status' => 1,
            'message' => 'Test a resolver',
            'data' => $test,
        ], 200);
    }
    public function TimeTrasncurridoToMinute($fecha_inicio)
    {
        $date1 = new DateTime(date('Y-m-d H:i:s'));
        $date2 = new DateTime(date($fecha_inicio));
        $diff = $date1->diff($date2);
        $totalSegundo = $diff->s;
        $totalSegundo = ($diff->i * 60) + $totalSegundo;
        $totalSegundo = ($diff->h * 3600) + $totalSegundo;
        $totalSegundo = ($diff->d * 86400) + $totalSegundo;
        return $totalSegundo;
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $postulante_id =$request->user()->postulante_id;

        Log::info("TestResultadoController/store({$postulante_id},{$request->getContent()})");
        $resultadoTest = DB::table('resultado_test')
            ->where('resultado_test.resultado_test_id', $request->resultado_test_id)
            ->update([
                'resultado_test.postulante_id' => $request->user()->postulante_id,
                'estado' => 1,
            ]);

        foreach ($request->respuestaPreguntas as $key => $pregunta) {
            $resultadoPregunta = DB::table('resultado_pregunta')->insertGetId([
                'resultado_test_id' => $request->resultado_test_id,
                'pregunta_id' => $pregunta['pregunta_id'],
                'fecha_inicio' => $pregunta['fecha_inicio'],
                'tiempo_duracion' => $pregunta['tiempo_duracion'],
            ]);
            foreach ($pregunta['resultadoRespuestas'] as $key => $respuesta) {

                $imagenRespuesta = $this->validarImagen($request->test_id, $respuesta['descripcion'], 'resultado_respuesta');

                $resultadoRespuesta = DB::table('resultado_respuesta')->insertGetId([
                    'resultado_pregunta_id' => $resultadoPregunta,
                    'respuesta_id' => $respuesta['respuesta_id'],
                    'descripcion' => $imagenRespuesta,
                    'valor' => $respuesta['valor'] == null ? '' : $respuesta['valor'],
                ]);
            }
        }
        return response()->json([
            'status' => 1,
            'message' => 'Registrado correctamente',
            'data' => $request->all(),
        ], 200);

    }
    public function validarImagen($test_id, $descripcion, $carpeta)
    {
        $verificar = DB::table('test')
            ->where('test_id', $test_id)
            ->first();
        switch ($verificar->tipo_preguntas_id) {
            case 4:
                if ($descripcion != null && $descripcion != '') {
                    return $descripcion = $this->Base64toFile($descripcion, $carpeta);
                } else {
                    return "sin_imagen.jpg";
                }
            default:
                if ($descripcion == null) {
                    $descripcion = "";
                }
                return $descripcion;
                break;
        }
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
    public function FileToBase64($nameFile)
    {
        try {
            $path = public_path() . '/assets/cuestionario/' . $nameFile . '';
            $extencion = pathinfo($path, PATHINFO_EXTENSION);
            $image = base64_encode(file_get_contents($path));
            return "data:image/$extencion;base64, $image";
        } catch (\Throwable $th) {
            return "";
        }
    }
    public function Base64toFile($base64, $tipoDocumento)
    {
        $name = "image-$tipoDocumento-" . uniqid() . time() . ".jpg";
        $path = public_path() . '/assets/' . $tipoDocumento . '/' . $name;
        $imagen = Image::make(file_get_contents($base64))->setFileInfoFromPath($base64); //controlar peso de archivo
        $height = $imagen->height();
        $width = $imagen->width();
        $imagen->resize($width, $height)->orientate()->save($path);
        return $name;

    }
}
/* 
C:\laragon\www\api-consulter-home\public\assets\respuestas
http://localhost/api-consulter-home/public/assets/respuestas/image-respuestas-651b0ce04e5c11696271584.jpg
http://localhost/api-consulter-home/public/assets/respuestas/image-respuestas-651b0ce0e223f1696271584.jpg
http://localhost/api-consulter-home/public/assets/respuestas/image-respuestas-651b0ce183e071696271585.jpg
http://localhost/api-consulter-home/public/assets/respuestas/image-respuestas-651b0ce2219851696271586.jpg
http://localhost/api-consulter-home/public/assets/respuestas/image-respuestas-651b0ce2b378d1696271586.jpg


http://localhost/api-consulter-home/public/assets/respuestas/image-respuestas-651b0ce3c98c01696271587.jpg
http://localhost/api-consulter-home/public/assets/respuestas/image-respuestas-651b0ce4ac5401696271588.jpg
http://localhost/api-consulter-home/public/assets/respuestas/image-respuestas-651b0ce5915a81696271589.jpg
http://localhost/api-consulter-home/public/assets/respuestas/image-respuestas-651b0ce76d9361696271591.jpg
http://localhost/api-consulter-home/public/assets/respuestas/image-respuestas-651b0ce7edadd1696271591.jpg

*/