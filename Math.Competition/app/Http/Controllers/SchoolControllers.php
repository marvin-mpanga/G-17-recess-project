<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Schools;

class SchoolController extends Controller
{
    public function index()
    {
        try {
            $schools = School::all();
            return view('pages.table', compact('schools'));
        } catch (\Exception $e) {
            return response()->json(['error' => 'Failed to fetch schools: ' . $e->getMessage()], 500);
        }
    }
    public function fetchSchools()
    {
        $schools = School::all();
        $output = "";
        foreach ($schools as $school) {
            $output .= $school->id . "|" . $school->name . "|" . $school->district . "|" . $school->regno . "\n";
        }
        return response(rtrim($output), 200)->header('Content-Type', 'text/plain');
    }

    public function addSchool(Request $request)
    {
        try {
            $school = new School();
            $school->name = $request->name;
            $school->district = $request->district;
            $school->regno = $request->regno;
            $school->save();

            return response("success|School added successfully", 200)->header('Content-Type', 'text/plain');
        } catch (\Exception $e) {
            return response("error|Failed to add school: " . $e->getMessage(), 500)->header('Content-Type', 'text/plain');}
        }

}