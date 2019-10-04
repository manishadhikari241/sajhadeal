@extends('front.master_front')
@section('title', 'Privacy Policy')
@section('content')
    <section id="about-about">
        <div class="container">
            <div class="card p-5 ">
                <h2 class="text-center "></h2>
                <p class="text-center mb-4"></p>
                <h2 class="text-center">Privacy Policies</h2>
                <div class="text-justify mx-auto" style="max-width: 74rem;">
                    <p class="about-m">{!! $setting->policies !!}</p>
                </div>
            </div>
        </div>
    </section>

@endsection