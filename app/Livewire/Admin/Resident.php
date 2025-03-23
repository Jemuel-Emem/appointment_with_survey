<?php

namespace App\Livewire\Admin;
use App\Models\Resident as residents;
use Livewire\Component;

class Resident extends Component
{

    public $patients, $selectedResident, $showModal1 = false, $showModal = false, $viewAllModal = false;


    // Define all properties for form inputs
    public $household_id, $full_name, $date_of_birth, $age, $gender, $civil_status;
    public $contact_number, $email, $home_address, $purok_zone, $years_of_residency;

    // Emergency Contact
    public $emergency_name, $emergency_relationship, $emergency_contact_number, $emergency_alt_contact_number;

public $residents;

    public $category = [];

    public $editingResidentId = null;

    public function editResident($id)
    {
        $resident = residents::findOrFail($id);

        $this->editingResidentId = $id;
        $this->household_id = $resident->household_id;
        $this->full_name = $resident->full_name;
        $this->date_of_birth = $resident->date_of_birth;
        $this->age = $resident->age;
        $this->gender = $resident->gender;
        $this->civil_status = $resident->civil_status;
        $this->contact_number = $resident->contact_number;
        $this->email = $resident->email;
        $this->home_address = $resident->home_address;
        $this->purok_zone = $resident->purok_zone;
        $this->years_of_residency = $resident->years_of_residency;
        $this->emergency_name = $resident->emergency_contact_name;
        $this->emergency_relationship = $resident->emergency_contact_relationship;
        $this->emergency_contact_number = $resident->emergency_contact_number;
        $this->emergency_alt_contact_number = $resident->emergency_alt_contact_number;

        $this->showModal = true;
    }




    protected $rules = [
        'household_id' => 'required|string|max:50',
        'full_name' => 'required|string|max:255',
        'date_of_birth' => 'required|date',
        'age' => 'required|integer|min:0',
        'gender' => 'required|in:Male,Female',
        'civil_status' => 'required|string|max:50',
        'contact_number' => 'required|string|max:15',
        'email' => 'nullable|email|max:255',
        'home_address' => 'required|string|max:255',
        'purok_zone' => 'required|string|max:50',
        'years_of_residency' => 'required|integer|min:0',

        // Emergency Contact
        'emergency_name' => 'required|string|max:255',
        'emergency_relationship' => 'required|string|max:50',
        'emergency_contact_number' => 'required|string|max:15',
        'emergency_alt_contact_number' => 'nullable|string|max:15',


    ];
    public function openModal()
    {
        $this->resetValidation();
        $this->reset();
        $this->showModal = true;
    }

    public function closeModal()
    {
        $this->reset([
            'household_id', 'full_name', 'date_of_birth', 'age', 'gender', 'civil_status',
            'contact_number', 'email', 'home_address', 'purok_zone', 'years_of_residency',
            'emergency_name', 'emergency_relationship', 'emergency_contact_number', 'emergency_alt_contact_number',

        ]);

        $this->category = [];
        $this->showModal = false;
    }

    public function closeModal1(){

        $this->viewAllModal = false;
    }





    public function save()
    {
        $this->validate();

        if ($this->editingResidentId) {
            $resident = residents::findOrFail($this->editingResidentId);
            $resident->update([
                'household_id' => $this->household_id,
                'full_name' => $this->full_name,
                'date_of_birth' => $this->date_of_birth,
                'age' => $this->age,
                'gender' => $this->gender,
                'civil_status' => $this->civil_status,
                'contact_number' => $this->contact_number,
                'email' => $this->email,
                'home_address' => $this->home_address,
                'purok_zone' => $this->purok_zone,
                'years_of_residency' => $this->years_of_residency,
                'emergency_contact_name' => $this->emergency_name,
                'emergency_contact_relationship' => $this->emergency_relationship,
                'emergency_contact_number' => $this->emergency_contact_number,
                'emergency_alt_contact_number' => $this->emergency_alt_contact_number,
            ]);

            session()->flash('message', 'Resident updated successfully!');
        } else {
            residents::create([
                'household_id' => $this->household_id,
                'full_name' => $this->full_name,
                'date_of_birth' => $this->date_of_birth,
                'age' => $this->age,
                'gender' => $this->gender,
                'civil_status' => $this->civil_status,
                'contact_number' => $this->contact_number,
                'email' => $this->email,
                'home_address' => $this->home_address,
                'purok_zone' => $this->purok_zone,
                'years_of_residency' => $this->years_of_residency,
                'emergency_contact_name' => $this->emergency_name,
                'emergency_contact_relationship' => $this->emergency_relationship,
                'emergency_contact_number' => $this->emergency_contact_number,
                'emergency_alt_contact_number' => $this->emergency_alt_contact_number,
            ]);

            session()->flash('message', 'Resident added successfully!');
        }

        $this->closeModal();
    }


    public function showResident($id)
    {
        $this->selectedResident = residents::find($id);
        $this->viewAllModal = true;
    }

    public function deleteResident($id)
    {
        residents::findOrFail($id)->delete();
        session()->flash('message', 'Resident deleted successfully!');
        $this->residents = residents::all(); // Refresh data
    }

    public function mount()
    {
        $this->residents = residents::all();
    }

    public function render()
    {
        return view('livewire.admin.resident', [
            'residents' => residents::all(),
        ]);
    }

}
