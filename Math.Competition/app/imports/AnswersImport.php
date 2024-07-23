<?php
namespace App\Imports;

use App\Models\Answer;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class AnswersImport implements ToModel, WithHeadingRow
{
    public function model(array $row)
    {
        return new Answer([
            'answer_no' => $row['answer_no'],
            'question_id' => $row['question_id'],
            'challenge_id' => $row['challenge_id'],
            'answer_text' => $row['answer_text'],
            'score' => $row['score'],
        ]);
    }
}
