<?php

namespace App\Livewire\Students;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Student;

class FormOneThreeStudents extends Component
{
    use WithPagination;

    public string $search = '';
    public string $filterGrade = '';
    public string $filterBarangay = '';
    public bool $onlyWithFormOneThree = true;

    protected $paginationTheme = 'tailwind';

    public function updatingSearch() { $this->resetPage(); }
    public function updatingFilterGrade() { $this->resetPage(); }
    public function updatingFilterBarangay() { $this->resetPage(); }
    public function updatingOnlyWithFormOneThree() { $this->resetPage(); }

    public function render()
    {
        $students = Student::query()
            ->when($this->onlyWithFormOneThree, fn ($q) =>
                $q->whereNotNull('form_one_three')->where('form_one_three', '!=', '[]')
            )
            ->when($this->search, function ($query) {
                $query->where(function ($q) {
                    $q->where('first_name', 'like', "%{$this->search}%")
                      ->orWhere('last_name', 'like', "%{$this->search}%");
                });
            })
            ->when($this->filterGrade, fn ($q) => $q->where('grade_level', $this->filterGrade))
            ->when($this->filterBarangay, fn ($q) => $q->where('barangay', $this->filterBarangay))
            ->orderBy('last_name')
            ->paginate(6);

        return view('livewire.students.form-one-three-students', [
            'students' => $students,
            'availableGrades' => Student::distinct()->pluck('grade_level'),
            'availableBarangays' => Student::distinct()->pluck('barangay'),
        ]);
    }
}
