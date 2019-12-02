@extends('layouts.app')
@section('content')
    <!-- Page-Title -->
    <div class="row mb-2">
        <div class="col-sm-12">
            <div class="page-title-box">
                <ol class="breadcrumb hide-phone float-right p-0 m-0">
                    <li class="breadcrumb-item">
                        <a href="#">GP Digital Library</a>
                    </li>
                    <li class="breadcrumb-item">
                        <a href="#">Books</a>
                    </li>
                    <li class="breadcrumb-item active">
                        Book
                    </li>
                </ol>

            </div>
        </div>
    </div>
    <!-- end page title end breadcrumb -->

    <div class="row">
        <div class="col-sm-12 col-lg-3 offset-2 justify-content-center">
            <div>
                <img src="{{$book->cover_image}}">
                <br><br>
                <p>Title:   {{($book->title)}}</p>
            </div>
        </div>

        <div class="col-sm-12 col-lg-3">
            <hr>
            <p>Author:   {{$book->author}}</p>
            <hr>
            <p>Year:   {{$book->year_of_publication}}</p>
            <hr>
            <p>Category:   {{($book->group->category->name)}}</p>
            <hr>

        </div>

        <div class="col-sm-12 col-lg-3">
            <hr>
            <p>Group:   {{$book->group->name}}</p>
            <hr>
            <p>Date Created:   {{($book->created_at)}}</p>
            <hr>
            <p>Date Updated:   {{$book->updated_at}}</p>
            <hr>
        </div>

    </div>
@endsection