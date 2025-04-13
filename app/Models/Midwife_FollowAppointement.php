<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Midwife_FollowAppointement extends Model
{
    protected $table = 'midwife__follow_appointements'; // double underscore if needed
    protected $fillable = ['med_id', 'followup_date'];

    public function appointment()
    {
        return $this->belongsTo(Midwife_Appointment::class);
    }

}
