<?php

namespace App\Exports;

use App\Models\Project;
use App\Models\Transfer;
use App\Models\CreditNote;
use App\Models\PromissoryNote;
use App\Models\PromissoryNoteCommissioner;
use Maatwebsite\Excel\Concerns\FromView;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\WithProperties;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;

class GeneralExport implements FromView, WithProperties, WithEvents
{
    public function view(): View
    {
        $currentMonth = date('m');
        $currentYear = date('Y');

        $projects = Project::with('investors')
            ->whereMonth('created_at', $currentMonth)
            ->whereYear('created_at', $currentYear)
            ->get()
            ->sortBy(function ($project) {
                return $project->investors->pluck('investor_name')->join(',');
            });

        $promissory_notes = PromissoryNote::whereMonth('created_at', $currentMonth)
            ->whereYear('created_at', $currentYear)
            ->get();

        $promissory_notes_commissioner = PromissoryNoteCommissioner::whereMonth('created_at', $currentMonth)
            ->whereYear('created_at', $currentYear)
            ->get();

        $transfers = Transfer::whereMonth('created_at', $currentMonth)
            ->whereYear('created_at', $currentYear)
            ->where('transfer_bank', '!=', 'FONDOS')
            ->get();

        $totalTransferAmount = Transfer::where('transfer_bank', '!=', 'FONDOS')
            ->whereMonth('created_at', $currentMonth)
            ->whereYear('created_at', $currentYear)
            ->sum('transfer_amount');

        $credit_notes = CreditNote::whereMonth('created_at', $currentMonth)
            ->whereYear('created_at', $currentYear)
            ->get();

        return view('modules.dashboard._general_report', [
            'projects' => $projects,
            'transfers' => $transfers,
            'totalTransferAmount' => $totalTransferAmount,
            'credit_notes' => $credit_notes,
            'promissory_notes' => $promissory_notes,
            'promissory_notes_commissioner' => $promissory_notes_commissioner,
        ]);
    }

    public function properties(): array
    {
        return [
            'title' => 'REPORTE GENERAL',
            'creator' => 'Investor Insight',
        ];
    }

    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function(AfterSheet $event) {
                $sheet = $event->sheet->getDelegate();
                $startRow = 5; // Inicio de la fila a partir de la cual se realizará el merge
                $headerStartRow = 2;
                $endRow = $sheet->getHighestRow();

                while ($startRow <= $endRow) {
                    $sheet->mergeCells('B' . $headerStartRow . ':H' . $headerStartRow);
                    $startRow++; // Incrementar startRow para evitar bucle infinito
                }
            },
        ];
    }
}