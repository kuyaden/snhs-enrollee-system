<?php

namespace App\Livewire\Charts;

use Livewire\Component;
use App\Models\Student;

class TotalBarangay extends Component
{
    public $totalBarangay;

    protected $listeners = ['student-added' => 'updateCount'];

    public function mount()
    {
        $this->loadTotalBarangay();
    }

    public function loadTotalBarangay()
    {
        $this->totalBarangay = Student::distinct('barangay')->count('barangay');
    }

    public function updateCount()
    {
        $this->loadTotalBarangay();
    }

    public function render()
    {
        return view('livewire.charts.total-barangay');
    }
}
