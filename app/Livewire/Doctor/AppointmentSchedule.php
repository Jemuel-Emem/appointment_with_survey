<?php

namespace App\Livewire\Doctor;
use App\Models\Appointment;
use Carbon\Carbon;
use App\Jobs\SendSmsReminderJob;
use App\Models\User;
use App\Models\DoctorAvailability;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class AppointmentSchedule extends Component
{
    public $showModal = false;
    public $available_date;
    public $doctor_id;

//     public function saveAvailability()
// {
//     $this->validate([
//         'available_date' => 'required|date|after_or_equal:today',
//         'doctor_id' => 'required|exists:users,id',
//     ]);


//     $availability = DoctorAvailability::create([
//         'doctor_id' => $this->doctor_id,
//         'available_date' => $this->available_date,
//     ]);


//     $pendingAppointments = Appointment::whereNull('appointment_date')
//         ->orderBy('created_at')
//         ->get();

//     foreach ($pendingAppointments as $appointment) {
//         $appointment->update([
//             'appointment_date' => $this->available_date,
//         ]);
//     }

//     session()->flash('message', 'Schedule added and appointments updated!');
//     $this->reset(['available_date', 'doctor_id', 'showModal']);
// }

// public function saveAvailability()
// {
//     $this->validate([
//         'available_date' => 'required|date|after_or_equal:today',
//         'doctor_id' => 'required|exists:users,id',
//     ]);

//     $availability = DoctorAvailability::create([
//         'doctor_id' => $this->doctor_id,
//         'available_date' => $this->available_date,
//     ]);

//     $pendingAppointments = Appointment::whereNull('appointment_date')
//         ->orderBy('created_at')
//         ->get();

//     foreach ($pendingAppointments as $appointment) {
//         $appointment->update([
//             'appointment_date' => $this->available_date,
//         ]);

//         // Send SMS reminder for next day 7:40 AM
//         $sendTime = Carbon::parse($this->available_date)->setTime(7, 40);
//         if ($sendTime->isPast()) {
//             $sendTime = now()->addMinute(); // fallback if it's already past 7:40 today
//         }

//         SendSmsReminderJob::dispatch(
//             $appointment->phone_number,
//             $appointment->patient_name,
//             Carbon::parse($this->available_date)->format('Y-m-d') . ' (Auto-Scheduled)'
//         )->delay($sendTime);
//     }

//     session()->flash('message', 'Schedule added and appointments updated with SMS reminders!');
//     $this->reset(['available_date', 'doctor_id', 'showModal']);
// }

public function saveAvailability()
{
    $this->validate([
        'available_date' => 'required|date|after_or_equal:today',
        'doctor_id' => 'required|exists:users,id',
    ]);

    $availability = DoctorAvailability::create([
        'doctor_id' => $this->doctor_id,
        'available_date' => $this->available_date,
    ]);

    $pendingAppointments = Appointment::whereNull('appointment_date')
        ->orderBy('created_at')
        ->get();

    foreach ($pendingAppointments as $appointment) {
        $appointment->update([
            'appointment_date' => $this->available_date,
        ]);

        $type = strtolower($appointment->client_type ?? 'others');
        $timeSlot = match ($type) {
            'newborn' => '7:00–8:00AM',
            'pregnant' => '8:30–10:30AM',
            'senior' => '10:30–11:30AM',
            'pwd' => '1:00–2:00PM',
            default => '3:00–4:00PM'
        };


        $msg = "Hi {$appointment->patient_name}, your appt is on {$this->available_date} @ $timeSlot.";


        $msg = substr($msg, 0, 90);


        $sendTime = Carbon::parse($this->available_date)
            ->subDay()
            ->setTime(7, 40);

        if ($sendTime->isPast()) {
            $sendTime = now()->addMinutes(1);
        }

        SendSmsReminderJob::dispatch(
            $appointment->phone_number,
            $appointment->patient_name,
            $msg
        )->delay($sendTime);
    }

    session()->flash('message', 'Schedule added and appointments updated with SMS reminders!');
    $this->reset(['available_date', 'doctor_id', 'showModal']);
}

    public function render()
    {
        return view('livewire.doctor.appointment-schedule', [
            'schedules' => DoctorAvailability::with('doctor')->orderBy('available_date')->get(),
            'doctors' => User::where('is_admin', 2)->get(),
        ]);
    }
}

