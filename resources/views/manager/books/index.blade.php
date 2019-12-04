@extends('layouts.app')
@section('content')
    <!-- Page-Title -->
    <div class="row mb-2">
        <div class="col-sm-12">
            <div class="page-title-box">
                <ol class="breadcrumb hide-phone float-right p-0 m-0">
                    <li class="breadcrumb-item">
                        <a href="{{url('/home')}}">BlueCrest E-Library</a>
                    </li>
                    <li class="breadcrumb-item">
                        <a href="#">Books</a>
                    </li>
                    <li class="breadcrumb-item active">
                        All Books
                    </li>
                </ol>

            </div>
        </div>
    </div>
    <!-- end page title end breadcrumb -->

    <div class="row justify-center-center mb-5">
        <div class="col-sm-12 col-lg-12">
            <div class="card">
                <div class="card-header text-center h2">All Books</div>
                <div class="card-body">


                        <div class="table-responsive">
                            <table class="table table-striped">
                                {{--id="userAllTable">--}}
                                <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Title</th>
                                    <th>Author</th>
                                    <th>Year Of Publication</th>
                                    <th>Cover Image</th>
                                    <th>Faculty</th>
                                    <th>Department</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                @php($id = 1)
                                @forelse($books as $book)
                                    <tr>
                                        <td>{{$id}}</td>
                                        <td>{{$book->title}}</td>
                                        <td>{{$book->author}}</td>
                                        <td>{{$book->year_of_publication}}</td>
                                        <td><img src="{{$book->cover_image}}" class="img-lg"></td>
                                        <td>{{$book->department->faculty->name}}</td>
                                        <td>{{$book->department->name}}</td>
                                        <td class="text-white">
                                            {!! Form::open(['method'=>'DELETE', 'route'=>['book.destroy', $book->id]]) !!}
                                            <a class="btn btn-success" href="{{url('book/'.$book->id)}}"><span class="mdi mdi-eye show"></span></a>
                                            <a class="btn btn-warning" href="{{url('book/'.$book->id.'/edit')}}"><span class="edit mdi mdi-file-document-edit"></span></a>
                                            <button data-toggle="tooltip" data-placement="top" title="Delete" type="submit" class="btn btn-danger"
                                                    onclick="return confirm('Are you sure you want to delete this item?')"><span class="mdi mdi-delete"></span></button>
                                            {!! Form::close() !!}
                                        </td>
                                    </tr>
                                    @php($id++)
                                    @empty
                                    <p class="justify-content-center text-danger">No Books Available</p>
                                @endforelse
                                </tbody>
                            </table>
                        </div>

                </div>
            </div>

        </div>

    </div>
@endsection