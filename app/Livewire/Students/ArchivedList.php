<?php

namespace App\Livewire\Students;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Student;

class ArchivedList extends Component
{
    use WithPagination;

    public string $search = '';
    public string $filterGrade = '';
    public string $filterBarangay = '';

    public ?int $studentToDelete = null; // ID of student to delete
    public bool $showDeleteModal = false; // modal visibility

    protected $paginationTheme = 'tailwind';

    //  Reset pagination when filters change
    public function updatingSearch() { $this->resetPage(); }
    public function updatingFilterGrade() { $this->resetPage(); }
    public function updatingFilterBarangay() { $this->resetPage(); }

    //  Restore archived student
    public function restore($id)
    {
        $student = Student::withTrashed()->find($id);
        if ($student) {
            $student->restore();
            session()->flash('success', 'Student restored successfully.');
        }
    }

    //  Show modal for delete confirmation
    public function confirmDelete($id)
    {
        $this->studentToDelete = $id;
        $this->showDeleteModal = true;
    }

    //  Permanently delete the student
    public function delete()
    {
        if ($this->studentToDelete) {
            $student = Student::withTrashed()->find($this->studentToDelete);
            if ($student) {
                $student->forceDelete();
                session()->flash('success', 'Student permanently deleted.');
            }
            $this->studentToDelete = null;
            $this->showDeleteModal = false; // close modal
        }
    }

    //  Cancel deletion
    public function cancelDelete()
    {
        $this->studentToDelete = null;
        $this->showDeleteModal = false;
    }

    public function render()
    {
        $students = Student::onlyTrashed()
            ->when($this->search, function ($query) {
                $search = trim($this->search);
                $query->where(function ($q) use ($search) {
                    $q->where('first_name', 'like', "%{$search}%")
                      ->orWhere('middle_name', 'like', "%{$search}%")
                      ->orWhere('last_name', 'like', "%{$search}%")
                      ->orWhere('lrn', 'like', "%{$search}%")
                      ->orWhere('barangay', 'like', "%{$search}%")
                      ->orWhere('grade_level', 'like', "%{$search}%")
                      ->orWhere('sex', 'like', "%{$search}%")
                      ->orWhereRaw("CONCAT(first_name, ' ', last_name) LIKE ?", ["%{$search}%"])
                      ->orWhereRaw("CONCAT(last_name, ' ', first_name) LIKE ?", ["%{$search}%"]);
                });
            })
            ->when($this->filterGrade, fn ($q) => $q->where('grade_level', $this->filterGrade))
            ->when($this->filterBarangay, fn ($q) => $q->where('barangay', $this->filterBarangay))
            ->orderBy('last_name')
            ->paginate(10);

        return view('livewire.students.archived-list', [
            'students' => $students,
            'availableGrades' => Student::onlyTrashed()->distinct()->pluck('grade_level'),
            'availableBarangays' => Student::onlyTrashed()->distinct()->pluck('barangay'),
            'totalDeleted' => Student::onlyTrashed()->count(),
        ]);
    }
}
