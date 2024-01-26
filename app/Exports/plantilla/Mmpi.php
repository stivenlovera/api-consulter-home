<?php

namespace App\Exports\plantilla;

use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\RegistersEventListeners;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\BeforeExport;
use Maatwebsite\Excel\Excel;
use stdClass;

class Mmpi implements
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
                $event->writer->reopen(new \Maatwebsite\Excel\Files\LocalTemporaryFile(storage_path() . '/plantillas/' . 'MMPI-SOFTWARE.xlsx'), Excel::XLSX);
                $event->writer->getSheetByIndex(0);
                $preguntas_excel = $this->listaPreguntas();
                //dd($preguntas_excel);
                //dd($this->resultado_test,$this->postulante);
                // fill with information
               
                foreach ($this->resultado_test->preguntas as $key => $pregunta) {
                    foreach ($pregunta->respuestas as $i => $respuesta) {
                        if ($i == 0) {
                            if ($respuesta->valor == '1') {
                                $event->getWriter()->getSheetByIndex(0)->setCellValue( $preguntas_excel[$key]->cierto, '1');
                            }
                            //dump($preguntas_excel[$key]->a, '1');
                        }
                        if ($i == 1) {
                            //dump($preguntas_excel[$key]->b, '1');
                            if ($respuesta->valor == '1') {
                                $event->getWriter()->getSheetByIndex(0)->setCellValue($preguntas_excel[$key]->falso, '1');
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
        $row = 2;
        while ($row <= 77) {
            $posisiones = new stdClass;
            $posisiones->cierto='C'.$row;
            $posisiones->falso='D'.$row;
            $resultado[] = $posisiones;
            $row++;
        }

        return $resultado;
    }
}
