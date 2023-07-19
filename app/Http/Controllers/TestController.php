<?php

namespace App\Http\Controllers;

use DB;
use Illuminate\Http\Request;
use Image;

class TestController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $lista = DB::table('test')->get();
        return response()->json([
            'status' => 1,
            'message' => 'Lista actualizadas',
            'data' => $lista,
        ], 200);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $test_insert = DB::table('test')->insertGetId([
            'nombreTest' => $request->nombreTest,
            'descripcion_test' => $request->descripcion_test,
            'tiempo_total' => $request->tiempo_total,
            'procedimiento' => $request->procedimiento,
            'tipo_preguntas_id' => $request->tipo_preguntas_id,
        ]);
        foreach ($request->preguntas as $key => $pregunta) {
            $imagenPregunta = $this->validarImagen($test_insert, $pregunta['imagen'], 'preguntas');
            $pregunta_insert = DB::table('pregunta')->insertGetId([
                'pregunta_nombre' => $pregunta['pregunta_nombre'],
                'tiempo_total' => $pregunta['tiempo_total'],
                'imagen' => $imagenPregunta,
                'test_id' => $test_insert,
            ]);
            foreach ($pregunta['respuestas'] as $key => $respuesta) {
                $imagenRespuesta = $this->validarImagen($test_insert, $respuesta['imagen'], 'respuestas');
                $respuesta_insert = DB::table('respuesta')->insertGetId([
                    'descripcion' => $respuesta['descripcion'],
                    'imagen' => $imagenRespuesta,
                    'pregunta_id' => $pregunta_insert,
                    'procesar' => 'si',
                    'valor' => '1',
                ]);
            }
        }
        foreach ($request->pasos as $key => $paso) {
            $imagenPasos = $this->validarImagenPasos($paso['imagen'], 'pasos');
            $pasos = DB::table('procedimiento')->insertGetId([
                'descripcion' => $paso['descripcion'],
                'imagen' => $imagenPasos,
                'test_id' => $test_insert,
            ]);
        }

        return response()->json([
            'status' => 1,
            'message' => 'Registrado correctamente',
            'data' => null,
        ], 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $test = DB::table('test')->where('test_id', $id)->first();
        $preguntas = DB::table('pregunta')->where('test_id', $test->test_id)->get();
        foreach ($preguntas as $key => $pregunta) {
            $respuesta = DB::table('respuesta')->where('pregunta_id', $pregunta->pregunta_id)->get();
            $pregunta->respuestas = $respuesta;
        }
        $test->preguntas = $preguntas;
        return response()->json([
            'status' => 1,
            'message' => 'Registrado correctamente',
            'data' => $test,
        ], 200);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $test = DB::table('test')->where('test_id', $id)->first();
        $preguntas = DB::table('pregunta')->where('test_id', $test->test_id)->get();
        foreach ($preguntas as $key => $pregunta) {
            $respuesta = DB::table('respuesta')->where('pregunta_id', $pregunta->pregunta_id)->get();
            $pregunta->respuestas = $respuesta;
        }
        $test->preguntas = $preguntas;
        return response()->json([
            'status' => 1,
            'message' => 'Registrado correctamente',
            'data' => $test,
        ], 200);
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
        $test_update = DB::table('test')
            ->where('test_id', $id)
            ->update([
                'nombreTest' => $request->nombreTest,
                'descripcion_test' => $request->descripcion_test,
                'tiempo_respuesta' => $request->tiempo_respuesta,
                'ver_separado' => '0',
            ]);
        $preguntas = DB::table('pregunta')->where('test_id', $id)->get();
        foreach ($preguntas as $key => $pregunta) {
            $pregunta_delete = DB::table('pregunta')
                ->where('pregunta_id', $pregunta->pregunta_id)
                ->delete();
            $respuesta_delete = DB::table('respuesta')
                ->where('pregunta_id', $pregunta->pregunta_id)
                ->delete();
        }

        return response()->json([
            'status' => 1,
            'message' => 'Modificado correctamente',
            'data' => null,
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $deleteTest = DB::table('test')
            ->where('test_id', $id)
            ->delete();
        $preguntas = DB::table('pregunta')
            ->where('test_id', $id)
            ->get();
        foreach ($preguntas as $key => $pregunta) {

            $preguntas = DB::table('respuesta')
                ->where('pregunta_id', $pregunta->pregunta_id)
                ->delete();
        }
        $preguntas = DB::table('pregunta')
            ->where('test_id', $id)
            ->delete();

        return response()->json([
            'status' => 1,
            'message' => 'Eliminado correctamente',
            'data' => null,
        ], 200);
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
    public function validarImagen($test_id, $descripcion, $carpeta)
    {
        $verificar = DB::table('test')
            ->where('test_id', $test_id)
            ->first();
        if ($verificar->tipo_preguntas_id == 4 && $descripcion != null && $descripcion != '') {
            return $descripcion = $this->Base64toFile($descripcion, $carpeta);
        } else {
            return '';
        }
    }
    public function validarImagenPasos($descripcion, $carpeta)
    {
        if ($descripcion != null && $descripcion != '') {
            return $descripcion = $this->Base64toFile($descripcion, $carpeta);
        } else {
            return '';
        }
    }
}
