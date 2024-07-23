<?php

namespace App\Imports;

use App\Models\Question;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class QuestionsImport implements ToModel, WithHeadingRow
{
    public function model(array $row)
    {
        return new Question([
            'question_no' => $row['question_no'],
            'challenge_id' => $row['challenge_id'],
            'answer_id' => $row['answer_id'],
            'marks' => $row['marks'],
        ]);
    }
}
