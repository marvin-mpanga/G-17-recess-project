<?php

namespace App\Http\Controllers;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use App\Models\Challenge;
use App\Models\School;
use App\Models\Question;
use App\Models\Answer;
use App\Imports\QuestionImport;
use App\Imports\AnswerImport;
use Maatwebsite\Excel\Facades\Excel;
use Maatwebsite\Excel\Collections\ToCollection;
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

    public function manageChallenge() {
        return view('manage_challenge')->with('challenges');
    }

    public function uploadSchools()
    {
        return view('upload_schools');
    }

    public function storeSchool(Request $request)
    {
        $validatedData = $request->validate([
            'school_regno' => 'required',
            'school_name' => 'required',
            'district' => 'required',
        ]);

        School::create($validatedData);

        return redirect()->back()->with('success', 'School uploaded successfully!');
    }


    // public function storeSchool(Request $request)
    // {
        

    //     return redirect()->route('upload_schools')->with('success', 'School added successfully.');
    // }
    //     public function uploadQuestions()
    // {
    //     $Questions= Question::all();
    //     $Answers= Answer::all();
    //     return view('upload_questions');
       
    // }

    public function showUploadForm(Request $request)
    {
        $request->validate([
            'import_questions' => 'required|file|mimes:xls,xlsx'
        ]);

        Excel::import(new QuestionImport, $request->file('import_questions'));

        return redirect()->back()->with('success', 'Questions uploaded successfully.');
    }
    
    public function showAnswerForm(Request $request)
    {
        $request->validate([
            'import_answers' => 'required|file|mimes:xls,xlsx'
        ]);

        Excel::import(new AnswerImport, $request->file('import_answers'));

        return redirect()->back()->with('success', 'Answers uploaded successfully.');
    }

    public function setChallengeParameter(Request $request)
{
    // Validate the request data
    $request->validate([
        'startDate' => 'required|date',
        'endDate' => 'required|date',
        'duration' => 'required|integer',
        'no_of_questions' => 'required|integer',
    ]);

    // Create a new challenge instance
    $challenge = new Challenge();

    // Assign the request data to the challenge instance
    $challenge->startDate = $request->input('startDate');
    $challenge->endDate = $request->input('endDate');
    $challenge->duration = $request->input('duration');
    $challenge->no_of_questions = $request->input('no_of_questions');

    // Save the challenge instance to the database
    $challenge->save();

    // Return a success message or redirect to a success page
    return redirect()->route('manage_challenge')->with('success', 'Challenge parameters set successfully!');
   }
}