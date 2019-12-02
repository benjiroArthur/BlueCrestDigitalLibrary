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
                        Show Faculty
                    </li>
                </ol>

            </div>
        </div>
    </div>
    <!-- end page title end breadcrumb -->

    <div class="row justify-center-center mb-5">
        <div class="col-sm-12 col-lg-12">
            <div class="card">
                <div class="card-header text-center h2">Faculty Details</div>
                <div class="card-body">


                        <div class="table-responsive">
                            <table class="table table-striped">

                                <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>FACULTY ID</th>
                                    <th>Name</th>
                                    <th>COVER IMAGE</th>
                                    <th>DATE CREATED</th>
                                    <th>LAST UPDATED</th>

                                </tr>
                                </thead>
                                <tbody>
                                @php($id = 1)
                                    <tr>
                                        <td>{{$id}}</td>
                                        <td>{{$faculty->id}}</td>
                                        <td>{{$faculty->name}}</td>
                                        <td>
                                            <div class="card-img">
                                                <img class="img-responsive" src="{{$faculty->cover_image}}" style="width: 100px; height: auto">
                                            </div>
                                        </td>
                                        <td>{{$faculty->created_at}}</td>
                                        <td>{{$faculty->updated_at}}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>

                </div>
            </div>

        </div>

    </div>
@endsection