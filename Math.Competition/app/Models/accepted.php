<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Accepted extends Model
{
    protected $table = 'accepted';
    protected $primaryKey = 'participantID';
    protected $fillable = [
        'userName',
        'firstName',
        'lastName',
        'email',
        'D_O_B',
        'schoolRegNo',
    ];
}

