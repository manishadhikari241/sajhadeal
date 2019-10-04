@extends('front.master_front')
@section('title', 'Reset Password')
@section('content')
    <section id="form_login">
        <div class="alert alert-danger" style="display: none;">

        </div>
        <div class="alert alert-success" style="display: none;">

        </div>
        <form method="post" class="form-login" id="login-form" action="/reset/{{ $email }}/{{ $code }}">
            @csrf
            <div class="form-log-in-with-email nor">

                <div class="form-white-background">

                    <div class="form-title-row">
                        <h1>Set New Password</h1>
                    </div>

                    <div class="form-row">
                        <label>
                            <span>Email</span>
                            <input type="text" disabled value="{{$email}}">
                        </label>
                    </div>
                    <div class="form-row">
                        <label>
                            <span>New Password</span>
                            <input type="password" name="password" placeholder="Enter Your New Password" required>
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