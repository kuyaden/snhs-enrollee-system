<?php

namespace App\Livewire\Students;

use App\Models\Student;
use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Storage;

class EnrolledEdit extends Component
{
    use WithFileUploads;

    public $student;

    // Student fields
    public $lrn, $first_name, $middle_name, $last_name, $extension_name;
    public $sex, $birthdate, $birthplace, $age;
    public $grade_level, $student_section;
    public $barangay, $street, $municipality, $province;
    public $contact_number, $father_name, $mother_name, $guardian_name;
    public $mother_tongue, $religion, $ip, $is_4ps, $is_pwd;
    public $enrollment_year, $enrollment_status;

    // File uploads
    public $photo;
    public $form_one_three;
    public $live_birth;

    public function mount($id)
{
    $this->student = Student::findOrFail($id);

    // populate fields (excluding file uploads)
    $this->fill($this->student->only([
        'lrn', 'first_name', 'middle_name', 'last_name', 'extension_name',
        'sex', 'birthdate', 'birthplace',
        'grade_level', 'student_section',
        'barangay', 'street', 'municipality', 'province',
        'contact_number', 'father_name', 'mother_name', 'guardian_name',
        'mother_tongue', 'religion', 'ip', 'is_4ps', 'is_pwd', 'age',
        'enrollment_year', 'enrollment_status',
        'profile_image' // Only image path
    ]));

    // do NOT assign file paths to Livewire file properties
    $this->form_one_three = null;
    $this->live_birth = null;
}


    public function update()
    {
        $this->validate([
    'enrollment_year' => 'nullable|integer|min:2000|max:' . (now()->year + 1),
    'enrollment_status' => 'nullable|string',
    'lrn' => 'nullable|string|max:12',
    'first_name' => 'nullable|string|max:255',
    'middle_name' => 'nullable|string|max:255',
    'last_name' => 'nullable|string|max:255',
    'extension_name' => 'nullable|string|max:50',
    'student_section' => 'nullable|string|max:255',
    'sex' => 'nullable|string',
    'birthdate' => 'nullable|date',
    'birthplace' => 'nullable|string|max:255',
    'grade_level' => 'nullable|string|max:50',
    'barangay' => 'nullable|string|max:255',
    'street' => 'nullable|string|max:255',
    'municipality' => 'nullable|string|max:255',
    'province' => 'nullable|string|max:255',
    'contact_number' => 'nullable|string|max:20',
    'father_name' => 'nullable|string|max:255',
    'mother_name' => 'nullable|string|max:255',
    'guardian_name' => 'nullable|string|max:255',
    'mother_tongue' => 'nullable|string|max:255',
    'religion' => 'nullable|string|max:255',
    'ip' => 'nullable|string|max:255',
    'is_4ps' => 'nullable|string',
    'is_pwd' => 'nullable|string',
    'photo' => 'nullable|image|max:2048',
    'form_one_three' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:2048',
    'live_birth' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:2048',
    'age' => 'nullable|integer|min:0|max:100',



]);


        // base update data
        $data = [
            'enrollment_year' => $this->enrollment_year,
            'enrollment_status' => $this->enrollment_status,
            'lrn' => $this->lrn,
            'first_name' => $this->first_name,
            'middle_name' => $this->middle_name,
            'last_name' => $this->last_name,
            'extension_name' => $this->extension_name,
            'student_section' => $this->student_section,
            'sex' => $this->sex,
            'birthdate' => $this->birthdate,
            'birthplace' => $this->birthplace,
            'grade_level' => $this->grade_level,
            'barangay' => $this->barangay,
            'street' => $this->street,
            'municipality' => $this->municipality,
            'province' => $this->province,
            'contact_number' => $this->contact_number,
            'father_name' => $this->father_name,
            'mother_name' => $this->mother_name,
            'guardian_name' => $this->guardian_name,
            'mother_tongue' => $this->mother_tongue,
            'religion' => $this->religion,
            'ip' => $this->ip,
            'is_4ps' => $this->is_4ps,
            'is_pwd' => $this->is_pwd,
            'age' => $this->age,
        ];

        // ✅ handle file uploads
        if ($this->photo) {
            $data['profile_image'] = $this->photo->store('students/photos', 'public');
        }
        if ($this->form_one_three) {
            $data['form_one_three'] = $this->form_one_three->store('students/forms', 'public');
        }
        if ($this->live_birth) {
            $data['live_birth'] = $this->live_birth->store('students/live_births', 'public');
        }

        // ✅ apply updates
        $this->student->update($data);

        session()->flash('success', 'Student updated successfully.');

        return redirect()->route('students.enrolled-list');
    }

    public function render()
    {
        return view('livewire.students.enrolled-edit');
    }
}
