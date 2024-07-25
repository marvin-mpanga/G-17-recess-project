<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Pupil extends Authenticatable
{
    use Notifiable;

    protected $table = 'pupil';
    protected $primaryKey = 'pupilID';

    protected $fillable = [
        'userName',
        'fName',
        'lName',
        'email',
        'D_O_B',
        'schoolRegNo',
        'password', 
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];
}
