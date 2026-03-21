<?php

namespace App\Livewire\Students;

use App\Models\Student;
use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Validation\ValidationException;

class AddStudent extends Component
{
    use WithFileUploads;

    public $last_name, $first_name, $middle_name, $extension_name;
    public $sex, $birthdate, $birthplace, $grade_level, $lrn, $age;
    public $mother_tongue, $ip, $religion, $other_religion, $is_4ps, $is_pwd, $other_disability; 
    public $street, $barangay, $municipality, $province;
    public $father_name, $mother_name, $guardian_name, $contact_number;
    public $profile_image;
    public $live_birth, $live_birth_one, $live_birth_two, $form_one_three;
    public $enrollment_year, $school_year, $enrollment_status, $father_occupation, $mother_occupation;
    public $father_education, $mother_education, $father_disability, $mother_disability, $father_income, $mother_income;
    public $guardian_occupation, $guardian_education, $guardian_income, $guardian_disability;

    public function save()
    {
        try {
            $this->validate([
                'last_name' => 'required|regex:/^[A-Z][a-zA-Z\s]+$/|max:255',
                'first_name' => 'required|regex:/^[A-Z][a-zA-Z\s]+$/|max:255',
                'middle_name' => 'nullable|regex:/^[A-Z]?[a-zA-Z\s]*$/|max:255',
                'extension_name' => 'nullable|regex:/^[A-Za-z\s]+$/|max:255',
                'grade_level' => 'required|string|max:255',
                'lrn' => 'required|digits:12',
                'sex' => 'required|in:Male,Female',
                'birthdate' => 'required|date',
                'birthplace' => 'nullable|regex:/^[A-Z][a-zA-Z\s]+$/|max:255',
                'mother_tongue' => 'nullable|regex:/^[A-Z][a-zA-Z\s]*$/|max:255',
                'ip' => 'nullable|string',
                'religion' => 'nullable|string|max:255',
                'other_religion' => 'required_if:religion,Others|string|max:255|nullable', 
                'is_4ps' => 'nullable|string',
                'is_pwd' => 'nullable|string',
                'other_disability' => 'required_if:is_pwd,Others|string|max:255|nullable',
                'street' => 'nullable|string|max:255',
                'barangay' => 'required|string|max:255',
                'municipality' => 'nullable|regex:/^[A-Z][a-zA-Z\s]+$/|max:255',
                'province' => 'nullable|regex:/^[A-Z][a-zA-Z\s]+$/|max:255',
                'father_name' => 'nullable|regex:/^[A-Z][a-zA-Z\s]+$/|max:255',
                'mother_name' => 'nullable|regex:/^[A-Z][a-zA-Z\s]+$/|max:255',
                'guardian_name' => 'nullable|regex:/^[A-Z][a-zA-Z\s]+$/|max:255',
                'contact_number' => ['nullable', 'regex:/^09[0-9]{9}$/'],
                'enrollment_year' => 'nullable|integer|min:2000|max:' . (now()->year + 1),
                'school_year' => 'nullable|string',
                'enrollment_status' => 'required|string|max:255',
                'live_birth' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:2048',
                'live_birth_one' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:2048',
                'live_birth_two' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:2048',
                'form_one_three' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:2048',
                'profile_image' => 'nullable|image|max:2048',
                'father_occupation' => 'nullable|regex:/^[A-Z][a-zA-Z\s]*$/|max:255',
                'father_education' => 'nullable|string|max:255',
                'father_income' => 'nullable|numeric|min:0',
                'mother_occupation' => 'nullable|regex:/^[A-Z][a-zA-Z\s]*$/|max:255',
                'mother_education' => 'nullable|string|max:255',
                'mother_income' => 'nullable|numeric|min:0',
                'father_disability' => 'nullable|regex:/^[A-Z][a-zA-Z\s]*$/|max:255',
                'mother_disability' => 'nullable|regex:/^[A-Z][a-zA-Z\s]*$/|max:255',
                'guardian_occupation' => 'nullable|regex:/^[A-Z][a-zA-Z\s]*$/|max:255',
                'guardian_education' => 'nullable|string|max:255',
                'guardian_income' => 'nullable|numeric|min:0',
                'guardian_disability' => 'nullable|regex:/^[A-Z][a-zA-Z\s]*$/|max:255',
                'age' => 'nullable|integer|min:0|max:100',
            ]);

            // File uploads
            $liveBirthPath = $this->live_birth?->store('live_births', 'public');
            $liveBirthOnePath = $this->live_birth_one?->store('live_births', 'public');
            $liveBirthTwoPath = $this->live_birth_two?->store('live_births', 'public');
            $formOneThreePath = $this->form_one_three?->store('form_137', 'public');
            $profileImagePath = $this->profile_image?->store('profile_images', 'public');

            //  Final religion value
            $finalReligion = $this->religion === 'Others' ? $this->other_religion : $this->religion;
            
            $finalDisability = $this->is_pwd === 'Others' ? $this->other_disability : $this->is_pwd;
            
            Student::create([
                'last_name' => $this->last_name,
                'first_name' => $this->first_name,
                'middle_name' => $this->middle_name,
                'extension_name' => $this->extension_name,
                'sex' => $this->sex,
                'birthdate' => $this->birthdate,
                'birthplace' => $this->birthplace,
                'grade_level' => $this->grade_level,
                'lrn' => $this->lrn,
                'mother_tongue' => $this->mother_tongue,
                'ip' => $this->ip,
                'religion' => $finalReligion, 
                'is_4ps' => $this->is_4ps,
               'pwd' => $finalDisability,
                'street' => $this->street,
                'barangay' => $this->barangay,
                'municipality' => $this->municipality,
                'province' => $this->province,
                'father_name' => $this->father_name,
                'mother_name' => $this->mother_name,
                'guardian_name' => $this->guardian_name,
                'contact_number' => $this->contact_number,
                'enrollment_year' => $this->enrollment_year,
                'school_year' => $this->school_year,
                'enrollment_status' => $this->enrollment_status,
                'profile_image' => $profileImagePath,
                'live_birth' => $liveBirthPath,
                'live_birth_one' => $liveBirthOnePath,
                'live_birth_two' => $liveBirthTwoPath,
                'form_one_three' => $formOneThreePath,
                'father_occupation' => $this->father_occupation,
                'father_education' => $this->father_education,
                'father_income' => $this->father_income,
                'mother_occupation' => $this->mother_occupation,
                'mother_education' => $this->mother_education,  
                'mother_income' => $this->mother_income,
                'father_disability' => $this->father_disability,
                'mother_disability' => $this->mother_disability,
                'guardian_occupation' => $this->guardian_occupation,
                'guardian_education' => $this->guardian_education,
                'guardian_income' => $this->guardian_income,
                'guardian_disability' => $this->guardian_disability,
                'age' => $this->age,
            ]);

            $this->dispatch('modal-close', ['name' => 'confirm-submit']);
            return redirect()->route('students.enrolled-list')->with('success', 'Student successfully added!');


        } catch (ValidationException $e) {
            $this->dispatch('modal-close', ['name' => 'confirm-submit']);
            $this->showValidationModal = true;
            throw $e;
        }
    }


    public function render()
    {
        return view('livewire.students.add-student');
    }
}
