<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Appointment extends Model
{

    protected $fillable = [
        'patient_name',
        'appointment_date',
        'appointment_time',
        'doctor_id',

    ];


    public function doctor()
    {
        return $this->belongsTo(User::class, 'doctor_id');
    }

    public function followups()
    {
        return $this->hasMany(followup_appointments::class, 'appointment_id');
    }
}
