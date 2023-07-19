<?php

namespace App\Http\Controllers;

use DB;
use Illuminate\Http\Request;

class EvaluacionPostulanteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

    }
    public function listaEvaluacion($id)
    {
        try {
            $listPostulantes = DB::table('postulante_evaluacion')
                ->select(
                    'postulante_evaluacion.*',
                    'postulante.*',
                    DB::raw("CONCAT(postulante.nombre,' ', postulante.apellidos) as nombreCompleto"),
                    DB::raw("CONCAT('" . env('APP_EVALUADOR_AUTH') . "', postulante_evaluacion.token) as token")
                )
                ->join('postulante', 'postulante_evaluacion.postulante_id', 'postulante.postulante_id')
                ->where('postulante_evaluacion.evaluacion_id', $id)
                ->orderBy('postulante.nombre', 'DESC')
                ->get();
            $tests = DB::table('test_evaluacion')
                ->join('test', 'test.test_id', 'test_evaluacion.test_id')
                ->where('test_evaluacion.evaluacion_id', $id)
                ->get();
            $evaluacion = DB::table('evaluacion')
                ->where('evaluacion.evaluacion_id', $id)
                ->first();
            return response()->json([
                'status' => 1,
                'message' => 'Lista Postulantes',
                'data' => [
                    'evaluacionPostulante' => $listPostulantes,
                    'test' => $tests,
                    'evaluacion' => $evaluacion,
                ],
            ], 200);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => 0,
                'message' => 'Error Lista Postulantes',
                'data' => null,
            ], 200);
        }
    }
    public function listaPreview($id)
    {
        try {
            
            $tests = DB::table('test_evaluacion')
                ->join('test', 'test.test_id', 'test_evaluacion.test_id')
                ->where('test_evaluacion.evaluacion_id', $id)
                ->get();
            $evaluacion = DB::table('evaluacion')
                ->where('evaluacion.evaluacion_id', $id)
                ->first();
            return response()->json([
                'status' => 1,
                'message' => 'Lista Postulantes',
                'data' => [
                    'test' => $tests,
                    'evaluacion' => $evaluacion,
                ],
            ], 200);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => 0,
                'message' => 'Error Lista Postulantes',
                'data' => null,
            ], 200);
        }
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
        //
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
}
