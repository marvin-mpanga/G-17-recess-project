<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function showAboutUs()
    {
        return view('/aboutUs');
    }

    public function showContact()
    {
        return view('/contact');
    }
}
