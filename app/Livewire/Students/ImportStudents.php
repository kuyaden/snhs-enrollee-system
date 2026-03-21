<?php

namespace App\Livewire\Students;

use Livewire\Component;
use Livewire\WithFileUploads;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\StudentsImport;

class ImportStudents extends Component
{
    use WithFileUploads;

    public $file;

    protected $rules = [
        'file' => 'required|file|mimes:xlsx,xls'
    ];

    public function import()
    {
        $this->validate();

        // Import. Use getRealPath() so Laravel Excel reads the temp file.
        Excel::import(new StudentsImport, $this->file->getRealPath());

        // Emit an event so the enrolled list component can refresh instantly
        $this->emit('studentsImported');

        // Reset file input
        $this->reset('file');

        // flash success for toast
        session()->flash('success', 'Students imported successfully!');
    }

    public function render()
    {
        return view('livewire.students.import-students');
    }
}
