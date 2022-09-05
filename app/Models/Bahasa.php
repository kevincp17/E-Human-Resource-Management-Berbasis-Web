<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bahasa extends Model
{
    protected $table = 'languange';
    public $timestamps=false;

    public function user()
    {
        return $this->belongsTo('App\User','user_id');
    }
}
