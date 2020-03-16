<?php

namespace App\Http\Controllers;

use App\Imports\UserImport;
use App\User;
use App\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Response;
use Intervention\Image\Facades\Image;
use Maatwebsite\Excel\Facades\Excel;


class UsersController extends Controller
{
    public function __construct()
    {

        $this->middleware('auth');
        $this->middleware('LibraryManager')->except('show', 'update','changePassword','pwdChange', 'editProfile');
    }



    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //return all users
        $users = User::paginate(3);

        return view('manager.users.index', compact('users'));
    }

    public function paginateIndex(Request $request)
    {
        if($request->ajax())
        {
            //return all users
            $users = User::paginate(10);

            return view('manager.users.paginateIndex', compact('users'))->render();
        }

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('manager.users.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        Excel::import(new UserImport, $request->file('file'));
        return redirect()->back()->with('success', 'User Data Uploaded Successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //show user details
        $user = User::findOrFail($id);
        return view('users.show', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $user = User::findOrFail($id);
        $roles = Role::all();
        return view('manager.users.edit', compact('user', 'roles'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

        //validate
        $this->validate($request,[
            'name'=>'required|string|max:225',
            'username'=>'required',
            'email'=>'required|email|max:225',
            'gender'=>'required|string|max:225',
            'date_of_birth'=>'required|date|max:225',
            'phone_number'=>'required|string|max:225',
        ]);


        if($request->hasFile('image'))
        {

            $image = $request->image;

            $fileNameWithExt = $image->getClientOriginalName();

            //Get just filename
            $fileName = pathinfo($fileNameWithExt, PATHINFO_FILENAME);
            $fileName = $request->input('username');

            //Get just extension
            $extension = $image->getClientOriginalExtension();

            //Filename to store
            $fileNameToStore = $fileName.'.'.$extension;



            //upload file

            $path = $image->storeAs('public/images/users', $fileNameToStore);

            $imagePath = public_path('images/users/'.$fileNameToStore);
            //resize image
            Image::make($image->getRealPath())->resize(128,128)->save($imagePath);

        }

        $user = User::find($id);

        $updateRequest = $request->except('image');
        if($request->hasfile('image'))
        {
            $updateRequest['image'] = $fileNameToStore;
        }
        $updateRequest['profile_updated'] = true;

        $user->update($updateRequest);

        return redirect('/home')->with('success', 'Profile Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //delete user
        $user = User::findOrFail($id);
        $user->delete();
        return redirect()->back()->with('success', 'User Records Deleted Successfully');
    }

    public function excelTemplate()
    {
        $filename = 'CreateUserTemplate.xlsx';
        $file_path = public_path().'/files/'.$filename;

        if(file_exists($file_path))
        {
            return response::download($file_path, $filename, ['Content-Length: '.filesize($file_path)]);
        }
    }

    public function pwdChange(Request $request, $id)
    {

        $this->validate($request,[

            'password' => 'required|string|min:6|confirmed',

        ]);

        $user = User::find($id);

        if(Hash::check($request->input('old-password'), $user->password))
        {
            $user->password = Hash::make($request->input('password'));
            $user->password_changed = 1;
            $user->save();
            return redirect('/home')->with('success', 'Password Changed Successfully');
        }
        return redirect('/home')->with('error', 'Invalid Password');
    }

    public function changePassword($id)
    {
        $user = User::find($id);
        return view('users.pwdChange', compact('user'));
    }

    public function editProfile($id)
    {
        $user = User::find($id);

        return view('users.profileUpdate', compact('user'));
    }


}
