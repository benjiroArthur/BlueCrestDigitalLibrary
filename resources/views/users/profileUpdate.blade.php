@extends('layouts.app')
@section('content')

    <!-- Page-Title -->
    <div class="row mb-5">
        <div class="col-sm-12">
            <div class="page-title-box">
                <ol class="breadcrumb hide-phone float-right p-0 m-0">
                    <li class="breadcrumb-item">
                        <a href="{{url('/home')}}">BlueCrest E-Library</a>
                    </li>
                    <li class="breadcrumb-item">
                        <a href="#">User</a>
                    </li>
                    <li class="breadcrumb-item active">
                        Profile Update
                    </li>
                </ol>

            </div>
        </div>
    </div>
    <!-- end page title end breadcrumb -->
    <div class="row">
        <div class="col-12">
            <div class="card-box">


                <h4 class="header-title m-t-0 text-center">Profile Update Form</h4>
                <br><br>

                {!! Form::open(['action' =>[ 'UsersController@update', auth()->user()->id], 'method' => 'POST', 'enctype' => 'multipart/form-data','files'=>'true']) !!}
                {{ method_field('PUT') }}
                {{ csrf_field() }}
                <div class="row justify-content-center">
                    <div class="col-sm-12 col-md-12 col-lg-8">
                        <div class="row formBox">
                            <div class="col-lg-6 col-sm-12">
                                <div class="p-20">

                                    <div class="form-group">
                                        <label for="username">USERNAME<span class="text-danger">*</span></label>
                                        <input type="text" name="username" parsley-trigger="change" required
                                               placeholder="SERVICE NUMBER" class="form-control" id="username" value="{{$user->username}}" readonly>
                                    </div>

                                    <div class="form-group">
                                        <label for="name">Full Name<span class="text-danger">*</span></label>
                                        <input type="text" onkeyup="this.value = this.value.toUpperCase();" name="name" parsley-trigger="change" required
                                               placeholder="Full Name" class="form-control" id="name" value="{{$user->name}}">
                                    </div>

                                    <div class="form-group">
                                        <label for="email">Email<span class="text-danger">*</span></label>
                                        <input type="email" name="email" onkeyup="this.value = this.value.toLowerCase();" parsley-trigger="change" required
                                               placeholder="Email" class="form-control" id="email" value="{{$user->email}}">
                                    </div>

                                    <div class="form-group">
                                        <label for="role">ROLE<span class="text-danger">*</span></label>
                                        <input type="text" name="role" parsley-trigger="change" required
                                               placeholder="ROLE" class="form-control" id="role" value="{{$user->role->name}}" readonly>
                                    </div>




                                </div>
                            </div>
                            <div class="col-lg-6 col-sm-12">
                                <div class="p-20">

                                    <div class="form-group">
                                        <label for="date_of_birth">DATE OF BIRTH<span class="text-danger">*</span></label>
                                        <input type="date" name="date_of_birth" parsley-trigger="change" required
                                               placeholder="DATE OF BIRTH" class="form-control" id="date_of_birth" value="{{$user->date_of_birth }}">
                                    </div>

                                    <div class="form-group">
                                        <label for="gender">GENDER<span class="text-danger">*</span></label>
                                        <select type="text" name="gender" required class="form-control" id="gender">
                                            <option value="">Select Gender</option>
                                            <option value="Male" @if($user->gender == 'Male') selected @endif>Male</option>
                                            <option value="Female" @if($user->gender == 'Female') selected @endif>Female</option>

                                        </select>

                                    </div>


                                    <div class="form-group">
                                        <label for="phone_number">Phone Number<span class="text-danger">*</span></label>
                                        <input type="text" name="phone_number" parsley-trigger="change" required
                                               placeholder="Phone Number" class="form-control" id="phone_number" value="{{$user->phone_number}}">
                                    </div>

                                    <div class="form-group">
                                        <label>PROFILE PICTURE <span class="text-danger">128 X 128 Pixels</span></label>
                                        <input type="file" class="form-control" name="image">
                                    </div>




                                </div>
                            </div>
                            <div class="form-group m-b-0 justify-content-center col-lg-4 offset-4 text-center">

                                <button class="btn btn-blueCrest waves-effect waves-light" type="submit">
                                    Submit
                                </button>
                                <button type="reset" class="btn btn-secondary waves-effect m-l-5">
                                    Cancel
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

                {!! Form::close() !!}
            </div>
        </div>
    </div>

@endsection
