<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    use AuthenticatesUsers;

    // Default redirect path
    protected $redirectTo = RouteServiceProvider::HOME;

    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    // Show login forms
    public function showAdminLoginForm()
    {
        return view('auth.admin_login');
    }

    public function showPupilLoginForm()
    {
        return view('auth.pupil_login');
    }

    public function showRepLoginForm()
    {
        return view('auth.rep_login');
    }
}