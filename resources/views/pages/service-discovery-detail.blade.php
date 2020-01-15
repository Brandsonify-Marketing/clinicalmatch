@extends('layouts.master')

@section('content')
<section class="banner-inner-pg" style="background-image: url({{asset('images/service-detail-bg.jpg')}});">
    <div class="container wow fadeIn" data-wow-duration="2s" data-wow-delay="1s">
        <h2 class="main-head">Clinical Trial Discovery Services</h2>
    </div>
</section>
<section class="ser-dtl-sec">
    <div class="container">
        <h2 class="main-head">Why Patients and Physicians Love Us! </h2>
        <div class="our-story-txt">
            <p>Clinical trials offer the ability for patients to achieve critical improvements in their quality of life and potentially benefit from unique, innovative new treatments for illnesses and diseases. However, finding clinical trials can be time-consuming, frustrating, and difficult, particularly for patients and their families, but also for physicians.</p>
            <p>We offer a solution to those challenges – a unique platform purpose-built to help patients, their family members, and physicians identify the right clinical trials at the right time to ensure access to alternative treatments.</p>

        </div>
        <div class="srvc-dtl-img">
            <img class="wow fadeInUp" data-wow-duration="1s" src="{{asset('images/service-detial-img1.png')}}">
        </div>
        <div class="our-story-txt">
            <p>At Clinical Match, our focus is on providing data-driven clinical trial matching and improved participant retention in an ethical and regulatory-rich environment supported by our proprietary algorithm. For patients, that means access to unique treatment options.</p>
            <p>For physicians, it means the ability to help patients find solutions to their health challenges, but also the ability to be engaged.</p>
        </div>
        <div class="srvc-dtl-img">
            <img class="wow fadeInUp" data-wow-duration="1s"  src="{{asset('images/service-detial-img2.png')}}">
        </div>
        <div class="our-story-txt">
            <p>While data and technology are critical components of our platform, we never forget that our services are focused on delivering solutions for patients. Because of that, compassion and ethical practices are at the core of our mission. </p>
            <p>We recognize physicians as critical to the outcome for patients, our clinical trial participation and  retention model requires physician involvement and is part of a patient’s clinical management.</p>
        </div>
        <div class="srvc-dtl-img">
            <img class="wow fadeInUp" data-wow-duration="1s"  src="{{asset('images/service-detial-img3.png')}}">
        </div>
        <div class="our-story-txt">
            <p>For patients, their family members, and physicians, Clinical Match offers a dynamic solution to pressing needs and health concerns. We make it simpler to find the ideal clinical trials, enroll, and then manage the entire experience.</p>
            <p>We invite you to explore our platform and learn more about what makes Clinical Match an innovative platform.</p>
        </div>
        <div class="we-do-btn wow fadeIn" data-wow-duration="2s" data-wow-delay=".5s">
            <a href="#" class="btn-typo">Let’s Get Started</a>
        </div>
    </div>
</section>
@include('partials.explore-resources')
@endsection