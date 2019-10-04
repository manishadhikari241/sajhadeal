@extends('front.master_front')
@section('title','About Us')

@section('content')
    <section id="about-about">
        <div class="container">
            <div class="card p-5 ">
                <h1 class="text-center ">- Our Mission -</h1>
                <div class="text-center mb-4">{!! isset($setting) ? $setting->brief_about_us : '' !!}</div>
                <h2 class="text-center">About</h2>
                <div class="text-justify mx-auto" style="max-width: 74rem;">
                    <p class="about-m">
                        {!! isset($setting) ? $setting->detail_about_us : '' !!}
                    </p>
                </div>
            </div>
        </div>
    </section>


    @endsection