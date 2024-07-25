<?php
namespace App\Imports;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;




class QuestionImport implements ToCollection, WithHeadingRow{
    public function collection(Collection $rows){

        foreach ($rows as $row) 
        {
            $question = Question::where('question_text', $row['question_text'])->first();
            
            if($question)
            {
                $question->update([
                    'question_text' => $row['question_text'],
                    'answer_id' => $row['answer_id'],
                ]);
                
            }
            else{ 
            Question::create([
                'question_id' => $row['question_id'],
                'question_text' => $row['question_text'],
                'answer_id' => $row['answer_id'],
            ]);
        }
    }
}
}