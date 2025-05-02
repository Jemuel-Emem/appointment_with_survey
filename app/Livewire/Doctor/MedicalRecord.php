<?php
namespace App\Livewire\Doctor;
use App\Models\Medical_Records;
use App\Models\patients;
use App\Models\Resident;
use Livewire\Component;

class MedicalRecord extends Component
{
    public $editMode = false;
public $editingId;
public $record_id = null;
    public $selectedRecord;
public $showViewModal = false;
    public $showModal = false;
    public $medicalRecords;
    public $search = '';

    // Patient Information
    public $household_id, $full_name, $date_of_birth, $age, $gender, $civil_status;
    public $contact_number, $email, $home_address, $purok_zone, $years_of_residency;


    public $diagnosis, $symptoms, $prescriptions;


    public function editRecord($id)
    {
        $record = Medical_Records::findOrFail($id);

        $this->record_id = $record->id;
        $this->household_id = $record->household_id;
        $this->full_name = $record->full_name;
        $this->date_of_birth = $record->date_of_birth;
        $this->age = $record->age;
        $this->gender = $record->gender;
        $this->civil_status = $record->civil_status;
        $this->contact_number = $record->contact_number;
        $this->email = $record->email;
        $this->home_address = $record->home_address;
        $this->purok_zone = $record->purok_zone;
        $this->years_of_residency = $record->years_of_residency;
        $this->diagnosis = $record->diagnosis;
        $this->symptoms = $record->symptoms;
        $this->prescriptions = $record->prescriptions;

        $this->showModal = true;
    }


    public function viewRecord($id)
    {
        $this->selectedRecord = Medical_Records::findOrFail($id);
        $this->showViewModal = true;
    }
    public function fetchPatientData()
    {
        $this->validate(['household_id' => 'required']);

        // First try to find in Patients table
        $patient = patients::where('household_id', $this->household_id)->first();

        if (!$patient) {
            // If not found in Patients, try Residents table
            $resident = Resident::where('household_id', $this->household_id)->first();

            if ($resident) {
                $this->fill([
                    'full_name' => $resident->full_name,
                    'date_of_birth' => $resident->date_of_birth,
                    'age' => $resident->age,
                    'gender' => $resident->gender,
                    'civil_status' => $resident->civil_status,
                    'contact_number' => $resident->contact_number,
                    'email' => $resident->email,
                    'home_address' => $resident->home_address,
                    'purok_zone' => $resident->purok_zone,
                    'years_of_residency' => $resident->years_of_residency,
                ]);

                $this->showModal = true;
            } else {
                session()->flash('error', 'No patient or resident found with that Household ID.');
            }
        } else {
            $this->fill([
                'full_name' => $patient->full_name,
                'date_of_birth' => $patient->date_of_birth,
                'age' => $patient->age,
                'gender' => $patient->gender,
                'civil_status' => $patient->civil_status,
                'contact_number' => $patient->contact_number,
                'email' => $patient->email,
                'home_address' => $patient->home_address,
                'purok_zone' => $patient->purok_zone,
                'years_of_residency' => $patient->years_of_residency,
            ]);

            $this->showModal = true;
        }
    }
    public function resetForm()
    {
        $this->reset([
            'household_id', 'full_name', 'date_of_birth', 'age', 'gender', 'civil_status',
            'contact_number', 'email', 'home_address', 'purok_zone', 'years_of_residency',
            'diagnosis', 'symptoms', 'prescriptions',
            'showModal', 'editMode', 'editingId'
        ]);
    }

    public function mount()
{
    $this->loadRecords();
}

public function loadRecords()
{
    $this->medicalRecords = Medical_Records::latest()->get();
}
    // public function save()
    // {
    //     $this->validate([
    //         'diagnosis' => 'required|string',
    //         'symptoms' => 'required|string',
    //         'prescriptions' => 'required|string',
    //     ]);

    //     Medical_Records::create([
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
    //         'diagnosis' => $this->diagnosis,
    //         'symptoms' => $this->symptoms,
    //         'prescriptions' => $this->prescriptions,
    //     ]);

    //     session()->flash('message', 'Medical record saved successfully!');

    //     $this->reset([
    //         'household_id', 'full_name', 'date_of_birth', 'age', 'gender', 'civil_status',
    //         'contact_number', 'email', 'home_address', 'purok_zone', 'years_of_residency',
    //         'diagnosis', 'symptoms', 'prescriptions', 'showModal'
    //     ]);
    // }

    public function save()
    {
        $this->validate([
            'diagnosis' => 'required|string',
            'symptoms' => 'required|string',
            'prescriptions' => 'required|string',
        ]);

        if ($this->record_id) {

            $record = Medical_Records::findOrFail($this->record_id);
            $record->update([
                'diagnosis' => $this->diagnosis,
                'symptoms' => $this->symptoms,
                'prescriptions' => $this->prescriptions,
            ]);

            session()->flash('message', 'Medical record updated successfully!');
        } else {

            Medical_Records::create([
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
                'diagnosis' => $this->diagnosis,
                'symptoms' => $this->symptoms,
                'prescriptions' => $this->prescriptions,
            ]);

            session()->flash('message', 'Medical record saved successfully!');
        }

        $this->reset([
            'household_id', 'full_name', 'date_of_birth', 'age', 'gender', 'civil_status',
            'contact_number', 'email', 'home_address', 'purok_zone', 'years_of_residency',
            'diagnosis', 'symptoms', 'prescriptions', 'showModal', 'record_id'
        ]);

        $this->loadRecords();
    }

    public function sar(){


    }
    protected $paginationTheme = 'bootstrap';
    public function render()
    {
        return view('livewire.doctor.medical-record', [
            'records' => Medical_Records::when($this->search, function ($query) {
                    $search = '%' . $this->search . '%';
                    $query->where('full_name', 'like', $search)
                          ->orWhere('diagnosis', 'like', $search)
                          ->orWhere('symptoms', 'like', $search)
                          ->orWhere('prescriptions', 'like', $search);
                })
                ->latest()
                ->paginate(10) // This creates a Paginator instance
        ]);
    }

}
