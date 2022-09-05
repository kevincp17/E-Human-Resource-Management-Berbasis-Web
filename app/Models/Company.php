<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    protected $table = 'company';
    public $timestamps=false;

    public function user()
    {
        return $this->belongsTo('App\User','user_id');
    }

    public function job()
    {
        return $this->hasMany('App\Job','company_id');
    }

    public function rekening()
    {
        return $this->hasMany('App\Rekening','company_id');
    }
}
