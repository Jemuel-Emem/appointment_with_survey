<?php
namespace App\Livewire\Admin;

use App\Models\Appointment;
use App\Models\followup_appointments as FollowupAppointment;
use Livewire\Component;

class Appointments extends Component
{
    public $showFollowupModal = false;
    public $selectedAppointmentId;
    public $followups = [];

    public function openFollowupModal($appointmentId)
    {
        $this->selectedAppointmentId = $appointmentId;
        $this->followups = FollowupAppointment::where('appointment_id', $appointmentId)->get();
        $this->showFollowupModal = true;
    }

    public function closeFollowupModal()
    {
        $this->showFollowupModal = false;
        $this->selectedAppointmentId = null;
        $this->followups = [];
    }

    public function render()
    {
        return view('livewire.admin.appointments', [
            'appointments' => Appointment::with('doctor')->get(),
        ]);
    }
}
