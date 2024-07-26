<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Challenge extends Model
{
    use HasFactory;
    protected $table = 'challenge';

    protected $fillable = [
        'challengeId',
        'challengeName',
        'challengeDate',
        'startTime',
        'endTime',
        'adminId',
    ];

    public $timestamps = true;

    // Optional: Define relationships
    public function administrator()
    {
        return $this->belongsTo(Administrator::class, 'adminId');
    }

    public function attempts()
    {
        return $this->hasMany(Attempt::class, 'challengeId');
    }

}

