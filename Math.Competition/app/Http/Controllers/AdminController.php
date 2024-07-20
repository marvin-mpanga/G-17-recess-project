<?php

namespace App\Http\Controllers;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Http\Request;

class AdminController extends Controller
{   
    public function adminRegister(Request $request){
        return redirect()->route('admin.dashboard');
    }

    public function showAdminDashboard()
    {
    return view('admin_dashboard');
    }

    public function adminProfile(){
        return view('admin_profile');
    }


    public function adminOverview() {
        return view('admin_overview');
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
            'questions' => 'required|mimes:xls,xlsx',
            'answers' => 'required|mimes:xls,xlsx',
        ]);

        // Process the questions file
        Excel::import(new QuestionsImport, $request->file('questions'));

        // Process the answers file
        Excel::import(new AnswersImport, $request->file('answers'));

        return back()->with('success', 'Files uploaded successfully.');
    }
    
    public function uploadAnswers() {
        // // Validate the request data
        // $request->validate([
        //     'answerNo'=> 'required',
        //     'questionID' => 'required',
        //     'challengeId'=> 'required',
        //     'correctAnswer' => 'required',
        // ]);

        // // Create a new answer instance
        // $answer = new Answer();
        // $answer->question_id = $request->input('questionID');
        // $answer->answerNo = $request->input('answerNo');
        // $answer->challengeID = $request->input('challengeID');
        // $answer->answer = $request->input('correctAnswer');
        

        // // Save the answer to the database
        // $answer->save();

        // // Return a success response
        // return redirect()->back()->with('success', 'Answer uploaded successfully!');
        return view('upload_answers');
    }

    public function uploadDocs(Request $request) {
                // Validate the request data
                $request->validate([
                    'file' => 'required|mimes:xlsx,xls',
                ]);
        
                // Get the uploaded file
                $file = $request->file('file');
        
                // Store the file in the "files" directory
                $filePath = Storage::putFile('files', $file);
        
                // Return a success response
                return redirect()->back()->with('success', 'File uploaded successfully!');
        
    
    }

    public function overallStats() {

        return view('overall_stats');
    }
    


}
