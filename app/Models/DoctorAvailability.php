<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DoctorAvailability extends Model
{
    //

    protected $fillable = [
        'doctor_id',
        'available_date',
    ];

    public function doctor()
    {
        return $this->belongsTo(User::class, 'doctor_id');
    }
}
