<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Administrator extends Authenticatable
{
    use Notifiable;

    protected $table = 'administrator';

    protected $fillable = [
        'adminId',
        'adminName',
        'password',
    ];

    public $timestamps = true;

    // Optional: Hide the password attribute
    protected $hidden = [
        'password',
    ];

}
