<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class question_response extends Model
{
    use HasFactory;
    protected $table = 'table_question_response';

    protected $fillable = [
        'responsiveId',
        'attemptId',
        'questionId',
        'isCorrect',
        'timetaken',
    ];

    public $timestamps = true;

    protected $primaryKey = 'responsiveId';

    protected $keyType = 'string';

}
