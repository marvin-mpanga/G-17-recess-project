<?php

namespace App\Models;
 
use Illuminate\Database\Eloquent\Model;

class Schools extends Model
{
    protected $table = '_schools';
    protected $primaryKey = 'schoolRegNo';
    protected $fillable = [
        'schoolName',
        'district',
    ];

}


