<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Attempt extends Model
{
    use HasFactory;
    protected $table = 'attempt';

    protected $fillable = [
        'attemptId',
        'participantId',
        'challengeId',
        'attemptNumber',
        'score',
    ];

    public $timestamps = true;

    // Optional: Define relationships
    public function participant()
    {
        return $this->belongsTo(Participant::class, 'participantId');
    }

    public function challenge()
    {
        return $this->belongsTo(Challenge::class, 'challengeId');
    }
}


