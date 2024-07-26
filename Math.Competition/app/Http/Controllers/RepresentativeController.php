<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pupil;
use App\Models\Representative;

class RepresentativeController extends Controller
{   
    public function repLogin(Request $request)
    {
        return redirect()->route('dashboard.overview');
    }
}
