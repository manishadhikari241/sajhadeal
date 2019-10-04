@extends('front.master_front')
@section('title', 'Register')
@section('content')
    {{--@dd($errors)--}}
    <div id="form_register">

        <!-- You only need this form and the form-register.css -->

        <form action="/register" method="POST" class="form">
            {{csrf_field()}}

            <div class="form-register-with-email">

                <div class="form-white-background">

                    <div class="form-title-row">
                        <h1>Create an account</h1>
                    </div>

                    <div class="form-row">
                        <label>
                            <span>Name</span>
                            <input class="uk-input {{ $errors->has('name') ? 'error-form' : '' }}" type="text"
                                   value="{{ old('name') }}" name="name">
                        </label>
                        @if ($errors->has('name'))
                            <span class="invalid-feedback" role="alert">
                                        {{ $errors->first('name') }}
                                    </span>
                        @endif
                    </div>

                    <div class="form-row">
                        <label>
                            <span>Email</span>
                            <input class="uk-input {{ $errors->has('email') ? 'error-form' : '' }}" value="{{ old('email') }}" type="email" name="email">
                        </label>
                        @if ($errors->has('email'))
                            <span class="invalid-feedback" role="alert">
                                        {{ $errors->first('email') }}
                            </span>
                        @endif
                    </div>
                    <div class="form-row">
                        <label>
                            <span>Phone</span>
                            <input class="uk-input {{ $errors->has('phone') ? 'error-form' : '' }}" value="{{ old('phone') }}" type="text" name="phone">
                        </label>
                        @if ($errors->has('phone'))
                            <span class="invalid-feedback" role="alert">
                                        {{ $errors->first('phone') }}
                            </span>
                        @endif
                    </div>

                    <div class="form-row">
                        <label>
                            <span>Password</span>
                            <input class="uk-input {{ $errors->has('password') ? 'error-form' : '' }}" type="password" name="password">
                        </label>
                        @if ($errors->has('password'))
                            <span class="invalid-feedback" role="alert">
                                {{ $errors->first('password') }}
                            </span>
                        @endif
                    </div>


                    <div class="mb">
                        <label for=""> <input type="checkbox" class="uk-checkbox" name="checkbox" checked>
                            I agree to the <a href="#">terms and conditions</a></label>

                    </div>

                    <div class="form-row">
                        <button type="submit" class="center uk-button checkout">Register</button>
                    </div>
                    <a href="{{'login'}}" class="form-log-in-with-existing">Already have an account? Login here
                        &rarr;</a>

                </div>


            </div>

            <div class="form-sign-in-with-social">

                <div class="form-row form-title-row">
                    <span class="form-title">Sign in with</span>
                </div>

                <a href="/login/google" class="form-google-button">Google</a>
                <a href="/login/facebook" class="form-facebook-button">Facebook</a>
                {{--<a href="#" class="form-twitter-button">Twitter</a>--}}

            </div>

        </form>

    </div>


@endsection