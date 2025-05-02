<?php

namespace App\Livewire\Midwife;
use App\Models\PregnantTracker;
use App\Models\Pregnants as Pregnant;
use Livewire\Component;

class AddPregnant extends Component
{
    public $selectedPregnantId;
public $trackerRecords = [];
public $detailRecord; // To store the details
public $showDetailsModal = false;
    public $showModal = false;
    public $modalType = ''; // 'pregnant' or 'tracker'

    // Pregnant Fields
    public $pregnant_id, $date_tracked, $name, $dob, $age, $gp, $height, $weight, $bmi, $pregnant_months, $purok, $husband_partner, $muac, $tt_status, $remarks;

    // Pregnant Tracker Fields
    public $tracker_id, $date_of_visit, $family_number, $months_upon_visit, $purok1, $vaccine_received, $weight1, $height1, $bp, $remarks1, $next_schedule_visit;

    public function openModal($type, $pregnantId = null)
    {
        $this->modalType = $type;
        $this->showModal = true;

        if ($type === 'tracker' && $pregnantId) {
            $this->selectedPregnantId = $pregnantId;
            $this->pregnant_id = $pregnantId;
            $this->trackerRecords = PregnantTracker::where('pregnant_id', $pregnantId)->get();
        }
    }
    public function showDetails($id)
    {
        $this->detailRecord = Pregnant::findOrFail($id);
        $this->showDetailsModal = true;
    }
    public function closeModal()
    {
        $this->showModal = false;
        $this->showDetailsModal = false;
    }




    public function save()
    {

        if ($this->modalType === 'pregnant') {
            $this->validate([
                'date_tracked' => 'required|date',
                'name' => 'required|string',
                'dob' => 'required|date',
                'age' => 'required|numeric',
                'pregnant_months' => 'required|numeric',
            ]);

            Pregnant::updateOrCreate(
                ['id' => $this->pregnant_id],
                [
                    'date_tracked' => $this->date_tracked,
        'name' => $this->name,
        'dob' => $this->dob,
        'age' => $this->age,
        'gp' => $this->gp, // Ensure 'gp' is included
        'height' => $this->height,
        'weight' => $this->weight,
        'bmi' => $this->bmi,
        'pregnant_months' => $this->pregnant_months,
        'purok' => $this->purok,
        'husband_partner' => $this->husband_partner,
        'muac' => $this->muac,
        'tt_status' => $this->tt_status,
        'remarks' => $this->remarks,


                ]
            );

            flash()->success('Pregnant data added successfully!');
        } else {


             $this->validate([
                 'date_of_visit' => 'required|date',
                 'family_number' => 'required|string',
                 'months_upon_visit' => 'required|numeric',
                 'purok1' => 'required|string',
                 'next_schedule_visit' => 'required|date',
             ]);

             PregnantTracker::updateOrCreate(
                ['id' => $this->tracker_id], // Update only if tracker_id exists, otherwise create a new record
               [
                    'pregnant_id' => $this->pregnant_id, // Assign the correct foreign key
                    'date_of_visit' => $this->date_of_visit,
                     'family_number' => $this->family_number,
                     'months_upon_visit' => $this->months_upon_visit,
                     'purok' => $this->purok1,
                     'vaccine_received' => $this->vaccine_received,
                     'weight' => $this->weight1,
                     'height' => $this->height1,
                     'bp' => $this->bp,
                     'remarks' => $this->remarks1,
                     'next_schedule_visit' => $this->next_schedule_visit,
                 ]
             );


             flash()->success('Pregnant tarcker data added successfully!');

        }

        $this->closeModal();
    }

    public function edit($id, $type)
    {
        $this->openModal($type);

        if ($type === 'pregnant') {
            $pregnant = Pregnant::findOrFail($id);
            $this->pregnant_id = $pregnant->id;
            $this->date_tracked = $pregnant->date_tracked;
            $this->name = $pregnant->name;
            $this->dob = $pregnant->dob;
            $this->age = $pregnant->age;
            $this->gp = $pregnant->gp; // Ensure this field is included
            $this->height = $pregnant->height;
            $this->weight = $pregnant->weight;
            $this->bmi = $pregnant->bmi;
            $this->pregnant_months = $pregnant->pregnant_months;
            $this->purok = $pregnant->purok;
            $this->husband_partner = $pregnant->husband_partner;
            $this->muac = $pregnant->muac;
            $this->tt_status = $pregnant->tt_status;
            $this->remarks = $pregnant->remarks;
        } else {
            $tracker = PregnantTracker::findOrFail($id);
            $this->tracker_id = $tracker->id;
            $this->date_of_visit = $tracker->date_of_visit;
            $this->family_number = $tracker->family_number;
            $this->months_upon_visit = $tracker->months_upon_visit;
            $this->purok1 = $tracker->purok;
            $this->vaccine_received = $tracker->vaccine_received;
            $this->weight1 = $tracker->weight;
            $this->height1 = $tracker->height;
            $this->bp = $tracker->bp;
            $this->remarks1 = $tracker->remarks;
            $this->next_schedule_visit = $tracker->next_schedule_visit;
        }
    }

    public function delete($id, $type)
    {
        if ($type === 'pregnant') {
            Pregnant::findOrFail($id)->delete();
        } else {
            PregnantTracker::findOrFail($id)->delete();
        }
    }

    public function render()
    {
        return view('livewire.midwife.add-pregnant', [
            'pregnantRecords' => Pregnant::all(),
            'trackerRecords' => PregnantTracker::all(),
        ]);
    }
}
