<?php

namespace App\Exports;

use App\Models\Project;
use Maatwebsite\Excel\Concerns\FromView;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\WithProperties;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;

// File used to export active projects to an investors from a select (modules/projects/_investors_select_project_export)
class ActiveInvestorProjectExport implements FromView, WithProperties, WithEvents
{
   protected $investorId;

    public function __construct($investorId)
    {
        $this->investorId = $investorId;
    }

    public function view(): View
    {
        $projects = Project::where('project_status', 1)
            ->whereHas('investors', function ($query) {
                $query->where('investor_id', $this->investorId);
            })
            ->with('investors')
            ->orderBy('project_name', 'asc')
            ->get();

        return view('modules.projects._report_active_investor_project_excel', [
            'projects' => $projects,
        ]);
    }

    public function properties(): array
    {
        return [
            'title' => 'EXCEL - PROYECTOS ACTIVOS',
            'creator' => 'Investor Insight',
        ];
    }

    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function(AfterSheet $event) {
                $sheet = $event->sheet->getDelegate();
                $startRow = 2; // Inicio de la fila a partir de la cual se realizará el merge
                $endRow = $sheet->getHighestRow(); // Obtener la última fila modificada
                while ($startRow <= $endRow) {
                    $sheet->mergeCells('B' . $startRow . ':D' . $startRow);
                    $startRow += 8;
                }
            },
        ];
    }
}
