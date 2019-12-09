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

    <div class="row">
        <div class="col-sm-12 col-lg-9 col-md-8">
            <div class="row">
                <div class="col-sm-12 col-lg-2 col-md-12 ml-lg-2 justify-content-center">
                    <div>
                        <img src="{{$book->cover_image}}">
                        <hr>
                        <p class="text-center">{{($book->title)}}</p>
                    </div>
                </div>

                <div class="col-sm-12 col-lg-5 col-md-12">
                    <div class="row">
                        <div class="col-sm-4 col-md-5 co-lg-6">
                            <hr>
                            <p>Author:</p>
                            <hr>
                            <p>Year Of Publication:</p>
                            <hr>
                            <p>Category:</p>
                            <hr>
                            <p>Group:</p>
                            <hr>
                        </div>

                        <div class="col-sm-4 col-md-5 co-lg-6">
                            <hr>
                            <p>{{$book->author}}</p>
                            <hr>
                            <p>{{$book->year_of_publication}}</p>
                            <hr>
                            <p>{{($book->department->faculty->name)}}</p>
                            <hr>
                            <p>{{$book->department->name}}</p>
                            <hr>
                        </div>
                    </div>

                </div>

                <div class="col-lg-4 col-md-12 col-sm-12">
                    <div class="row">
                        <div class="col-sm-5 col-md-6 col-lg-6">
                            <hr>
                            <p id="ben">Reviews <span class="mdi mdi-pen"></span>:</p>
                            <hr>
                            <p>Likes <span class="mdi mdi-thumb-up text-primary"></span>:</p>
                            <hr>
                            <p>Unlikes <span class="mdi mdi-thumb-down text-danger"></span>:</p>
                            <hr>
                        </div>

                        <div class="col-sm-5 col-md-6 col-lg-6">
                            <hr>
                            <p id="ben">{{($book->reviews->count())}}</p>
                            <hr>
                            <p>{{$like}}</p>
                            <hr>
                            <p>{{$unLike}}</p>
                            <hr>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row justify-content-center">
                <a class="btn btn-success mx-2" href="{{route('download-book',[$book->id])}}"><span class="mdi mdi-download"></span> Download</a>
                @if($review)

                    @if($review->like == true)
                        <a class="btn btn-primary mx-2" href="#" data-toggle="modal" data-target="#unlikeEditReviewModal"><span class="mdi mdi-thumb-down text-danger"></span> Review/Unlike</a>
                    @else
                        <a class="btn btn-danger mx-2" href="#" data-toggle="modal" data-target="#likeEditReviewModal"><span class="mdi mdi-thumb-up text-primary"></span> Review/Like</a>

                    @endif

                @else
                    <a class="btn btn-primary mx-2" href="#" data-toggle="modal" data-target="#createReviewModal"><span class="mdi mdi-thumb-up"></span> Review/Like</a>
                @endif
            </div>
        </div>
        {{--ajax request for comments--}}
        <div class="col-sm-12 col-lg-3 col-md-4">
            <p class="text-blueCrest">Comments</p>
            <div class="my-3 container" id="comments">

            </div>
        </div>
        {{--end of comments--}}
    </div>









