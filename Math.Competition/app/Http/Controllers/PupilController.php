<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Challenge;
use App\Models\answers;
use App\Models\Submission;
use App\Models\User;
use App\Models\Pupil;
use Illuminate\Support\Facades\Auth;

class PupilController extends Controller
{   

    public function pupilLogin(Request $request){
        return redirect()->route('dashboard.overview');
    }
    
    public function pupilRegister(Request $request){
        
            // Validate the request data
            $request->validate([
                'pupilId' => 'required|string',
                'username' => 'required|string',
                'name' => 'required|string',
                'email' => 'required|email',
                'D_O_B' => 'required|date',
                'password' => 'required|string',
                'renterPassword' => 'required|string',
            ]);
        
            // Create a new pupil record
            $pupil = Pupil::create([
                'pupilId' => $request->input('pupilId'),
                'username' => $request->input('username'),
                'name' => $request->input('name'),
                'email' => $request->input('email'),
                'D_O_B' => $request->input('D_O_B'),
                'password' => bcrypt($request->input('password')),
            ]);
        
            // Return a response
            return redirect()->route('dashboard.overview')->with('success', 'Registration successful!');
        }
        public function store(Request $request)
{
    $validatedData = $request->validate([
        'name' => 'required',
        'email' => 'required|email',
        'D_O_B' => 'required|date',
        'password' => 'required|min:8',
        'userName' => 'required', // add this line
    ]);

    $validatedData['password'] = bcrypt($validatedData['password']);

    Pupil::create($validatedData);
} 
public function update(Request $request)
{
  $pupil = Pupil::find($request->input('pupil_id'));
  $pupil->name = $request->input('name');
  $pupil->username = $request->input('username');
  $pupil->date_of_birth = $request->input('date_of_birth');
  $pupil->save();
  return response()->json(['success' => true]);
}


    public function showOverview()
    {
        return view('auth.dashboard.overview');

    }
    public function showAnalytics()
    {
    // ...
        return view('auth.dashboard.analytics');

    }

    public function showProgress()
    {
        
        return view('auth.dashboard.progress');
    }

    public function showSubmissions()
    {
        
        return view('auth.dashboard.submissions');
    }

    public function showProfile()
    {
            return view('auth.dashboard.profile');
        
    
    }

   

    public function showSettings()
    {
        return view('auth.dashboard.settings');
    }

    public function showHelp()
    {
        return view('auth.dashboard.help');
    }

}