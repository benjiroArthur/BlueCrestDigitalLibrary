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
                        <a href="#">Users</a>
                    </li>
                    <li class="breadcrumb-item active">
                        Add Users
                    </li>
                </ol>

            </div>
        </div>
    </div>
    <!-- end page title end breadcrumb -->

    <div class="row">
        <div class="col-12">
            <div class="card-box">


                <h4 class="header-title m-t-0 text-center">Bulk User Upload Form</h4><br><br>
                <div>
                    <a href="{{route('excelTemplate')}}"><p class="text-danger justify-content-center text-center">Please First Download The Template</p></a>


                    {!! Form::open(['action' => 'UsersController@store', 'method' => 'POST', 'enctype' => 'multipart/form-data','files'=>'true']) !!}

                    {{ csrf_field() }}

                    <div class="row">

                        <div class="col-lg-4 offset-4">
                            <div class="p-20">


                                    <input type="file" class="" name="file">

                                <button class="btn btn-primary waves-effect waves-light btn-blueCrest" type="submit">
                                    Submit
                                </button>

                            </div>

                        </div>
                    </div>

                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>


@endsection