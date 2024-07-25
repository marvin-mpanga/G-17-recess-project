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


    public function manageChallenge() {
        $challenges = Challenge::all();
        return view('manage_challenge')->with('challenges');
    }

    public function uploadSchools()
    {
        
        return view('upload_schools');
    }

    public function storeSchool(Request $request)
    {
        $request->validate([
            'schoolName' => 'required|string|max:255',
            'schoolDistrict' => 'required|string|max:255',
            'schoolRegNo' => 'required|string|max:255',
            'repId'=> 'required|String',
            'repName' => 'required|string|max:255',
            'repEmail' => 'required|email|unique:schools',
        ]);

        $school = School::create($request->all());

        return redirect()->route('upload_schools')->with('success', 'School added successfully.');
    }

    public function editSchool(School $school)
    {
        return view('edit_school')->with('school', $school);
    }

    public function updateSchool(Request $request, School $school)
    {
        $request->validate([
            'repId'=> 'required|String',
            'schoolName' => 'required|string',
            'schoolDistrict' => 'required|string',
            'schoolRegNo' => 'required|string',
            'repName' => 'required|string',
            'repEmail' => 'required|email', $school->id,
        ]);

        $school->update($request->all());

        return redirect()->route('upload_schools')->with('success', 'School updated successfully.');
    }

    public function deleteSchool(School $school)
    {
        $school->delete();

        return redirect()->route('upload_schools')->with('success', 'School deleted successfully.');
    }

    public function uploadQuestions()
    {
        $Questions= Question::all();
        $Answers= Answer::all();
        return view('upload_questions');
       
    }

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
    return back()->with('success', 'Challenge parameters set successfully!');
}

public function editChallenge($id)
{
    $challenge = Challenge::find($id);
    return view('edit-challenge', compact('challenge'));
}

public function updateChallenge(Request $request, $id)
{
    $challenge = Challenge::find($id);
    $challenge->update($request->all());
    return redirect()->route('manage_challenge')->with('success', 'Challenge updated successfully!');
}

public function deleteChallenge($id)
{
    Challenge::destroy($id);
    return redirect()->route('manage_challenge')->with('success', 'Challenge deleted successfully!');
}




}
