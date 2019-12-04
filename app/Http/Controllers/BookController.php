<?php

namespace App\Http\Controllers;


use App\Book;
use App\Department;
use App\Faculty;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;
use Intervention\Image\Facades\Image;

class BookController extends Controller
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
        //
        $books = Book::paginate(30);
        return view('manager.books.index', compact('books'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //create new book
        $faculties = Faculty::all();
        $departments = Department::all();
        return view('manager.books.create', compact('faculties', 'departments'));
    }

    public function requestDepartment(Request $request, $id)
    {
        if($request->ajax())
        {
            $departments = Department::where('faculty_id',$id)->get();
            return response()->json($departments);
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        //validate
        $this->validate($request,[
            'title'=>'required|string|max:225',
            'author'=>'required|string|max:225',
            'cover_image'=>'required|image|mimes:jpeg,png,jpg,gif,svg|max:225',
            'file_name'=>'required|mimes:pdf',
            'faculty_id'=>'required',
            'department_id'=>'required',
        ]);


        if($request->hasFile('file_name'))
        {

            $pdf_file = $request->file_name;

            $fileNameWithExt = $pdf_file->getClientOriginalName();

            //Get just filename
            $file_name = pathinfo($fileNameWithExt, PATHINFO_FILENAME);
            $file_name = $request->input('title');
            $file_name= str::title($file_name);
            $file_name = str_replace(' ','',$file_name);
            $file_name = Str::limit($file_name,10, '');

            //Get just extension
            $extension = $pdf_file->getClientOriginalExtension();

            //Filename to store
            $fileNameToStore = $file_name.'_'.time().'.'.$extension;



            //upload file

            $pdf_file->storeAs('public/books/', $fileNameToStore);



        }



        if($request->hasFile('cover_image'))
        {

            $image_file = $request->cover_image;

            $imageNameWithExt = $image_file->getClientOriginalName();

            //Get just filename
            $image_name = pathinfo($imageNameWithExt, PATHINFO_FILENAME);
            $image_name = $request->input('title');
            $image_name= str::title($image_name);
            $image_name = str_replace(' ', '', $image_name);
            $image_name = str::limit($image_name,10,'');

            //Get just extension
            $extension = $image_file->getClientOriginalExtension();

            //Filename to store
            $imageNameToStore = $image_name.'_'.time().'.'.$extension;



            //upload file

            $path = $image_file->storeAs('public/images/books/', $imageNameToStore);

            $image_path = public_path('images/books/'.$imageNameToStore);
            //resize image
            Image::make($image_file->getRealPath())->resize(140,128)->save($image_path);


        }






        $bookRequest = $request->except(['cover_image', 'file_name', 'category_id']);
        if($request->hasFile('file_name'))
        {
            $bookRequest['file_name'] = $fileNameToStore;
        }
        if($request->hasFile('cover_image'))
        {
            $bookRequest['cover_image'] = $imageNameToStore;
        }

        $book = new Book();
        $book->create($bookRequest);

        return redirect()->back()->with('success', 'Book Uploaded Successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //show book details
        $book = Book::findOrFail($id);
        return view('manager.books.show', compact('book'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //Edit selected book records
        $book = Book::findOrFail($id);
        $faculties = Faculty::all();
        $departments = Department::all();
        return view('manager.books.edit', compact('faculties', 'departments', 'book'));
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

            $this->validate($request, [
                'title' => 'required|string|max:225',
                'author' => 'required|string|max:225',
                'faculty_id' => 'required',
                'department_id' => 'required',
            ]);



        if($request->hasFile('file_name'))
        {

            $pdf_file = $request->file_name;

            $fileNameWithExt = $pdf_file->getClientOriginalName();

            //Get just filename
            $file_name = pathinfo($fileNameWithExt, PATHINFO_FILENAME);
            $file_name = $request->input('title');
            $file_name= str::title($file_name);
            $file_name = str_replace(' ','',$file_name);
            $file_name = Str::limit($file_name,10, '');

            //Get just extension
            $extension = $pdf_file->getClientOriginalExtension();

            //Filename to store
            $fileNameToStore = $file_name.'_'.time().'.'.$extension;



            //upload file

            $pdf_file->storeAs('public/books/', $fileNameToStore);

//return $fileNameToStore;

        }



        if($request->hasFile('cover_image'))
        {

            $image_file = $request->cover_image;

            $imageNameWithExt = $image_file->getClientOriginalName();

            //Get just filename
            $image_name = pathinfo($imageNameWithExt, PATHINFO_FILENAME);
            $image_name = $request->input('title');
            $image_name= str::title($image_name);
            $image_name = str_replace(' ', '', $image_name);
            $image_name = str::limit($image_name,10,'');

            //Get just extension
            $extension = $image_file->getClientOriginalExtension();

            //Filename to store
            $imageNameToStore = $image_name.'_'.time().'.'.$extension;



            //upload file

            $path = $image_file->storeAs('public/images/books/', $imageNameToStore);

            $image_path = public_path('images/books/'.$imageNameToStore);
            //resize image
            Image::make($image_file->getRealPath())->resize(140,128)->save($image_path);


        }






        $bookRequest = $request->except(['cover_image', 'file_name', 'category_id']);
        if($request->hasFile('file_name'))
        {
            $bookRequest['file_name'] = $fileNameToStore;
        }
        if($request->hasFile('cover_image'))
        {
            $bookRequest['cover_image'] = $imageNameToStore;
        }

        $book = Book::findOrFail($id);
        $book->update($bookRequest);

        return redirect('/book')->with('success', 'Book Records Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //delete selected book
        $book = Book::findOrFail($id);
        $book->delete();
        return redirect()->back()->with('success', 'Book Records Deleted Successfully');
    }

}
