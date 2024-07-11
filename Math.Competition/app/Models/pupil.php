<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pupil extends Model
{
    protected $table = 'pupil';
    protected $primaryKey = 'pupilID';
    protected $fillable = [
        'userName',
        'firstName',
        'lastName',
        'email',
        'D_O_B',
        'schoolRegNo',
    ];
}
