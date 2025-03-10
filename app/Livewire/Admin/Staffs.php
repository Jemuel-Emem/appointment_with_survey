<?php

namespace App\Livewire\Admin;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;

class Staffs extends Component
{
    public $showModal = false;
    public $name, $email, $role, $password, $staffId;
    public $isEditing = false;

    public function openModal()
    {
        $this->resetForm();
        $this->showModal = true;
        $this->isEditing = false;
    }

    public function closeModal()
    {
        $this->showModal = false;
    }

    public function resetForm()
    {
        $this->reset(['name', 'email', 'role', 'password', 'staffId']);
    }

    public function save()
    {
        $this->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email,' . $this->staffId,
            'role' => 'required|in:doctor,midwife',
            'password' => $this->isEditing ? 'nullable|min:6' : 'required|min:6',
        ]);

        $is_admin = $this->role === 'doctor' ? 2 : 0;

        if ($this->isEditing) {
            $staff = User::find($this->staffId);
            if ($staff) {
                $staff->update([
                    'name' => $this->name,
                    'email' => $this->email,
                    'is_admin' => $is_admin,
                    'password' => $this->password ? Hash::make($this->password) : $staff->password,
                ]);
            }
        } else {
            User::create([
                'name' => $this->name,
                'email' => $this->email,
                'is_admin' => $is_admin,
                'password' => Hash::make($this->password),
            ]);
        }

        $this->resetForm();
        $this->closeModal();
    }

    public function editStaff($id)
    {
        $staff = User::findOrFail($id);
        $this->staffId = $staff->id;
        $this->name = $staff->name;
        $this->email = $staff->email;
        $this->role = $staff->is_admin == 2 ? 'doctor' : 'midwife';
        $this->isEditing = true;
        $this->showModal = true;
    }

    public function deleteStaff($id)
    {
        User::findOrFail($id)->delete();
    }

    public function render()
    {
        return view('livewire.admin.staffs', [
            'staffs' => User::whereIn('is_admin', [0, 2])->get(),
        ]);
    }
}
