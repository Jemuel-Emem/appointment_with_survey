<?php

namespace App\Livewire\Doctor;

use App\Models\followup_appointments as FollowupAppointment;
use App\Models\Appointment;
use Livewire\Component;

class Index extends Component
{
    public $appointments = [];
    public $followups = [];

    public function mount()
    {
        // Regular appointments
        $this->appointments = Appointment::select('id', 'appointment_date', 'appointment_time')
            ->get()
            ->map(function ($appointment) {
                $date = is_string($appointment->appointment_date)
                    ? \Carbon\Carbon::parse($appointment->appointment_date)
                    : $appointment->appointment_date;

                return [
                    'id' => $appointment->id,
                    'title' => 'Appointment',
                    'start' => $date->format('Y-m-d'),
                    'time' => $appointment->appointment_time,
                    'color' => 'blue',
                    'type' => 'regular'
                ];
            })->toArray();

        // Follow-up appointments
        $this->followups = FollowupAppointment::with('appointment')
            ->get()
            ->map(function ($followup) {
                $date = is_string($followup->followup_date)
                    ? \Carbon\Carbon::parse($followup->followup_date)
                    : $followup->followup_date;

                return [
                    'id' => $followup->id,
                    'title' => 'Follow-up',
                    'start' => $date->format('Y-m-d'),
                    'time' => $followup->appointment->appointment_time ?? '', // Use original appointment time
                    'color' => 'darkgreen',
                    'type' => 'followup'
                ];
            })->toArray();
    }

    public function render()
    {
        return view('livewire.doctor.index', [
            'allEvents' => array_merge($this->appointments, $this->followups)
        ]);
    }
}
