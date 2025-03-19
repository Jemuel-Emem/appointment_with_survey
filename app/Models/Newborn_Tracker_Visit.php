<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Newborn_Tracker_Visit extends Model
{
    //

    protected $fillable = [
        'newborn_id',
        'visit_date',
        'age_today',
        'height',
        'reason_of_visit',
        'vaccine_or_service_provided',
        'dose',
        'schedule_next_visit',
        'remarks'
    ];

    public function newborn()
    {
        return $this->belongsTo(Newborn::class);
    }
}
