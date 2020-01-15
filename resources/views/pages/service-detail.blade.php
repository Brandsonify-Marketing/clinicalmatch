@extends('layouts.master')

@section('content')
<section class="banner-inner-pg" style="background-image: url({{asset('images/service-detail-bg.jpg')}});">
    <div class="container wow fadeIn" data-wow-duration="2s" data-wow-delay="1s">
        <h2 class="main-head">Clinical Trial Management & Retention Services</h2>
    </div>
</section>
<section class="ser-dtl-sec">
    <div class="container">
        <h2 class="main-head">Why Principal Investigators and Sponsors Love Us!</h2>
        <div class="our-story-txt">
            <p>We understand that it can be challenging to locate physicians and patients for clinical trials. Our platform was designed specifically to alleviate that challenge. We offer unique tools, features, and capabilities to make it simpler for sponsors and principal investigators to attract and retain both patients and physicians, ensuring better success and preventing premature termination.</p>
            <p>The Clinical Match platform is built on advanced technology, including a proprietary algorithm that helps ensure the utmost in terms of patient matching. By submitting your clinical trial, you can take advantage of these tools.</p>

        </div>
        <div class="srvc-dtl-img">
            <img class="wow fadeInUp" data-wow-duration="1s" src="{{asset('images/service-detial-img1.png')}}">
        </div>
        <div class="our-story-txt">
            <p>ClinicalMatch uses a customized and individualized approach that is tailored to a Participant and the research site. ClinicalMatch will organize appointments and tasks using our proprietary software to track progress and identify retention issues. As an incentive to retaining Participants, ClinicalMatch uses a unique hold-back reimbursement model as a gift to enrolled Participants.</p>
        </div>
        <div class="srvc-dtl-img">
            <img class="wow fadeInUp" data-wow-duration="1s"  src="{{asset('images/service-detial-img2.png')}}">
        </div>
        <div class="our-story-txt">
            <p>Our sole goal is to match eligible patients with the right clinical trials, but we also strive to deliver powerful tools and unique capabilities that make managing your trial simpler and easier by offering full management solution using our proprietary software.</p>
            <p>Of course, not all trial sponsors and investigators require the same tools and capabilities. Our platform is scalable to ensure that you always have access to the features you require at each stage of your trial.</p>
        </div>
        <div class="srvc-dtl-img">
            <img class="wow fadeInUp" data-wow-duration="1s"  src="{{asset('images/service-detial-img3.png')}}">
        </div>
        <div class="our-story-txt">
            <p>Ready to experience the difference the right platform, advanced technology, and an expert partner can make? </p>
        </div>
        <div class="we-do-btn wow fadeIn" data-wow-duration="2s" data-wow-delay=".5s">
            <a href="#" class="btn-typo">Let’s Get Started</a>
        </div>
    </div>
</section>
@include('partials.explore-resources')
@endsection