<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class challenge_progress extends Model
{
    use HasFactory;
    protected $table = 'challenge_progress';

    protected $fillable = [
        'challenge_id',
        'challengeId',
        'participantId',
    ];

    public $timestamps = true;

    // Optional: Define relationships
    public function challenge()
    {
        return $this->belongsTo(Challenge::class, 'challengeId');
    }

    public function participant()
    {
        return $this->belongsTo(Participant::class, 'participantId');
    }


}
