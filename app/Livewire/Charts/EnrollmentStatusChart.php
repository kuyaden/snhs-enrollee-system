<?php

namespace App\Livewire\Charts;

use Livewire\Component;
use App\Models\Student;

class EnrollmentStatusChart extends Component
{
    public $chartLabels = [];
    public $chartData = [];

    public function mount()
    {
        $statuses = Student::selectRaw('enrollment_status, COUNT(*) as count')
            ->whereNotNull('enrollment_status')
            ->groupBy('enrollment_status')
            ->orderBy('enrollment_status')
            ->get();

        $this->chartLabels = $statuses->pluck('enrollment_status')->toArray();
        $this->chartData = $statuses->pluck('count')->toArray();
    }

    public function render()
    {
        return view('livewire.charts.enrollment-status-chart');
    }
}
