<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Rejected extends Model
{
    protected $table = 'rejected';

    protected $fillable = [
        'fName',
        'lName',
        'email',
        'schoolRegNo',
    ];

    public $timestamps = true;

}

