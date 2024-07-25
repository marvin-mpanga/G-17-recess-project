<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Challenge extends Model
{
    use HasFactory;
    protected $table = '_challenge';
    protected $primaryKey = 'id';
    protected $fillable = [
        'no_of_questions',
        'Duration',
        'startDate',
        'endDate',
    ];
}
