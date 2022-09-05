<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rekening extends Model
{
    use HasFactory;
    protected $table = 'rekening';
    public $timestamps=false;

    public function company()
    {
        return $this->belongsTo('App\Company','company_id');
    }

    public function user()
    {
        return $this->belongsTo('App\User','user_id');
    }
}
