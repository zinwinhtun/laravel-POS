@extends('user.layout.master')

@section('content')

<!-- Contact Start -->
<div class="container-fluid">
    <h2 class="section-title position-relative text-uppercase mx-xl-5 mb-4"><span class="bg-secondary pr-3">Contact Us</span></h2>
    <div class="row px-xl-5">
        <div class="col-lg-7 mb-5">
            <div class="contact-form bg-light p-30">
                <div id="success"></div>
                <form name="sentMessage" id="contactForm" novalidate="novalidate" action="{{ route('user#sentMessage') }}" method="POST">
                    @csrf
                    <div class="control-group">
                        <input type="text" disabled class="form-control" id="name" placeholder="Your Name" name="name"
                            required="required" data-validation-required-message="Please enter your name"  value="{{Auth::user()->name}}" />
                        <p class="help-block text-danger"></p>
                    </div>
                    <div class="control-group">
                        <input type="email" disabled class="form-control" id="email" placeholder="Your Email" name="email"
                            required="required" data-validation-required-message="Please enter your email" value="{{Auth::user()->email}}" />
                        <p class="help-block text-danger"></p>
                    </div>
                    <div class="control-group">
                        <textarea class="form-control @error('message') is-invalid @enderror" rows="8" id="message" placeholder="Message"
                            required="required" name="message"
                            data-validation-required-message="Please enter your message">{{ old('message') }}</textarea>
                            @error('message')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        <p class="help-block text-danger"></p>
                    </div>
                    <div>
                        <button class="btn btn-primary py-2 px-4" name="sentBtn" type="submit" id="sendMessageButton">Send
                            Message</button>
                    </div>
                </form>
            </div>
        </div>
        <div class="col-lg-5 mb-5">
            <div class="bg-light p-30 mb-30">
                <iframe style="width: 100%; height: 250px;"
                src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3733.6184088230975!2d96.56072651442967!3d20.644405106165127!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x30ceb786f3f218d1%3A0xbc3c00e4faa2c764!2zS2FsYXcgQ2l0eSBWaWV3ICjhgIDhgJzhgLHhgKzhgJnhgLzhgK3hgK_hgLfhgJvhgL7hgLDhgIHhgIThgLrhgLgp!5e0!3m2!1sen!2smm!4v1669382289081!5m2!1sen!2smm"
                frameborder="0" style="border:0;" allowfullscreen="" aria-hidden="false" tabindex="0"></iframe>
            </div>
            <div class="bg-light p-30 mb-3">
                <p class="mb-2"><i class="fa fa-map-marker-alt text-primary mr-3"></i>123 Street, kalaw , Myanmar</p>
                <p class="mb-2"><i class="fa fa-envelope text-primary mr-3"></i>zinwinhtun71@gmail.com</p>
                <p class="mb-2"><i class="fa fa-phone-alt text-primary mr-3"></i>+959977166520</p>
            </div>
        </div>
    </div>
</div>
<!-- Contact End -->

@endsection
