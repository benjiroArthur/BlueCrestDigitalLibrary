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
                        <a href="#">Faculty</a>
                    </li>
                    <li class="breadcrumb-item active">
                        All Faculties
                    </li>
                </ol>

            </div>
        </div>
    </div>
    <!-- end page title end breadcrumb -->

    <div class="row justify-center-center mb-5">
        <div class="col-sm-12 col-lg-12">
            <div class="card">
                <div class="card-header text-center h2">All Faculties</div>
                <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped">

                                <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Name</th>
                                    <th>Cover Image</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                @php($id = 1)
                                @forelse($faculties as $faculty)
                                    <tr>
                                        <td>{{$id}}</td>
                                        <td>{{$faculty->name}}</td>
                                        <td>
                                            <div class="card-img">
                                                <img class="img-responsive" src="{{$faculty->cover_image}}" style="width: 100px; height: auto">
                                            </div>
                                        </td>
                                        <td class="text-white">
                                            {!! Form::open(['method'=>'DELETE', 'route'=>['faculty.destroy', $faculty->id]]) !!}
                                            <a class="btn btn-success" href="{{url('faculty/'.$faculty->id)}}"><span class="mdi mdi-eye show"></span></a>
                                            <a class="btn btn-warning" href="{{url('faculty/'.$faculty->id.'/edit')}}"><span class="edit mdi mdi-file-document-edit"></span></a>
                                            <button data-toggle="tooltip" data-placement="top" title="Delete" type="submit" class="btn btn-danger"
                                                    onclick="return confirm('Deleting this Faculty will Delete its associate Departments and Books, Are you sure you want to Proceed?')"><span class="mdi mdi-delete"></span></button>
                                            {!! Form::close() !!}
                                        </td>
                                    </tr>
                                    @php($id++)
                                    @empty
                                @endforelse

                                </tbody>
                            </table>
                        </div>

                </div>
            </div>

        </div>

    </div>
@endsection
