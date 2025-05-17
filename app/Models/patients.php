<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class patients extends Model
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

        // Health Information
        'philhealth_member',
        'philhealth_number',
        'existing_medical_conditions',
        'allergies',
        'current_medications',
        'past_surgeries_hospitalizations',
        'family_medical_history',
        'covid_vaccinated',
        'other_vaccinations_received',


        'category',

        'under_medical_treatment',
        'treatment_details',
        'months_pregnant_newborn'
    ];
}
