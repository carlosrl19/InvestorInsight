<?php

namespace App\Exports;

use App\Models\Project;
use App\Models\Investor;
use Maatwebsite\Excel\Concerns\FromView;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\WithProperties;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;

// File used to export active projects to all investors with active projects
class ActiveProjectsExport implements FromView, WithProperties, WithEvents
{
    public function view(): View
    {
        // Obtener los proyectos con sus inversores
        $projects = Project::with('investors')
            ->where('project_status', 1)
            ->get()
            ->sortBy(function ($project) {
                return $project->investors->pluck('investor_name')->join(',');
            });

        return view('modules.projects._report_active_projects_excel', [
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
