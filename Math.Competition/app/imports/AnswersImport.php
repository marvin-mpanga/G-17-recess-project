<?php

namespace App\Imports;
namespace App\Imports;

use App\Models\Answer;
use Maatwebsite\Excel\Concerns\ToModel;

class AnswerImport implements ToModel
{
    public function model(array $row)
    {
        return new Answer([
            'answerId' => $row['answerId'],
            'answerText' => $row['answerText'],
            'questionId' => $row['questionId'],
        ]);
    }
}