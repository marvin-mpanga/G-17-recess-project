<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Administrator extends Model
{
    protected $table = '_administrator';
    protected $primaryKey = 'adminID';
    protected $fillable = [
        'name',
        'password',
    ];
}
