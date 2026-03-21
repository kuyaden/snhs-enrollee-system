<?php

namespace App\Livewire\Charts;

use Livewire\Component;
use App\Models\Student;

class TotalArchivedStudents extends Component
{
    public $archivedStudents;

    protected $listeners = ['student-archived' => 'updateCount'];

    public function mount()
    {
        $this->loadArchivedStudents();
    }

    public function loadArchivedStudents()
    {
        $this->archivedStudents = Student::onlyTrashed()->count();
    }

    public function updateCount()
    {
        $this->loadArchivedStudents();
    }

    public function render()
    {
        return view('livewire.charts.total-archived-students');
    }
}
