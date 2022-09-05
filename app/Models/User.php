<?php

namespace App\Models;

use App\Http\Middleware\Authenticate;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Laravel\Cashier\Billable;

class User extends Model
{
    use HasFactory, Notifiable,Billable;

    protected $table = 'user';
    protected $fillable = [
        'name','email', 'password','username','role_id'
    ];
    protected $hidden = [
        'password',
        'remember_token',
    ];
    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public $timestamps = false;

    public function role()
    {
        return $this->belongsTo('App\Role','role_id');
    }

    public function job_applies()
    {
        return $this->hasMany('App\JobApply','user_id');
    }

    public function education()
    {
        return $this->hasMany('App\Education','user_id');
    }

    public function skill()
    {
        return $this->hasMany('App\Skill','user_id');
    }

    public function experience()
    {
        return $this->hasMany('App\Experience','user_id');
    }

    public function rekening()
    {
        return $this->hasMany('App\Rekening','user_id');
    }

    public function verifyUser()
    {
        return $this->hasOne('App\VerifyUser');
    }


}
