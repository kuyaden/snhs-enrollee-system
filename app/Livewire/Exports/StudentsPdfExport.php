<?php

namespace App\Livewire\Exports;

use Livewire\Component;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\Student;

class StudentsPdfExport extends Component
{
    public function export()
    {
        $students = Student::orderBy('last_name')->get();

        $pdf = Pdf::loadView('exports.students-pdf', compact('students'))
            ->setPaper('a4', 'landscape');

        return response()->streamDownload(
            fn() => print($pdf->output()),
            'students_report.pdf'
        );
    }

    public function render()
    {
        // ⚠️ this should not contain the students table
        return view('livewire.exports.students-pdf-export');
    }
}
