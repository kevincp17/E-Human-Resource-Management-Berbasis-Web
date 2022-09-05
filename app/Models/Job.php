<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Job extends Model
{
    protected $table = 'job';
    public $timestamps=false;
//    protected $primaryKey = 'id';


    public function company()
    {
        return $this->belongsTo('App\Company','company_id');
    }

    public function job_applies()
    {
        return $this->hasMany('App\JobApply','job_id');
    }

}
