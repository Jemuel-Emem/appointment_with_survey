<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class pregnants extends Model
{
    //

    protected $fillable = [
        'date_tracked',
        'name',
        'dob',
        'age',
        'gp',
        'height',
        'weight',
        'bmi',
        'pregnant_months',
        'purok',
        'husband_partner',
        'muac',
        'tt_status',
        'remarks',
        'phone_number'
    ];
}
