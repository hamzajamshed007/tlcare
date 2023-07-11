<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use App\Models\UserDetail;
use App\Models\BabySitterCertificate;
use App\Models\BabySitterDetail;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'social_login',
        'access_token',
        'otp',
        'user_type',
    ];

    public function UserDetail()
    {
        return $this->hasOne(UserDetail::class,'user_id','id');
    }

    public function BabySitterDetail()
    {
        return $this->hasOne(BabySitterDetail::class,'baby_sitter_id','id');
    }

    public function BabySitterCertificate()
    {
        return $this->hasMany(BabySitterCertificate::class,'baby_sitter_id','id');
    }
    public function Services()
    {
        return $this->hasMany(Services::class,'user_id','id');
    }

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
}
