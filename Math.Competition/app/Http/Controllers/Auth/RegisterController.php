<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class RegisterController extends Controller
{
    use RegistersUsers;
    public function __construct()
    {
        $this->middleware('guest');
        
    }
    public function showadminRegisterForm()
    {
        return view('admin_register');
    }

    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:admins'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
    }

    protected function create(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);
    }
    public function adminRegister(Request $request)
    {
        $this->validator($request->all())->validate();
        $admin = $this->create($request->all());
        $this->guard('admin')->login($admin);


        return redirect()->intended('/admin.dashboard');
    }
    
    protected function guard(){
        return guard('pupil');

    }
    public function showpupilRegisterForm()
    {
        return view('pupil_register');
    }

    /**
     * Handle pupil registration.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function pupilRegister(Request $request)
{
    $request->validate([
        'fName' => 'required|string',
        'lName' => 'required|string',
        'username' => 'required|string',
        'dob' => 'required|date',
        'email' => 'required|email',
        'password' => 'required|string|min:8|confirmed',
        'password_confirmation' => 'required|string|min:8',
        'profile_picture' => $initial, // store the initial as the profile picture

    ]);

    $user = new User();
    $user->fName = $request->input('fName');
    $user->lName = $request->input('lName');
    $user->username = $request->input('username');
    $user->dob = $request->input('dob');
    $user->email = $request->input('email');
    $user->password = bcrypt($request->input('password'));
    $user->save();
    

    return redirect()->route('dashboard.overview')->with('success', 'Registration successful! Please log in.');
}


    /**
     * Show the representative registration form.
     *
     * @return \Illuminate\Http\Response
     */
    public function showrepRegisterForm()
    {
        return view('rep_register');
    }

    /**
     * Handle representative registration.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function repRegister(Request $request)
    {
        $this->validator($request->all())->validate();
        $rep = $this->create($request->all());
        return redirect()->route('rep.dashboard');
    }
    
    public function schoolRepCreate(){
    return view('schooRepDashboard');
    }
   
}

