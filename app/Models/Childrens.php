<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Childrens extends Model
{
    use HasFactory;
    protected $table = "childrens";
    protected $fillable = [
        'service_id',
        'user_id',
        'child_name',
        'child_age'
    ];
}
