<?php

namespace App\Livewire\Admin;
use App\Models\Resident;
use Livewire\Component;
use App\Models\patients as Patient; // Ensure you import the correct Patient model
use Illuminate\Validation\Rule;

class Patients extends Component
{
    public $patients, $selectedPatient, $showModal1 = false, $showModal = false, $viewAllModal = false;


    // Define all properties for form inputs
    public $household_id, $full_name, $date_of_birth, $age, $gender, $civil_status;
    public $contact_number, $email, $home_address, $purok_zone, $years_of_residency;

    // Emergency Contact
    public $emergency_name, $emergency_relationship, $emergency_contact_number, $emergency_alt_contact_number;

    // Health Information
    public $philhealth_member, $philhealth_number, $existing_medical_conditions, $allergies, $current_medications;
    public $past_surgeries, $family_medical_history, $covid_vaccinated, $other_vaccinations_received;

    // Categories
    public $pregnant = false, $newborn = false, $pwd = false, $senior_citizen = false, $months_pregnant_newborn;

    // Medical Treatment
    public $under_medical_treatment = false, $treatment_details;

    public $category = [];

    public $editingPatientId = null;

    public $residentData = null;



    public function editPatient($id)
    {
        $patient = Patient::findOrFail($id);

        $this->editingPatientId = $id;
        $this->household_id = $patient->household_id;
        $this->full_name = $patient->full_name;
        $this->date_of_birth = $patient->date_of_birth;
        $this->age = $patient->age;
        $this->gender = $patient->gender;
        $this->civil_status = $patient->civil_status;
        $this->contact_number = $patient->contact_number;
        $this->email = $patient->email;
        $this->home_address = $patient->home_address;
        $this->purok_zone = $patient->purok_zone;
        $this->years_of_residency = $patient->years_of_residency;
        $this->emergency_name = $patient->emergency_contact_name;
        $this->emergency_relationship = $patient->emergency_contact_relationship;
        $this->emergency_contact_number = $patient->emergency_contact_number;
        $this->emergency_alt_contact_number = $patient->emergency_alt_contact_number;
        $this->philhealth_member = $patient->philhealth_member;
        $this->philhealth_number = $patient->philhealth_number;
        $this->existing_medical_conditions = $patient->existing_medical_conditions;
        $this->allergies = $patient->allergies;
        $this->current_medications = $patient->current_medications;
        $this->past_surgeries = $patient->past_surgeries_hospitalizations;
        $this->family_medical_history = $patient->family_medical_history;
        $this->covid_vaccinated = $patient->covid_vaccinated;
        $this->other_vaccinations_received = $patient->other_vaccinations_received;

        // ✅ Ensure category is always an array
        $this->category = $patient->category ? json_decode($patient->category, true) : [];

        $this->months_pregnant_newborn = $patient->months_pregnant_newborn;
        $this->under_medical_treatment = $patient->under_medical_treatment;
        $this->treatment_details = $patient->treatment_details;

        // Open edit modal
        $this->showModal = true;


    }

    public function fetchResidentData()
{
    $resident = Resident::where('household_id', $this->household_id)->first();

    if ($resident) {
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

        // ✅ Set modal to open
        $this->showModal = true;

    } else {
        $this->reset([
            'full_name', 'date_of_birth', 'age', 'gender', 'civil_status',
            'contact_number', 'email', 'home_address', 'purok_zone', 'years_of_residency',
            'emergency_name', 'emergency_relationship', 'emergency_contact_number', 'emergency_alt_contact_number'
        ]);
    }
}

