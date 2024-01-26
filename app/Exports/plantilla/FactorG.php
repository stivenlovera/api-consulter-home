<?php

namespace App\Exports\plantilla;

use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\RegistersEventListeners;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\BeforeExport;
use Maatwebsite\Excel\Excel;
use stdClass;

class FactorG implements
WithEvents
{
    private $resultado_test;
    private $postulante;
    public function __construct($resultado_test, $postulante)
    {
        $this->resultado_test = $resultado_test;
        $this->postulante = $postulante;
    }
    use Exportable, RegistersEventListeners;
    public function registerEvents(): array
    {
        return [
            // Handle by a closure.
            BeforeExport::class => function (BeforeExport $event) {

                $event->writer->reopen(new \Maatwebsite\Excel\Files\LocalTemporaryFile(storage_path() . '/plantillas/' . 'Factor G2 -.xlsx'), Excel::XLSX);
                $event->writer->getSheetByIndex(0);
                $preguntas_excel = $this->listaPreguntas();
                //dd($this->resultado_test,$this->postulante);
                $event->getWriter()->getSheetByIndex(0)->setCellValue('C10', $this->postulante->nombre . ' ' . $this->postulante->apellidos);
                $event->getWriter()->getSheetByIndex(0)->setCellValue('V10', (date('Y') - date('Y', strtotime($this->postulante->fecha_nacimiento))));
                $event->getWriter()->getSheetByIndex(0)->setCellValue('V11', date('d/m/Y', strtotime($this->postulante->fecha_nacimiento)));
                // fill with information
                //dd($this->resultado_test);
                foreach ($preguntas_excel as $key => $test) {
                    if (!empty($this->resultado_test[$key])) {
                        //dump($test, $this->resultado_test[$key]->preguntas);
                        foreach ($test as $i => $pregunta) {
                            foreach ($pregunta->respuesta as $x =>  $valor) {
                                //dump($this->resultado_test[$key]->preguntas[$i]->respuestas[$x]->valor,$valor);
                                if ($this->resultado_test[$key]->preguntas[$i]->respuestas[$x]->valor=='1') {
                                    $event->getWriter()->getSheetByIndex(0)->setCellValue( $valor, '1');
                                }
                            }
                        }
                    }
                }
            },
        ];
    }
    public function listaPreguntas()
    {
        $resultado = [];
        $resultado[] = $this->test1();
        $resultado[] = $this->test2();
        $resultado[] = $this->test3();
        $resultado[] = $this->test4();
        return $resultado;
    }
    public function test1()
    {
        $resultado = [];
        $columns = array('B', 'C', 'D', 'E', 'F');
        $row = 1;
        $posicion = 19;
        while ($row <= 12) {
            $pregunta = new stdClass;
            $pregunta->num = $row;
            $respuesta = 1;
            while ($respuesta <= 5) {
                $pregunta->respuesta[] = $columns[$respuesta - 1] . $posicion;
                $respuesta++;
            }
            $resultado[] = $pregunta;
            if ($row == 5 || $row == 10) {
                $posicion++;
            }
            $row++;
            $posicion++;
        }
        return $resultado;
    }
    public function test2()
    {
        $resultado = [];
        $columns = array('I', 'J', 'K', 'L', 'M');
        $row = 1;
        $posicion = 19;
        while ($row <= 15) {
            $pregunta = new stdClass;
            $pregunta->num = $row;
            $respuesta = 1;
            while ($respuesta <= 5) {
                $pregunta->respuesta[] = $columns[$respuesta - 1] . $posicion;
                $respuesta++;
            }
            $resultado[] = $pregunta;
            if ($row == 5 || $row == 10) {
                $posicion++;
            }
            $row++;
            $posicion++;
        }
        return $resultado;
    }
    public function test3()
    {
        $resultado = [];
        $columns = array('P', 'Q', 'R', 'S', 'T');
        $row = 1;
        $posicion = 19;
        while ($row <= 12) {
            $pregunta = new stdClass;
            $pregunta->num = $row;
            $respuesta = 1;
            while ($respuesta <= 5) {
                $pregunta->respuesta[] = $columns[$respuesta - 1] . $posicion;
                $respuesta++;
            }
            $resultado[] = $pregunta;
            if ($row == 5 || $row == 10) {
                $posicion++;
            }
            $row++;
            $posicion++;
        }
        return $resultado;
    }
    public function test4()
    {
        $resultado = [];
        $columns = array('W', 'X', 'Y', 'Z', 'AA');
        $row = 1;
        $posicion = 19;
        while ($row <= 8) {
            $pregunta = new stdClass;
            $pregunta->num = $row;
            $respuesta = 1;
            while ($respuesta <= 5) {
                $pregunta->respuesta[] = $columns[$respuesta - 1] . $posicion;
                $respuesta++;
            }
            $resultado[] = $pregunta;
            if ($row == 5) {
                $posicion++;
            }
            $row++;
            $posicion++;
        }
        return $resultado;
    }

}
