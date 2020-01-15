@extends('layouts.master')
@section('content')
<section class="banner-inner-pg" style="background-image: url({{asset('images/resource-landing-bg.jpg')}});">
    <div class="container wow fadeIn" data-wow-duration="2s" data-wow-delay="1s">
        <h2 class="main-head">Resources: Case Study Category</h2>
        <p>Vivamus pharetra vestibulum purus, vulputate ullamcorper tortor volutpat ut.</p>
        <ul>
            <li>
                <a href="{{ route('resource.articles') }}">Articles</a>
            </li>
            <li>
                <a href="{{ route('resource.case-study') }}">Case Studies</a>
            </li>
        </ul>
    </div>
</section>
<section class="blog-section">
    <div class="container">
        <div class="row">
            <div class="col-12 col-md-8 post-lft-sec">
                <div class="blog-wrap blog-wrap-detail wow fadeInUp">
                    <div class="blog-wrap-text">
                        <h2 class="main-head">{!! $post->title !!}</h2>
                    </div>
                    <div class="blog-wrap-img">
                        <img src="{{ url('storage/'.$post->image)}}">
                    </div>
                    <div class="blog-wrap-text blog-content">
                        {!! $post->body !!}
                    </div>
                </div>
                <section class="more-case-study d-md-none wow fadeInUp">
                    <div class="container">
                        <h2 class="main-head">More Case Studies</h2>
                        <div class="more-case-study-main">
                            <div class="row">
                                @foreach($caseStudies as $caseStudy)
                                <div class="col-6 case-wrap">
                                    <div class="row">
                                        <div class="col-4 img-wrap">
                                            <a href="{{ route('resource.case-study-detail',$caseStudy->slug) }}">
                                                <img src="{{ url('storage/'.$caseStudy->image)}}">
                                            </a>
                                        </div>
                                        <div class="col-8 col-lg-6 text-wrap">
                                            <a href="{{ route('resource.case-study-detail',$caseStudy->slug) }}">
                                                <h2>{!! $caseStudy->title !!}</h2>         
                                                <p>{{ date('F dS, Y',strtotime($caseStudy->created_at)) }}</p>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </section>
            </div>
            @include('partials.resource-sidebar')
        </div>
    </div> 
</section>
<section class="more-case-study d-none d-md-block wow fadeInUp">
    <div class="container">
        <h2 class="main-head">More Case Studies</h2>
        <div class="more-case-study-main">
            <div class="row">
                @foreach($caseStudies as $caseStudy)
                <div class="col-6  case-wrap">
                    <div class="row">
                        <div class="col-4 img-wrap">
                            <a href="{{ route('resource.case-study-detail',$caseStudy->slug) }}">
                                <img src="{{ url('storage/'.$caseStudy->image)}}">
                            </a>
                        </div>
                        <div class="col-md-8 col-lg-6 text-wrap">
                            <a href="{{ route('resource.case-study-detail',$caseStudy->slug) }}">
                                <h2>{!! $caseStudy->title !!}</h2>         
                                <p>{{ date('F dS, Y',strtotime($caseStudy->created_at)) }}</p>
                            </a>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</section>
@endsection