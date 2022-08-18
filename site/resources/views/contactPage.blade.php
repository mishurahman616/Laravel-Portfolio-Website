@extends('layout.app')

@section('title')
Contact
@endsection

@section('content')
<div class="container-fluid jumbotron mt-5 ">
    <div class="row d-flex justify-content-center">
        <div class="col-md-6  text-center">
                <img class=" page-top-img fadeIn" src="images/knowledge.svg">
                <h1 class="page-top-title mt-3">- যোগাযোগ -</h1>
        </div>
    </div>
</div>


<div id="contactId" class="container-fluid section-marginTop parallax text-center">
    <div class="row ">
        <div class="col-md-6 contact-form ">
            <h5 class="help-line-title"> <i class="fas icon-custom-color fa-headphones-alt"></i> হেলপ লাইন </h5>
            <h5 class="help-line-title m-0">  ০১৭৯৪৯১৪৫৭০ </h5>
        </div>
        <div id="contactForm" class="col-md-4 contact-form">
                <h5 class="service-card-title">যোগাযোগ করুন </h5>
                <div class="form-group ">
                    <input type="text" id="contactName" name="contactName" class="form-control w-100" placeholder="আপনার নাম">
                </div>
                <div class="form-group">
                    <input type="text" id="contactMobile" name="contactMobile" class="form-control  w-100" placeholder="মোবাইল নং ">
                </div>
                <div class="form-group">
                    <input type="text" id="contactEmail" name="contactEmail" class="form-control  w-100" placeholder="ইমেইল ">
                </div>
                <div class="form-group">
                    <input  type="text" id="contactMessage" name="contactMessage" class="form-control  w-100" placeholder="মেসেজ ">
                </div>
                <button id="contactSendButton" type="submit" class="btn btn-block normal-btn w-100">পাঠিয়ে দিন </button>
        </div>

    </div>
</div>
@endsection