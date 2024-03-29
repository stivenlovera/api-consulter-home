<?php

namespace App\Exports\plantilla;

use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\RegistersEventListeners;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\BeforeExport;
use Maatwebsite\Excel\Excel;
use stdClass;

class Eysenck implements
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
                $event->writer->reopen(new \Maatwebsite\Excel\Files\LocalTemporaryFile(storage_path() . '/plantillas/' . 'EYSENCK FORMA B-.xlsx'), Excel::XLSX);
                $event->writer->getSheetByIndex(0);
                $preguntas_excel = $this->listaPreguntas();
                //dd($this->resultado_test,$this->postulante);
                $event->getWriter()->getSheetByIndex(0)->setCellValue('E4', $this->postulante->nombre . ' ' . $this->postulante->apellidos);
                $event->getWriter()->getSheetByIndex(0)->setCellValue('H4', (date('Y') - date('Y', strtotime($this->postulante->fecha_nacimiento))));
                $event->getWriter()->getSheetByIndex(0)->setCellValue('E6', date('d/m/Y', strtotime($this->postulante->fecha_nacimiento)));
                // fill with information
               
                foreach ($this->resultado_test->preguntas as $key => $pregunta) {
                    foreach ($pregunta->respuestas as $i => $respuesta) {
                        if ($i == 0) {
                            if ($respuesta->valor == '1') {
                                $event->getWriter()->getSheetByIndex(0)->setCellValue( $preguntas_excel[$key]->si, '1');
                            }
                            //dump($preguntas_excel[$key]->a, '1');
                        }
                        if ($i == 1) {
                            //dump($preguntas_excel[$key]->b, '1');
                            if ($respuesta->valor == '1') {
                                $event->getWriter()->getSheetByIndex(0)->setCellValue($preguntas_excel[$key]->no, '1');
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
        $resultado = [];
        $row = 13;
        while ($row <= 69) {
            $posisiones = new stdClass;
            $posisiones->si='H'.$row;
            $posisiones->no='I'.$row;
            $resultado[] = $posisiones;
            $row++;
        }

        return $resultado;
    }
}
