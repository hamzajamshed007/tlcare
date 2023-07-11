<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Applicants extends Model
{
    use HasFactory;
    protected $table = "applicants";
    protected $fillable = [
        'baby_sitter_id',
        'user_id',
        'service_id',
        'message',
        'status'
    ];
    public function BabySitter()
    {
        return $this->hasOne(User::class,'id','baby_sitter_id');
    }
    public function User()
    {
        return $this->hasOne(User::class,'id','user_id');
    }
    public function Service()
    {
        return $this->hasOne(Services::class,'id','service_id');
    }
}
