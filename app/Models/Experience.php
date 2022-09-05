<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Experience extends Model
{
    protected $table = 'experience';
    public $timestamps=false;

    public function user()
    {
        return $this->belongsTo('App\User','user_id');
    }
}
