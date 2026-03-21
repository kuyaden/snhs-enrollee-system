<?php

namespace App\Livewire\Students;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Student;

class LiveBirthStudents extends Component
{
    use WithPagination;

    public string $search = '';
    public string $filterGrade = '';
    public string $filterBarangay = '';
    public bool $onlyWithLiveBirth = false;

    // Use Tailwind pagination (optional if using Bootstrap)
    protected $paginationTheme = 'tailwind';

    // Reset pagination when filters or search are updated
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

    public function updatingOnlyWithLiveBirth()
    {
        $this->resetPage();
    }

    public function render()
    {
        $students = Student::query()
            ->when($this->onlyWithLiveBirth, fn ($q) => $q->whereNotNull('live_birth'))
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

        return view('livewire.students.live-birth-students', [
            'students' => $students,
            'availableGrades' => Student::distinct()->pluck('grade_level'),
            'availableBarangays' => Student::distinct()->pluck('barangay'),
        ]);
    }
}
