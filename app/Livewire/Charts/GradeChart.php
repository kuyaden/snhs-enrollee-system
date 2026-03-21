<?php

namespace App\Livewire\Charts;

use Livewire\Component;
use App\Models\Student;

class GradeChart extends Component
{
    public $chartLabels = [];
    public $chartData = [];

    public function mount()
    {
        // Use numeric grades if that's what your database stores
        $grades = [7, 8, 9, 10, 11, 12];

        // Labels will be shown on the chart
        $this->chartLabels = array_map(fn($g) => "Grade $g", $grades);

        // Count how many students per grade
        $this->chartData = array_map(function ($grade) {
            return Student::where('grade_level', $grade)->count();
        }, $grades);
    }

    public function render()
    {
        return view('livewire.charts.grade-chart');
    }
}
