<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;
use Maatwebsite\Excel\Concerns\WithCustomStartCell;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Events\AfterSheet;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;

class exportSeleccionUnicaPlantilla implements
    FromCollection,
    ShouldAutoSize,
    WithHeadings,
    WithEvents,
    WithCustomStartCell,
    WithColumnFormatting
{
    private $test;
    private $preguntas;

    public function __construct($test, $preguntas)
    {
        $this->test = $test;
        $this->preguntas = $preguntas;
    }
    use Exportable;
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        /* return response()->json([
            'data' => $preguntasExport,
        ], 200); */
        $collection = collect($this->preguntas);
        return $collection;
    }
    public function headings(): array
    {
        return [
            '',
            '',
            ''
        ];
    }

    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function (AfterSheet $event) {
                $event->sheet->mergeCells('A1:D1');
                $event->sheet->setCellValue('A1', 'RESULTADO DE TEST '.$this->test->nombreTest);
                $event->sheet->mergeCells('B2:D2');
                $event->sheet->setCellValue('A2', "NOMBRE Y APELLIDOS:");
                $event->sheet->setCellValue('B2', $this->test->nombre . " "  . $this->test->nombre);

                $event->sheet->mergeCells('B3:D3');
                $event->sheet->setCellValue('A3', "NOMBRE TEST: ");
                $event->sheet->setCellValue('B3',  $this->test->nombreCargo);
                $event->sheet->mergeCells('B4:D4');
                $event->sheet->setCellValue('A4', "FECHA REALIZACION:");
                $event->sheet->setCellValue('B4', $this->test->resultados_test->fecha_inicio);

                //size
                $event->sheet->getColumnDimension('I')->setAutoSize(false);
                $event->sheet->getColumnDimension('H')->setAutoSize(false);
                /* $event->sheet->getColumnDimension('G')->setAutoSize(false); */
                $event->sheet->getColumnDimension('J')->setAutoSize(false);

                /* $event->sheet->getColumnDimension('G')->setWidth(16); */
                $event->sheet->getColumnDimension('H')->setWidth(15);
                $event->sheet->getColumnDimension('E')->setWidth(15);
                $event->sheet->getColumnDimension('I')->setWidth(20);
                $event->sheet->getColumnDimension('J')->setWidth(15);

                /* $event->sheet->getStyle('A2:D2')->applyFromArray([
                    'alignment' => [
                        'wrapText' => true,
                    ],
                ]); */
                $event->sheet->getStyle('A1:D1')->applyFromArray([
                    'font' => [
                        'bold' => true,
                        'size' => 12,
                    ],
                    'alignment' => [
                        'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
                    ],
                ]);
               /*  $event->sheet->getStyle('A6:D6')->applyFromArray([
                    'borders' => [
                        'allBorders' => [
                            'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                            'color' => ['rgb' => '030303'],
                        ],
                    ],
                    'alignment' => [
                        'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
                    ],
                    'fill' => [
                        'color' => array('rgb' => 'd6d6d6'),
                    ],
                ]); */
            },
        ];
    }
    public function columnFormats(): array
    {
        return [
            'H' => NumberFormat::FORMAT_PERCENTAGE,
            //'C' => NumberFormat::FORMAT_NUMBER,
        ];
    }
    public function startCell(): string
    {
        return 'E6';
    }
}
