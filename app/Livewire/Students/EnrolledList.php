<?php

namespace App\Livewire\Students;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Student;

class EnrolledList extends Component
{
    use WithPagination;

    public $search = '';
    public $filterYear = '';
    public $filterGrade = '';
    public $filterBarangay = '';
    public $filterSex = '';
    public $showArchived = false; // ✅ toggle between active & archived
    public $studentToDelete = null;

    protected $paginationTheme = 'tailwind';

    // 🔄 Reset pagination on filter/search update
    public function updatingSearch() { $this->resetPage(); }
    public function updatingFilterYear() { $this->resetPage(); }
    public function updatingFilterGrade() { $this->resetPage(); }
    public function updatingFilterBarangay() { $this->resetPage(); }
    public function updatingFilterSex() { $this->resetPage(); }
    public function updatingShowArchived() { $this->resetPage(); }

    // ✅ Mark student for archive
    public function setStudentToDelete($id)
    {
        $this->studentToDelete = $id;
    }

    // ✅ Archive student (soft delete)
    public function deleteConfirmed()
    {
        if ($this->studentToDelete) {
            $student = Student::find($this->studentToDelete);
            if ($student) {
                $student->delete(); // uses SoftDeletes
                session()->flash('success', 'Student archived successfully.');
            }
            $this->studentToDelete = null;
        }
    }

    // ✅ Restore archived student
    public function restoreStudent($id)
    {
        $student = Student::withTrashed()->find($id);
        if ($student && $student->trashed()) {
            $student->restore();
            session()->flash('success', 'Student restored successfully.');
        }
    }

    // ✅ Dropdown filters
    public function getAvailableYearsProperty()
    {
        return Student::select('enrollment_year')
            ->distinct()
            ->orderBy('enrollment_year', 'desc')
            ->pluck('enrollment_year');
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

    public function getAvailableSexesProperty()
    {
        return Student::select('sex')
            ->distinct()
            ->pluck('sex')
            ->sort()
            ->values();
    }

    // ✅ Render students (active or archived)
    public function render()
    {
        $students = Student::query()
            ->when($this->showArchived, fn($q) => $q->onlyTrashed()) // show archived if toggled
            ->when(!$this->showArchived, fn($q) => $q->withoutTrashed()) // default: active only
            ->when($this->filterYear, fn($q) => $q->where('enrollment_year', $this->filterYear))
            ->when($this->filterGrade, fn($q) => $q->where('grade_level', $this->filterGrade))
            ->when($this->filterBarangay, fn($q) => $q->where('barangay', $this->filterBarangay))
            ->when($this->filterSex, fn($q) => $q->where('sex', $this->filterSex))
            ->where(function ($query) {
                $query->where('first_name', 'like', '%' . $this->search . '%')
                    ->orWhere('middle_name', 'like', '%' . $this->search . '%')
                    ->orWhere('last_name', 'like', '%' . $this->search . '%')
                    ->orWhere('barangay', 'like', '%' . $this->search . '%')
                    ->orWhere('grade_level', 'like', '%' . $this->search . '%')
                    ->orWhere('sex', 'like', '%' . $this->search . '%');
            })
            ->orderBy('last_name')
            ->paginate(10);

        return view('livewire.students.enrolled-list', [
            'students' => $students, 
            'availableYears' => $this->availableYears,
            'availableGrades' => $this->availableGrades,
            'availableBarangays' => $this->availableBarangays,
            'availableSexes' => $this->availableSexes,
        ]);
    }
}
