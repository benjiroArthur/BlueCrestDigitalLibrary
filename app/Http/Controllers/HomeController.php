<?php

namespace App\Http\Controllers;

use App\Book;
use App\Department;
use App\Faculty;
use App\User;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $user_id = auth()->user()->id;
        if(auth()->user()->profile_updated == 1)
        {
            if(auth()->user()->password_changed == 1)
            {
//
                $faculties = Faculty::all();
                return view('home', compact('faculties'));
            }
            else
            {
                $user = User::find($user_id);

                return view('users.pwdChange', compact('user'));
            }

        }
        else
        {
            $user = User::find($user_id);

            return view('users.profileUpdate', compact('user'));
        }
    }

    public function requestDepartment(Request $request, $id)
    {
        if($request->ajax())
        {
            $departments = Department::where('faculty_id',$id)->get();
            return response()->json($departments);
        }
    }

    public function requestBooks(Request $request, $id)
    {
        if($request->ajax())
        {
            $books = Book::where('department_id',$id)->get();
            return response()->json($books);
        }
    }
}
