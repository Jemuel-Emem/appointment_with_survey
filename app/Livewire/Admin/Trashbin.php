<?php

namespace App\Livewire\Admin;

use App\Models\TrashBin as t;
use App\Models\User;
use Livewire\Component;

class Trashbin extends Component
{
    public function deletePermanently($id)
    {
        t::findOrFail($id)->delete(); // permanently delete from trash bin
        flash()->error('Record permanently deleted.');
    }

    public function retrieve($id)
    {
        $trash = t::findOrFail($id);

        // Restore user in the users table
        $restoredUser = User::withTrashed()->find($trash->user_id);

        if ($restoredUser) {
            $restoredUser->restore(); // If soft-deleted user still exists, restore it
        } else {
            User::create([
                'id' => $trash->user_id, // optional depending on your DB
                'name' => $trash->name,
                'email' => $trash->email,
                'is_admin' => $trash->role == 'doctor' ? 2 : 0,
                'password' => bcrypt('password'), // dummy password (ask user to reset)
            ]);
        }

        $trash->delete(); // remove from trash bin
        flash()->success('User retrieved successfully.');
    }

    public function render()
    {
        return view('livewire.admin.trashbin', [
            'trashBins' => t::with('user')->get(),
        ]);
    }

}
