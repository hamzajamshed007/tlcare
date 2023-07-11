<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BabySitterCertificate extends Model
{
    use HasFactory;
    protected $table = "baby_sitter_certificate";
    protected $fillable = [
        'baby_sitter_id',
        'certificates',
    ];
}
