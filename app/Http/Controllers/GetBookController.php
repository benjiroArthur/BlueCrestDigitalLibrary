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
    public function index($id)
    {
        //get single book
        $book = Book::find($id);
        $like = $book->reviews()->where('like', 1)->count();
        $review = $book->reviews()->where('user_id', auth()->user()->id)->first();
        $unLike = $book->reviews()->where('like', 0)->count();


        return view('book', compact('book', 'like', 'unLike', 'review'));
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
        //
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
}
