<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TimeSchedules extends Model
{
    use HasFactory;
    protected $table = "time_schedule";
    protected $fillable = [
        'service_id',
        'user_id',
        'date',
        'start_time',
        'end_time',
        'schedule',
    ];
}
