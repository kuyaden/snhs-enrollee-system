<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Student extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'last_name',
        'first_name',
        'middle_name',
        'extension_name',
        'sex',
        'birthdate',
        'birthplace',
        'grade_level',
        'lrn',
        'mother_tongue',
        'ip',
        'religion',
        'is_4ps',
        'street',
        'barangay',
        'municipality',
        'province',
        'father_name',
        'mother_name',
        'guardian_name',
        'contact_number',
        'live_birth',
        'profile_image',
        'enrollment_year',
        'live_birth_one',
        'live_birth_two',
        'enrollment_status',
        'form_one_three',
        'pwd',
        'father_occupation',
        'mother_occupation',
        'guardian_occupation',
        'father_education',
        'mother_education',
        'guardian_education',
        'father_income',
        'mother_income',
        'guardian_income',
        'father_disability',
        'mother_disability',
        'guardian_disability',
        'section_id',
        'age'
    ];

    protected $dates = ['deleted_at'];

    // ✅ Query scopes
    public function scopeActive($query)
    {
        return $query->whereNull('deleted_at');
    }

    public function scopeArchived($query)
    {
        return $query->onlyTrashed();
    }

    public function section()
    {
        return $this->belongsTo(Section::class);
    }
}
