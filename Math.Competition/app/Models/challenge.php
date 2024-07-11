<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Challenge extends Model
{
    protected $table = '_challenge';
    protected $primaryKey = 'challengeNo';
    protected $fillable = [
        'no_of_questions',
        'date',
        'startTime',
        'endTime',
    ];
}
