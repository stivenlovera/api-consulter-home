<?php

namespace App\Http\Controllers;

use DB;
use Illuminate\Http\Request;

class EnlaceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $usuario=auth()->user();
        return response()->json([
            'usuario' => $usuario,
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
            $insert = DB::table('enlace')->insert([
                'codigo' => 'millaveprivada',
                'estado' => 1,
                'fecha_inicio' => '2023-04-22',
                'fecha_fin' => '2023-04-26',
                'postulantes_id' => 1,
            ]);
            return response()->json([
                'status' => 1,
                'message' => 'Registrado correctamente',
                'data' => null,
            ], 200);
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
        try {
            $enlace = DB::table('enlace')->where('enlace.postulantes_id', $id)->first();
            return response()->json([
                'status' => 1,
                'message' => 'Mostrar Clave',
                'data' => $enlace,
            ], 200);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => 0,
                'message' => 'Ha ocurrido un error',
                'data' => null,
            ], 200);
        }
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
        try {
            $update = DB::table('enlace')->update([
                'codigo' => 'millaveprivada',
                'estado' => 1,
                'fecha_inicio' => '2023-04-22',
                'fecha_fin' => '2023-04-26',
                'postulantes_id' => $request->postulantes_id,
            ])->where('enlace.enlace_id', $id);
            return response()->json([
                'status' => 1,
                'message' => 'Registrado correctamente',
                'data' => null,
            ], 200);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => 0,
                'message' => 'Ha ocurrido un error',
                'data' => null,
            ], 200);
        }
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
