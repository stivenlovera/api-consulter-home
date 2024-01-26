<?php

namespace App\Exports\plantilla;

use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\RegistersEventListeners;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\BeforeExport;
use Maatwebsite\Excel\Excel;
use stdClass;

class Edwards implements
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
                $event->writer->reopen(new \Maatwebsite\Excel\Files\LocalTemporaryFile(storage_path() . '/plantillas/' . 'EDWARD CUESTIONARIO-SOFTWARE.xlsx'), Excel::XLSX);
                $event->writer->getSheetByIndex(0);
                //dd($this->resultado_test,$this->postulante);
                $event->getWriter()->getSheetByIndex(0)->setCellValue('G3', $this->postulante->nombre.' '.$this->postulante->apellidos);
                $event->getWriter()->getSheetByIndex(0)->setCellValue('AC3', (date('Y')-date('Y', strtotime($this->postulante->fecha_nacimiento))));
                $event->getWriter()->getSheetByIndex(0)->setCellValue('AU3', date('d/m/Y', strtotime($this->postulante->fecha_nacimiento)));
                // fill with information
                $preguntas_excel = $this->listaPreguntas();
                foreach ($this->resultado_test->preguntas as $key => $pregunta) {
                    foreach ($pregunta->respuestas as $i => $respuesta) {
                        if ($i == 0) {
                            if ($respuesta->valor == '1') {
                                $event->getWriter()->getSheetByIndex(0)->setCellValue($preguntas_excel[$key]->a, '1');
                            }
                            //dump($preguntas_excel[$key]->a, '1');

                        }
                        if ($i == 1) {
                            //dump($preguntas_excel[$key]->b, '1');
                            if ($respuesta->valor == '1') {
                                $event->getWriter()->getSheetByIndex(0)->setCellValue($preguntas_excel[$key]->b, '1');
                            }
                        }
                    }
                }
                //dd($this->resultado_test);

            },

        ];
    }
    public function listaPreguntas()
    {
        //columna
        $columnas = [
            array('A', 'C'),
            array('E', 'G'),
            array('I', 'K'),
            array('M', 'O'),
            array('Q', 'S'),
            array('U', 'W'),
            array('Y', 'AA'),
            array('AC', 'AE'),
            array('AG', 'AI'),
            array('AK', 'AM'),
            array('AO', 'AQ'),
            array('AS', 'AU'),
            array('AW', 'AY'),
            array('BA', 'BC'),
            array('BE', 'BG'),
        ];

        //dd($columnas);
        $resultado = [];
        $resultado = $this->pregunta75($columnas, $resultado);
        $resultado = $this->pregunta150($columnas, $resultado);
        $resultado = $this->pregunta225($columnas, $resultado);

        return $resultado;
    }
    public function pregunta75($columnas, $resultado)
    {
        $fila = 1;
        while ($fila <= 5) {
            foreach ($columnas as $key => $columna) {
                $row = 8;
                while ($row <= 12) {
                    $posisiones = new stdClass;
                    $posisiones->a = $columna[0] . $row;
                    $posisiones->b = $columna[1] . $row;
                    $resultado[] = $posisiones;
                    $row++;
                }
                if ($key >= 14) {
                    return $resultado;
                }
            }
            $fila++;
        }
    }
    public function pregunta150($columnas, $resultado)
    {
        $fila = 1;
        while ($fila <= 5) {
            foreach ($columnas as $key => $columna) {
                $row = 16;
                while ($row <= 20) {
                    $posisiones = new stdClass;
                    $posisiones->a = $columna[0] . $row;
                    $posisiones->b = $columna[1] . $row;
                    $resultado[] = $posisiones;
                    $row++;
                }
                if ($key >= 14) {
                    return $resultado;
                }
            }
            $fila++;
        }
    }
    public function pregunta225($columnas, $resultado)
    {
        $fila = 1;
        while ($fila <= 5) {
            foreach ($columnas as $key => $columna) {
                $row = 24;
                while ($row <= 28) {
                    $posisiones = new stdClass;
                    $posisiones->a = $columna[0] . $row;
                    $posisiones->b = $columna[1] . $row;
                    $resultado[] = $posisiones;
                    $row++;
                }
                if ($key >= 14) {
                    return $resultado;
                }
            }
            $fila++;
        }
    }
}
