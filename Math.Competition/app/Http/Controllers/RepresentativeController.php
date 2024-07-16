<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pupil;

class RepresentativeController extends Controller
{   
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
    {
    return view('school_rep.dashboard');
    }

    public function listPupils()
    {
       
        $pupils = Pupil::paginate(10); // Ensure pagination
        $totalPupils = Pupil::count();
        return view('schoolRep.viewApplicants', compact('pupils', 'totalPupils'));
       
    }

    public function confirmPupil(Request $request, $id)
    {
        $pupil = Pupil::find($id);
        $pupil->status = $request->input('confirm') == 'yes' ? 'confirmed' : 'rejected';
        $pupil->save();
        return redirect()->route('schoolRep.viewApplicants')->with('status', 'Pupil status updated!');
    }

    public function rep_profile()
    {
        $rep = auth()->user();
        return view('schoolRep.rep_profile', compact('rep'));
    }

    public function updateProfile(Request $request)
    {
        $rep = auth()->user();
        $rep->name = $request->input('name');
        $rep->email = $request->input('email');
        $rep->save();
        return redirect()->route('schoolRep.rep_profile')->with('status', 'Profile updated!');
    }

    public function communications()
    {
        return view('schoolRep.communications');
    }
    public function sendMessage(Request $request)
{
    // Get the message from the request
    $message = $request->input('message');

    // Fetch all pupils (or filter as necessary)
    $pupils = Pupil::all(); // or Pupil::where('some_criteria', 'value')->get();

    foreach ($pupils as $pupil) {
        $recipient = $pupil->email;

        // Send email
        Mail::to($recipient)->send(new PupilNotification($recipient, $message));
    }

    return redirect()->route('school-rep.communications')->with('status', 'Messages sent to all pupils!');
}
        public function analytics()
    {
        // Implement logic to fetch and display analytics data
        return view('schoolRep.analytics');
    }

    public function resources()
    {
        // Implement logic to fetch and display resources
        return view('schoolRep.resources');
    }
}
