<?php

namespace App\Http\Controllers;

use DB;
use Illuminate\Http\Request;

class EvaluadorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $evaluadores = DB::table('evaluador')
            ->select(
                'evaluador.*',
                'cargo.nombreCargo'
            )
            ->join('cargo', 'cargo.cargo_id', 'evaluador.cargo_id')
            ->get();
        return response()->json([
            'status' => 1,
            'message' => 'lista de cargo',
            'data' => [
                'evaluadores' => $evaluadores,
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
        $cargos = DB::table('cargo')->get();
        $tests = DB::table('test')->get();
        return response()->json([
            'status' => 1,
            'message' => 'Create cargo',
            'data' => [
                'cargos' => $cargos,
                'tests' => $tests,
            ],
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
        $evaluador = DB::table('evaluador')->insertGetId([
            'nombreEvaluador' => $request->nombreEvaluador,
            'cargo_id' => $request->cargo_id,
        ]);
        foreach ($request->tests as $key => $test) {
            $insertTest = DB::table('config_evaluador')->insertGetId([
                'evaluador_id' => $evaluador,
                'test_id' => $test['test_id'],
            ]);
        }
        return response()->json([
            'status' => 1,
            'message' => 'Añadido correctamente',
            'data' => $evaluador,
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
        $evaluador = DB::table('evaluador')->where('evaluador_id', $id)->first();
        return response()->json([
            'status' => 1,
            'message' => 'Mostrar una cargos',
            'data' => [
                'cargo' => $evaluador,
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
        $evaluador = DB::table('evaluador')->where('evaluador_id', $id)->update([
            'nombreCargo' => $request->nombreCargo,
            'cargo_id' => $request->cargo_id,
        ]);
        return response()->json([
            'status' => 1,
            'message' => 'Modificado correctamente',
            'data' => $evaluador,
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
        $evaluador = DB::table('evaluador')->where('evaluador_id', $id)->delete();
        return response()->json([
            'status' => 1,
            'message' => 'Eliminado correctamente',
            'data' => $evaluador,
        ], 200);
    }
}
