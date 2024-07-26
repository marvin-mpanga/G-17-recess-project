<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Answer extends Model
{
    use HasFactory;

    protected $table = 'answer';

    protected $fillable = [
        'answerId',
        'questionId',
        'answerTxt',
    ];

    public $timestamps = true;

    // Optional: Define relationships
    public function question()
    {
        return $this->belongsTo(Question::class, 'questionId');
    }


}
