<?php

namespace App\Livewire\Admin;

use App\Models\User;
use App\Models\Resident;
use App\Models\patients as Patient;
use Livewire\Component;

class Index extends Component
{
    public function render()
    {
        return view('livewire.admin.index', [
            'doctorsCount' => User::where('is_admin', '2')->count(),
            'midwivesCount' => User::where('is_admin', '1')->count(),
            'patientsCount' => Patient::count(),
            'residentsCount' => Resident::count(),
        ]);
    }
}
