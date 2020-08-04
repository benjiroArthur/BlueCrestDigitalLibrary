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
                        <a href="#">Department</a>
                    </li>
                    <li class="breadcrumb-item active">
                        Add Department
                    </li>
                </ol>
                {{--<h4 class="page-title">Add Users</h4>--}}
            </div>
        </div>
    </div>
    <!-- end page title end breadcrumb -->

    <div class="row">
        <div class="col-12">
            <div class="card-box">


                <h4 class="header-title m-t-0 text-center">Add Department</h4>

                {!! Form::open(['action' => 'DepartmentController@store', 'method' => 'POST', 'enctype' => 'multipart/form-data','files'=>'true']) !!}

                {{ csrf_field() }}

                <div class="row justify-content-center">

                    <div class="col-md-6 formBox">
                        <div class="p-20">


                            <div class="form-group">
                                <label for="name">Department Name</label>
                                <input type="text" name="name" parsley-trigger="change"
                                       placeholder="Department Name" class="form-control" id="name">
                            </div>

                            <div class="form-group">
                                <label for="faculty_id">Faculty</label>
                                <select type="text" name="faculty_id" class="form-control" id="faculty_id">
                                    <option value="">Select Faculty</option>

                                        @forelse($faculties as $faculty)
                                            <option value="{{$faculty->id}}">{{$faculty->name}}</option>
                                            @empty
                                        @endforelse
                                </select>

                            </div>

                        <div class="form-group text-center m-b-0">
                            <button class="btn btn-blueCrest waves-effect waves-light" type="submit">
                                Submit
                            </button>
                            <button type="reset" class="btn btn-secondary waves-effect m-l-5">
                                Cancel
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
