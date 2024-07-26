<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class question_response extends Model
{
    use HasFactory;
    
    protected $table = 'question_response';

    protected $fillable = [
        'responseId',
        'questionId',
        'attemptId',
        'isCorrect',
        'startTime',
        'endTime',
    ];

    public $timestamps = true;

    // Optional: Define relationships
    public function question()
    {
        return $this->belongsTo(Question::class, 'questionId');
    }

    public function attempt()
    {
        return $this->belongsTo(Attempt::class, 'attemptId');
    }


}
