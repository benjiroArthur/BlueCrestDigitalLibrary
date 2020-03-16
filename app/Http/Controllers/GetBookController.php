<?php

namespace App\Http\Controllers;

use App\Book;
use Illuminate\Http\Request;

class GetBookController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

    }
 /**
     * Display a listing of the resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function getbook($id)
    {

        return view('book');
    }

    /**
     * Display a listing of the resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function downloadBook($id)
    {
        //Download book

        $book = Book::find($id);
        $file = $book->file_name;
        $headers = [
            'content-type' => 'application/pdf',
            'Content-disposition' => 'inline; filename='.$book->title.'.pdf'
        ];
          return response()->file($file, $headers);


        //return response()->download($file, $book->title.'.pdf');
    }



    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $book = Book::find($id);
        return response()->json($book);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $book = Book::find($id);
        $faculty = $book->department->faculty->name;
        $department = $book->department->name;
        $like = $book->reviews()->where('like', 1)->count();
        $review = $book->reviews()->where('user_id', auth()->user()->id)->first();
        $unLike = $book->reviews()->where('like', 0)->count();

        $data = [
            'faculty' => $faculty,
            'department' => $department,
            'likes' => $like,
            'unlikes' => $unLike,
            'review' => $review
        ];

        return response()->json($data);
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function openBook($id)
    {
        //Open book

        $book = Book::find($id);
        $file = $book->file_name;
        $file = asset('books/'.$file);
       return view('openBook', compact('file'));

    }
}
