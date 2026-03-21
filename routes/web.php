<?php

use App\Livewire\Roles\RoleCreate;
use App\Livewire\Roles\RoleEdit;
use App\Livewire\Roles\RoleIndex;
use App\Livewire\Roles\RoleShow;

use App\Livewire\SpecialCategories\Students4Ps;
use App\Livewire\SpecialCategories\StudentsIp;
use App\Livewire\SpecialCategories\StudentsPwd;
use App\Livewire\Students\AddStudent;
use App\Exports\Sf1Export;
use App\Livewire\Students\AssignStudents;
use App\Livewire\Students\SchoolForms;
use App\Livewire\Students\SchoolFormsSf1;
use App\Livewire\Students\SectionManager;
use App\Livewire\Students\ArchivedList;
use App\Livewire\Students\BarangayList;
use App\Livewire\Students\BarangayMap;
use App\Livewire\Students\EnrolledEdit;
use App\Livewire\Students\EnrolledList;
use App\Livewire\Students\EnrolledShow;
use App\Livewire\Students\FormOneThreeStudents;
use App\Livewire\Students\LiveBirthStudents;
use App\Livewire\Users\UserIndex;
use App\Livewire\Users\UserCreate;
use App\Livewire\Users\UserEdit;
use App\Livewire\Users\UserShow;
use Illuminate\Support\Facades\Route;
use Livewire\Volt\Volt;
use App\Exports\StudentsExport;
use Maatwebsite\Excel\Facades\Excel; 
use Maatwebsite\Excel\Excel as ExcelFormat;


Route::redirect('/', '/login')->name('home');

Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');
    

Route::middleware(['auth'])->group(function () {
    Route::redirect('settings', 'settings/profile');

    Route::get('users/create', UserCreate::class)->name('users.create');
    Route::get('users/{id}/edit', UserEdit::class)->name('users.edit');
    Route::get('users/{id}', UserShow::class)->name('users.show');
    Route::get('users', UserIndex::class)->name('users.index');
    
    Route::get('roles', RoleIndex::class)->name('roles.index')->middleware("permission:role.show|role.create|role.edit|role.delete");
    Route::get('roles/create', RoleCreate::class)->name('roles.create')->middleware("permission:role.create");
    Route::get('roles/{id}/edit', RoleEdit::class)->name('roles.edit')->middleware("permission:role.edit");
    Route::get('roles/{id}', RoleShow::class)->name('roles.show')->middleware("permission:role.delete");

    Route::get('students', AddStudent::class)->name('add.students');
    Route::get('students/live-birth', LiveBirthStudents::class)->name('students.livebirth');
    Route::get('students/barangay-map', BarangayMap::class)->name('students.barangay-map');
    Route::get('students/barangay-list', BarangayList::class)->name('students.barangay-list');
    Route::get('students/form-one-three-students', FormOneThreeStudents::class)->name('students.form-one-three-students');
    Route::get('students/archived-list', ArchivedList::class)->name('students.archived-list');
    Route::get('students/section-manager', SectionManager::class)->name('students.section-manager');
    Route::get('students/assign-students', AssignStudents::class)->name('students.assign-students');
    Route::get('students/school-forms', SchoolForms::class)->name('students.school-forms');
    Route::get('students/school-forms.sf1', SchoolFormsSf1::class)->name('students.school-forms.sf1');

    Route::get('students/indigenous', StudentsIp::class)->name('students.indigenous');
    Route::get('students/4Pstudents', Students4Ps::class)->name('students.4Pstudents');
    Route::get('students/pwd', StudentsPwd::class)->name('students.pwd');
  
    Route::get('students/enrolled-list', EnrolledList::class)->name('students.enrolled-list');
    Route::get('students/enrolled/{id}', EnrolledShow::class)->name('students.enrolled.show');
    Route::get('students/enrolled/{id}/edit', EnrolledEdit::class)->name('students.enrolled.edit');

    Route::get('/school-forms/sf1/export/{grade}', function ($grade) {
    return Excel::download(
        new Sf1Export($grade),
        "SF1_Grade_{$grade}.xlsx"
    );
})->name('sf1.export');

    Route::get('/export-students', function (\Illuminate\Http\Request $request) {
    $year = $request->query('year');
    $grade = $request->query('grade');
    $barangay = $request->query('barangay');
    $sex = $request->query('sex');

    $filename = 'students_' . ($year ?? 'all')
        . '_' . ($grade ?? 'all')
        . '_' . ($barangay ?? 'all')
        . '_' . ($sex ?? 'all') . '.xlsx';

    return Excel::download(new StudentsExport($year, $grade, $barangay, $sex), $filename, ExcelFormat::XLSX);
})->name('students.export');

    Volt::route('settings/profile', 'settings.profile')->name('settings.profile');
    Volt::route('settings/password', 'settings.password')->name('settings.password');
    Volt::route('settings/appearance', 'settings.appearance')->name('settings.appearance');
});

require __DIR__.'/auth.php';
