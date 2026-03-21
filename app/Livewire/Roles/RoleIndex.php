<?php

namespace App\Livewire\Roles;

use Livewire\Component;
use Spatie\Permission\Models\Role;

class RoleIndex extends Component
{
    public $roleToDelete = null;

    public function render()
    {
        $roles = Role::with('permissions')->get();
        return view('livewire.roles.role-index', compact('roles'));
    }


    public function deleteConfirmed()
    {
        if ($this->roleToDelete) {
            $role = Role::find($this->roleToDelete);

            if ($role) {
                $role->delete();
                session()->flash('success', 'Role deleted successfully.');
            }

            $this->roleToDelete = null; // Reset after deletion
        }
    }

    
    public function setRoleToDelete($id)
    {
        $this->roleToDelete = $id;
    }
}
