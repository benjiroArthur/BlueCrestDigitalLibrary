<!-- Styles -->
        <style>
            html, body {
                background-color: #fff;
                color: #636b6f;
                font-family: 'Nunito', sans-serif;
                font-weight: 200;
                height: 100vh;
                margin: 0;
            }

            .full-height {
                height: 100vh;
            }

            .flex-center {
                align-items: center;
                display: flex;
                justify-content: center;
            }

            .position-ref {
                position: relative;
            }

            .top-right {
                position: absolute;
                right: 10px;
                top: 18px;
            }

            .content {
                text-align: center;
            }

            .title {
                font-size: 84px;
            }

            .links > a {
                color: #09378c;
                padding: 0 25px;
                font-size: 13px;
                font-weight: 600;
                letter-spacing: .1rem;
                text-decoration: none;
                text-transform: uppercase;
            }

            .m-b-md {
                margin-bottom: 30px;
            }
        </style>
        @extends('layouts.app')
        @section('content')
            <div class="container-fluid mt-sm-4">
                <div class="row">
                    <div class="col-sm-12 col-lg-12">
                        <div class="content mt-xl-5">
                            <div class="title m-b-md pt-xl-5" style="height: 500px;">
                                <h1 class="font-weight-bolder" style="color: #09378c !important;">WELCOME</h1>
                                {{--carousel starts--}}
                                <div class="row justify-content-center">
                                <div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
                                    <div class="carousel-inner" style="height: 400px; width: auto;">
                                        <div class="carousel-item active">
                                            <img src="{{asset('images/assets/bc_welcome_logo.png')}}" class="d-block img-fluid" alt="...">
                                        </div>
                                        <div class="carousel-item img-fluid">
                                            <img src="{{asset('images/assets/banner1.jpg')}}" class="d-block img-fluid" alt="...">
                                        </div>
                                        <div class="carousel-item img-fluid">
                                            <img src="{{asset('images/assets/banner2.jpg')}}" class="d-block img-fluid" alt="...">
                                        </div>
                                        <div class="carousel-item img-fluid">
                                            <img src="{{asset('images/assets/banner3.jpg')}}" class="d-block img-fluid" alt="...">
                                        </div>
                                        <div class="carousel-item img-fluid">
                                            <img src="{{asset('images/assets/banner4.jpg')}}" class="d-block img-fluid" alt="...">
                                        </div>
                                        <div class="carousel-item img-fluid">
                                            <img src="{{asset('images/assets/banner5.jpg')}}" class="d-block img-fluid" alt="...">
                                        </div>
                                        <div class="carousel-item img-fluid">
                                            <img src="{{asset('images/assets/banner6.jpg')}}" class="d-block img-fluid" alt="...">
                                        </div>
                                        <div class="carousel-item img-fluid">
                                            <img src="{{asset('images/assets/banner7.jpg')}}" class="d-block img-fluid" alt="...">
                                        </div>
                                        <div class="carousel-item img-fluid">
                                            <img src="{{asset('images/assets/banner13.jpeg')}}" class="d-block img-fluid" alt="...">
                                        </div>
                                        <div class="carousel-item img-fluid">
                                            <img src="{{asset('images/assets/banner8.jpg')}}" class="d-block img-fluid" alt="...">
                                        </div>
                                        <div class="carousel-item img-fluid">
                                            <img src="{{asset('images/assets/banner9.jpeg')}}" class="d-block img-fluid" alt="...">
                                        </div>
                                        <div class="carousel-item img-fluid">
                                            <img src="{{asset('images/assets/banner10.jpeg')}}" class="d-block img-fluid" alt="...">
                                        </div>
                                        <div class="carousel-item img-fluid">
                                            <img src="{{asset('images/assets/banner11.jpeg')}}" class="d-block img-fluid" alt="...">
                                        </div>
                                        <div class="carousel-item img-fluid">
                                            <img src="{{asset('images/assets/banner12.jpeg')}}" class="d-block img-fluid" alt="...">
                                        </div>
                                        <div class="carousel-item img-fluid">
                                            <img src="{{asset('images/assets/banner14.jpeg')}}" class="d-block img-fluid" alt="...">
                                        </div>
                                    </div>
                                    <a class="carousel-control-prev" style="color: #09378c !important;" href="#carouselExampleControls" role="button" data-slide="prev">
                                        <span class="carousel-control-prev-icon text-primary" aria-hidden="true"></span>
                                        <span class="sr-only">Previous</span>
                                    </a>
                                    <a class="carousel-control-next" style="color: #09378c !important;" href="#carouselExampleControls" role="button" data-slide="next">
                                        <span class="carousel-control-next-icon" style="color: #09378c !important;" aria-hidden="true"></span>
                                        <span class="sr-only">Next</span>
                                    </a>
                                </div>
                                </div>
                                {{--carousel ends--}}
                            </div>

                            <div class="links">

                                    @forelse($faculties as $faculty)
                                        <a href="#">{{$faculty->name}}</a>
                                    @empty

                                    @endforelse

                            </div>
                        </div>
                    </div>
                </div>

            </div>
        @endsection
