@extends('front.master_front')
@section('title', 'Login')
@section('content')
    <section id="form_login">
        <div class="alert alert-danger" style="display: none;">

        </div>
        <div class="alert alert-success" style="display: none;">

        </div>
        <form class="form-login" id="login-form">

            <div class="form-log-in-with-email or">

                <div class="form-white-background">

                    <div class="form-title-row">
                        <h1>Log in</h1>
                    </div>

                    <div class="form-row">
                        <label>
                            <span>Email</span>
                            <input type="email" name="email" placeholder="Enter Your Email">
                        </label>
                    </div>

                    <div class="form-row">
                        <label>
                            <span>Password</span>
                            <input type="password" name="password" placeholder="Enter Your Password">
                        </label>
                    </div>
                    {{--<div class="form-row">--}}
                        {{--<label>--}}
                            {{--<span>Remember me</span>--}}
                            {{--<input type="checkbox" class="form-check-input" name="remember_me">--}}
                        {{--</label>--}}
                    {{--</div>--}}
                    <div class="form-row">

                        <button type="submit" class="uk-button checkout center">Log in</button>
                    </div>
                    <a href="{{route('forget_password')}}" class="form-forgotten-password">Forgotten password &middot;</a>
                    <a href="{{  route('register') }}" class="form-create-an-account">Create an account &rarr;</a>

                </div>


            </div>

            <div class="form-sign-in-with-social" style="margin-top:60px">

                <div class="form-row form-title-row">
                    <h1 class="form-title">Sign in with</h1>
                </div>

                <a href="/login/google" class="form-google-button">Google</a>
                <a href="/login/facebook" class="form-facebook-button">Facebook</a>
                {{--<a href="#" class="form-twitter-button">Twitter</a>--}}

            </div>

        </form>

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