@extends('layouts.app')
@section('content')
    <!-- Page-Title -->
    <meta name="" content="">
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
                        Book
                    </li>
                </ol>

            </div>
        </div>
    </div>
    <!-- end page title end breadcrumb -->

    <router-view>
        {{--Vue elements goes here--}}
    </router-view>

@endsection