{{--Modals start--}}
    <div class="modal fade bd-example-modal-sm" id="createReviewModal" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-sm">
            <div class="modal-content">
                {!! Form::open(['action' => 'ReviewsController@store', 'method' => 'POST', 'enctype' => 'multipart/form-data','files'=>'true']) !!}

                {{ csrf_field() }}
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Review This Book</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body formBox">

                    <div class="row justify-content-center">
                        <div class="custom-control custom-radio custom-control-inline">
                            <input type="radio" id="customRadioInline1" name="like" class="custom-control-input" value="{{1}}">
                            <label class="custom-control-label" for="customRadioInline1"><span class="mdi mdi-thumb-up text-primary"></span></label>
                        </div>
                        <div class="custom-control custom-radio custom-control-inline">
                            <input type="radio" id="customRadioInline2" name="like" class="custom-control-input" value="{{0}}">
                            <label class="custom-control-label" for="customRadioInline2"><span class="mdi mdi-thumb-down text-danger"></span></label>
                        </div>
                    </div>


                    <div class="form-group">

                        <input type="hidden" name="book_id" parsley-trigger="change" required
                               placeholder="Title" class="form-control" id="title" value="{{$book->id}}">
                    </div>
                    <div class="form-group">
                        <input type="hidden" name="user_id" parsley-trigger="change" required
                               placeholder="Title" class="form-control" id="title" value="{{auth()->user()->id}}">
                    </div>
                    <div class="form-group">

                        <textarea type="text" name="comment" parsley-trigger="change" required
                                  placeholder="Comment" class="form-control" id="comment" rows="3"></textarea>
                    </div>

                </div>
                <div class="modal-footer justify-content-center">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                    <input type="submit" class="btn btn-primary" value="Submit">
                </div>
                {!! Form::close() !!}
            </div>
        </div>
    </div>
    @if(($review))
    <div class="modal fade bd-example-modal-sm" id="likeEditReviewModal" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-sm">
            <div class="modal-content">
                {!! Form::open(['action' => ['ReviewsController@update', $review->id], 'method' => 'POST', 'enctype' => 'multipart/form-data','files'=>'true']) !!}
                {!! method_field('PUT') !!}
                {{ csrf_field() }}
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Review This Book</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body formBox">

                    <div class="row justify-content-center">
                        <div class="custom-control custom-radio custom-control-inline">
                            <input type="radio" id="customRadioInline3" name="like" class="custom-control-input" value="{{1}}">
                            <label class="custom-control-label" for="customRadioInline3"><span class="mdi mdi-thumb-up text-primary"></span></label>
                        </div>
                        <div class="custom-control custom-radio custom-control-inline">
                            <input type="radio" id="customRadioInline4" name="like" class="custom-control-input" value="{{0}}">
                            <label class="custom-control-label" for="customRadioInline4"><span class="mdi mdi-thumb-down text-danger"></span></label>
                        </div>
                    </div>


                    <div class="form-group">

                        <input type="hidden" name="book_id" parsley-trigger="change" required
                               placeholder="Title" class="form-control" id="title" value="{{$book->id}}">
                    </div>
                    <div class="form-group">
                        <input type="hidden" name="user_id" parsley-trigger="change" required
                               placeholder="Title" class="form-control" id="title" value="{{auth()->user()->id}}">
                    </div>
                    <div class="form-group">

                        <textarea type="text" name="comment" parsley-trigger="change" required
                                  placeholder="Comment" class="form-control" id="comment" rows="3">{{$review->comment}}</textarea>
                    </div>

                </div>
                <div class="modal-footer justify-content-center">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                    <input type="submit" class="btn btn-primary" value="Submit">
                </div>
                {!! Form::close() !!}
            </div>
        </div>
    </div>
    <div class="modal fade bd-example-modal-sm" id="unlikeEditReviewModal" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-sm">
            <div class="modal-content">
                {!! Form::open(['action' => ['ReviewsController@update', $review->id], 'method' => 'POST', 'enctype' => 'multipart/form-data','files'=>'true']) !!}
                {!! method_field('PUT') !!}
                {{ csrf_field() }}
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Review This Book</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body formBox">

                    <div class="row justify-content-center">
                        <div class="custom-control custom-radio custom-control-inline">
                            <input type="radio" id="customRadioInline5" name="like" class="custom-control-input" value="{{1}}">
                            <label class="custom-control-label" for="customRadioInline5"><span class="mdi mdi-thumb-up text-primary"></span></label>
                        </div>
                        <div class="custom-control custom-radio custom-control-inline">
                            <input type="radio" id="customRadioInline6" name="like" class="custom-control-input" value="{{0}}">
                            <label class="custom-control-label" for="customRadioInline6"><span class="mdi mdi-thumb-down text-danger"></span></label>
                        </div>
                    </div>


                    <div class="form-group">

                        <input type="hidden" name="book_id" parsley-trigger="change" required
                               placeholder="Title" class="form-control" id="title" value="{{$book->id}}">
                    </div>
                    <div class="form-group">
                        <input type="hidden" name="user_id" parsley-trigger="change" required
                               placeholder="Title" class="form-control" id="title" value="{{auth()->user()->id}}">
                    </div>
                    <div class="form-group">

                        <textarea type="text" name="comment" parsley-trigger="change" required
                                  placeholder="Comment" class="form-control" id="comment" rows="3">{{$review->comment}}</textarea>
                    </div>

                </div>
                <div class="modal-footer justify-content-center">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                    <input type="submit" class="btn btn-primary" value="Submit">
                </div>
                {!! Form::close() !!}
            </div>
        </div>
    </div>
    @endif
    {{--Modals end--}}

    @section('script')
        <script>

            function loadComment(){
                $.ajax({
                    type:"GET",
                    url:"{{url('/book/comments/'.$book->id)}}",
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                    },
                    cache:false,
                    success:function(data){

                        var len = data.length;
                        $('#comments').empty();

                        for(var i = 0; i < len; i++)
                        {
                            var comment = data[i]['comment'];
                            var name = data[i]['user']['name'];
                            var date = data[i]['updated_at'];
                            $('#comments').append('<div class="card mb-2" style="border: 1px solid grey; border-radius: 10px; font-size: x-small">\n' +
                                '                    <p class="p-2"><b>'+name+'</b></p>\n' +
                                '                    <div class="text-center" style="font-size: 15px">'+comment+'</div>\n' +
                                '                    <div class="p-2 text-danger">Last Update: '+date+'</div>\n' +
                                '                </div>');

                        }
                    },
                    complete:function() {
                        // Schedule the next request when the current one's complete
                        setTimeout(loadComment, 5000);
                    }
                })
            }

            $(document).ready(function(){
                loadComment();
            });


        </script>
    @endsection
@endsection