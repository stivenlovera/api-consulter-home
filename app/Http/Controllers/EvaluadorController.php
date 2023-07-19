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
    public function index(Request $request)
    {
        $listaEvaluacion = DB::table('postulante_evaluacion')
            ->join('evaluacion', 'evaluacion.evaluacion_id', 'postulante_evaluacion.evaluacion_id')
            ->where('postulante_id', $request->user()->postulante_id)
            ->where('estado_evaluacion_postulante_id', 2)
            ->first();
        $tests = DB::table('test')
            ->select(
                'test.*'
            )
            ->join('test_evaluacion', 'test_evaluacion.test_id', 'test.test_id')
            ->where('test_evaluacion.evaluacion_id', $listaEvaluacion->evaluacion_id)
            ->get();
        foreach ($tests as $key => $test) {
            $verificar_test = DB::table('resultado_test')
                ->where('resultado_test.test_id', $test->test_id)
                ->where('resultado_test.postulante_id', $request->user()->postulante_id)
                ->first();
            if ($verificar_test) {
                $test->completado = 'si';
            } else {
                $test->completado = 'no';
            }
        }
        $persona = DB::table('postulante')
            ->where('postulante_id', $request->user()->postulante_id)
            ->first();
        $cargo = DB::table('cargo')
            ->where('cargo_id', $listaEvaluacion->cargo_id)
            ->first();
        return response()->json([
            'status' => 1,
            'message' => 'Lista de test disponibles',
            'data' => [
                'id' => $persona->postulante_id,
                'nombreCompleto' => "$persona->nombre $persona->apellidos",
                'test' => $tests,
                'cargo' => $cargo->nombreCargo,
                'fechaFinal' => date('Y-m-d', strtotime($listaEvaluacion->fechafin)),
                'fechaInicio' => date('Y-m-d', strtotime($listaEvaluacion->fechaInicio)),
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
