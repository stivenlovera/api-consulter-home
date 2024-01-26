<?php

namespace App\Http\Controllers;

use App\Exports\exportSelecionUnica;
use App\Exports\plantilla\Edwards;
use App\Exports\plantilla\Eysenck;
use App\Exports\plantilla\Kuder;
use App\Exports\plantilla\Mmpi;
use App\Exports\plantilla\FactorG;
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
                'test_evaluacion.test_evaluacion_id'
            )
            ->join('postulante_evaluacion', 'postulante_evaluacion.evaluacion_id', 'test_evaluacion.evaluacion_id')
            ->join('test', 'test.test_id', 'test_evaluacion.test_id')
            ->where('postulante_evaluacion.evaluacion_id', $evaluacion_id)
            ->where('postulante_evaluacion.postulante_id', $postulante_id)
            ->get();
        $postulante = DB::table('postulante')->where('postulante_id', $postulante_id)->first();
        $evaluacion = DB::table('evaluacion')->where('evaluacion_id', $evaluacion_id)->first();
        foreach ($tests as $key => $test) {
            $verificar_test = DB::table('resultado_test')
                ->where('resultado_test.test_evaluacion_id', $test->test_evaluacion_id)
                ->where('resultado_test.postulante_id', $postulante_id)
                ->first();
            if ($verificar_test) {
                $test->completado = 'si';
                $test->resultado_test_id = $verificar_test->resultado_test_id;
            } else {
                $test->completado = 'no';
                $test->resultado_test_id = 0;
            }
        }

        return response()->json([
            'status' => 1,
            'message' => 'Lista de test resueltos',
            'data' => [
                'tests' => $tests,
                'postulante' => $postulante,
                'evaluacion' => $evaluacion,
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
        //impletamenta alerta  para pendientes
    }
    public function report_pdf($evaluacion_id, $postulante_id, $test_evaluacion_id, $resultado_test_id)
    {
        //TEST
        $resultado_test = $this->obtenerTest($postulante_id, $evaluacion_id, $resultado_test_id);
        //dd($resultado_test);
        $postulante = $this->obtenerInfoPostulante($evaluacion_id, $postulante_id);
        //dd($resultado_test, $postulante);

        //dd($preguntas);
        $nombreDocumento = $postulante->nombre . ' ' . $postulante->apellidos . ' - ' . $resultado_test->nombreTest . ' ' . date('d-m-Y', strtotime($resultado_test->fecha_inicio)) . '.pdf';
        switch ($resultado_test->tipo_preguntas_id) {
            case 1:
                $pdf = PDF::loadView('resultados_test.criterio', compact('resultado_test', 'postulante'))->setPaper('letter')->setWarnings(false);
                return $pdf->download($nombreDocumento);
            case 4:
                $pdf = PDF::loadView('resultados_test.dibujo', compact('resultado_test', 'postulante'))->setPaper('letter')->setWarnings(false);
                return $pdf->download($nombreDocumento);
            case 6:
                $pdf = PDF::loadView('resultados_test.roshard', compact('resultado_test', 'postulante'))->setPaper('letter')->setWarnings(false);
                return $pdf->download($nombreDocumento);
            case 12:
                $pdf = PDF::loadView('resultados_test.ordenar-imagenes', compact('resultado_test', 'postulante'))->setPaper('letter')->setWarnings(false);
                return $pdf->download($nombreDocumento);
            case 13:
                $pdf = PDF::loadView('resultados_test.ordenar-imagenes', compact('resultado_test', 'postulante'))->setPaper('letter')->setWarnings(false);
                return $pdf->download($nombreDocumento);
            default:
                break;
        }
    }

    public function report_excel($evaluacion_id, $postulante_id, $test_evaluacion_id, $resultado_test_id)
    {
        $resultado_test = $this->obtenerTest($postulante_id, $evaluacion_id, $resultado_test_id);
        //dd('aqui');
        $postulante = $this->obtenerInfoPostulante($evaluacion_id, $postulante_id);
        //dd($resultado_test, $postulante);
        $nombreDocumento = $postulante->nombre . ' ' . $postulante->apellidos . ' - ' . $resultado_test->nombreTest . ' ' . date('d-m-Y', strtotime($resultado_test->fecha_inicio)) . '.xlsx';
        switch ($resultado_test->tipo_preguntas_id) {
            case 9:
                return $this->excel->download(new Eysenck($resultado_test, $postulante), $nombreDocumento);
                break;
            case 10:
                return $this->excel->download(new Edwards($resultado_test, $postulante), $nombreDocumento);
                break;
            case 7:
                return $this->excel->download(new Kuder($resultado_test, $postulante), $nombreDocumento);
                break;
            case 8:
                return $this->excel->download(new Mmpi($resultado_test, $postulante), $nombreDocumento);
                break;
            case 11:
                $resultado_test = $this->obtenerTestFactorG($postulante_id, $evaluacion_id, $resultado_test_id);
                return $this->excel->download(new FactorG($resultado_test, $postulante), $nombreDocumento);
            default:

                break;
        }
    }
    public function obtenerFactorG($tipo_preguntas_id)
    {
        $tests = DB::table('test_ejemplo')
            ->select('test.test_id')
            ->join('test', 'test.test_id', 'test_ejemplo.test_id')
            ->where('test_ejemplo.ejemplo_id', '!=', 0)
            ->get()
            ->pluck('test_id');
        return $tests;
    }
    public function obtenerTest($postulante_id, $evaluacion_id, $resultado_test_id)
    {
        $resultado_test = DB::table('resultado_test')
            ->select(
                'resultado_test.*',
                'test.*'
            )
            ->join('test_evaluacion', 'resultado_test.test_evaluacion_id', 'test_evaluacion.test_evaluacion_id')
            ->join('test', 'test.test_id', 'test_evaluacion.test_id')
            ->where('resultado_test.postulante_id', $postulante_id)
            ->where('test_evaluacion.evaluacion_id', $evaluacion_id)
            ->where('resultado_test.resultado_test_id', $resultado_test_id)
            ->first();

        $preguntas = DB::table('pregunta')
            ->join('resultado_pregunta', 'resultado_pregunta.pregunta_id', 'pregunta.pregunta_id')
            ->where('resultado_pregunta.resultado_test_id', $resultado_test->resultado_test_id)
            ->get();

        foreach ($preguntas as $key => $pregunta) {
            $respuestas = DB::table('respuesta')
                ->join('resultado_respuesta', 'resultado_respuesta.respuesta_id', 'respuesta.respuesta_id')
                ->where('resultado_respuesta.resultado_pregunta_id', $pregunta->resultado_pregunta_id)
                ->get();
            $pregunta->respuestas = $respuestas;
        }
        $resultado_test->preguntas = $preguntas;
        return $resultado_test;
    }

    //
    public function obtenerInfoPostulante($evaluacion_id, $postulante_id)
    {
        $postulante = DB::table('postulante')
            ->select(
                'postulante.*',
                'cargo.*',
                'estado.*',
                'empresa.*'
            )
            ->join('postulante_evaluacion', 'postulante_evaluacion.postulante_id', 'postulante.postulante_id')
            ->join('evaluacion', 'evaluacion.evaluacion_id', 'postulante_evaluacion.evaluacion_id')
            ->join('cargo', 'cargo.cargo_id', 'evaluacion.cargo_id')
            ->join('empresa', 'empresa.empresa_id', 'evaluacion.empresa_id')
            ->join('estado', 'estado.estado_id', 'evaluacion.estado_id')
            ->where('evaluacion.evaluacion_id', $evaluacion_id)
            ->where('postulante_evaluacion.postulante_id', $postulante_id)
            ->first();
        return $postulante;
    }
    public function obtenerTestFactorG($postulante_id, $evaluacion_id, $resultado_test_id)
    {
        $resultados = [];
        $obtenerFactorG = $this->obtenerFactorG(11);
        foreach ($obtenerFactorG as $key => $test_id) {
            $resultado_test = DB::table('resultado_test')
                ->select(
                    'resultado_test.*',
                    'test.*'
                )
                ->join('test_evaluacion', 'resultado_test.test_evaluacion_id', 'test_evaluacion.test_evaluacion_id')
                ->join('test', 'test.test_id', 'test_evaluacion.test_id')
                ->where('resultado_test.postulante_id', $postulante_id)
                ->where('test_evaluacion.evaluacion_id', $evaluacion_id)
                ->where('test.test_id', $test_id)
                ->where('resultado_test.resultado_test_id', $resultado_test_id)
                ->first();

            if ($resultado_test) {
                $preguntas = DB::table('pregunta')
                    ->join('resultado_pregunta', 'resultado_pregunta.pregunta_id', 'pregunta.pregunta_id')
                    ->where('resultado_pregunta.resultado_test_id', $resultado_test->resultado_test_id)
                    ->get();
                foreach ($preguntas as $key => $pregunta) {
                    $respuestas = DB::table('respuesta')
                        ->join('resultado_respuesta', 'resultado_respuesta.respuesta_id', 'respuesta.respuesta_id')
                        ->where('resultado_respuesta.resultado_pregunta_id', $pregunta->resultado_pregunta_id)
                        ->get();
                    $pregunta->respuestas = $respuestas;
                }
                $resultado_test->preguntas = $preguntas;
                $resultados[] = $resultado_test;
            }
        }
        return $resultados;
    }
}
