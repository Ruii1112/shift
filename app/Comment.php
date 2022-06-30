<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $fillable = [
        'sentence', 'user_id', 'shift_id',
    ];
    
     public function shifts()
    {
        return $this->belogsTo('App\Shift');
    }
    
    public function users()
    {
        return $this->belogsTo('App\User');
    }
}
