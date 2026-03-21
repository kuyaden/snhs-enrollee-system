<?php

namespace App\Livewire\Charts;

use Livewire\Component;
use App\Models\Student;

class BarangayChart extends Component
{
    public $chartLabels = [];
    public $chartData = [];

    public function mount()
    {
        $students = Student::select('barangay')
            ->selectRaw('COUNT(*) as total')
            ->groupBy('barangay')
            ->orderByDesc('total')
            ->get();

        $this->chartLabels = $students->pluck('barangay')->toArray();
        $this->chartData = $students->pluck('total')->toArray();
    }

    public function render()
    {
        return view('livewire.charts.barangay-chart');
    }
}
