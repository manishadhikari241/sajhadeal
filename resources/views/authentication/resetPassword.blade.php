@extends('layouts.master')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-6 col-md-offset-3">
                <div class="panel" style="border: 2px solid dodgerblue;">
                    <div class="panel-heading bg-primary">
                        <h2>Enter New Password</h2>
                    </div>
                    <div class="panel-body">
                        <form id="login-form" method="post" action="" class="form" >
                            {{csrf_field()}}

                            @if(session('success'))
                                <div class="alert alert-success">
                                    {{session('success')}}
                                </div>
                            @endif


                            <div class="form-group">
                                <span><i class="fas fa-envelope"></i></span>
                                <input type="password" name="password" placeholder="Password" required>
                            </div>
                            <div class="form-group">
                                <span><i class="fas fa-envelope"></i></span>
                                <input type="password" name="Password_Confirmation" placeholder="Confirm Password" required>
                            </div>

                            <div class="form-group">
                                <input type="submit" value="submit" class="pull-right" >
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
{{--@section('script')--}}
{{--<script type="text/javascript">--}}
{{--$.ajaxSetup({--}}
{{--headers:{--}}
{{--'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')--}}
{{--}--}}
{{--})--}}
{{--$('#login-form').submit(function(event) {--}}
{{--event.preventDefault();--}}
{{--var postData = {--}}
{{--'email': $('input[name=email]').val(),--}}
{{--'password': $('input[name=password]').val(),--}}
{{--'remember_me': $('input[name=remember_me]').is(':checked'),--}}
{{--}--}}
{{--$.ajax({--}}
{{--type:'POST',--}}
{{--url:'/login',--}}
{{--data: postData,--}}
{{--success:function (response) {--}}
{{--window.location=response.route;--}}
{{--},--}}
{{--error:function (response) {--}}
{{--$('.alert-danger').text(response.responseJSON.error)--}}
{{--$('.alert-danger').show()--}}
{{--}--}}
{{--})--}}

{{--})--}}
{{--</script>--}}
{{--@endsection--}}