<?php

namespace App\Livewire\Admin;

use App\Models\Newborn;
use Livewire\Component;

class Childrec extends Component
{
    public $showModal = false;
    public $selectedChild;

    public function showChild($id)
    {
        $this->selectedChild = Newborn::findOrFail($id);
        $this->showModal = true;
    }

    public function closeModal()
    {
        $this->showModal = false;
        $this->selectedChild = null;
    }

    public function render()
    {
        return view('livewire.admin.childrec', [
            'newborns' => Newborn::all(),
        ]);
    }
}
