<?php

namespace App\Livewire\Students;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Student;

class SchoolFormsSf1 extends Component
{
    use WithPagination;

    public $filterGrade = '';
    protected $paginationTheme = 'tailwind';

    public function updatingFilterGrade() { $this->resetPage(); }

    public function getAvailableGradesProperty()
    {
        return Student::select('grade_level')
            ->distinct()
            ->pluck('grade_level')
            ->sort()
            ->values();
    }

    public function render()
    {
        $students = Student::query()
            ->when($this->filterGrade, fn($q) => $q->where('grade_level', $this->filterGrade))
            ->orderBy('last_name')
            ->paginate(10);

        return view('livewire.students.school-forms-sf1', [
            'students' => $students,
            'availableGrades' => $this->availableGrades,
        ]);
    }
}
