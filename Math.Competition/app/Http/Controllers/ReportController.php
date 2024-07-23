<?php

namespace App\Http\Controllers;
use App\Models\Challenge;


use Illuminate\Http\Request;
use Session;

class ReportController extends Controller
{
    public function generateReport()
    {
        // Retrieve the scores and questions from the session
        $scores = Session::get('scores');
        $questions = Session::get('questions');
        $startTime = Session::get('start_time');
        $endTime = now();
        $totalTime = $startTime->diffInSeconds($endTime);

        // Calculate the total score
        $totalScore = array_reduce($scores, function ($carry, $score) {
            return $carry + $score['score'];
        }, 0);

        // Calculate time taken for each question
        $questionTimes = [];
        foreach ($scores as $index => $score) {
            $questionStartTime = $startTime->copy()->addSeconds($index * ($totalTime / count($scores)));
            $questionEndTime = $questionStartTime->copy()->addSeconds($totalTime / count($scores));
            $questionTimes[] = [
                'question_id' => $score['question_id'],
                'time_taken' => $questionStartTime->diffInSeconds($questionEndTime)
            ];
        }

        // Pass data to the view
        return view('report', compact('scores', 'totalScore', 'totalTime', 'questionTimes'));
    }
}
