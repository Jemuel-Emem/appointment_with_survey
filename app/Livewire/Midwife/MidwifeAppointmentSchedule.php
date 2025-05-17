<?php

namespace App\Livewire\Midwife;
use App\Models\Midwife_Appointment as Appointment;
use Carbon\Carbon;
use App\Jobs\SendSmsReminderJob;
use App\Models\midwife_availabilities;
use App\Models\User;

use Livewire\Component;

class MidwifeAppointmentSchedule extends Component
{

        public $showModal = false;
    public $available_date;
    public $doctor_id;
    public $timeSlots = [];


  public function saveAvailability()
{
    $this->validate([
        'available_date' => 'required|date|after_or_equal:today',
        'timeSlots.Newborn' => 'required',
        'timeSlots.Pregnant' => 'required',
    ]);

        midwife_availabilities::create([
        'available_date' => $this->available_date,
        'newborn_time' => $this->timeSlots['Newborn'],
        'pregnant_time' => $this->timeSlots['Pregnant']
    ]);

    $pendingAppointments = Appointment::whereNull('appointment_date')
        ->whereIn('category_type', ['Pregnant', 'Newborn'])
        ->orderBy('created_at')
        ->get();

    foreach ($pendingAppointments as $appointment) {
        // Get the appropriate time slot for the category
        $timeSlot = $this->timeSlots[$appointment->category_type];

        // Extract start time from time slot string (e.g., "7:00-8:00AM")
        $startTime = trim(explode('–', $timeSlot)[0]);

        try {
            $parsedTime = Carbon::parse($startTime);
        } catch (\Exception $e) {
            $parsedTime = Carbon::parse('8:00AM');
        }

        // Update appointment with date and time
        $appointment->update([
            'appointment_date' => $this->available_date,
            'appointment_time' => $parsedTime->format('H:i:s'),
        ]);

        // Prepare SMS message
        $msg = "Hi {$appointment->patient_name}, your {$appointment->category_type} ";
        $msg .= "appointment is scheduled for {$this->available_date} at {$timeSlot}.";

        // Schedule SMS reminder
        SendSmsReminderJob::dispatch(
            $appointment->phone_number,
            $appointment->patient_name,
            substr($msg, 0, 160)
        )->delay(
            Carbon::parse($this->available_date)->subDay()
        );
    }

    session()->flash('message', 'Appointments scheduled successfully!');
    $this->reset(['available_date', 'timeSlots', 'showModal']);
}
public function render()
{
    return view('livewire.midwife.midwife-appointment-schedule', [
        'schedules' => midwife_availabilities::latest()->get()
    ]);
}
}
