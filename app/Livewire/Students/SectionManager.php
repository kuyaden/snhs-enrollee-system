<?php

namespace App\Livewire\Students;

use Livewire\Component;
use App\Models\Section;
use App\Models\Student;

class SectionManager extends Component
{
    // Data
    public $sections;
    public $students;

    // Form / model fields
    public $grade_level;
    public $name;
    public $adviser;

    // Filters & search
    public $search = '';
    public $filterGrade = '';
    public $filterAdviser = '';

    // UI state
    public $showCreateModal = false;
    public $showEditModal = false;
    public $editingSectionId = null;
    public $viewingSectionId = null;

    // Selection for assign-students
    public $selectedSectionId;
    public $selectedStudents = [];

    protected $rules = [
        'grade_level' => 'required|string',
        'name'        => 'required|string|max:255',
        'adviser'     => 'nullable|string|max:255',
    ];

    public function render()
    {
        $query = Section::with('students')->orderBy('grade_level')->orderBy('name');

        if (!empty($this->search)) {
            $q = $this->search;
            $query->where(function ($builder) use ($q) {
                $builder->where('name', 'like', "%{$q}%")
                        ->orWhere('adviser', 'like', "%{$q}%")
                        ->orWhere('grade_level', 'like', "%{$q}%");
            });
        }

        if (!empty($this->filterGrade)) {
            $query->where('grade_level', $this->filterGrade);
        }

        if (!empty($this->filterAdviser)) {
            $query->where('adviser', $this->filterAdviser);
        }

        $this->sections = $query->get();
        $this->students = Student::whereNull('section_id')->get();

        return view('livewire.students.section-manager');
    }

    public function store()
    {
        $this->validate();

        Section::create([
            'grade_level' => $this->grade_level,
            'name'        => $this->name,
            'adviser'     => $this->adviser,
        ]);

        $this->reset(['grade_level', 'name', 'adviser']);
        $this->showCreateModal = false;

        session()->flash('message', 'Section created successfully.');
    }

    public function editSection($id)
    {
        $section = Section::findOrFail($id);

        $this->editingSectionId = $section->id;
        $this->grade_level = $section->grade_level;
        $this->name = $section->name;
        $this->adviser = $section->adviser;
        $this->showEditModal = true;
    }

    public function updateSection()
    {
        $this->validate();

        $section = Section::findOrFail($this->editingSectionId);
        $section->update([
            'grade_level' => $this->grade_level,
            'name'        => $this->name,
            'adviser'     => $this->adviser,
        ]);

        $this->reset(['grade_level', 'name', 'adviser', 'editingSectionId']);
        $this->showEditModal = false;

        session()->flash('message', 'Section updated successfully.');
    }

    public function assignStudents()
    {
        if ($this->selectedSectionId && !empty($this->selectedStudents)) {
            Student::whereIn('id', $this->selectedStudents)
                ->update(['section_id' => $this->selectedSectionId]);

            $this->reset('selectedStudents', 'selectedSectionId');

            session()->flash('message', 'Students assigned successfully.');
        }
    }

    public function viewStudents($sectionId)
    {
        $this->viewingSectionId = $sectionId;
    }

    public function closeView()
    {
        $this->viewingSectionId = null;
    }

    public function removeStudent($studentId, $sectionId)
    {
        $student = Student::find($studentId);

        if ($student && $student->section_id == $sectionId) {
            $student->section_id = null;
            $student->save();
        }

        $this->sections = Section::with('students')->get();
        session()->flash('message', 'Student removed from section.');
    }

    public function delete($id)
    {
        $section = Section::findOrFail($id);

        Student::where('section_id', $section->id)->update(['section_id' => null]);

        $section->delete();

        session()->flash('message', 'Section deleted.');
    }

    public function cancelCreate()
    {
        $this->reset(['grade_level', 'name', 'adviser']);
        $this->showCreateModal = false;
    }

    public function cancelEdit()
    {
        $this->reset(['grade_level', 'name', 'adviser', 'editingSectionId']);
        $this->showEditModal = false;
    }
}
