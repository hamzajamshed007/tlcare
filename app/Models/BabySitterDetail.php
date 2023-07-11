<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BabySitterDetail extends Model
{
    use HasFactory;
    protected $table = "baby_sitter_detail";
    protected $fillable = [
        'baby_sitter_id',
        'first_name',
        'last_name',
        'age',
        'hourly_rate',
        'lat',
        'long',
        'experience',
        'description',
    ];
}
