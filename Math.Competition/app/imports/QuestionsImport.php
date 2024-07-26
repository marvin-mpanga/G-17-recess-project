<?php
namespace App\Imports;

use App\Models\Question;
use Maatwebsite\Excel\Concerns\ToModel;

class QuestionImport implements ToModel
{
    public function model(array $row)
    {
        return new Question([
            'questionId' => $row['questionId'],
            'challengeID' => $row['challengeID'],
            'questionText' => $row['questionText'],
        ]);
    }
}