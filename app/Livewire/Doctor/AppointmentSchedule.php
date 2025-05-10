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
    public $timeSlots = [];



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



    // $type = strtolower($appointment->client_type ?? 'others');
    // $timeSlot = match ($type) {
    //     'newborn' => '7:00–8:00AM',
    //     'pregnant' => '8:30–10:30AM',
    //     'senior citizen' => '10:30–11:30AM',
    //     'pwd' => '1:00–2:00PM',
    //     default => '3:00–4:00PM'
    // };

    $clientType = $appointment->category_type ?? 'Others';
$timeSlot = $this->timeSlots[$clientType] ?? '3:00–4:00PM';


$msg = "Hi {$appointment->patient_name}, your appt is on {$this->available_date} @ $timeSlot.";

// Trim to 90 characters max
$msg = substr($msg, 0, 90);

// $smsTime = match ($type) {
//     'newborn' => [7, 0],
//     'pregnant' => [8, 0],
//     'senior citizen' => [9, 0],
//     'pwd' => [12, 0],
//     default => [13, 0]
// };
// $sendTime = Carbon::parse($this->available_date)
//     ->subDay()
//     ->setTime($smsTime[0], $smsTime[1]);

// Parse start time from the selected time slot (e.g. "8:30–10:30AM")
$slotStart = explode('–', $timeSlot)[0] ?? '7:00AM';

try {
    $parsedStart = Carbon::parse($slotStart);
} catch (\Exception $e) {
    $parsedStart = Carbon::parse('7:00AM');
}

$sendTime = Carbon::parse($this->available_date)
    ->subDay()
    ->setTime($parsedStart->hour, $parsedStart->minute);



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

