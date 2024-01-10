<?php

namespace App\Http\Controllers;

use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class EvaluadorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        Log::info("EvaluadorController/index({$request->getContent()})");
        try {
            $evaluacion = DB::table('postulante_evaluacion')
                ->join('evaluacion', 'evaluacion.evaluacion_id', 'postulante_evaluacion.evaluacion_id')
                ->where('postulante_id', $request->user()->postulante_id)
                ->where('estado_evaluacion_postulante_id', 2)
                ->first();
            $tests = DB::table('test')
                ->select(
                    'test.*',
                    'test_evaluacion.test_evaluacion_id'
                )
                ->join('test_evaluacion', 'test_evaluacion.test_id', 'test.test_id')
                ->where('test_evaluacion.evaluacion_id', $evaluacion->evaluacion_id)
                ->get();
            foreach ($tests as $key => $test) {
                $verificar_test = DB::table('resultado_test')
                    ->where('resultado_test.test_evaluacion_id', $test->test_evaluacion_id)
                    ->where('resultado_test.postulante_id', $request->user()->postulante_id)
                    ->first();
                $test_ejemplo = DB::table('test_ejemplo')
                    ->where('test_id', $test->test_id)->first();
                $test->ejemplo_test_id = $test_ejemplo ? $test_ejemplo->ejemplo_id : 0;
                if ($verificar_test) {
                    if ($verificar_test->estado == 0) {
                        $test->completado = 'no';
                    } else {
                        $test->completado = 'si';
                    }
                } else {
                    $test->completado = 'no';
                }
            }
            $persona = DB::table('postulante')
                ->where('postulante_id', $request->user()->postulante_id)
                ->first();
            $cargo = DB::table('cargo')
                ->where('cargo_id', $evaluacion->cargo_id)
                ->first();
            $response = response()->json([
                'status' => 1,
                'message' => 'Lista de test disponibles',
                'data' => [
                    'id' => $persona->postulante_id,
                    'nombreCompleto' => "$persona->nombre $persona->apellidos",
                    'test' => $tests,
                    'cargo' => $cargo->nombreCargo,
                    'fechaFinal' => date('Y-m-d', strtotime($evaluacion->fechafin)),
                    'fechaInicio' => date('Y-m-d', strtotime($evaluacion->fechaInicio)),
                    'evaluacion_id' => $evaluacion->evaluacion_id,
                ],
            ], 200);
            Log::info("EvaluadorController/index SUCCESS({$response})");
            return $response;

        } catch (\Throwable $th) {
            Log::error("EvaluadorController/index(){$th->getMessage()}");
            $response = response()->json([
                'status' => 1,
                'message' => $th->getMessage(),
                'data' => null,
            ]);
            return $response;
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
