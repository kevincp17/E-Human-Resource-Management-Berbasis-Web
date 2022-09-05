<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Jurusan extends Model
{
    protected $table = 'jurusan';

    public function fakultas(){
        return $this->belongsTo('App\Fakultas','fakultas_id');
    }
}
