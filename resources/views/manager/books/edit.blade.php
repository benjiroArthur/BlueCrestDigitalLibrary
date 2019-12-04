@extends('layouts.app')
@section('content')
    <!-- Page-Title -->
    <div class="row mb-2">
        <div class="col-sm-12 col-lg-12">
            <div class="page-title-box">
                <ol class="breadcrumb hide-phone float-right p-0 m-0">
                    <li class="breadcrumb-item">
                        <a href="{{url('/home')}}">BlueCrest E-Library</a>
                    </li>
                    <li class="breadcrumb-item">
                        <a href="#">Books</a>
                    </li>
                    <li class="breadcrumb-item active">
                        Edit Books
                    </li>
                </ol>
            </div>
        </div>
    </div>
    <!-- end page title end breadcrumb -->

    <div class="row">
        <div class="col-12">
            <div class="card-box">


                <h4 class="header-title m-t-0 text-center">Edit Books</h4>

                {!! Form::open(['action' => ['BookController@update', $book->id], 'method' => 'POST', 'enctype' => 'multipart/form-data','files'=>'true']) !!}
                {{method_field('PUT')}}
                {{ csrf_field() }}

                <div class="row">

                    <div class="col-lg-6 offset-lg-3 formBox">
                        <div class="p-20">


                            <div class="form-group">
                                <label for="title">Title</label>
                                <input type="text" name="title" parsley-trigger="change" required
                                       placeholder="Title" class="form-control" id="title" value="{{$book->title}}">
                            </div>

                            <div class="form-group">
                                <label for="author">Author's Name</label>
                                <input type="text" name="author" parsley-trigger="change" required
                                       placeholder="Author's Name" class="form-control" id="author" value="{{$book->author}}">
                            </div>

                            <div class="form-group">
                                <label for="year_of_publication">Year Of Publication</label>
                                <input type="date" name="year_of_publication" parsley-trigger="change" required
                                       class="form-control" id="year_of_publication" value="{{$book->year_of_publication}}">
                            </div>

                            <div class="form-group">
                                <label for="faculty_id">Faculty</label>
                                <select onchange="getGroup();" type="text" name="faculty_id" required class="form-control" id="faculty_id">
                                    <option value="{{$book->department->faculty->id}}">{{$book->department->faculty->name}}</option>

                                        @forelse($faculties as $faculty)
                                            <option value="{{$faculty->id}}">{{$faculty->name}}</option>
                                        @empty
                                        @endforelse


                                </select>

                            </div>

                            <div class="form-group">
                                <label for="department_id">Department</label>
                                <select type="text" name="department_id" required class="form-control" id="department_id">
                                    <option value="{{$book->department->id}}">{{$book->department->name}}</option>
                                </select>

                            </div>


                            <div class="form-group">
                                <label>Book <span class="text-white text-center">PDF FILES ONLY</span></label>
                                <input type="file" class="form-control" name="file_name">
                            </div>

                            <div class="form-group">
                                <label>Cover Image <span class="text-danger">128 X 135 Pixels</span></label>
                                <input type="file" class="form-control" name="cover_image">
                            </div>

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

    <script>
        function getGroup() {
            var id = $('#faculty_id').val();

            $.ajax({
                type:"GET",
                url:"{{url('/requestDepartment/')}}/"+id,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                },
                cache:false,
                success:function(data){
                    var len = data.length;
                    $('#department_id').empty();


                    $('#department_id').append("<option value={{$book->department->id}}>{{$book->department->name}}</option>");
                    for(var i = 0; i < len; i++)
                    {
                        var id = data[i]['id'];
                        var name = data[i]['name'];

                        $('#department_id').append("<option value='"+id+"'>"+name+"</option>");
                    }
                }
            });
        }
    </script>
@endsection