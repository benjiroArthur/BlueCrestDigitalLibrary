<?php

namespace App\Http\Controllers;

use App\Faculty;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;


class FacultyController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('LibraryManager');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //get list of all faculties
        $faculties = Faculty::all();
        return view('manager.faculty.index', compact('faculties'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //view for creating faculty record
        return view('manager.faculty.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //save newly created faculty into the database
        if($request->hasFile('cover_image'))
        {

            $image_file = $request->cover_image;

            $imageNameWithExt = $image_file->getClientOriginalName();

            //Get just filename
            $image_name = pathinfo($imageNameWithExt, PATHINFO_FILENAME);
            $image_name = $request->input('name');
            $image_name= str::title($image_name);
            $image_name = str_replace(' ', '', $image_name);

            //Get just extension
            $extension = $image_file->getClientOriginalExtension();

            //Filename to store
            $imageNameToStore = $image_name.'_'.time().'.'.$extension;



            //upload file

            $path = $image_file->storeAs('public/images/faculty/', $imageNameToStore);

            $image_path = public_path('images/faculty/'.$imageNameToStore);
            //resize image
            Image::make($image_file->getRealPath())->resize(400,250)->save($image_path);


        }

        $faculty = new Faculty();
        $facultyRequest = $request->except('cover_image');

        if($request->hasFile('cover_image')){$facultyRequest['cover_image'] = $imageNameToStore;}
        $faculty->create($facultyRequest);
        return redirect()->back()->with('success', 'Faculty Records Created Successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //Show details of the selected faculty
        $faculty = Faculty::findOrFail($id);
        return view('manager.faculty.show', compact('faculty'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //Edit a selected faculty
        $faculty = Faculty::findOrFail($id);
        return view('manager.faculty.edit', compact('faculty'));
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
        //Update the selected Faculty
        if($request->hasFile('cover_image'))
        {

            $image_file = $request->cover_image;

            $imageNameWithExt = $image_file->getClientOriginalName();

            //Get just filename
            $image_name = pathinfo($imageNameWithExt, PATHINFO_FILENAME);
            $image_name = $request->input('name');
            $image_name= str::title($image_name);
            $image_name = str_replace(' ', '', $image_name);

            //Get just extension
            $extension = $image_file->getClientOriginalExtension();

            //Filename to store
            $imageNameToStore = $image_name.'_'.time().'.'.$extension;



            //upload file

            $path = $image_file->storeAs('public/images/faculty/', $imageNameToStore);

            $image_path = public_path('images/faculty/'.$imageNameToStore);
            //resize image
            Image::make($image_file->getRealPath())->resize(400,250)->save($image_path);


        }
        $faculty = Faculty::findOrFail($id);

        $facultyRequest = $request->except('cover_image');

        if($request->hasFile('cover_image')){$facultyRequest['cover_image'] = $imageNameToStore;}
        $faculty->update($facultyRequest);

        return redirect()->back()->with('success', 'Faculty Records Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //Delete selected faculty records
        $faculty = Faculty::findOrFail($id);
        $faculty->departments()->books()->delete();
        $faculty->departments()->delete();
        $faculty->delete();
    }
}
