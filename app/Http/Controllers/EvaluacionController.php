<?php

namespace App\Http\Controllers;

use App\Models\User;
use DB;
use Illuminate\Http\Request;

class EvaluacionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $evaluaciones = DB::table('evaluacion')
            ->select(
                'evaluacion.*',
                'cargo.nombreCargo',
                DB::raw("DATE_FORMAT(evaluacion.fechaCreacion,'%d/%m/%Y') AS fechaCreacion"),
                'empresa.nombreEmpresa',
                'estado.nombreEstado'
            )
            ->join('cargo', 'cargo.cargo_id', 'evaluacion.cargo_id')
            ->join('empresa', 'empresa.empresa_id', 'evaluacion.empresa_id')
            ->join('estado', 'estado.estado_id', 'evaluacion.estado_id')
            ->orderBy('evaluacion.nombreEvaluacion','ASC')
            ->get();
        foreach ($evaluaciones as $key => $evaluacion) {

            $evaluacion->tests = DB::table('test_evaluacion')
                ->where('evaluacion_id', $evaluacion->evaluacion_id)
                ->get()->count();

            $evaluacion->postulantes = DB::table('postulante_evaluacion')
                ->where('evaluacion_id', $evaluacion->evaluacion_id)
                ->get()->count();

        }
        return response()->json([
            'status' => 1,
            'message' => 'lista de cargo',
            'data' => [
                'evaluaciones' => $evaluaciones,
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
        $empresas = DB::table('empresa')->get();
        $postulantes = DB::table('postulante')
            ->select('postulante.*')
            ->where('postulante_evaluacion.evaluacion_id', null)
            ->leftJoin('postulante_evaluacion', 'postulante_evaluacion.postulante_id', 'postulante.postulante_id')
            ->get();
        $estados = DB::table('estado')->get();
        return response()->json([
            'status' => 1,
            'message' => 'Create cargo',
            'data' => [
                'cargos' => $cargos,
                'tests' => $tests,
                'empresas' => $empresas,
                'postulantes' => $postulantes,
                'estados' => $estados,
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
        $fechaCreacion = date("Y-m-d", strtotime($request->fechaCreacion));
        $fechaFin = $this->calcularFechas($fechaCreacion, $request->dia);
        if ($request->estado_id > 2) {
            return response()->json([
                'status' => 0,
                'message' => 'No se puede crear evaluacion con estado FINALIZADO',
                'data' => null,
            ], 200);
        }
        if ($this->verificarExisteNombreStore($request->nombreEvaluacion)) {
            return response()->json([
                'status' => 0,
                'message' => 'Nombre evaluacion ya fue registrado',
                'data' => null,
            ], 200);
        }

        $evaluador = DB::table('evaluacion')->insertGetId([
            'nombreEvaluacion' => $request->nombreEvaluacion,
            'cargo_id' => $request->cargo_id,
            'fechaCreacion' => $request->fechaCreacion,
            'nota' => $request->nota == null ? '' : $request->nota,
            'dia' => $request->dia,
            'empresa_id' => $request->empresa_id,
            'estado_id' => $request->estado_id,
            'fechaCreacion' => $fechaCreacion,
            'fechaInicio' => $fechaCreacion,
            'fechafin' => $fechaFin,
        ]);
        foreach ($request->tests as $key => $test) {
            $insertTest = DB::table('test_evaluacion')->insertGetId([
                'evaluacion_id' => $evaluador,
                'test_id' => $test,
            ]);
        }
        foreach ($request->postulantes as $key => $postulante) {
            $infoPostulantes = DB::table('postulante')->where('postulante_id', $postulante)->first();
            $usuario = DB::table('usuario')->insertGetId([
                'usuario' => trim($infoPostulantes->nombre),
                'password' => trim($infoPostulantes->apellidos),
                'postulante_id' => $postulante,
                'tipousuario_id' => '1',
                'habilitado' => '1',
            ]);
            $insertTest = DB::table('postulante_evaluacion')->insertGetId([
                'evaluacion_id' => $evaluador,
                'token' => $this->createToken($infoPostulantes->nombre, $infoPostulantes->apellidos),
                'estado_evaluacion_postulante_id' => $request->estado_id,
                'postulante_id' => $postulante,
            ]);
        }
        return response()->json([
            'status' => 1,
            'message' => 'Añadido correctamente',
            'data' => $evaluador,
        ], 200);
    }
    private function calcularFechas($fechaInicio, $dia)
    {
        $fechaFin = date("Y-m-d", strtotime($fechaInicio . "+ " . $dia . " days"));
        return $fechaFin;
    }
    private function verificarExisteNombreStore($nombreEvaluacion)
    {
        $verificar = DB::table('evaluacion')->where('nombreEvaluacion', $nombreEvaluacion)->first();
        if ($verificar) {
            return true;
        } else {
            return false;
        }
    }
    private function verificarExisteNombreUpdate($nombreEvaluacion, $evaluacion_id)
    {
        $verificar = DB::table('evaluacion')->where('nombreEvaluacion', $nombreEvaluacion)->whereNotIn('evaluacion_id', [$evaluacion_id])->first();
        if ($verificar) {
            return true;
        } else {
            return false;
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
    private function createToken($usuario, $password)
    {
        $user = User::where('usuario', $usuario)->where('password', $password)->first();
        $token = $user->createToken($user)->plainTextToken;
        return $token;
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $cargos = DB::table('cargo')->get();
        $tests = DB::table('test')->get();
        $empresas = DB::table('empresa')->get();
        $postulantes = DB::table('postulante')
            ->select('postulante.*')
            //->where('postulante.estadoPostulanteId', 1)
            ->get();
        $estados = DB::table('estado')->get();

        $evaluacion = DB::table('evaluacion')
            ->where('evaluacion_id', $id)->first();
        $evaluacion->tests = DB::table('test_evaluacion')
            ->where('evaluacion_id', $id)
            ->get()
            ->pluck('test_id');
        $evaluacion->postulantes = DB::table('postulante_evaluacion')
            ->where('evaluacion_id', $id)
            ->get()
            ->pluck('postulante_id');

        return response()->json([
            'status' => 1,
            'message' => 'Mostrar una cargos',
            'data' => [
                'evaluacion' => $evaluacion,
                'cargos' => $cargos,
                'tests' => $tests,
                'empresas' => $empresas,
                'postulantes' => $postulantes,
                'estados' => $estados,
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
        $fechaCreacion = date("Y-m-d", strtotime($request->fechaCreacion));
        $fechaFin = $this->calcularFechas($fechaCreacion, $request->dia);

        if ($this->verificarExisteNombreUpdate($request->nombreEvaluacion, $id)) {
            return response()->json([
                'status' => 0,
                'message' => 'Nombre evaluacion ya fue registrado',
                'data' => null,
            ], 200);
        }

        $evaluador = DB::table('evaluacion')
            ->where('evaluacion_id', $id)
            ->update([
                'nombreEvaluacion' => $request->nombreEvaluacion,
                'cargo_id' => $request->cargo_id,
                'fechaCreacion' => $request->fechaCreacion,
                'nota' => $request->nota == null ? '' : $request->nota,
                'dia' => $request->dia,
                'empresa_id' => $request->empresa_id,
                'estado_id' => $request->estado_id,
                'fechaCreacion' => $fechaCreacion,
                'fechaInicio' => $fechaCreacion,
                'fechafin' => $fechaFin,
            ]);
        $deleteTests = DB::table('test_evaluacion')->where('evaluacion_id', $id)->delete();
        $deletePostulantes = DB::table('postulante_evaluacion')
            ->where('evaluacion_id', $id)
            ->delete();
        foreach ($request->tests as $key => $test) {
            $insertTest = DB::table('test_evaluacion')->insertGetId([
                'evaluacion_id' => $id,
                'test_id' => $test,
            ]);
        }
        foreach ($request->postulantes as $key => $postulante) {
            $deleteUsuario = DB::table('usuario')->where('postulante_id', $postulante)->delete();
            $infoPostulantes = DB::table('postulante')->where('postulante_id', $postulante)->first();
            $usuario = DB::table('usuario')->insertGetId([
                'usuario' => trim($infoPostulantes->nombre),
                'password' => trim($infoPostulantes->apellidos),
                'postulante_id' => $postulante,
                'tipousuario_id' => '1',
                'habilitado' => '1',
            ]);

            $insertTest = DB::table('postulante_evaluacion')->insertGetId([
                'evaluacion_id' => $id,
                'token' => $this->createToken($infoPostulantes->nombre, $infoPostulantes->apellidos),
                'postulante_id' => $postulante,
                'estado_evaluacion_postulante_id' => $request->estado_id,
            ]);
        }
        return response()->json([
            'status' => 1,
            'message' => 'Modificado correctamente',
            'data' => $id,
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
        $evaluador = DB::table('evaluacion')->where('evaluador_id', $id)->delete();
        $deleteTests = DB::table('test_evaluacion')->where('evaluacion_id', $id)->delete();
        $deletePostulantes = DB::table('postulante_evaluacion')
            ->where('evaluacion_id', $id)
            ->where('tipousuario_id', 1)
            ->delete();
        return response()->json([
            'status' => 1,
            'message' => 'Eliminado correctamente',
            'data' => $evaluador,
        ], 200);
    }
}
