<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PregnantTracker extends Model
{
    //

    protected $fillable = [
        'pregnant_id',
        'date_of_visit', 'family_number', 'months_upon_visit',
        'purok', 'vaccine_received', 'weight', 'height',
        'bp', 'remarks', 'next_schedule_visit'
    ];

    public function pregnant()
{
    return $this->belongsTo(pregnants::class);
}

}
