<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Question;
use App\Models\Challenge;
use Session;

class QuestionController extends Controller
{
    // Get random questions and store them in the session
    public function getRandomQuestions()
    {
        $challenge = Challenge::find(1); // Assuming a single challenge setup
        $questions = Question::inRandomOrder()->take($challenge->num_questions)->get();

        // Store questions in the session
        Session::put('questions', $questions);
        Session::put('current_question_index', 0);
        Session::put('scores', []);
        Session::put('start_time', now());

        return redirect()->route('present.question');
    }

    // Present an individual question to the user
    public function presentQuestion()
    {
        $questions = Session::get('questions');
        $index = Session::get('current_question_index', 0);

        if ($index >= count($questions)) {
            return redirect()->route('generate.report');
        }

        $question = $questions[$index];
        return view('question', compact('question'));
    }

    // Score the user's answer
    public function scoreAnswer(Request $request)
    {
        $questions = Session::get('questions');
        $index = Session::get('current_question_index', 0);

        if ($index >= count($questions)) {
            return redirect()->route('generate.report');
        }

        $question = $questions[$index];
        $answer = $request->input('answer');

        // Logic to score the answer
        if ($answer == '-') {
            $score = 0;
        } elseif ($answer == $question->correct_answer) {
            $score = $question->marks;
        } else {
            $score = -3; // Deduct 3 marks for incorrect answer
        }

        // Store score
        $scores = Session::get('scores');
        $scores[] = ['question_id' => $question->id, 'score' => $score];
        Session::put('scores', $scores);

        // Increment the current question index
        Session::put('current_question_index', $index + 1);

        return redirect()->route('present.question');
    }
}
