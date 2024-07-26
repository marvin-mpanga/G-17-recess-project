<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class pupil_score extends Model
{
    use HasFactory;

    protected $table = 'pupil_scores';

    protected $fillable = [
        'pupilID',
        'pupil_name',
        'year', 
        'score',
    ];

    public $timestamps = true;

    protected $casts = [
        'year' => 'integer',
        'score' => 'float',
    ];
}


