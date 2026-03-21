<?php

namespace App\Livewire\Students;

use App\Models\Student;
use Livewire\Component;

class BarangayList extends Component
{
    public $search = '';

    public function render()
    {
        $students = Student::query()
            ->when($this->search, function ($query) {
                $query->where(function ($q) {
                    $q->where('first_name', 'ILIKE', '%' . $this->search . '%')
                      ->orWhere('last_name', 'ILIKE', '%' . $this->search . '%')
                      ->orWhere('middle_name', 'ILIKE', '%' . $this->search . '%')
                      ->orWhere('barangay', 'ILIKE', '%' . $this->search . '%');
                });
            })
            ->orderBy('barangay')
            ->orderBy('last_name')
            ->get();

        $groupedStudents = $students->groupBy('barangay');

        return view('livewire.students.barangay-list', [
            'groupedStudents' => $groupedStudents
        ]);
    }
}
