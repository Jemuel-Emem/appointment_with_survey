<?php

namespace App\Livewire\Admin;
use App\Models\Midwife_Appointment as Appointment;
use App\Models\Midwife_FollowAppointement as FollowupAppointment;
use Livewire\Component;

class MedAppointements extends Component
{

    public $showFollowupModal = false;
    public $selectedAppointmentId;
    public $followups = [];

    public function openFollowupModal($appointmentId)
    {
        $this->selectedAppointmentId = $appointmentId;
        $this->followups = FollowupAppointment::where('med_id', $appointmentId)->get();
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
        return view('livewire.admin.med-appointements', [
            'appointments' => Appointment::all(),
        ]);

    }
}
