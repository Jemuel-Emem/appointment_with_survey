<?php

namespace App\Livewire\Midwife;
use App\Models\Midwife_Appointment;
use Carbon\Carbon;
use App\Models\Midwife_FollowAppointement as FollowupAppointment;
use App\Models\Midwife_Appointment as AppModel;
use Livewire\Component;

class Appointment extends Component
{

    public $showFollowupModal = false;
    public $selectedAppointmentId;
    public $followups = [];

    public $showModal = false;
    public $appointmentId, $patientName, $date, $time, $status, $doctorId;
    public $isEditing = false;

    public $followupDate;

    public function openModal()
    {
        $this->resetForm();
        $this->showModal = true;
        $this->isEditing = false;
    }

    public function openFollowupModal($appointmentId)
    {
        $this->appointmentId = $appointmentId;
        $this->followupDate = null;
        $this->showFollowupModal = true;
    }

    public function saveFollowup()
    {
        $this->validate(['followupDate' => 'required|date']);

        FollowupAppointment::create([
            'med_id' => $this->appointmentId,
            'followup_date' => $this->followupDate,
        ]);

        $this->showFollowupModal = false;
        $this->followupDate = null;
    }
    public function closeModal()
    {
        $this->showModal = false;
    }

    public function resetForm()
    {
        $this->reset(['appointmentId', 'patientName', 'date', 'time',  'doctorId']);
    }
    public function save()
    {


        $this->validate([
            'patientName' => 'required',
            'date' => 'required|date',
            'time' => 'required',

        ]);

        $appointmentDateTime = Carbon::parse($this->date . ' ' . $this->time);
        $now = Carbon::now();

        // Check if the appointment is in the past
        if ($appointmentDateTime->lessThan($now)) {
            $this->addError('time', 'Cannot book an appointment in the past.');
            return;
        }



        // Check for overlapping appointments within 30 minutes
        $conflict = AppModel::where('appointment_date', $this->date)

            ->where(function ($query) use ($appointmentDateTime) {
                $query->whereBetween('appointment_time', [
                    $appointmentDateTime->copy()->subMinutes(30)->format('H:i:s'),
                    $appointmentDateTime->copy()->addMinutes(30)->format('H:i:s'),
                ]);
            });


        if ($this->isEditing) {
            $conflict->where('id', '!=', $this->appointmentId);
        }

        if ($conflict->exists()) {
            $this->addError('time', 'This doctor already has an appointment within 30 minutes of the selected time.');
            return;
        }


        // Save or update
        if ($this->isEditing) {
            $appointment = AppModel::find($this->appointmentId);
            if ($appointment) {
                $appointment->update([
                    'patient_name' => $this->patientName,
                    'appointment_date' => $this->date,
                    'appointment_time' => $this->time,

                ]);
            }
        } else {
            AppModel::create([
                'patient_name' => $this->patientName,
                'appointment_date' => $this->date,
                'appointment_time' => $this->time,

            ]);
        }

        $this->resetForm();
        $this->closeModal();
    }


    public function editAppointment($id)
    {
        $appointment = AppModel::findOrFail($id);
        $this->appointmentId = $appointment->id;
        $this->patientName = $appointment->patient_name;
        $this->date = $appointment->appointment_date;
        $this->time = $appointment->appointment_time;
        $this->doctorId = $appointment->doctor_id;


        $this->isEditing = true;
        $this->showModal = true;
    }

    public function deleteAppointment($id)
    {
        AppModel::findOrFail($id)->delete();
    }


    public function render()
    {
        return view('livewire.midwife.appointment', [
            'appointments' => AppModel::with( 'followups')->get(),
        ]);
    }

}
