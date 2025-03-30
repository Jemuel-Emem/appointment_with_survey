<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class followup_appointments extends Model
{
    //

    protected $fillable = ['appointment_id', 'followup_date'];

    public function appointment()
    {
        return $this->belongsTo(Appointment::class);
    }


}
