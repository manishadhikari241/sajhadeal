@extends('front.master_front')
@section('title','Contact Us')

@section('content')
    <section class="contact_us py-5">
        <div class="container">
            <div class="row box-shadow s">
                <div class="col-md-6">
                    <div class="heading">
                        <h2>Direct Contact Us</h2>
                    </div>
                    <div class="contact_us-ul">
                        <ul>
                            <li> Address:
                                {{ isset($setting) ? $setting->address : ''}}</li>
                            <li> Telephone:
                                01-<a href="tel:+977{{ isset($setting) ? $setting->company_number : '' }}">{{ isset($setting) ? $setting->company_number : '' }}</a></</li>
                            <li>Email: <a href="mailto:{{ isset($setting) ? $setting->email : '' }}">{{ isset($setting) ? $setting->email : '' }}</a></li>

                        </ul>
                    </div>
                    <div class="contact_us-map">
<iframe src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d3532.566409211925!2d85.343977!3d27.699793!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x88d258e070fa523!2sSajadeal+Online+Services+Pvt+Ltd!5e0!3m2!1sen!2snp!4v1560078108340!5m2!1sen!2snp" width="600" height="450" frameborder="0" style="border:0" allowfullscreen></iframe>                    </div>

                </div>
                <div class="col-md-6  ">
                    <div class="form_container ">
                        <div class="row">
                            <div class="col-sm-12 mb">
                                <div class="heading ">
                                    <h2>Contact Form</h2>
                                </div>
                                <p>
                                    Please send your message below. We will get back to you at the earliest!
                                </p>
                            </div>
                        </div>

                        <form role="form" method="post" action="{{  route('contact-post') }}">
                            @csrf

                            <div class="row">
                                <div class="col-sm-12 form-group">
                                    <label for="message">
                                        Message:</label>
                                    <textarea class="form-control" type="textarea" id="message" name="message"
                                              maxlength="6000"
                                              rows="7"></textarea>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-6 form-group">
                                    <label for="name">
                                        Your Name:</label>
                                    <input type="text" class="form-control" id="name" name="name" required="">
                                </div>
                                <div class="col-sm-6 form-group">
                                    <label for="email">
                                        Email:</label>
                                    <input type="email" class="form-control" id="email" name="email" required="">
                                </div>
                            </div>


                            <div class="row">
                                <div class="col-sm-12 form-group">
                                    <button type="submit" class="uk-button checkout">Send →</button>
                                </div>
                            </div>

                        </form>
                        <div id="success_message" style="width:100%; height:100%; display:none; ">
                            <h3>Posted your message successfully!</h3>
                        </div>
                        <div id="error_message" style="width:100%; height:100%; display:none; ">
                            <h3>Error</h3>
                            Sorry there was an error sending your form.

                        </div>
                    </div>
                </div>
            </div>
        </div>

    </section>

    <section class="mb free-ads">
        <div class="container-fluid">
            <div class="row d-flex flex-nowrap">
                <div class=""><a href=""><img src="{{  asset('front/images/b1.png') }}" alt=""></a></div>
                <div class=""><a href=""><img src="{{  asset('front/images/b2.png') }}" alt=""></a></div>
                <div class=""><a href=""><img src="{{  asset('front/images/b1.png') }}" alt=""></a></div>

            </div>
        </div>
    </section>


@endsection

@section('script')
<script>

  fbq('track', 'Contact');

</script>
@endsection