<?php

namespace App\Exports\plantilla;

use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\RegistersEventListeners;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\BeforeExport;
use Maatwebsite\Excel\Excel;
use stdClass;

class Kuder implements
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

                //$event->writer->getProperties()->setCreator('Patrick');
                $event->writer->reopen(new \Maatwebsite\Excel\Files\LocalTemporaryFile(storage_path() . '/plantillas/' . 'KUDER.xlsx'), Excel::XLSX);

                $preguntas_excel = $this->listaPreguntas();
                //dd($preguntas_excel);
                $event->getWriter()->getSheetByIndex(0)->setCellValue('E3', $this->postulante->nombre . ' ' . $this->postulante->apellidos);
                $event->getWriter()->getSheetByIndex(0)->setCellValue('E5', (date('Y') - date('Y', strtotime($this->postulante->fecha_nacimiento))));
                $event->getWriter()->getSheetByIndex(0)->setCellValue('K5', date('d/m/Y', strtotime($this->postulante->fecha_nacimiento)));
                // fill with information

                foreach ($this->resultado_test->preguntas as $key => $pregunta) {
                    foreach ($pregunta->respuestas as $i => $respuesta) {
                        if ($i == 0) {
                            if ($respuesta->valor == 'Me gusta') {
                                $event->getWriter()->getSheetByIndex(0)->setCellValue($preguntas_excel[$key]->respuesta[$i]->meGusta, '1');
                            }
                            if ($respuesta->valor == 'No me gusta') {
                                $event->getWriter()->getSheetByIndex(0)->setCellValue($preguntas_excel[$key]->respuesta[$i]->noMeGusta, '1');
                            }
                            //dump($preguntas_excel[$key]->a, '1');
                        }
                        if ($i == 1) {
                            //dump($preguntas_excel[$key]->b, '1');
                            if ($respuesta->valor == 'Me gusta') {
                                $event->getWriter()->getSheetByIndex(0)->setCellValue($preguntas_excel[$key]->respuesta[$i]->meGusta, '1');
                            }
                            if ($respuesta->valor == 'No me gusta') {
                                $event->getWriter()->getSheetByIndex(0)->setCellValue($preguntas_excel[$key]->respuesta[$i]->noMeGusta, '1');
                            }
                        }
                        if ($i == 1) {
                            //dump($preguntas_excel[$key]->b, '1');
                            if ($respuesta->valor == 'Me gusta') {
                                $event->getWriter()->getSheetByIndex(0)->setCellValue($preguntas_excel[$key]->respuesta[$i]->meGusta, '1');
                            }
                            if ($respuesta->valor == 'No me gusta') {
                                $event->getWriter()->getSheetByIndex(0)->setCellValue($preguntas_excel[$key]->respuesta[$i]->noMeGusta, '1');
                            }
                        }
                    }
                }
                //dd($this->resultado_test);
            }
        ];
    }
    public function listaPreguntas()
    {
        $resultado = [];
        $resultado = $this->posicionPag1($resultado);
        $resultado = $this->posicionPag2($resultado);
        $resultado = $this->posicionPag3($resultado);
        $resultado = $this->posicionPag4($resultado);
        $resultado = $this->posicionPag5($resultado);
        $resultado = $this->posicionPag6($resultado);
        $resultado = $this->posicionPag7($resultado);
        $resultado = $this->posicionPag8($resultado);
        return $resultado;
    }
    public function posicionPag1($resultado)
    {
        $row = 1;
        $posicion = 8;
        while ($row <= 104) {
            $pregunta = new stdClass;
            $pregunta->num = $row;
            $aux = 1;

            while ($aux <= 3) {
                $respuesta = new stdClass;
                $respuesta->meGusta = 'B' . $posicion;
                $respuesta->noMeGusta = 'D' . $posicion;
                $pregunta->respuesta[] = $respuesta;
                $aux++;
                $posicion++;
            }
            $posicion++;
            $resultado[] = $pregunta;
            $row++;

            if ($row >= 14) {
                return $resultado;
            }
        }
    }
    public function posicionPag2($resultado)
    {
        $row = 1;
        $posicion = 8;
        while ($row <= 104) {
            $pregunta = new stdClass;
            $pregunta->num = $row;
            $aux = 1;

            while ($aux <= 3) {
                $respuesta = new stdClass;
                $respuesta->meGusta = 'F' . $posicion;
                $respuesta->noMeGusta = 'H' . $posicion;
                $pregunta->respuesta[] = $respuesta;
                $aux++;
                $posicion++;
            }
            $posicion++;
            $resultado[] = $pregunta;
            $row++;

            if ($row >= 14) {
                return $resultado;
            }
        }
    }
    public function posicionPag3($resultado)
    {
        $row = 1;
        $posicion = 8;
        while ($row <= 104) {
            $pregunta = new stdClass;
            $pregunta->num = $row;
            $aux = 1;

            while ($aux <= 3) {
                $respuesta = new stdClass;
                $respuesta->meGusta = 'J' . $posicion;
                $respuesta->noMeGusta = 'L' . $posicion;
                $pregunta->respuesta[] = $respuesta;
                $aux++;
                $posicion++;
            }
            $posicion++;
            $resultado[] = $pregunta;
            $row++;

            if ($row >= 14) {
                return $resultado;
            }
        }
    }
    public function posicionPag4($resultado)
    {
        $row = 1;
        $posicion = 8;
        while ($row <= 104) {
            $pregunta = new stdClass;
            $pregunta->num = $row;
            $aux = 1;

            while ($aux <= 3) {
                $respuesta = new stdClass;
                $respuesta->meGusta = 'N' . $posicion;
                $respuesta->noMeGusta = 'P' . $posicion;
                $pregunta->respuesta[] = $respuesta;
                $aux++;
                $posicion++;
            }
            $posicion++;
            $resultado[] = $pregunta;
            $row++;

            if ($row >= 14) {
                return $resultado;
            }
        }
    }
    public function posicionPag5($resultado)
    {
        $row = 1;
        $posicion = 8;
        while ($row <= 104) {
            $pregunta = new stdClass;
            $pregunta->num = $row;
            $aux = 1;

            while ($aux <= 3) {
                $respuesta = new stdClass;
                $respuesta->meGusta = 'R' . $posicion;
                $respuesta->noMeGusta = 'T' . $posicion;
                $pregunta->respuesta[] = $respuesta;
                $aux++;
                $posicion++;
            }
            $posicion++;
            $resultado[] = $pregunta;
            $row++;

            if ($row >= 14) {
                return $resultado;
            }
        }
    }
    public function posicionPag6($resultado)
    {
        $row = 1;
        $posicion = 8;
        while ($row <= 104) {
            $pregunta = new stdClass;
            $pregunta->num = $row;
            $aux = 1;

            while ($aux <= 3) {
                $respuesta = new stdClass;
                $respuesta->meGusta = 'V' . $posicion;
                $respuesta->noMeGusta = 'X' . $posicion;
                $pregunta->respuesta[] = $respuesta;
                $aux++;
                $posicion++;
            }
            $posicion++;
            $resultado[] = $pregunta;
            $row++;

            if ($row >= 14) {
                return $resultado;
            }
        }
    }
    public function posicionPag7($resultado)
    {
        $row = 1;
        $posicion = 8;
        while ($row <= 104) {
            $pregunta = new stdClass;
            $pregunta->num = $row;
            $aux = 1;

            while ($aux <= 3) {
                $respuesta = new stdClass;
                $respuesta->meGusta = 'Z' . $posicion;
                $respuesta->noMeGusta = 'AB' . $posicion;
                $pregunta->respuesta[] = $respuesta;
                $aux++;
                $posicion++;
            }
            $posicion++;
            $resultado[] = $pregunta;
            $row++;

            if ($row >= 14) {
                return $resultado;
            }
        }
    }
    public function posicionPag8($resultado)
    {
        $row = 1;
        $posicion = 8;
        while ($row <= 104) {
            $pregunta = new stdClass;
            $pregunta->num = $row;
            $aux = 1;

            while ($aux <= 3) {
                $respuesta = new stdClass;
                $respuesta->meGusta = 'AD' . $posicion;
                $respuesta->noMeGusta = 'AF' . $posicion;
                $pregunta->respuesta[] = $respuesta;
                $aux++;
                $posicion++;
            }
            $posicion++;
            $resultado[] = $pregunta;
            $row++;

            if ($row >= 14) {
                return $resultado;
            }
        }
    }
}