    public function render()
    {
        return view('livewire.admin.patients', [
            'patients' => Patient::all(), // Fetch all patients for display
        ]);
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

        // Health Information
        'philhealth_member' => 'required|boolean',
        'philhealth_number' => 'nullable|string|max:50',
        'existing_medical_conditions' => 'nullable|string',
        'allergies' => 'nullable|string',
        'current_medications' => 'nullable|string',
        'past_surgeries' => 'nullable|string',
        'family_medical_history' => 'nullable|string',
        'covid_vaccinated' => 'required|boolean',
        'other_vaccinations_received' => 'nullable|string',

        'category' => 'array', // Ensure category is an array
      'category.*' => 'string|in:Pregnant,Newborn,PWD,Senior Citizen,Others',
        'months_pregnant_newborn' => 'nullable|integer|min:0',

        // Medical Treatment
        'under_medical_treatment' => 'required|boolean',
        'treatment_details' => 'nullable|string',
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
            'philhealth_member', 'philhealth_number', 'existing_medical_conditions', 'allergies', 'current_medications',
            'past_surgeries', 'family_medical_history', 'covid_vaccinated', 'other_vaccinations_received',
            'months_pregnant_newborn', 'under_medical_treatment', 'treatment_details'
        ]);

        $this->category = [];
        $this->showModal = false;
    }

    public function closeModal1(){

        $this->viewAllModal = false;
    }




    // public function save()
    // {
    //     $this->validate();
    //     Patient::create([
    //         'household_id' => $this->household_id,
    //         'full_name' => $this->full_name,
    //         'date_of_birth' => $this->date_of_birth,
    //         'age' => $this->age,
    //         'gender' => $this->gender,
    //         'civil_status' => $this->civil_status,
    //         'contact_number' => $this->contact_number,
    //         'email' => $this->email,
    //         'home_address' => $this->home_address,
    //         'purok_zone' => $this->purok_zone,
    //         'years_of_residency' => $this->years_of_residency,
    //         'emergency_contact_name' => $this->emergency_name,
    //         'emergency_contact_relationship' => $this->emergency_relationship,
    //         'emergency_contact_number' => $this->emergency_contact_number,
    //         'emergency_alt_contact_number' => $this->emergency_alt_contact_number,
    //         'philhealth_member' => $this->philhealth_member,
    //         'philhealth_number' => $this->philhealth_number,
    //         'existing_medical_conditions' => $this->existing_medical_conditions,
    //         'allergies' => $this->allergies,
    //         'current_medications' => $this->current_medications,
    //         'past_surgeries_hospitalizations' => $this->past_surgeries,
    //         'family_medical_history' => $this->family_medical_history,
    //         'covid_vaccinated' => $this->covid_vaccinated,
    //         'other_vaccinations_received' => $this->other_vaccinations_received,
    //         'category' => json_encode($this->category),
    //         'months_pregnant_newborn' => $this->months_pregnant_newborn,
    //         'under_medical_treatment' => $this->under_medical_treatment,
    //         'treatment_details' => $this->treatment_details,
    //     ]);

    //     flash()->success('Patient added successfully!');

    //     $this->closeModal();
    // }
    public function save()
    {


        $this->validate();

        if ($this->editingPatientId) {
            // Update patient record
            $patient = Patient::findOrFail($this->editingPatientId);
            $patient->update([
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
                'philhealth_member' => $this->philhealth_member,
                'philhealth_number' => $this->philhealth_number,
                'existing_medical_conditions' => $this->existing_medical_conditions,
                'allergies' => $this->allergies,
                'current_medications' => $this->current_medications,
                'past_surgeries_hospitalizations' => $this->past_surgeries,
                'family_medical_history' => $this->family_medical_history,
                'covid_vaccinated' => $this->covid_vaccinated,
                'other_vaccinations_received' => $this->other_vaccinations_received,
                'category' => json_encode($this->category),
                'months_pregnant_newborn' => $this->months_pregnant_newborn,
                'under_medical_treatment' => $this->under_medical_treatment,
                'treatment_details' => $this->treatment_details,
            ]);

            flash()->success('Patient updated successfully!');
        } else {


            // Create new patient
            Patient::create([
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
                'philhealth_member' => $this->philhealth_member,
                'philhealth_number' => $this->philhealth_number,
                'existing_medical_conditions' => $this->existing_medical_conditions,
                'allergies' => $this->allergies,
                'current_medications' => $this->current_medications,
                'past_surgeries_hospitalizations' => $this->past_surgeries,
                'family_medical_history' => $this->family_medical_history,
                'covid_vaccinated' => $this->covid_vaccinated,
                'other_vaccinations_received' => $this->other_vaccinations_received,
                'category' => json_encode($this->category),
                'months_pregnant_newborn' => $this->months_pregnant_newborn,
                'under_medical_treatment' => $this->under_medical_treatment,
                'treatment_details' => $this->treatment_details,
            ]);

            flash()->success('Patient added successfully!');
        }

        $this->closeModal();
    }

    public function showPatient($id)
    {
        $this->selectedPatient = Patient::find($id);
        $this->viewAllModal = true;
    }
    public function deletePatient($id)
    {
        Patient::find($id)->delete();
        flash()->error('Patient deleted successfully!');
        $this->patients = Patient::all(); // Refresh data
    }

    public function mount()
    {
        $this->patients = Patient::all();
    }


}
