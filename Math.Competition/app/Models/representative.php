<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Representative extends Authenticatable
{
    protected $table = 'representative';

    protected $fillable = [
        'repId',
        'schoolRegNo',
        'repName',
        'repEmail',
        'password',
    ];

    public $timestamps = true;

    // Optional: Hide the password attribute
    protected $hidden = [
        'password',
    ];

}
 
