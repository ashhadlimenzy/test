<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class appointmentdate extends Model
{
    use HasFactory;

    protected $fillable = [
        'doctor_id',
        'd_o_a',
        'time_slot',
        'end_time_slot',
        'duration',
    ];
}
