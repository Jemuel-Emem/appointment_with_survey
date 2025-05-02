<?php

namespace App\Livewire\Doctor;
use App\Models\followup_appointments as FollowupAppointment;
use App\Jobs\SendAppointmentSMS;
use App\Jobs\SendSmsReminderJob;
use Carbon\Carbon;
use App\Models\Appointment as AppModel;
use App\Models\User;

use Livewire\Component;

class Appointment extends Component
{
    public $showModal = false;
    public $appointmentId, $patientName, $date, $time, $status, $doctorId, $phone_number;
    public $isEditing = false;
    public $showFollowupModal = false;
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
            'appointment_id' => $this->appointmentId,
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



//     public function save()
// {
//     $this->validate([
//         'patientName' => 'required',
//         'phone_number' => 'required',
//         'date' => 'required|date',
//         'time' => 'required',
//         'doctorId' => 'required|exists:users,id',
//     ]);

//     $appointmentDateTime = Carbon::parse($this->date . ' ' . $this->time);
//     $now = Carbon::now();

//     // Prevent booking in the past
//     if ($appointmentDateTime->lessThan($now)) {
//         $this->addError('time', 'Cannot book an appointment in the past.');
//         return;
//     }

//     // Save or update
//     if ($this->isEditing) {
//         $appointment = AppModel::find($this->appointmentId);
//         if ($appointment) {
//             $appointment->update([
//                 'patient_name' => $this->patientName,
//                 'phone_number' => $this->phone_number,
//                 'appointment_date' => $this->date,
//                 'appointment_time' => $this->time,
//                 'doctor_id' => $this->doctorId,
//             ]);
//         }
//     } else {
//         $appointment = AppModel::create([
//             'patient_name' => $this->patientName,
//             'phone_number' => $this->phone_number,
//             'appointment_date' => $this->date,
//             'appointment_time' => $this->time,
//             'doctor_id' => $this->doctorId,
//         ]);
//     }

//     $appointmentDateTime = Carbon::parse($appointment->appointment_date . ' ' . $appointment->appointment_time);
//     $reminderTime = $appointmentDateTime->copy()->subDay();

//     SendSmsReminderJob::dispatch(
//         $appointment->phone_number,
//         $appointment->patient_name,
//         $appointmentDateTime->format('Y-m-d H:i:s')
//     )->delay($reminderTime);
//     $this->resetForm();
//     $this->closeModal();
// }

public function save()
{
    $this->validate([
        'patientName' => 'required',
        'phone_number' => 'required',
        'date' => 'required|date',
        'time' => 'required',
        'doctorId' => 'required|exists:users,id',
    ]);

    $appointmentDateTime = Carbon::parse($this->date . ' ' . $this->time);
    $now = Carbon::now();


    if ($appointmentDateTime->lessThan($now)) {
        $this->addError('time', 'Cannot book an appointment in the past.');
        return;
    }


    $conflict = AppModel::where('appointment_date', $this->date)
        ->where('doctor_id', $this->doctorId)
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


    if ($this->isEditing) {
        $appointment = AppModel::find($this->appointmentId);
        if ($appointment) {
            $appointment->update([
                'patient_name' => $this->patientName,
                'phone_number' => $this->phone_number,
                'appointment_date' => $this->date,
                'appointment_time' => $this->time,
                'doctor_id' => $this->doctorId,
            ]);
        }
    } else {
        $appointment = AppModel::create([
            'patient_name' => $this->patientName,
            'phone_number' => $this->phone_number,
            'appointment_date' => $this->date,
            'appointment_time' => $this->time,
            'doctor_id' => $this->doctorId,
        ]);
    }


    $appointmentDateTime = Carbon::parse($appointment->appointment_date . ' ' . $appointment->appointment_time);
    $reminderTime = $appointmentDateTime->copy()->subDay();

    SendSmsReminderJob::dispatch(
        $appointment->phone_number,
        $appointment->patient_name,
        $appointmentDateTime->format('Y-m-d H:i:s')
    )->delay($reminderTime);

    $this->resetForm();
    $this->closeModal();
}

    private function sendSMS($phoneNumber, $message)
    {
        $ch = curl_init();

        $parameters = array(
            'apikey' => '046125f45f4f187e838905df98273c4e',
            'number' => $phoneNumber,
            'message' => $message,
            'sendername' => 'KaisFrozen'
        );

        curl_setopt($ch, CURLOPT_URL, 'https://semaphore.co/api/v4/messages');
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($parameters));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        $output = curl_exec($ch);
        curl_close($ch);
    }

    public function editAppointment($id)
    {
        $appointment = AppModel::findOrFail($id);
        $this->appointmentId = $appointment->id;
        $this->patientName = $appointment->patient_name;
        $this->phone_number = $appointment->phone_number;
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
        return view('livewire.doctor.appointment', [
            'appointments' => AppModel::with('doctor', 'followups')->get(),
            'doctors' => \App\Models\User::where('is_admin', 2)->get(),
        ]);
    }
}
