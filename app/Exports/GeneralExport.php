<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\WithMultipleSheets;

class GeneralExport implements WithMultipleSheets
{
    public function sheets(): array
    {
        return [
            new ProjectsSheet(),
            new TransfersSheet(),
            new PromissoryNotesSheet(),
        ];
    }
}