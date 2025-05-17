<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class midwife_availabilities extends Model
{
  protected $fillable = ['available_date', 'newborn_time', 'pregnant_time'];
}
