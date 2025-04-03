<?php

namespace App\Livewire\Midwife;
use App\Models\pregnants as Pregnant;
use App\Models\Newborn;
use Livewire\Component;

class Index extends Component
{
    public function render()
    {
        return view('livewire.midwife.index', [
            'newbornCount' => Newborn::count(),
            'pregnantCount' => Pregnant::count(),
        ]);
    }
}
