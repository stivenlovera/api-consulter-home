<?php

namespace App\Http\Controllers;

use DB;
use Illuminate\Http\Request;
use Image;

class PreguntaController extends Controller
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
        $plantilla_insert = DB::table('plantilla')->insertGetId([
            'plantilla_nombre' => $request->plantilla_nombre,
            'plantilla_descripcion' => $request->plantilla_descripcion,
            'tiempo_respuesta' => $request->tiempo_respuesta,
            'ver_separado' => '0',
        ]);
        foreach ($request->preguntas as $key => $pregunta) {
            $pregunta_insert = DB::table('pregunta')->insertGetId([
                'pregunta_nombre' => $pregunta['pregunta_nombre'],
                'tipo_pregunta_id' => $pregunta['tipo_pregunta_id'],
                'pregunta_descripcion' => "",
                'plantilla_id' => $plantilla_insert,
            ]);
            foreach ($pregunta['respuestas'] as $key => $respuesta) {
                $respuesta_insert = DB::table('respuesta')->insertGetId([
                    'respuesta_fija' => $respuesta['respuesta_fija'] == null ? '' : $respuesta['respuesta_fija'],
                    'recurso' => $respuesta['recurso'] == null ? '' : $respuesta['recurso'],
                    'pregunta_id' => $pregunta_insert,
                ]);
            }
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
    public function Base64toFile($base64, $id)
    {
        $name = "image-$id-" . uniqid() . time() . ".jpg";
        $path = public_path() . '/assets/cuestionario/' . $name;
        $imagen = Image::make(file_get_contents($base64)); //controlar peso de archivo
        $height = $imagen->height() / 4;
        $width = $imagen->width() / 4;
        $imagen->resize($width, $height)->save($path);
        return $name;

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
}
