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
                        Show Department
                    </li>
                </ol>

            </div>
        </div>
    </div>
    <!-- end page title end breadcrumb -->

    <div class="row justify-center-center mb-5">
        <div class="col-sm-12 col-lg-12">
            <div class="card">
                <div class="card-header text-center h2">Departments Details</div>
                <div class="card-body">


                        <div class="table-responsive">
                            <table class="table table-striped">

                                <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Name</th>
                                    <th>FACULTY NAME</th>
                                    <th>DATE CREATED</th>
                                    <th>LAST UPDATED</th>

                                </tr>
                                </thead>
                                <tbody>
                                @php($id = 1)
                                    <tr>
                                        <td>{{$id}}</td>
                                        <td>{{$department->name}}</td>
                                        <td>{{$department->faculty->name}}</td>
                                        <td>{{date_format($department->created_at, 'd F Y  - h:i a')}}</td>
                                        <td>{{date_format($department->updated_at, 'd F Y  - h:i a')}}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>

                </div>
            </div>

        </div>

    </div>
@endsection