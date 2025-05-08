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
        $appointmentsData = Appointment::select('appointment_date', 'appointment_time')
            ->get()
            ->groupBy('appointment_date');

        $this->appointments = [];

        foreach ($appointmentsData as $date => $appointments) {
            foreach ($appointments as $appointment) {
                $this->appointments[] = [
                    'title' => 'Appointment',
                    'start' => \Carbon\Carbon::parse($date)->format('Y-m-d'),
                    'time' => $appointment->appointment_time,
                    'color' => 'blue',
                    'type' => 'regular',
                    'count' => count($appointments) // count per day
                ];
            }
        }
    }


    public function render()
    {
        return view('livewire.doctor.index', [
            'allEvents' => $this->appointments
        ]);
    }

}
