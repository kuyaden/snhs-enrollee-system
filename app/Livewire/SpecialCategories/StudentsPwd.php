<?php

namespace App\Livewire\SpecialCategories;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Student;

class StudentsPwd extends Component
{
    use WithPagination;

    public $search = '';
    public $filterGrade = '';
    public $filterBarangay = '';

    protected $paginationTheme = 'tailwind';

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function updatingFilterGrade()
    {
        $this->resetPage();
    }

    public function updatingFilterBarangay()
    {
        $this->resetPage();
    }

    public function getAvailableGradesProperty()
    {
        return Student::select('grade_level')
            ->distinct()
            ->pluck('grade_level')
            ->sort()
            ->values();
    }

    public function getAvailableBarangaysProperty()
    {
        return Student::select('barangay')
            ->distinct()
            ->pluck('barangay')
            ->sort()
            ->values();
    }

    public function render()
{
    $students = Student::query()
        ->whereNotNull('pwd')
        ->where('pwd', '!=', 'None')
        ->when($this->filterGrade, fn($q) => $q->where('grade_level', $this->filterGrade))
        ->when($this->filterBarangay, fn($q) => $q->where('barangay', $this->filterBarangay))
        ->where(function ($query) {
            $query->where('first_name', 'like', '%' . $this->search . '%')
                ->orWhere('middle_name', 'like', '%' . $this->search . '%')
                ->orWhere('last_name', 'like', '%' . $this->search . '%');
        })
        ->orderBy('last_name')
        ->paginate(10);

    return view('livewire.special-categories.students-pwd', [
        'students' => $students,
        'availableGrades' => $this->availableGrades,
        'availableBarangays' => $this->availableBarangays,
    ]);
}

}
