<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Challenge;
use App\Models\answers;
use App\Models\Submission;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class PupilController extends Controller
{
    public function index()
    {
        return view('pupil.dashboard');
    }

    public function challenges()
    {
        $challenges = Challenge::all();
        return view('pupil.challenges', compact('challenges'));
    }

    public function progress()
    {
        $pupilId = Auth::id();
        $answers = Answers::where('pupil_id', $pupilId)->get();
        $submissions = Submission::where('pupil_id', $pupilId)->get();
        return view('pupil.progress', compact('answersw', 'submissions'));
    }

    public function submissions()
    {
        $pupilId = Auth::id();
        $submissions = Submission::where('pupil_id', $pupilId)->get();
        return view('pupil.submissions', compact('submissions'));
    }

    public function profile()
    {
        $pupil = Auth::user();
        return view('pupil.profile', compact('pupil'));
    }

    public function updateProfile(Request $request)
    {
        $pupil = Auth::user();
        $pupil->name = $request->input('name');
        $pupil->email = $request->input('email');
        if ($request->has('password') && $request->input('password') != '') {
            $pupil->password = bcrypt($request->input('password'));
        }
        $pupil->save();

        return redirect()->route('pupil.profile')->with('status', 'Profile updated!');
    }

    public function settings()
    {
        return view('pupil.settings');
    }

    public function help()
    {
        return view('pupil.help');
    }
}
