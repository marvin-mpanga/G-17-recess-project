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
        return view('admin_login');
    }
    public function adminLogin(Request $request)
    {
        $this->validate($request, [
            'adminID'=>'required|min:25',
            'name'=> 'required|min:255',
            'email' => 'required|email',
            'password' => 'required|min:4',
        ]);

        if (Auth::guard('admin')->attempt(['email' => $request->email, 'password' => $request->password], $request->get('remember'))) {
            return redirect()->intended(route('admin.dashboard'));
        }

        return back()->withInput($request->only('email', 'remember'));
    }

    public function showPupilLoginForm()
    {
        return view('pupil_login');
    }

    public function showRepLoginForm()
    {
        return view('representative_login');
    }

    // Handle login for Pupil


public function login(Request $request)
{
    $request->validate([
        'schoolRegNo' => 'required|string',
        'username' => 'required|string',
        'email' => 'required|email',
        'password' => 'required|string',
    ]);

    $user = User::where('schoolRegNo', $request->input('schoolRegNo'))
                ->where('username', $request->input('username'))
                ->where('email', $request->input('email'))
                ->first();

    if (!$user) {
        return redirect()->back()->withErrors(['login' => 'User not found. Please register first.']);
    }

    if (Auth::attempt($request->only(['schoolRegNo', 'username', 'email', 'password']))) {
        // Login successful, redirect to dashboard
        return redirect()->route('dashboard.overview');
    }

    // Login failed, redirect back with error message
    return redirect()->back()->withErrors(['login' => 'Invalid credentials']);
}



    // Handle login for Representative
    public function repLogin(Request $request)
    {
        $this->validate($request, [
            'email' => 'required|email',
            'password' => 'required|min:6',
        ]);

        if (Auth::guard('representative')->attempt(['email' => $request->email, 'password' => $request->password], $request->get('remember'))) {
            return redirect()->intended(route('schoolRep.dashboard'));
        }

        return back()->withInput($request->only('email', 'remember'));
    }

}