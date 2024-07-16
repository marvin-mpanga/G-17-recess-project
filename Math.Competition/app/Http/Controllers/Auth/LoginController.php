<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    use AuthenticatesUsers;

    protected $redirectTo = RouteServiceProvider::HOME;

    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function showAdminLoginForm(Request $request)
    {
        return view('auth.admin_login');
    }

    public function showPupilLoginForm(Request $request)
    {
        return view('auth.pupil_login');
    }

    public function showRepLoginForm(Request $request)
    {
        return view('auth.rep_login');
    }
    
    
    
}

