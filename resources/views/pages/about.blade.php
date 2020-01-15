@extends('layouts.master')

@section('content')

<section class="banner-inner-pg" style="background-image: url({{ asset('images/about-banner.jpg') }});">
    <div class="container wow fadeIn" data-wow-duration="2s" data-wow-delay="1s">
        <h2 class="main-head">About Clinical Match</h2>
        <p>Empowering improved health outcomes through compassion and data-driven technology.</p>
    </div>
</section>
<section class="our-story wow fadeInUp" id="ourstory">
    <div class="container">
        <div class="our-sec-stry">
            <h2 class="main-head">Our Story</h2>
            <div class="row">
                <div class="col-12 col-md-6 d-flex our-story-img align-items-center justify-content-center">
                    <div class="vr-stry-img wow fadeInUp" data-wow-duration="1.5s">
                        <img src="{{ asset('images/our-story-img.png') }}">
                    </div>            
                </div>
                <div class="col-12 col-md-6 our-story-txt">
                    <p>Clinical Match was founded to solve pressing problems for patients, physicians, and even principal investigators and pharmaceutical companies. Clinical trials have been used for decades to help identify potential innovative new treatments to diseases and health conditions. However, challenges have always limited the success of those trials. We offer the ability to overcome those hurdles.</p>
                    <p>Many trials did not see the patient enrollment necessary to move forward. Physicians and patients often lack knowledge of upcoming and ongoing trials. Errors in matching patients to specific trials often led to low retention rates, as well.</p>
                    <p>Our data-driven, technologically-advanced platform delivers innovative solutions to these age-old problems through a human, ethical, and regulatory-guided platform. Our goal is to create an environment where patients, physicians, and principal investigators can come together to achieve their goals together, empowered by education, accurate patient/trial matching, and supported by a physician-driven patient enrollment and retention model.</p>
                </div>
            </div>
        </div>
    </div>
</section>
<section class="our-story wow fadeInUp" id="ourteam">
    <div class="container">
        <div class="our-sec-stry">
            <h2 class="main-head">Our team</h2>
            <div class="row">
                <div class="col-12 col-md-6 our-story-txt">
                    <p>The Clinical Match team has years of experience in conducting and managing clinical trials. We developed the Clinical Match platform to address challenges in clinical trials while supporting mission-critical goals, including protecting patient privacy and fostering responsible, professional relationships with patients, physicians, investigators, and pharmaceutical industry. However, it’s about more than furthering medical research – it’s about finding a compassionate solution to patient needs ethically.  </p>
                    <p>We recognize that patient and physician participation in clinical trials is the foundation of furthering medical knowledge. Without patients and physicians, clinical trials cannot succeed. Our unique model was developed to help improve that participation, as well as to help encourage physician participation in trials as a way to expand the range of treatment options available to their patients.</p>
                </div>
                <div class="col-12 col-md-6 d-flex our-story-img align-items-center justify-content-center">
                    <div class="vr-stry-img wow fadeInUp" data-wow-duration="1.5s">
                        <img src="{{ asset('images/our-team-img.png') }}">
                    </div>            
                </div>
            </div>
        </div>  
    </div>
</section>
<section class="our-story give-back wow fadeInUp" id="ourgiveback">
    <div class="container">
        <div class="our-sec-stry">
            <h2 class="main-head">How We Give Back</h2>
            <div class="row">
                <div class="col-12 col-md-6 d-flex our-story-img align-items-center justify-content-center">
                    <div class="vr-stry-img wow fadeInUp" data-wow-duration="1.5s">
                        <img src="{{ asset('images/jude-children.png') }}">    
                        <img src="{{ asset('images/medicine-sons.png') }}">
                    </div>             
                </div>
                <div class="col-12 col-md-6 our-story-txt">
                    <p>At Clinical Match, we recognize that we are part of a larger community. We recognize that we are uniquely positioned to make a measurable difference in the lives of others. </p>
                    <p>We give a percentage of our revenue to causes that align with our core mission and beliefs, including advancing medicine and improving patient care. Physicians on our platform are also encouraged to donate to causes they believe in.</p>
                    <p>At present, Clinical Match supports two organizations through financial contributions:</p>
                    <ul>
                        <li>Doctors Without Borders – Founded in 1971, this international organization is committed to providing the best care possible to every patient and focuses on serving areas of the world where access to medicine and quality medical care is poor or nonexistent. </li>
                        <li>St. Jude Children’s Research Hospital – St. Jude Children’s Research Hospital was built in 1962 and has played a critical role in discovering new cures and saving the lives of children since that time.</li>
                    </ul>      
                </div>
            </div>
            <div class="we-do-btn wow fadeIn" data-wow-duration="2s" data-wow-delay=".5s">
                <a href="#" class="btn-typo">DONATE</a>
            </div>
        </div>
    </div>
</section>
@include('partials.explore-resources')
@endsection