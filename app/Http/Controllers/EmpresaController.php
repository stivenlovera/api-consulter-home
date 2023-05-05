<?php

namespace App\Http\Controllers;

use DB;
use Illuminate\Http\Request;

class EmpresaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $empresas = DB::table('empresa')->get();
        return response()->json([
            'status' => 1,
            'message' => 'prueba',
            'data' => [
                'empresas' => $empresas,
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
        //dd($request->all());
        $empresa = DB::table('empresa')->insertGetId([
            'nombreEmpresa' => $request->nombreEmpresa,
            'dirrecion' => $request->dirrecion,
            'telefono' => $request->telefono,
            'nombreRespresentante' => $request->nombreRespresentante,
        ]);
        return response()->json([
            'status' => 1,
            'message' => 'Añadido correctamente',
            'data' => $empresa,
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
        $empresa = DB::table('empresa')->where('empresa_id', $id)->first();
        return response()->json([
            'status' => 1,
            'message' => 'Mostrar una empresa',
            'data' => [
                'empresa' => $empresa,
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
        $empresa = DB::table('empresa')->where('empresa_id', $id)->update([
            'nombreEmpresa' => $request->nombreEmpresa,
            'dirrecion' => $request->dirrecion,
            'telefono' => $request->telefono,
            'nombreRespresentante' => $request->nombreRespresentante,
        ]);
        return response()->json([
            'status' => 1,
            'message' => 'Modificado correctamente',
            'data' => $empresa,
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
        $empresa = DB::table('empresa')->where('empresa_id', $id)->delete();
        return response()->json([
            'status' => 1,
            'message' => 'Eliminado correctamente',
            'data' => $empresa,
        ], 200);
    }
}
