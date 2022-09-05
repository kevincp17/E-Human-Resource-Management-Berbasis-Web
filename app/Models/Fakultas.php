<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Fakultas extends Model
{
    protected $table = 'fakultas';

    public function jurusan(){
        return $this->hasMany('App\Jurusan','fakultas_id');
    }
}
