<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;
    protected $table = 'transaction';
    public $timestamps=false;

    public function rekening()
    {
        return $this->belongsTo('App\Rekening','rekening_id');
    }
}
