<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Resident extends Model
{
    //

    protected $fillable = [
        'household_id',
        'full_name',
        'date_of_birth',
        'age',
        'gender',
        'civil_status',
        'contact_number',
        'email',
        'home_address',
        'purok_zone',
        'years_of_residency',

        // Emergency Contact
        'emergency_contact_name',
        'emergency_contact_relationship',
        'emergency_contact_number',
        'emergency_alt_contact_number',
    ];
}
