<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Time extends Model
{
    protected $fillable = [
        'date', 'start_time', 'end_time', 'user_id', 'shift_id',
    ];
}
