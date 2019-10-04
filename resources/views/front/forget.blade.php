@extends('front.master_front')
@section('title', 'Forget Password')
@section('content')
    <section id="form_login">
        <div class="alert alert-danger" style="display: none;">

        </div>
        <div class="alert alert-success" style="display: none;">

        </div>
        <form class="form-login" method="post" id="login-form" action="{{ route('post_forgot_password') }}">
            @csrf
            <div class="form-log-in-with-email nor">

                <div class="form-white-background">

                    <div class="form-title-row">
                        <h1>Forgot Password</h1>
                    </div>

                    <div class="form-row">
                        <label>
                            <span>Email</span>
                            <input type="email" name="email" placeholder="Enter Your Email">
                        </label>
                    </div>



                    <div class="form-row">

                        <button type="submit" class="uk-button checkout center">Reset Password</button>
                    </div>
                    {{--<a href="forget.html" class="form-forgotten-password">Forgotten password &middot;</a>--}}
                    {{--<a href="{{  route('register') }}" class="form-create-an-account">Create an account &rarr;</a>--}}

                </div>


            </div>



        </form>

    </section>
@endsection
@section('script')
@endsection