<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Representative extends Authenticatable
{
    use Notifiable;

    protected $table = '_representative';
    protected $primaryKey = 'repId';

    protected $fillable = [
        'schoolRegNo',
        'repName',
        'password',
        'email',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];
}
