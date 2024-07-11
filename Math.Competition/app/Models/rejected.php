<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Rejected extends Model
{
    protected $table = 'rejected';
    protected $primaryKey = 'rejectionID';
    protected $fillable = [
        'userName',
        'firstName',
        'lastName',
        'email',
        'D_O_B',
        'schoolRegNo',
    ];
}

