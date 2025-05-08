<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Medical_Records extends Model
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
        'diagnosis',
        'symptoms',
        'prescriptions',
        'category'
    ];
}
