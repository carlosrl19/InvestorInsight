<?php 

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromView;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;
use App\Models\Transfer;

class TransfersSheet implements FromView, WithEvents
{
    public function view(): View
    {
        $currentMonth = date('m');
        $currentYear = date('Y');

        $transfers = Transfer::whereMonth('created_at', $currentMonth)
            ->whereYear('created_at', $currentYear)
            ->where('transfer_bank', '!=', 'FONDOS')
            ->get();

        $totalTransferAmount = Transfer::where('transfer_bank', '!=', 'FONDOS')
            ->whereMonth('created_at', $currentMonth)
            ->whereYear('created_at', $currentYear)
            ->sum('transfer_amount');

        return view('modules.dashboard._transfers_report', [
            'transfers' => $transfers,
            'totalTransferAmount' => $totalTransferAmount,
        ]);
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
                    $sheet->mergeCells('F' . $startRow . ':M' . $startRow);
                    $startRow++; // Incrementar startRow para evitar bucle infinito
                }
            },
        ];
    }
}
