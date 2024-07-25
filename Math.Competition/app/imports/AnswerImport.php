<?php
namespace App\Imports;

use App\Models\Answer;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Collections\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class AnswerImport implements ToCollection, WithHeadingRow
{
    public function collection(Collection $rows){

        foreach ($rows as $row) 
        {
            $answer = Answer::where('answer_text', $row['answer_text'])->first();
            
            if($answer)
            {
                $answer->update([
                    'answer_text' => $row['answer_text'],
                    'question_id' => $row['question_id'],
                ]);
                
            }
            else{ 
            Answer::create([
                'question_id' => $row['question_id'],
                'answer_text' => $row['answer_text'],
                'answer_id' => $row['answer_id'],
            ]);
        }
    }
        return new Answer([
            'question_id' => $row['question_id'],
            'answer_text' => $row['answer_text'],
            'answer_id' => $row['answer_id'],
        ]);
    }
}
