<?php

namespace App\Http\Controllers;

use App\Exports\exportSelecionUnica;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Excel;

class ResultadoEvaluacion extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    private $excel;
    public function __construct(Excel $excel)
    {
        $this->excel = $excel;
    }
    public function index(Request $request, $evaluacion_id, $postulante_id)
    {
        $tests = DB::table('test_evaluacion')
            ->select(
                'test.*',
                'postulante_evaluacion.postulante_id',
                'postulante_evaluacion.evaluacion_id',
            )
            ->join('postulante_evaluacion', 'postulante_evaluacion.evaluacion_id', 'test_evaluacion.evaluacion_id')
            ->join('test', 'test.test_id', 'test_evaluacion.test_id')
            ->where('postulante_evaluacion.evaluacion_id', $evaluacion_id)
            ->where('postulante_evaluacion.postulante_id', $postulante_id)
            ->get();

        foreach ($tests as $key => $test) {
            $verificar_test = DB::table('resultado_test')
                ->where('resultado_test.test_id', $test->test_id)
                ->first();
            if ($verificar_test) {
                $test->completado = 'si';
            } else {
                $test->completado = 'no';
                $test->evaluacion_id = $evaluacion_id;
            }
        }

        return response()->json([
            'status' => 1,
            'message' => 'Lista de test resueltos',
            'data' => $tests,
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
        //impletamenta alerta  para pendientes
    }
    public function report_pdf($evaluacion_id, $postulante_id, $test_id)
    {
        //informacion  general del test
        $test = DB::table('test_evaluacion')
            ->select(
                'postulante.*',
                'test.*',
                'cargo.*'
            )
            ->join('evaluacion', 'evaluacion.evaluacion_id', 'evaluacion.evaluacion_id')
            ->join('cargo', 'cargo.cargo_id', 'evaluacion.cargo_id')
            ->join('postulante_evaluacion', 'postulante_evaluacion.evaluacion_id', 'test_evaluacion.evaluacion_id')
            ->join('postulante', 'postulante.postulante_id', 'postulante_evaluacion.postulante_id')
            ->join('test', 'test.test_id', 'test_evaluacion.test_id')
            ->where('postulante_evaluacion.evaluacion_id', $evaluacion_id)
            ->where('postulante_evaluacion.postulante_id', $postulante_id)
            ->where('test.test_id', $test_id)
            ->first();

        $test->resultaddos_test = DB::table('resultado_test')
            ->where('resultado_test.postulante_id', $postulante_id)
            ->where('resultado_test.test_id', $test->test_id)
            ->first();
        //seccion de preguntas
        $preguntas = DB::table('pregunta')
            ->where('pregunta.test_id', $test->test_id)
            ->get();
        foreach ($preguntas as $key => $pregunta) {
            $respuestas = DB::table('respuesta')
                ->where('respuesta.pregunta_id', $pregunta->pregunta_id)
                ->get();
            $respuestas_preguntas = DB::table('resultado_pregunta')
                ->where('resultado_pregunta.pregunta_id', $pregunta->pregunta_id)
                ->where('resultado_pregunta.resultado_test_id', $test->resultaddos_test->resultado_test_id)
                ->first();

            $pregunta->resultados_pregunta = $respuestas_preguntas;
            $pregunta->respuestas = $respuestas;
            foreach ($respuestas as $key => $respuesta) {
                $resultado_respuesta = DB::table('resultado_respuesta')
                    ->where('resultado_respuesta.respuesta_id', $respuesta->respuesta_id)
                    ->where('resultado_respuesta.resultado_pregunta_id', $pregunta->resultados_pregunta->resultado_pregunta_id)
                    ->first();
                $respuesta->resultados_respuesta = $resultado_respuesta;
            }
        }

        switch ($test->tipo_preguntas_id) {
            case 1:
                $pdf = PDF::loadView('resultados_test.criterio', compact('test', 'preguntas'))->setPaper('letter')->setWarnings(false);
                return $pdf->download("Doumento" . "stiven" . ".pdf");

            case 4:
                $pdf = PDF::loadView('resultados_test.dibujo', compact('test', 'preguntas'))->setPaper('letter')->setWarnings(false);
                return $pdf->download("Doumento" . "stiven" . ".pdf");

            default:
                break;
        }
    }
    public function ResultadoSeleccionUnica($evaluacion_id, $postulante_id, $test_id)
    {
        $test = DB::table('test_evaluacion')
            ->select(
                'postulante.*',
                'test.*',
                'cargo.*'
            )
            ->join('evaluacion', 'evaluacion.evaluacion_id', 'evaluacion.evaluacion_id')
            ->join('cargo', 'cargo.cargo_id', 'evaluacion.cargo_id')
            ->join('postulante_evaluacion', 'postulante_evaluacion.evaluacion_id', 'test_evaluacion.evaluacion_id')
            ->join('postulante', 'postulante.postulante_id', 'postulante_evaluacion.postulante_id')
            ->join('test', 'test.test_id', 'test_evaluacion.test_id')
            ->where('postulante_evaluacion.evaluacion_id', $evaluacion_id)
            ->where('postulante_evaluacion.postulante_id', $postulante_id)
            ->where('test.test_id', $test_id)
            ->first();

        $test->resultaddos_test = DB::table('resultado_test')
            ->where('resultado_test.postulante_id', $postulante_id)
            ->where('resultado_test.test_id', $test->test_id)
            ->first();
        //seccion de preguntas
        $preguntas = DB::table('pregunta')
            ->where('pregunta.test_id', $test->test_id)
            ->get();
        $excelPreguntas = [];

        foreach ($preguntas as $key => $pregunta) {
            $data = new \stdClass();
            $data->nro = $key;
            $data->nro = $pregunta->;
            $respuestas = DB::table('respuesta')
                ->where('respuesta.pregunta_id', $pregunta->pregunta_id)
                ->get();
            $respuestas_preguntas = DB::table('resultado_pregunta')
                ->where('resultado_pregunta.pregunta_id', $pregunta->pregunta_id)
                ->where('resultado_pregunta.resultado_test_id', $test->resultaddos_test->resultado_test_id)
                ->first();

            $pregunta->resultados_pregunta = $respuestas_preguntas;
            $pregunta->respuestas = $respuestas;
            foreach ($respuestas as $key => $respuesta) {
                $resultado_respuesta = DB::table('resultado_respuesta')
                    ->where('resultado_respuesta.respuesta_id', $respuesta->respuesta_id)
                    ->where('resultado_respuesta.resultado_pregunta_id', $pregunta->resultados_pregunta->resultado_pregunta_id)
                    ->first();
                $respuesta->resultados_respuesta = $resultado_respuesta;
            }
        }

        return response()->json([
            'data' => $test,
        ], 200);

        return $this->excel->download(new exportSelecionUnica([]), "Hoja de ejemplo " . date('m-d-Y') . ".xlsx");
    }
}