<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
class CargoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $cargos = DB::table('cargo')->get();
        return response()->json([
            'status' => 1,
            'message' => 'lista de cargo',
            'data' => [
                'cargos' => $cargos,
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
        $cargo = DB::table('cargo')->insertGetId([
            'nombreCargo' => $request->nombreCargo
        ]);
        return response()->json([
            'status' => 1,
            'message' => 'Añadido correctamente',
            'data' => $cargo,
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
        $cargo = DB::table('cargo')->where('cargo_id', $id)->first();
        return response()->json([
            'status' => 1,
            'message' => 'Mostrar una cargos',
            'data' => [
                'cargo' => $cargo,
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
        $cargo = DB::table('cargo')->where('cargo_id', $id)->update([
            'nombreCargo' => $request->nombreCargo
        ]);
        return response()->json([
            'status' => 1,
            'message' => 'Modificado correctamente',
            'data' => $cargo,
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
        $cargo = DB::table('cargo')->where('cargo_id', $id)->delete();
        return response()->json([
            'status' => 1,
            'message' => 'Eliminado correctamente',
            'data' => $cargo,
        ], 200);
    }
}
