<?php

namespace App\Http\Controllers;

use App\Faculty;
use Illuminate\Http\Request;

class WelcomeController extends Controller
{
    //
    public function index()
    {
        $faculties = Faculty::all();
        return view('welcome', compact('faculties'));
    }
}
