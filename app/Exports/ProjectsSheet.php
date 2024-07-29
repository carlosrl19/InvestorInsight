<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromView;
use Illuminate\Contracts\View\View;
use App\Models\Project;

class ProjectsSheet implements FromView
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

        $totalProjectInvestment = Project::with('investors')
            ->whereMonth('created_at', $currentMonth)
            ->whereYear('created_at', $currentYear)
            ->get()
            ->sum('project_investment');

        return view('modules.dashboard._projects_report', [
            'projects' => $projects,
            'totalProjectInvestment' => $totalProjectInvestment,
        ]);
    }
}
