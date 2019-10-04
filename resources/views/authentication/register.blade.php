@extends('layouts.master')
@section('content')
    <div class="container register">
        <div class="row">
            <div class="col-md-3 register-left">
                <img src="https://image.ibb.co/n7oTvU/logo_white.png" alt=""/>
                <h3>Welcome</h3>
                <p>You are 30 seconds away from earning your own money!</p>
                <a href="/login" class="btn btn-light">Login</a> <br/>
            </div>
            <div class="col-md-9 register-right">

                <div class="tab-content" id="myTabContent">
                    <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                        <h3 class="register-heading">Join Us</h3>
                        <form action="/register" method="POST" class="form">
                            {{csrf_field()}}
                        <div class="row register-form">



                                <div class="col-md-12">
                                    <div class="form-group">
                                        <input type="text" class="form-control" name="first_name" placeholder="First Name *" value="" />
                                    </div>
                                    <div class="form-group">
                                        <input type="text" class="form-control" name="last_name" placeholder="Last Name *" value="" />
                                    </div>
                                    <div class="form-group">
                                        <input type="text" class="form-control" name="phone" placeholder="Mobile Number *" value="" />
                                    </div>
                                    <div class="form-group">
                                        <input type="email" class="form-control" name="email" placeholder="Email *" value="" />
                                    </div>

                                    <div class="form-group">
                                        <input type="password" class="form-control" name="password" placeholder="Password *" value="" />
                                    </div>
                                    <div class="form-group">
                                        <input type="password" class="form-control" name="confirm_password" placeholder="Confirm Password *" value="" />
                                    </div>

                                    <input type="submit" class="btnRegister"  value="Register"/>
                                </div>

                        </div>
                        </form>
                    </div>

                </div>
            </div>
        </div>

    </div>

    @endsection