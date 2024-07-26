<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class perfomance extends Model
{
    use HasFactory;
    protected $fillable = [
        'SchoolId',
        'perfomance',
    ];

    protected $table = 'perfomance';
}
