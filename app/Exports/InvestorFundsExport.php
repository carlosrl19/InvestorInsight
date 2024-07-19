<?php

namespace App\Exports;

use App\Models\Investor;
use Maatwebsite\Excel\Concerns\FromView;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\WithProperties;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;
use Maatwebsite\Excel\Events\AfterSheet;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;

class InvestorFundsExport implements FromView, WithProperties, WithEvents, WithColumnFormatting
{
    protected $investorId;

    public function __construct($investorId)
    {
        $this->investorId = $investorId;
    }

    public function view(): View
    {
        $investor = Investor::findOrFail($this->investorId);

        return view('modules.investors_funds._report_excel', [
            'investor' => $investor,
            'investor_funds' => $investor->investor_funds,
        ]);
    }

    public function properties(): array
    {
        return [
            'title' => 'HISTORIAL DE MOVIMIENTOS EN FONDOS',
            'creator' => 'Investor Insight',
        ];
    }

    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function(AfterSheet $event) {
                $sheet = $event->sheet->getDelegate();
                $sheet->mergeCells('B2:H2'); // La celda B2 llega hasta la celda H2
                
                $startRow = 5; // Inicio de la fila a partir de la cual se realizará el merge
                $endRow = $sheet->getHighestRow(); // Obtener la última fila modificada
                while ($startRow <= $endRow) {
                    $sheet->mergeCells('F' . $startRow . ':H' . $startRow);
                    $startRow += 1;
                }
            },
        ];
    }

    public function columnFormats(): array
    {
        return [
            'B' => NumberFormat::FORMAT_DATE_DDMMYYYY, // Date Column
            'C' => NumberFormat::FORMAT_NUMBER_00,     // Movement
            'D' => NumberFormat::FORMAT_NUMBER_00,     // Previous Fund
            'E' => NumberFormat::FORMAT_NUMBER_00,     // Final Fund
        ];
    }
}
