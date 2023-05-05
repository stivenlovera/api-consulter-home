<?php

namespace App\Http\Controllers;

use DB;
use Illuminate\Http\Request;
use stdClass;

class HomeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $totalEmpresas = DB::table('empresa')->get();
        $empresa = new stdClass();
        $empresa->titulo = "Empresas";
        $empresa->valor = count($totalEmpresas);
        $empresa->routeApp = "";
        $empresa->color = "default";
        $empresa->icon = "empresas";

        $totalPostulantes = DB::table('postulante')->get();
        $postulante = new stdClass();
        $postulante->titulo = "postulantes";
        $postulante->valor = count($totalPostulantes);
        $postulante->routeApp = "";
        $postulante->color = "default";
        $postulante->icon = "postulantes";

        $totalEvaluaciones = DB::table('evaluacion')->get();
        $evaluacion = new stdClass();
        $evaluacion->titulo = "Evaluaciones";
        $evaluacion->valor = count($totalEvaluaciones);
        $evaluacion->routeApp = "";
        $evaluacion->color = "default";
        $evaluacion->icon = "evaluaciones";

        $totalCargo = DB::table('cargo')->get();
        $cargo = new stdClass();
        $cargo->titulo = "Cargos";
        $cargo->valor = count($totalCargo);
        $cargo->routeApp = "";
        $cargo->color = "default";
        $cargo->icon = "cargo";

        return response()->json([
            'status' => 1,
            'message' => 'Motrando resumenes',
            'data' => [
                $empresa,
                $postulante,
                $evaluacion,
                $cargo,
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
