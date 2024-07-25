<?php

namespace App\Models;
 
use Illuminate\Database\Eloquent\Model;

class School extends Model
{
    protected $table = '_schools';
    protected $primaryKey = 'schoolRegNo';
    protected $fillable = [
        'schoolName',
        'district',
    ];





}


