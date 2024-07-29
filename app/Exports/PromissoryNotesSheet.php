<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithTitle;
use Maatwebsite\Excel\Events\AfterSheet;
use Illuminate\Contracts\View\View;
use App\Models\PromissoryNote;

class PromissoryNotesSheet implements FromView, WithEvents, WithTitle
{
    public function view(): View
    {
        $currentMonth = date('m');
        $currentYear = date('Y');

        $promissory_notes = PromissoryNote::whereMonth('created_at', $currentMonth)
            ->whereYear('created_at', $currentYear)
            ->get();
        
        $totalPromissoriesAmount = PromissoryNote::whereMonth('created_at', $currentMonth)
            ->whereYear('created_at', $currentYear)
            ->sum('promissoryNote_amount');


        return view('modules.dashboard._promissory_notes_report', [
            'promissory_notes' => $promissory_notes,
            'totalPromissoriesAmount' => $totalPromissoriesAmount,
        ]);
    }

    public function title(): string
    {
        return 'PAGARES (PENDIENTES)'; // Nombre de la hoja
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
                    $startRow++; // Incrementar startRow para evitar bucle infinito
                }
            },
        ];
    }
}
