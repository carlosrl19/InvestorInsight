<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithTitle;
use Maatwebsite\Excel\Events\AfterSheet;
use Illuminate\Contracts\View\View;

use App\Models\Investor;

class InvestorsSheet implements FromView, WithEvents, WithTitle
{
    public function view(): View
    {
        $investors = Investor::where('investor_name', '!=', 'PIVOTE')
            ->orderBy('investor_balance','desc')
            ->get();

        return view('modules.dashboard._investors_report', [
            'investors' => $investors,
        ]);
    }

    public function title(): string
    {
        return 'INVERSIONISTAS'; // Nombre de la hoja
    }

    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function(AfterSheet $event) {
                $sheet = $event->sheet->getDelegate();
                $startRow = 4; // Inicio de la fila a partir de la cual se realizará el merge
                $headerStartRow = 2;
                $endRow = $sheet->getHighestRow();

                while ($startRow <= $endRow) {
                    $sheet->mergeCells('B' . $headerStartRow . ':F' . $headerStartRow);
                    $sheet->mergeCells('C' . $startRow . ':D' . $startRow);
                    $startRow++; // Incrementar startRow para evitar bucle infinito
                }
            },
        ];
    }
}
