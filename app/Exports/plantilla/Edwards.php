<?php

namespace App\Exports\plantilla;

use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\RegistersEventListeners;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\BeforeExport;
use Maatwebsite\Excel\Excel;

class Edwards implements
WithEvents
{
    private $tests;
    public function __construct($tests)
    {
        $this->tests = $tests;
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
                //dd($this->proyectos);
                // fill with information
                $event->getWriter()->getSheetByIndex(0)->setCellValue('G3', 'ALISTIVEN');
                $row = 8;
                $this->tests = [1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15];
                $grupo = 1;
                foreach ($this->tests as $i => $test) {
                    switch ($grupo) {
                        case 1:
                            $event->getWriter()->getSheetByIndex(0)->setCellValue('A' . $row, '1');
                            $event->getWriter()->getSheetByIndex(0)->setCellValue('C' . $row, '');
                            break;
                        case 2:
                            $event->getWriter()->getSheetByIndex(0)->setCellValue('E' . $row, '1');
                            $event->getWriter()->getSheetByIndex(0)->setCellValue('G' . $row, '');
                            break;
                        case 3:
                            $event->getWriter()->getSheetByIndex(0)->setCellValue('M' . $row, '1');
                            $event->getWriter()->getSheetByIndex(0)->setCellValue('O' . $row, '1');
                            break;
                        default:
                            # code...
                            break;
                    }
                    $row++;
                    if ($i / 5 == 1) {
                        //dd($i / 5 );
                        $row = 8;
                        $grupo++;
                    }
                }
            },

        ];
    }
    /*  public static function beforeExport(BeforeExport $event)
    {
    // get your template file
    //dd(public_path() . '/plantilla/' . 'report_compare.xlsx');
    $event->writer->reopen(new \Maatwebsite\Excel\Files\LocalTemporaryFile(public_path() . '/plantilla/' . 'report_compare.xlsx'), Excel::XLSX);
    $event->writer->getSheetByIndex(0);
    //dd($this->proyectos);
    // fill with information
    //$event->getWriter()->getSheetByIndex(0)->setCellValue('A1', 'Some Information');
    //$event->getWriter()->getSheetByIndex(0)->setCellByColumnAndRow([1, 3],'aqui va la fecha');
    $event->getWriter()->getSheetByIndex(0)->setCellValue('C1', date('m/d/Y'));
    $row = 5;
    foreach ($this->proyectos as $i => $proyecto) {
    $event->getWriter()->getSheetByIndex(0)->setCellValue('A' . $row, $proyecto);
    $row++;
    }
    return $event->getWriter()->getSheetByIndex(0);
    } */
    /* public function collection()
    {
    $collection = collect($this->proyecto);
    return $collection;
    }
    public function headings(): array
    {
    return [
    'Building',
    'Floor',
    'Cod Area',
    'Area',
    'SOV Code',
    'SOV Task',
    'Price',
    '% Completed',
    '% Date Las Record',
    'To Bill Acording % Completed',
    ];
    }

    public function registerEvents(): array
    {
    return [
    AfterSheet::class => function (AfterSheet $event) {
    $event->sheet->setCellValue('A1', '$this->proyecto->Codigo');
    $event->sheet->setCellValue('B1', '$this->proyecto->Nombre');
    $event->sheet->mergeCells('B1:J1');
    //size
    $event->sheet->getColumnDimension('I')->setAutoSize(false);
    $event->sheet->getColumnDimension('H')->setAutoSize(false);
    $event->sheet->getColumnDimension('G')->setAutoSize(false);
    $event->sheet->getColumnDimension('J')->setAutoSize(false);

    $event->sheet->getColumnDimension('G')->setWidth(16);
    $event->sheet->getColumnDimension('H')->setWidth(15);
    $event->sheet->getColumnDimension('E')->setWidth(15);
    $event->sheet->getColumnDimension('I')->setWidth(20);
    $event->sheet->getColumnDimension('J')->setWidth(15);

    $event->sheet->getStyle('A2:J2')->applyFromArray([
    'alignment' => [
    'wrapText' => true,
    ],
    ]);
    $event->sheet->getStyle('A1:I1')->applyFromArray([
    'font' => [
    'bold' => true,
    'size' => 12,
    ],
    'alignment' => [
    'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
    ],
    ]);
    $event->sheet->getStyle('A2:j2')->applyFromArray([
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
    ]);
    },
    ];
    }
    public function columnFormats(): array
    {
    return [
    'H' => NumberFormat::FORMAT_PERCENTAGE,
    //'C' => NumberFormat::FORMAT_NUMBER,
    ];
    } */
    public function startCell(): string
    {
        return 'A2';
    }
}
