<?php

namespace App\Livewire\Students;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Student;
use App\Models\Section;

class AssignStudents extends Component
{
    use WithPagination;

    public $selectedSectionId;
    public $search = '';
    public $filterGrade = '';
    public $selectedStudents = [];
    public $selectAll = false;

    protected $paginationTheme = 'tailwind';

    // ✅ Reset pagination when filters change
    public function updatingSearch() { $this->resetPage(); }
    public function updatingFilterGrade() { $this->resetPage(); }

    // ✅ Toggle select all
    public function updatedSelectAll($value)
    {
        if ($value) {
            // Get all student IDs from current filtered page
            $this->selectedStudents = $this->studentsQuery()
                ->orderBy('last_name')
                ->pluck('id')
                ->toArray();
        } else {
            $this->selectedStudents = [];
        }
    }

    // ✅ Assign selected students
    public function assignStudents()
    {
        if (!$this->selectedSectionId) {
            session()->flash('message', 'Please select a section first.');
            return;
        }

        if (empty($this->selectedStudents)) {
            session()->flash('message', 'No students selected.');
            return;
        }

        Student::whereIn('id', $this->selectedStudents)
            ->update(['section_id' => $this->selectedSectionId]);

        session()->flash('message', count($this->selectedStudents) . ' student(s) assigned successfully!');

        // Reset form and selections
        $this->reset(['selectedSectionId', 'selectedStudents', 'selectAll']);
    }

    private function studentsQuery()
    {
        return Student::query()
            ->whereNull('section_id')
            ->when($this->filterGrade, fn($q) => $q->where('grade_level', $this->filterGrade))
            ->where(function ($q) {
                $q->where('first_name', 'like', '%' . $this->search . '%')
                  ->orWhere('last_name', 'like', '%' . $this->search . '%');
            });
    }

    public function getAvailableGradesProperty()
    {
        return Student::whereNull('section_id')
            ->select('grade_level')
            ->distinct()
            ->pluck('grade_level')
            ->sort()
            ->values();
    }

    public function render()
    {
        $students = $this->studentsQuery()->orderBy('last_name')->paginate(10);

        return view('livewire.students.assign-students', [
            'sections' => Section::all(),
            'students' => $students,
            'availableGrades' => $this->availableGrades,
        ]);
    }
}
