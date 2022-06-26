<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ShiftTime extends Model
{
    protected $fillable = [
        'date', 'start_time', 'end_time', 'shift_id',
    ];
    
    public function shift()
    {
        return $this->belogsTo('App\Shift');
    }
}
