<?php

namespace App\Livewire\Midwife;
use App\Models\Newborn_Tracker_Visit as NewbornTrackerVisit;
use App\Models\Newborn as newBorns;
use Livewire\Component;

class Newborn extends Component
{
    public $newborns, $newborn_id, $date_of_delivery, $time_of_delivery, $name_of_mother, $age, $sex_of_baby, $name_of_child, $length, $weight, $date_and_vaccine_given, $place_of_delivery, $type_of_delivery, $remarks;
    public $isModalOpen = false;
    public $editMode = false;


    public  $newbornName, $newbornId;
    public $visits = [];

    public $isTrackerOpen = false;

    public $visit_date, $age_today, $height, $reason_of_visit, $vaccine_or_service_provided, $dose, $schedule_next_visit,$remarks1;
    public function render()
    {
        $this->newborns = newBorns::all();
        return view('livewire.midwife.newborn');
    }

    public function openModal()
    {
        $this->resetFields();
        $this->isModalOpen = true;
        $this->editMode = false;
    }

    public function closeModal()
    {
        $this->isModalOpen = false;
    }

    public function resetFields()
    {
        $this->newborn_id = null;
        $this->date_of_delivery = '';
        $this->time_of_delivery = '';
        $this->name_of_mother = '';
        $this->age = '';
        $this->sex_of_baby = '';
        $this->name_of_child = '';
        $this->length = '';
        $this->weight = '';
        $this->date_and_vaccine_given = '';
        $this->place_of_delivery = '';
        $this->type_of_delivery = '';
        $this->remarks = '';
    }


    public function saveVisit()
    {
        $this->validate([
            'visit_date' => 'required|date',
            'age_today' => 'required|integer',
            'height' => 'nullable|numeric',
            'reason_of_visit' => 'required|string',
            'vaccine_or_service_provided' => 'nullable|string',
            'dose' => 'nullable|string',
            'schedule_next_visit' => 'nullable|date',
            'remarks' => 'nullable|string',
        ]);

        NewbornTrackerVisit::create([
            'newborn_id' => $this->newbornId,
            'visit_date' => $this->visit_date,
            'age_today' => $this->age_today,
            'height' => $this->height,
            'reason_of_visit' => $this->reason_of_visit,
            'vaccine_or_service_provided' => $this->vaccine_or_service_provided,
            'dose' => $this->dose,
            'schedule_next_visit' => $this->schedule_next_visit,
            'remarks' => $this->remarks,
        ]);

        session()->flash('message', 'Visit record added successfully.');
        $this->resetForm();
        $this->openTracker($this->newbornId);
    }

    public function openTracker($newbornId)
    {
        $this->newbornId = $newbornId;
        $this->newbornName = newBorns::find($newbornId)->name_of_child;
        $this->visits = NewbornTrackerVisit::where('newborn_id', $newbornId)->get();
        $this->isTrackerOpen = true;
    }

    public function closeTracker()
    {
        $this->isTrackerOpen = false;
    }

    public function resetForm()
    {
        $this->visit_date = null;
        $this->age_today = null;
        $this->height = null;
        $this->reason_of_visit = null;
        $this->vaccine_or_service_provided = null;
        $this->dose = null;
        $this->schedule_next_visit = null;
        $this->remarks = null;
    }
    public function saveNewborn()
    {
        newBorns::create([
            'date_of_delivery' => $this->date_of_delivery,
            'time_of_delivery' => $this->time_of_delivery,
            'name_of_mother' => $this->name_of_mother,
            'age' => $this->age,
            'sex_of_baby' => $this->sex_of_baby,
            'name_of_child' => $this->name_of_child,
            'length' => $this->length,
            'weight' => $this->weight,
            'date_and_vaccine_given' => $this->date_and_vaccine_given,
            'place_of_delivery' => $this->place_of_delivery,
            'type_of_delivery' => $this->type_of_delivery,
            'remarks' => $this->remarks,
        ]);

        session()->flash('message', 'Newborn record added successfully!');
        $this->closeModal();
    }

    public function editNewborn($id)
    {
        $newborn = newBorns::findOrFail($id);
        $this->fill($newborn->toArray());
        $this->newborn_id = $id;
        $this->isModalOpen = true;
        $this->editMode = true;
    }

    public function updateNewborn()
    {
        $this->validate([
            'date_of_delivery' => 'required|date',
            'time_of_delivery' => 'required',
            'name_of_mother' => 'required|string|max:255',
            'age' => 'required|integer|min:1',
            'sex_of_baby' => 'required',
            'name_of_child' => 'required|string|max:255',
            'length' => 'required|numeric',
            'weight' => 'required|numeric',
            'date_and_vaccine_given' => 'nullable|string',
            'place_of_delivery' => 'nullable|string|max:255',
            'type_of_delivery' => 'nullable|string',
            'remarks' => 'nullable|string',
        ]);

        newBorns::find($this->newborn_id)->update([
            'date_of_delivery' => $this->date_of_delivery,
            'time_of_delivery' => $this->time_of_delivery,
            'name_of_mother' => $this->name_of_mother,
            'age' => $this->age,
            'sex_of_baby' => $this->sex_of_baby,
            'name_of_child' => $this->name_of_child,
            'length' => $this->length,
            'weight' => $this->weight,
            'date_and_vaccine_given' => $this->date_and_vaccine_given,
            'place_of_delivery' => $this->place_of_delivery,
            'type_of_delivery' => $this->type_of_delivery,
            'remarks' => $this->remarks,
        ]);

        session()->flash('message', 'Newborn record updated successfully!');
        $this->closeModal();
    }

    public function confirmDelete($id)
    {
        newBorns::findOrFail($id)->delete();
        session()->flash('message', 'Newborn record deleted successfully!');
    }
}
