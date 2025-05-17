<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Newborn extends Model
{
    //

    protected $fillable = [
        'date_of_delivery',
        'time_of_delivery',
        'name_of_mother',
        'age',
        'sex_of_baby',
        'name_of_child',
        'length',
        'weight',
        'date_and_vaccine_given',
        'place_of_delivery',
        'type_of_delivery',
        'remarks',
            'phone_number'
    ];
}
