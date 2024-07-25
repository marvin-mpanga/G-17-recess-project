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

    public function pupilLogin(Request $request){
        return redirect()->route('pupil.dashboard');
    }
    public function pupilRegister(Request $request)
    {
        // Registration logic here
        return redirect()->route('pupil.dashboard');
    }
    public function showPupilDashboard()
    {
        return view('auth.pupil_dashboard');

    }
    public function showChallenges()
    {
        
        return view('auth.pupil.challenges');
    }

    public function showProgress()
    {
        
        return view('auth.pupil.progress');
    }

    public function showSubmissions()
    {
        
        return view('auth.pupil.submissions');
    }

    public function showProfile()
    {
        return view('auth.pupil.profile');
    }

   

    public function showSettings()
    {
        return view('auth.pupil.settings');
    }

    public function showHelp()
    {
        return view('auth.pupil.help');
    }
    

}
