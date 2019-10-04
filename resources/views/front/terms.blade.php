@extends('front.master_front')
@section('title','Terms & Conditions')
@section('content')
    <section id="about-about">
        <div class="container">
            <div class="card p-5 ">
                {{--<h2 class="text-center ">Privacy</h2>--}}
                {{--<p class="text-center mb-4">{{  $setting->policies }}</p>--}}
                <h2 class="text-center">Terms And Condition</h2>
                <div class="text-justify mx-auto" style="max-width: 74rem;">
                    <p class="about-m">{!! $setting->terms !!}</p>
                </div>
            </div>
        </div>
    </section>

@endsection