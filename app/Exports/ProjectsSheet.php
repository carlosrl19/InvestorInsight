<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromView;
use Illuminate\Contracts\View\View;
use App\Models\Project;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithTitle;
use Maatwebsite\Excel\Events\AfterSheet;

class ProjectsSheet implements FromView, WithEvents, WithTitle
{
    public function view(): View
    {
        $projects = Project::with('investors')
            ->where('project_status', 1)
            ->get()
            ->sortBy(function ($project) {
                return $project->investors->pluck('investor_name')->join(',');
            });

        $totalProjectInvestment = Project::where('project_status', 1)
            ->get()
            ->sum('project_investment');

        return view('modules.dashboard._projects_report', [
            'projects' => $projects,
            'totalProjectInvestment' => $totalProjectInvestment,
        ]);
    }

    public function title(): string
    {
        return 'INVERSION PROYECTOS'; // Nombre de la hoja
    }

    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function(AfterSheet $event) {
                $sheet = $event->sheet->getDelegate();
                $startRow = 5; // Inicio de la fila a partir de la cual se realizará el merge
                $headerStartRow = 2;
                $headerInvestorName = 4;
                $endRow = $sheet->getHighestRow();

                while ($startRow <= $endRow) {
                    $sheet->mergeCells('B' . $headerStartRow . ':H' . $headerStartRow);
                    $sheet->mergeCells('D' . $startRow . ':E' . $startRow);
                    $sheet->mergeCells('D' . $headerInvestorName . ':E' . $headerInvestorName);
                    $startRow++; // Incrementar startRow para evitar bucle infinito
                }
            },
        ];
    }
}
