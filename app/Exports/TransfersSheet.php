<?php 

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromView;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithTitle;
use Maatwebsite\Excel\Events\AfterSheet;

use App\Models\Transfer;
use App\Models\InvestorFunds;

class TransfersSheet implements FromView, WithEvents, WithTitle
{
    public function view(): View
    {
        $currentMonth = date('m');
        $currentYear = date('Y');

        $founds = InvestorFunds::whereMonth('created_at', $currentMonth)
            ->whereYear('created_at', $currentYear)
            ->get();

        return view('modules.dashboard._transfers_report', [
            'founds' => $founds,
        ]);
    }

    public function title(): string
    {
        return 'MOVIMIENTOS (MES ACTUAL)'; // Nombre de la hoja
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
                    $sheet->mergeCells('B' . $headerStartRow . ':M' . $headerStartRow);
                    $sheet->mergeCells('G' . $startRow . ':M' . $startRow);
                    $startRow++; // Incrementar startRow para evitar bucle infinito
                }
            },
        ];
    }
}
