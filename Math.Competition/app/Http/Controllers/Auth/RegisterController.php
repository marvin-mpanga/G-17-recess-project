<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    protected function create(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);
    }

    /**
     * Show the administrator registration form.
     *
     * @return \Illuminate\Http\Response
     */
    public function showadminRegisterForm()
    {
        return view('auth.admin_register');
    }

    /**
     * Handle administrator registration.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function adminRegister(Request $request)
    {
        $this->validator($request->all())->validate();
        $admin = $this->create($request->all());
        return redirect()->route('admin.dashboard');
    }

    /**
     * Show the pupil registration form.
     *
     * @return \Illuminate\Http\Response
     */
    public function showpupilRegisterForm()
    {
        return view('auth.pupil_register');
    }

    /**
     * Handle pupil registration.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function pupilRegister(Request $request)
    {
        $this->validator($request->all())->validate();
        $pupil = $this->create($request->all());
        return redirect()->route('pupil.dashboard');
    }

    /**
     * Show the representative registration form.
     *
     * @return \Illuminate\Http\Response
     */
    public function showrepRegisterForm()
    {
        return view('auth.rep_register');
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
}

