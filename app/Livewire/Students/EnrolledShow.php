<?php

namespace App\Livewire\Students;

use App\Models\Student;
use Livewire\Component;

class EnrolledShow extends Component
{
    public $student;

    public function mount($id)
    {
        $this->student = Student::findOrFail($id);
    }

    public function render()
    {
        return view('livewire.students.enrolled-show');
    }
}

