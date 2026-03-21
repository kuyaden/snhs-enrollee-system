<?php

namespace App\Imports;

use App\Models\Student;
use Illuminate\Validation\Rule;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;
use Maatwebsite\Excel\Concerns\WithChunkReading; // optional for large files
use Maatwebsite\Excel\Concerns\Importable;

class StudentsImport implements ToModel, WithHeadingRow, WithValidation, WithChunkReading
{
    use Importable;

    public function model(array $row)
    {
        return new Student([
            'first_name'      => $row['first_name'] ?? null,
            'middle_name'     => $row['middle_name'] ?? null,
            'last_name'       => $row['last_name'] ?? null,
            'extension_name'  => $row['extension_name'] ?? null,
            'sex'             => $row['sex'] ?? null,
            'birthdate'       => isset($row['birthdate']) ? date('Y-m-d', strtotime($row['birthdate'])) : null,
            'grade_level'     => $row['grade_level'] ?? null,
            'section'         => $row['section'] ?? null,
            'barangay'        => $row['barangay'] ?? null,
            'lrn'             => $row['lrn'] ?? null,
            'enrollment_year' => $row['enrollment_year'] ?? date('Y'),
        ]);
    }

    public function rules(): array
    {
        return [
            '*.first_name' => 'required|string',
            '*.last_name'  => 'required|string',
            '*.sex'        => 'required|in:Male,Female',
            '*.grade_level'=> 'required',
            // optionally validate LRN uniqueness or format
            // '*.lrn' => 'nullable|digits:10|unique:students,lrn',
        ];
    }

    public function chunkSize(): int
    {
        return 1000;
    }
}
