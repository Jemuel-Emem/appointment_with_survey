<?php

namespace App\Livewire\Midwife;

use Livewire\Component;

class AddPregnant extends Component
{
    public $showModal = false;
    public $date_tracked, $name, $dob, $age, $gp, $height, $weight, $bmi, $pregnant_months, $purok, $husband_partner, $muac, $tt_status, $remarks;
    public function render()
    {
        return view('livewire.midwife.add-pregnant');
    }

    public function openModal()
    {
        $this->reset();
        $this->showModal = true;
    }

    public function closeModal()
    {
        $this->showModal = false;
    }

    public function save()
    {
        $this->validate([
            'date_tracked' => 'required|date',
            'name' => 'required|string',
            'dob' => 'required|date',
            'age' => 'required|integer',
            'gp' => 'required|string',
            'height' => 'required|numeric',
            'weight' => 'required|numeric',
            'bmi' => 'required|numeric',
            'pregnant_months' => 'required|integer',
            'purok' => 'required|string',
            'husband_partner' => 'nullable|string',
            'muac' => 'nullable|string',
            'tt_status' => 'nullable|string',
            'remarks' => 'nullable|string',
        ]);

        // Pregnant::create([
        //     'date_tracked' => $this->date_tracked,
        //     'name' => $this->name,
        //     'dob' => $this->dob,
        //     'age' => $this->age,
        //     'gp' => $this->gp,
        //     'height' => $this->height,
        //     'weight' => $this->weight,
        //     'bmi' => $this->bmi,
        //     'pregnant_months' => $this->pregnant_months,
        //     'purok' => $this->purok,
        //     'husband_partner' => $this->husband_partner,
        //     'muac' => $this->muac,
        //     'tt_status' => $this->tt_status,
        //     'remarks' => $this->remarks,
        // ]);

        $this->reset();
        $this->closeModal();
    }
}
