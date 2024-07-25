<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class submissions extends Model
{
    use HasFactory;

    protected $table = 'table__submissions';

    protected $primaryKey = 'submissionID';

    protected $fillable = [
        'average_score',
        'answerID',
    ];

    public function answer()
    {
        return $this->belongsTo(Answer::class, 'answerID', 'answerID');
    }
}

