<?php

namespace App\Livewire\Charts;

use Livewire\Component;
use App\Models\Student;

class RecentRegistrations extends Component
{
    public $recentStudents = [];

    public function mount()
    {
        $this->loadRecent();
    }

    public function loadRecent()
    {
        $this->recentStudents = Student::latest()->take(5)->get();
    }

    public function render()
    {
        return view('livewire.charts.recent-registrations');
    }
}
