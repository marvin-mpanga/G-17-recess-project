<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class challenge_progress extends Model
{
    use HasFactory;
    protected $table = 'table_challenge_progress';

    protected $fillable = [
        'progressId',
        'challenge',
        'participantId',
    ];

}
