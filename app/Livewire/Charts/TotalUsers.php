<?php

namespace App\Livewire\Charts;

use Livewire\Component;
use App\Models\User;

class TotalUsers extends Component
{
    public $totalUsers;

    protected $listeners = ['user-added' => 'updateCount'];

    public function mount()
    {
        $this->loadTotalUsers();
    }

    public function loadTotalUsers()
    {
        $this->totalUsers = User::count();
    }

    public function updateCount()
    {
        $this->loadTotalUsers();
    }

    public function render()
    {
        return view('livewire.charts.total-users');
    }
}
