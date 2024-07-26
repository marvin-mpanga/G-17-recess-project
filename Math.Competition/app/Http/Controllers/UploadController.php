<?php

namespace App\Imports;

use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\QuestionImport;
use App\Imports\AnswerImport;
Maatwebsite\Excel\Facades\Excel;

class UploadController extends Controller
{
    public function index()
    {
        return view('upload');
    }

    public function uploadQuestions(Request $request)
    {
        Excel::import(new QuestionImport, $request->file('questions_file'));
        return back()->with('success_questions', 'Questions uploaded successfully!');
    }

    public function uploadAnswers(Request $request)
    {
        Excel::import(new AnswerImport, $request->file('answers_file'));
        return back()->with('success_answers', 'Answers uploaded successfully!');
    }
}