<?php

namespace App\Http\Controllers;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use App\Models\Challenge;

use App\Imports\QuestionsImport;
use App\Imports\AnswersImport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Auth;



class AdminController extends Controller
{   
    public function adminRegister(Request $request){
        return redirect()->route('admin.dashboard');
    }

    public function adminLogin(Request $request){
        return redirect()->route('admin.dashboard');
    }
    public function showAdminDashboard()
    {
    return view('admin_dashboard');
    }

    public function adminProfile(){
        $admin = Auth::guard('admin')->user();
    if ($admin) {
        return view('admin_profile', compact('admin'));
    } else {
        return redirect()->route('admin_login');
    }

}

public function editInfo()
{
    $admin = Auth::user();
    return view('admin.edit-info', compact('admin'));
}

public function updateInfo(Request $request)
{
    $admin = Auth::user();
    $admin->update($request->all());
    return redirect()->back()->with('success', 'Info updated successfully!');
}



public function updateProfile(Request $request)
{
    $admin = Auth::guard('admin')->user();
    $admin->name = $request->input('name');
    $admin->email = $request->input('email');
    $admin->password = bcrypt($request->input('password'));
    $admin->save();
    return back()->with('success', 'Profile updated successfully!');}


    public function adminOverview() {
        $challenges = Challenge::all();
        return view('admin_overview', compact('challenges'));
    }

    public function uploadSchools() {
        return view('upload_schools');
    }


    public function showUploadForm()
    {
        return view('upload_questions');
    }

    public function uploadQuestions(Request $request)
    {
        $request->validate([
            'questions' => 'required|file|mimes:xls,xlsx'
        ]);

        Excel::import(new QuestionsImport, $request->file('questions'));

        return redirect()->back()->with('success', 'Questions uploaded successfully.');
    }

    public function uploadAnswers(Request $request)
    {
        $request->validate([
            'answers' => 'required|file|mimes:xls,xlsx'
        ]);

        Excel::import(new AnswersImport, $request->file('answers'));

        return redirect()->back()->with('success', 'Answers uploaded successfully.');
    }

    public function uploadDocs(Request $request) {
    
    }

    public function overallStats() {

        return view('overall_stats');
    }
    
    public function showChallengeForm()
    {
        return view('challenge_form');
    }

    public function createChallenge(Request $request)
    {
        $request->validate([
            'start_date' => 'required|date',
            'end_date' => 'required|date',
            'duration' => 'required|integer',
            'num_questions' => 'required|integer',
        ]);

        Challenge::create($request->all());

        return back()->with('success', 'Challenge created successfully.');
    }


}
