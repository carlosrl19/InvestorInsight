<?php

namespace App\Exports;

use App\Models\Project;
use Maatwebsite\Excel\Concerns\FromView;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\WithProperties;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;

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
            ->orderBy('project_investment', 'desc')
            ->get();

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
                $sheet->mergeCells('B2:D2'); // La celda B2 llega hasta la celda D2
            },
        ];
    }
}
