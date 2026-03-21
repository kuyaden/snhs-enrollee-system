<?php

namespace App\Livewire\Charts;

use Livewire\Component;
use App\Models\Student;

class GenderChart extends Component
{
    public $maleCount;
    public $femaleCount;
    public $malePercent;
    public $femalePercent;

    protected $listeners = ['student-added' => 'updateCounts'];

    public function mount()
    {
        $this->loadCounts();
    }

    public function loadCounts()
    {
        $this->maleCount = Student::where('sex', 'Male')->count();
        $this->femaleCount = Student::where('sex', 'Female')->count();

        $total = $this->maleCount + $this->femaleCount;

        if ($total > 0) {
            $this->malePercent = round(($this->maleCount / $total) * 100);
            $this->femalePercent = round(($this->femaleCount / $total) * 100);
        } else {
            $this->malePercent = 0;
            $this->femalePercent = 0;
        }
    }

    public function updateCounts()
    {
        $this->loadCounts();
    }

    public function render()
    {
        return view('livewire.charts.gender-chart', [
            'maleCount' => $this->maleCount,
            'femaleCount' => $this->femaleCount,
            'malePercent' => $this->malePercent,
            'femalePercent' => $this->femalePercent,
        ]);
    }
}
