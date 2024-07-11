<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Representative extends Model
{
    protected $table = '_representative';
    protected $primaryKey = 'repId';
    protected $fillable = [
        'schoolRegNo',
        'repName',
        'password',
        'email',
    ];
}

