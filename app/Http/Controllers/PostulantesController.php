<?php

namespace App\Http\Controllers;

use DB;
use Illuminate\Http\Request;

class postulantesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $listapostulantes = DB::table('postulante')->select(
            'postulante.*',
            DB::raw("DATE_FORMAT(postulante.fecha_nacimiento,'%Y-%m-%d') AS fecha_nacimiento")
        )->get();
        return response()->json([
            'status' => 1,
            'message' => 'prueba',
            'data' => [
                'postulantes' => $listapostulantes,
            ],
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
        try {
            $insertPostulante = DB::table('postulante')->insertGetId([
                'ci' => $request->ci,
                'nombre' => $request->nombre,
                'apellidos' => $request->apellidos,
                'dirrecion' => $request->dirrecion,
                'fecha_nacimiento' => date("Y-m-d", strtotime($request->fecha_nacimiento)),
                'telefono' => $request->telefono,
                'email' => $request->email,
            ]);
            return response()->json([
                'status' => 1,
                'message' => 'Registrado correctamente',
                'data' => null,
            ], 200);

            //enlace inicial
            $insert = DB::table('enlace')->insert([
                'codigo' => 'millaveprivada',
                'estado' => 1,
                'fecha_inicio' => '2023-04-22',
                'fecha_fin' => '2023-04-26',
                'postulante_id' => $insertPostulante,
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => 0,
                'message' => 'Ha ocurrido un error',
                'data' => null,
            ], 200);
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
        $postulante = DB::table('postulante')->where('postulante_id', $id)->first();
        return response()->json([
            'status' => 1,
            'message' => 'Mostrar una postulante',
            'data' => [
                'postulante' => $postulante,
            ],
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
        $postulante = DB::table('postulante')->where('postulante_id', $id)->update([
            'ci' => $request->ci,
            'nombre' => $request->nombre,
            'apellidos' => $request->apellidos,
            'dirrecion' => $request->dirrecion,
            'fecha_nacimiento' => $request->fecha_nacimiento,
            'telefono' => $request->telefono,
            'email' => $request->email,
        ]);
        return response()->json([
            'status' => 1,
            'message' => 'Modificado correctamente',
            'data' => $postulante,
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
        $postulante = DB::table('postulante')->where('postulante_id', $id)->delete();
        return response()->json([
            'status' => 1,
            'message' => 'Eliminado correctamente',
            'data' => $postulante,
        ], 200);
    }
}
