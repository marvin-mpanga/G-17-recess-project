<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminController extends Controller
{   
   
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function overview() {
        return view('overview');
    }

    public function manageSchools() {
        return view('schools');
    }

    public function manageQuestions() {
        return view('questions');
    }

    public function manageAnswers() {
        return view('answers');
    }

    public function manageUploads() {
        return view('uploads');
    }

    public function viewStatistics() {
        return view('stats');
    }
    public function index(){
    // Display both the dashboard and sidebar
    return view('admin.dashboard');
}


}
