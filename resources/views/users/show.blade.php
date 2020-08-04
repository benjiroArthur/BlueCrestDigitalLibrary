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
                        Profile
                    </li>
                </ol>

            </div>
        </div>
    </div>
    <!-- end page title end breadcrumb -->

    <h4 class="text-center">My Profile</h4>

    <div class="row ml-2 justify-content-center">
        <div class="col-sm-12 col-lg-2 justify-content-center">

            <div style="width: 130px; height: 130px">
                <img src="{{$user->image}}">
                <br><br>
                <p class="text-center">{{strtoupper($user->username)}}</p>
            </div>
        </div>

        <div class="col-sm-12 col-lg-5">
            <hr>
            <p>Full Name:   {{strtoupper($user->name)}}</p>
            <hr>
            <p>Role:   {{$user->role->name}}</p>
            <hr>
            <p>DateOf Birth:   {{date("d M, Y",strtotime($user->dateOfBirth))}}</p>
            <hr>
        </div>

        <div class="col-sm-12 col-lg-5">
            <hr>
            <p>Gender:   {{strtoupper($user->gender)}}</p>
            <hr>
            <p>Email:   {{$user->email}}</p>
            <hr>
            <p>Phone Number:   {{strtoupper($user->phone_number)}}</p>
            <hr>
        </div>
    </div>

    <div class="row justify-content-center">
        @if(auth()->user()->role->name == 'manager')
            <a href="{{url('/users/'.auth()->user()->id.'/edit')}}" class="btn btn-blueCrest" style="background-color: #191e2f; color: white">Edit Profile</a>
        @else
            <a href="{{url('/users/'.auth()->user()->id.'/editProfile')}}" class="btn btn-blueCrest" style="background-color: #191e2f; color: white">Edit Profile</a>
        @endif
    </div>


@endsection
