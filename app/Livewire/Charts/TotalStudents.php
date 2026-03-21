<?php

namespace App\Livewire\Charts;

use Livewire\Component;
use App\Models\Student;

class TotalStudents extends Component
{
    public $totalStudents;

    protected $listeners = ['student-added' => 'updateCount'];

    public function mount()
    {
        $this->loadTotalStudents();
    }

    public function loadTotalStudents()
    {
        $this->totalStudents = Student::count();
    }

    public function updateCount()
    {
        $this->loadTotalStudents();
    }

    public function render()
    {
        return view('livewire.charts.total-students');
    }
}
