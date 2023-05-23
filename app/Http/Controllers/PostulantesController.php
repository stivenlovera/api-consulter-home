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
            'estadopostulante.nombreEstadoPostulante',
            DB::raw("DATE_FORMAT(postulante.fecha_nacimiento,'%Y-%m-%d') AS fecha_nacimiento")
        )
            ->join('estadopostulante', 'estadopostulante.estadoPostulante_id', 'postulante.estadoPostulanteId')
            ->get();
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
        $estadoCiviles = DB::table('estadocivil')->get();
        $estadoPostulantes = DB::table('estadopostulante')->get();
        return response()->json([
            'status' => 1,
            'message' => 'Registrado correctamente',
            'data' => [
                'estadoCiviles' => $estadoCiviles,
                'estadoPostulantes' => $estadoPostulantes,
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
        try {
            $insertPostulante = DB::table('postulante')->insertGetId([
                'ci' => $request->ci,
                'nombre' => $request->nombre,
                'apellidos' => $request->apellidos,
                'dirrecion' => $request->dirrecion,
                'fecha_nacimiento' => date("Y-m-d", strtotime($request->fecha_nacimiento)),
                'fechaIngreso' => date("Y-m-d", strtotime($request->fechaIngreso)),
                'telefono' => $request->telefono,
                'email' => $request->email,
                'expectativaSalarial' => $request->expectativaSalarial,
                'estadoCivilId' => $request->estadoCivilId,
                'numeroHijos' => $request->numeroHijos,
                'edades' => $request->edades,
                'profesion' => $request->profesion,
                'estadoPostulanteId' => $request->estadoPostulanteId,
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
        $estadoCiviles = DB::table('estadocivil')->get();
        $estadoPostulantes = DB::table('estadopostulante')->get();
        $postulante = DB::table('postulante')
            ->select(
                'postulante.*',
                DB::raw("DATE_FORMAT(postulante.fecha_nacimiento,'%Y-%m-%d') AS fecha_nacimiento"),
                DB::raw("DATE_FORMAT(postulante.fechaIngreso,'%Y-%m-%d') AS fechaIngreso")
            )
            ->where('postulante_id', $id)
            ->first();
        return response()->json([
            'status' => 1,
            'message' => 'Mostrar una postulante',
            'data' => [
                'postulante' => $postulante,
                'estadoCiviles' => $estadoCiviles,
                'estadoPostulantes' => $estadoPostulantes,
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
