<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Challenge;
use App\Models\Question;
use App\Models\PupilChallenge;
use Illuminate\Support\Facades\Auth;

class ChallengeController extends Controller
{       
    public function setChallengeParams(Request $request)
    {
        $validatedData = $request->validate([
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
            'duration' => 'required|integer|min:1',
            'num_questions' => 'required|integer|min:1|max:100',
        ]);

        $challenge = new Challenge();
        $challenge->start_date = $validatedData['start_date'];
        $challenge->end_date = $validatedData['end_date'];
        $challenge->duration = $validatedData['duration'];
        $challenge->num_questions = $validatedData['num_questions'];
        $challenge->save();

        return redirect()->back()->with('status', 'Challenge parameters set successfully.');
    }

    public function getRandomQuestions()
    {
        $pupil = Auth::user();
        $activeChallenge = Challenge::where('start_date', '<=', now())
                                    ->where('end_date', '>=', now())
                                    ->first();

        if (!$activeChallenge) {
            return redirect()->back()->with('status', 'No active challenge available.');
        }

        $questions = Question::inRandomOrder()->take($activeChallenge->num_questions)->get();
        session(['questions' => $questions]);

        return redirect()->route('present.question');
    }

    public function presentQuestion(Request $request)
    {
        $questions = session('questions', []);
        $currentQuestion = session('current_question', 0);

        if ($currentQuestion >= count($questions)) {
            return redirect()->route('generate.report');
        }

        $question = $questions[$currentQuestion];
        session(['current_question' => $currentQuestion + 1]);

        return view('challenge.question', compact('question'));
    }

    public function scoreAnswer(Request $request)
    {
        $validatedData = $request->validate([
            'answer' => 'required',
        ]);

        $questions = session('questions', []);
        $currentQuestion = session('current_question', 0) - 1;
        $question = $questions[$currentQuestion];

        $score = 0;
        if ($validatedData['answer'] == '-') {
            $score = 0;
        } elseif ($validatedData['answer'] != $question->correct_answer) {
            $score = -3;
        } else {
            $score = $question->marks;
        }

        $scores = session('scores', []);
        $scores[] = [
            'question_id' => $question->id,
            'score' => $score,
            'answered_at' => now(),
        ];
        session(['scores' => $scores]);

        return redirect()->route('present.question');
    }

    public function managePupilAttempts()
    {
        $pupil = Auth::user();
        $challenges = PupilChallenge::where('pupil_id', $pupil->id)->get();

        return view('challenge.manage_attempts', compact('challenges'));
    }

    public function startChallenge(Request $request)
    {
        $pupil = Auth::user();
        $activeChallenge = Challenge::where('start_date', '<=', now())
                                    ->where('end_date', '>=', now())
                                    ->first();

        if (!$activeChallenge) {
            return redirect()->back()->with('status', 'No active challenge available.');
        }

        $pupilChallenge = PupilChallenge::where('pupil_id', $pupil->id)
                                         ->where('challenge_id', $activeChallenge->id)
                                         ->where('completed', false)
                                         ->first();

        if ($pupilChallenge) {
            return redirect()->route('present.question');
        }

        $pupilChallenge = new PupilChallenge();
        $pupilChallenge->pupil_id = $pupil->id;
        $pupilChallenge->challenge_id = $activeChallenge->id;
        $pupilChallenge->start_time = now();
        $pupilChallenge->save();

        session(['challenge_start_time' => now()]);

        return redirect()->route('present.question');
    }

    public function endChallenge(Request $request)
    {
        $pupil = Auth::user();
        $activeChallenge = Challenge::where('start_date', '<=', now())
                                    ->where('end_date', '>=', now())
                                    ->first();

        $pupilChallenge = PupilChallenge::where('pupil_id', $pupil->id)
                                         ->where('challenge_id', $activeChallenge->id)
                                         ->where('completed', false)
                                         ->first();

        if ($pupilChallenge) {
            $pupilChallenge->completed = true;
            $pupilChallenge->end_time = now();
            $pupilChallenge->save();
        }

        return redirect()->route('generate.report');
    }

    public function submitAnswer(Request $request)
    {
        // This method can be reused from QuestionController's scoreAnswer method
        app('App\Http\Controllers\QuestionController')->scoreAnswer($request);
        return redirect()->route('challenge.end');
    }

}
