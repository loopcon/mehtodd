<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;


class KeywordExport implements FromArray, WithHeadings, WithStyles, WithEvents
{
    use Exportable;

    protected $dataArray;
    protected $color_name;

    public function __construct(array $dataArray, string $color_name)
    {
        $this->dataArray = $dataArray;
        $this->color_name = $color_name;
    }

    public function array(): array
    {
        return $this->dataArray;
    }

    public function headings(): array
    {
        $headers = $this->dataArray[0];
        unset($this->dataArray[0]);
        return $headers;
    }

    public function styles(Worksheet $sheet)
    {
        return [
            1 => [
                'font' => [
                    'bold' => true,
                    'color' => ['argb' => 'FFA500'], // Set the font color to orange
                ],
            ],
        ];
    }

    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function (AfterSheet $event) {
                $spreadsheet = $event->sheet->getDelegate();
                $maxRow = $spreadsheet->getHighestDataRow();
                $maxColumn = $spreadsheet->getHighestDataColumn();
                $maxColumnIndex = \PhpOffice\PhpSpreadsheet\Cell\Coordinate::columnIndexFromString($maxColumn);

                $previousRow = [];
                for ($row = 2; $row <= $maxRow; $row++) {
                    $currentRow = [];
                    for ($column = 1; $column <= $maxColumnIndex; $column++) {
                        $cell = $spreadsheet->getCellByColumnAndRow($column, $row);
                        $currentRow[] = !empty($cell->getValue());
                    }

                    for ($column = 1; $column <= $maxColumnIndex; $column++) {
                        if ($currentRow[$column - 1] && empty($previousRow[$column - 1])) {
                            // Set the font color to red for non-empty cells with an empty cell above them
                            $cell = $spreadsheet->getCellByColumnAndRow($column, $row);
                            $cell->getStyle()->getFont()->getColor()->setRGB($this->color_name);
                        }
                    }

                    $previousRow = $currentRow;
                }
            },
        ];
    }
    public function columnWidths(): array
    {
        prx(12);
        return [
            'A' => 50, // Set the width of column A
            'B' => 50, // Set the width of column B
            'C' => 50, // Set the width of column C
        ];
    }
}
