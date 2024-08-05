<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithTitle;
use Maatwebsite\Excel\Events\AfterSheet;
use Illuminate\Contracts\View\View;
use App\Models\PromissoryNote;
use App\Models\PromissoryNoteCommissioner;

class PromissoryNotesSheet implements FromView, WithEvents, WithTitle
{
    public function view(): View
    {
        $promissory_notes = PromissoryNote::where('promissoryNote_status', 1)
            ->get();
        
        $promissory_notes_commissioners = PromissoryNoteCommissioner::where('promissoryNoteCommissioner_status', 1)
            ->get();
        
        $totalPromissoriesAmount = PromissoryNote::where('promissoryNote_status', 1)
            ->sum('promissoryNote_amount');
        
        $totalPromissoriesCommissionerAmount = PromissoryNoteCommissioner::where('promissoryNoteCommissioner_status', 1)
            ->sum('promissoryNoteCommissioner_amount');


        return view('modules.dashboard._promissory_notes_report', [
            'promissory_notes' => $promissory_notes,
            'promissory_notes_commissioners' => $promissory_notes_commissioners,
            'totalPromissoriesAmount' => $totalPromissoriesAmount,
            'totalPromissoriesCommissionerAmount' => $totalPromissoriesCommissionerAmount,
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

                // Buscar la fila que contiene el texto específico
                for ($row = 1; $row <= $endRow; $row++) {
                    $cellValue = $sheet->getCell('B' . $row)->getValue();
                    if ($cellValue === 'PAGARES ACTUALES A FAVOR DE COMISIONISTAS') {
                        // Realizar el merge de B a F en la fila encontrada
                        $sheet->mergeCells('B' . $row . ':F' . $row);
                        $sheet->getStyle('B' . $row . ':F' . $row)->applyFromArray([
                            'font' => [
                                'bold' => true,
                                'size' => 16,
                            ],
                            'alignment' => [
                                'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
                            ],
                            /*
                            'fill' => [
                                'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
                                'startColor' => ['argb' => 'FFFFFF00'], // Color de fondo (ejemplo)
                            ], */
                        ]);
                        break; // Salir del bucle una vez encontrado
                    }
                }
            },
        ];
    }
}
