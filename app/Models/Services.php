<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Services extends Model
{
    use HasFactory;
    protected $table = "services";
    protected $fillable = [
        'user_id',
        'service_name',
        'description',
        'status'
    ];

    public function Children()
    {
        return $this->hasMany(Childrens::class,'service_id','id');
    }
    public function User()
    {
        return $this->hasOne(User::class,'id','user_id');
    }
    public function TimeSchedules()
    {
        return $this->hasMany(TimeSchedules::class,'service_id','id');
    }
    public function Applicants()
    {
        return $this->hasOne(Applicants::class,'service_id','id');
    }
}
