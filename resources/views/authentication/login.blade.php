@extends('layouts.master')
@section('content')


    <section class="login-block">
        <div class="container">
            <div class="row">
                <div class="col-md-4 login-sec">
                    <div class="alert alert-danger" style="display: none;">

                    </div>
                    <div class="alert alert-success" style="display: none;">

                    </div>
                    <h2 class="text-center">Login Now</h2>
                    <form class="login-form" id="login-form">
                        <div class="form-group">
                            <label for="exampleInputEmail1" class="text-uppercase">Email</label>
                            <input type="email" name="email" class="form-control" placeholder="Enter Your Email">

                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1" class="text-uppercase">Password</label>
                            <input type="password" name="password" class="form-control" placeholder="Enter Your Password">
                        </div>


                        <div class="form-check">
                            <label class="form-check-label">
                                <input type="checkbox" class="form-check-input" name="remember_me">
                                <small>Remember Me</small>
                            </label>
                            <button type="submit" class="btn btn-login float-right">Submit</button>
                        </div>

                    </form>
                    <div class="copy-text"><a href="/forgotPassword">Forgot your password?</a></div>
                </div>
                <div class="col-md-8 banner-sec">
                    <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
                        <ol class="carousel-indicators">
                            <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
                            <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
                            <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
                        </ol>
                        <div class="carousel-inner" role="listbox">
                            <div class="carousel-item active">
                                <img class="d-block img-fluid" src="https://static.pexels.com/photos/33972/pexels-photo.jpg" alt="First slide">
                                <div class="carousel-caption d-none d-md-block">
                                    <div class="banner-text">
                                        <h2>This is Heaven</h2>
                                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation</p>
                                    </div>
                                </div>
                            </div>
                            <div class="carousel-item">
                                <img class="d-block img-fluid" src="https://images.pexels.com/photos/7097/people-coffee-tea-meeting.jpg" alt="First slide">
                                <div class="carousel-caption d-none d-md-block">
                                    <div class="banner-text">
                                        <h2>This is Heaven</h2>
                                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation</p>
                                    </div>
                                </div>
                            </div>
                            <div class="carousel-item">
                                <img class="d-block img-fluid" src="https://images.pexels.com/photos/872957/pexels-photo-872957.jpeg" alt="First slide">
                                <div class="carousel-caption d-none d-md-block">
                                    <div class="banner-text">
                                        <h2>This is Heaven</h2>
                                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation</p>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
@section('script')
    <script type="text/javascript">
        $.ajaxSetup({
            headers:{
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        })
        $('#login-form').submit(function(event) {
            event.preventDefault();
            var postData = {
                'email': $('input[name=email]').val(),
                'password': $('input[name=password]').val(),
                'remember_me': $('input[name=remember_me]').is(':checked'),
            }
                       $.ajax({
                type:'POST',
                url:'/login',
                data: postData,
                success:function (response) {
                    window.location=response.route;
                },
                error:function (response) {
                    $('.alert-danger').text(response.responseJSON.error)
                    $('.alert-danger').show()
                }
            })

        })
    </script>
    @endsection