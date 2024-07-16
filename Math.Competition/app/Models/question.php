<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Question extends Model
{
    protected $table = 'question';
    protected $primaryKey = 'questionID';
    protected $fillable = [
        'questionNo',
        'challengeId',
    ];

    public function challenge(): BelongsTo
    {
        return $this->belongsTo(Challenge::class, 'challengeId');
    }
}

