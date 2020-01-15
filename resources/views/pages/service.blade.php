@extends('layouts.master')

@section('content')
<section class="banner-inner-pg" style="background-image: url({{ asset('images/service-landing-bg.jpg') }});">
    <div class="container wow fadeIn" data-wow-duration="2s" data-wow-delay="1s">
        <h2 class="main-head">Services</h2>
        <p>Data-driven Clinical Match</p>
    </div>
</section>
<section class="what-we-do-Sec service-science wow fadeInUp">
    <div class="container">
        <!--<h2 class="main-head">The Science of creating<br>Clinical Matches?</h2>-->
<!--        <div class="we-do-sec">
            <div class="clinical-mtch-video">
                <iframe width="1169" height="658" src="https://www.youtube.com/embed/OrHYAmcz6vU?rel=0" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
            </div>          
        </div>-->
    </div>
</section>
@include('partials.what-we-do')
@include('partials.find-clinical-trial')
@include('partials.explore-resources')
@endsection