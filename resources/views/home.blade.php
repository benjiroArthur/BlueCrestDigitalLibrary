@extends('layouts.app')

@section('content')
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
                        All Books
                    </li>
                </ol>

            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <div class="card-box">
                <div class="row pr-5 pl-5 justify-content-center">

                        @forelse($faculties as $faculty)
                            <div class="col-sm-6 col-lg-2">
                                <a class="text-decoration-none" onclick="getDepartment({{$faculty->id}});" id="faculty" href="#">
                                    <div class="card mt-2 mr-1 text-center text-blueCrest" style="border:1px solid #09378c">
                                        <div class="card-img">
                                            <img class="img-thumbnail" src="{{$faculty->cover_image}}" alt="">
                                        </div>
                                        {{$faculty->name}}
                                    </div>
                                </a>
                            </div>
                    @empty
                        @endforelse

                </div>

                <div class="row pr-5 pl-5 justify-content-center mt-2 department-div">



                </div>
                <hr>
                <div class="row pr-5 pl-5 justify-content-center mt-2 books-div">

                </div>


            </div>
        </div>
    </div>



@endsection

@section('script')
    <script>

        function showSpinner(id,spinnerId)
        {
            $(id).html('<div class="spinner-border" role="status" id="' + spinnerId +'" style="color: #09378c">\n' +
                '                        <span class="sr-only">Loading...</span>\n' +
                '                    </div>');
        }
        function hideSpinner(spinnerId)
        {
            $(spinnerId).remove();
        }

        function getDepartment(facId)
        {
            showSpinner(".department-div", '222');

            $.ajax({
                type:"GET",
                url:"{{url('/faculty-department/')}}/"+facId,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                },
                cache:false,
                success:function(data){
                    var len = data.length;
                    if($(".department-div").hasClass("hidden"))
                    {
                        $(".department-div").removeClass("hidden")
                    }
                    $(".books-div").empty();
                    $(".department-div").empty();


                    for(var i = 0; i < len; i++)
                    {
                        var id = data[i]['id'];
                        var name = data[i]['name'];

                        $(".department-div").append('<div class="col-sm-6 col-lg-2">\n' +
                            "                                <a class=\"text-decoration-none\" onclick=\"getBooks("+id+");\" id=\"faculty\" href=\"#\">\n" +
                            "                                    <div class=\"card mt-2 mr-1 text-center text-blueCrest\" style=\"border:1px solid #09378c\">\n" +
                            "                                        <div class=\"card-img\">\n" +
                            "                                            <span class=\"mdi mdi-book-multiple\"></span>\n" +
                            "                                        </div>\n" +
                            "                                        <div class=\"departments\">\n" +
                            "\n" +name+
                            "                                        </div>\n" +
                            "                                    </div>\n" +
                            "                                </a>\n" +
                            "                            </div>");
                    }
                }
            });
        }


        function showBook(bookid)
        {
            window.location.href = '{{url("/get-book/")}}/'+bookid;

        }

        function getBooks(depId)
        {
            showSpinner(".books-div", '223');

            $.ajax({
                type:"GET",
                url:"{{url('/department-books/')}}/"+depId,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                },
                cache:false,
                success:function(data){
                    var len = data.length;

                    $(".books-div").empty();


                    for(var i = 0; i < len; i++)
                    {
                        var id = data[i]['id'];
                        var title = data[i]['title'];
                        var cover = data[i]['cover_image']

                        $(".books-div").html('<div class="col-sm-12 col-lg-2">\n' +
                            '                        <a class="text-decoration-none" onclick="showBook(' + id + ');" id="category" href="#">\n' +
                            '                            <div class="card mt-2 mr-1 text-center text-blueCrest" style="border:1px solid #09378c">\n' +
                            '                                <div class="card-img">\n' +
                            '                                    <img class="img-thumbnail" src="'+ cover +'" alt="">\n' +
                            '                                </div>\n' +
                            '                                ' +   title + '\n' +
                            '                            </div>\n' +
                            '                        </a>\n' +
                            '                    </div>');
                    }
                }
            });
        }

    </script>
@endsection
