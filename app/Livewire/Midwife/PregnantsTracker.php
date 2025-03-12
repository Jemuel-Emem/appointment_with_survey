<?php

namespace App\Livewire\Midwife;
use App\Models\PregnantTracker;
use Livewire\Component;

class PregnantsTracker extends Component
{

    public $showModal = false;
    public $tracker_id, $date_of_visit, $family_number, $months_upon_visit, $purok, $vaccine_received, $weight, $height, $bp, $remarks, $next_schedule_visit;

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
            'date_of_visit' => 'required|date',
            'family_number' => 'required|string',
            'months_upon_visit' => 'required|numeric',
            'purok' => 'required|string',
            'vaccine_received' => 'nullable|string',
            'weight' => 'nullable|numeric',
            'height' => 'nullable|numeric',
            'bp' => 'nullable|string',
            'remarks' => 'nullable|string',
            'next_schedule_visit' => 'required|date',
        ]);

        PregnantTracker::updateOrCreate(
            ['id' => $this->tracker_id],
            [
                'date_of_visit' => $this->date_of_visit,
                'family_number' => $this->family_number,
                'months_upon_visit' => $this->months_upon_visit,
                'purok' => $this->purok,
                'vaccine_received' => $this->vaccine_received,
                'weight' => $this->weight,
                'height' => $this->height,
                'bp' => $this->bp,
                'remarks' => $this->remarks,
                'next_schedule_visit' => $this->next_schedule_visit,
            ]
        );

        $this->reset();
        $this->closeModal();
    }

    public function edit($id)
    {
        $tracker = PregnantTracker::findOrFail($id);
        $this->tracker_id = $tracker->id;
        $this->date_of_visit = $tracker->date_of_visit;
        $this->family_number = $tracker->family_number;
        $this->months_upon_visit = $tracker->months_upon_visit;
        $this->purok = $tracker->purok;
        $this->vaccine_received = $tracker->vaccine_received;
        $this->weight = $tracker->weight;
        $this->height = $tracker->height;
        $this->bp = $tracker->bp;
        $this->remarks = $tracker->remarks;
        $this->next_schedule_visit = $tracker->next_schedule_visit;


        $this->dispatch('refreshModal');


        $this->showModal = true;
    }


    public function delete($id)
    {
        PregnantTracker::findOrFail($id)->delete();
    }

    public function render()
    {
        return view('livewire.midwife.pregnants-tracker', [
            'trackers' => PregnantTracker::all(),
        ]);
    }

}
