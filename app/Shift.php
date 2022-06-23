<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Shift extends Model
{
    protected $fillable = [
        'name', 'start_date', 'end_date', 'weekday_start_time', 'weekday_end_time', 'holiday_start_time', 'holiday_end_time',
    ];
}
