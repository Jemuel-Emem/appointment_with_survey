<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Midwife_Appointment extends Model
{
    protected $fillable = [
        'patient_name',
        'appointment_date',
        'appointment_time',
        'category_type',
        'phone_number'


    ];


    public function followups()
    {
        return $this->hasMany(Midwife_FollowAppointement::class, 'med_id');
    }
}
