<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Skill extends Model
{
    protected $table = 'skill';
    public $timestamps=false;

    protected $fillable = [
        'skill_name',
        'tingkat'
    ];

    public function user()
    {
        return $this->belongsTo('App\User','user_id');
    }
}
