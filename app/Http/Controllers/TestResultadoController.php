<?php

namespace App\Http\Controllers;

use DB;
use Illuminate\Http\Request;
use Image;

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

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request, $test_id, $postulante_id)
    {
        $evaluacion = DB::table('postulante_evaluacion')
            ->where('postulante_id', $postulante_id)
            ->first();
        $test = DB::table('test_evaluacion')
            ->select(
                'test.*'
            )
            ->join('test', 'test.test_id', 'test_evaluacion.test_id')
            ->where('test_evaluacion.test_id', $test_id)
            ->where('evaluacion_id', $evaluacion->evaluacion_id)
            ->first();
        $verificar_test = DB::table('resultado_test')
            ->where('resultado_test.test_id', $test->test_id)
            ->where('resultado_test.postulante_id', $request->user()->postulante_id)
            ->first();
        /* return response()->json([
        'status' => 1,
        'message' => 'Lista de test disponibles',
        'data' => $postulante_id,
        ], 200); */
        if ($verificar_test) {
            $test->completado = 'si';
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
        $test->preguntas = $preguntas;
        $test->pasos = $procedimientos;

        return response()->json([
            'status' => 1,
            'message' => 'Lista de test disponibles',
            'data' => $test,
        ], 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        /* return response()->json([
            'data' => $request->all(),
        ]); */
        $resultadoTest = DB::table('resultado_test')->insertGetId([
            'test_id' => $request->test_id,
            'fecha_inicio' => $request->fecha_inicio,
            'resultado_test.postulante_id' => $request->user()->postulante_id,
        ]);
        foreach ($request->respuestaPreguntas as $key => $pregunta) {
            $resultadoPregunta = DB::table('resultado_pregunta')->insertGetId([
                'resultado_test_id' => $resultadoTest,
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
                    'valor' => $respuesta['valor'],
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
