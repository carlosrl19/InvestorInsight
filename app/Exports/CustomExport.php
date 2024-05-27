<?php

namespace App\Exports;

use App\Models\Project;
use Maatwebsite\Excel\Concerns\FromView;
use Illuminate\Contracts\View\View;
use PhpOffice\PhpSpreadsheet\Style\Color;

class CustomExport implements FromView
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
}