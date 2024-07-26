<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Participant extends Model
{
    use HasFactory;
    protected $table = 'participant';

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
    ];

    public $timestamps = true;

}
