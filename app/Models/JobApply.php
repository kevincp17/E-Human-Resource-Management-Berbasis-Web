<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JobApply extends Model
{
    protected $table = 'job_applies';
    public $timestamps = false;
    protected $dates = ['tgl_wawancara'];

    public function user(){
        return $this->belongsTo('App\User','user_id');
    }

    public function job(){
        return $this->belongsTo('App\Job','job_id');
    }
}
