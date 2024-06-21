<?php

namespace App\Exports;

use App\Models\Project;
use Maatwebsite\Excel\Concerns\FromView;
use Illuminate\Contracts\View\View;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use Maatwebsite\Excel\Concerns\WithProperties;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;

class CustomExport implements FromView, WithProperties, WithEvents
{
    protected $projectId;

    public function __construct($projectId)
    {
        $this->projectId = $projectId;
    }

    public function view(): View
    {
        $project = Project::findOrFail($this->projectId);

        return view('modules.projects._report_excel', [
            'project' => $project,
            'investors' => $project->investors,
            'commissioners' => $project->commissioners,
        ]);
    }

    public function properties(): array
    {
        return [
            'title' => 'EXCEL DE PROYECTO',
            'creator' => 'Investor Insight',
        ];
    }

    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function(AfterSheet $event) {
                $sheet = $event->sheet->getDelegate();
                $sheet->mergeCells('B2:D2'); // La celda B2 llega hasta la celda D2

                // Protection / Security disabled
                // $sheet->getProtection()->setPassword('invest24_'); // Set password
                // $event->sheet->getProtection()->setSheet(true); // Set protection to excel
            },
        ];
    }
}