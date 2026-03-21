<?php

namespace App\Livewire\Students;

use App\Models\Student;
use Livewire\Component;

class BarangayMap extends Component
{
    public $barangays = [];

    protected $barangayCoordinates = [
        'San Isidro' => ['lat' => 11.0875, 'lng' => 124.9499],
        'Tuya' => ['lat' => 11.08797, 'lng' => 124.94451],
        'Tin-Ao' => ['lat' => 11.0979, 'lng' => 124.9350],
        'Balilit' => ['lat' => 11.0845, 'lng' => 124.9362],
        'Santa Elena' => ['lat' => 11.0972, 'lng' => 124.9738],
    ];

    public function mount()
    {
        $this->barangays = Student::selectRaw('barangay, COUNT(*) as student_count')
            ->groupBy('barangay')
            ->get()
            ->map(function ($item) {
                $coords = $this->barangayCoordinates[$item->barangay] ?? null;

                return $coords ? [
                    'name' => $item->barangay,
                    'lat' => $coords['lat'],
                    'lng' => $coords['lng'],
                    'student_count' => $item->student_count,
                ] : null;
            })
            ->filter()
            ->values()
            ->toArray();
    }

    public function render()
    {
        return view('livewire.students.barangay-map');
    }
}
