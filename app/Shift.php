<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Shift extends Model
{
    protected $fillable = [
        'name', 
    ];
    
    public function shifttimes()
    {
        return $this->hasMany('App\ShiftTime');
    }
    
    public function comments()
    {
        return $this->hasMany('App\Comment');
    }
    
    public function times()
    {
        return $this->hasMany('App\Time');
    }
}
