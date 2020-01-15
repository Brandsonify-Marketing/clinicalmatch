@extends('layouts.master')
@section('content')
<section class="banner">
    <div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
        <div class="carousel-inner">
            <div class="carousel-item active">
                <div class="baner-sec-inner">            
                    <img class="bnr-img d-none d-sm-block" src="{{ asset('images/banner.jpg') }}">
                    <img class="bnr-img d-sm-none" src="{{ asset('images/mob-banner.jpg') }}">
                    <div class="banner-content">
                        <div class="banner-icon">
                            <img src="{{ asset('images/banner-icon.png') }}">
                        </div>
                        <div class="banner-txt">
                            <h1>Find the perfect 
                                clinical trial for 
                                your patients</h1>
                            <a href="#" class="btn-typo">START TODAY</a>
                        </div>
                    </div>
                </div>  
            </div>
            <div class="carousel-item">  
                <div class="baner-sec-inner">                         
                    <img class="bnr-img d-none d-sm-block" src="{{ asset('images/banner2.jpg') }}">
                    <img class="bnr-img d-sm-none" src="{{ asset('images/mob-banner2.jpg') }}">
                    <div class="banner-content">
                        <div class="banner-icon">
                            <img src="{{ asset('images/banner-icon2.png') }}">
                        </div>
                        <div class="banner-txt">
                            <h1>Dedicated to 
                                helping you find
                                the right treatment</h1>
                            <a href="#" class="btn-typo">START TODAY</a>
                        </div>
                    </div>
                </div>  
            </div>
        </div>        
        <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
            <span class="carousel-control-prev-icon" aria-hi    dden="true"></span>
            <span class="sr-only">Previous</span>
        </a>
        <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next"               >
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="sr-only">Next    </span>
        </a>
    </div>
</section>

@include('partials.what-we-do')
@include('partials.find-clinical-trial')
<section class="post-sec wow fadeInUpBig">
    <h2 class="main-head">Articles</h2>
    <div class="outer-container">
        <div class="owl-carousel article-slider case-study owl-theme">
            @foreach($articles as $article)
            <div class="item">              
                <div class="article-sec">
                    <div class="article-user">
                        <div class="article-user-img">
                            <h2><a href="{{ route('resource.article-detail',$article->slug)}}"><img src="{{ url('storage/'.$article->image)}}"></a>
                        </div>
                        <div class="article-txt">
                            <div class="article-detial">
                                <h2><a href="{{ route('resource.article-detail',$article->slug)}}">{!! $article->title !!}</a></h2>
                                <p>{{ Str::limit($article->excerpt, $limit = 100, $end = '')}}</p>
                            </div>
                            <div class="article-more">
                                <div class="row justify-content-between">
                                    <div class="col-auto">
                                        <span>{{ date('F dS, Y',strtotime($article->created_at)) }}</span>
                                    </div>
                                    <div class="col-auto">
                                        <a href="{{ route('resource.article-detail',$article->slug)}}" class="blue-color">READ MORE</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>
<section class="post-sec wow fadeInUpBig">
    <h2 class="main-head">Case Studies</h2>
    <div class="outer-container">
        <div class="owl-carousel case-study owl-theme">
            @foreach($caseStudies as $caseStudy)
            <div class="item">              
                <div class="article-sec">
                    <div class="article-user">
                        <div class="article-user-img">
                            <a href="{{ route('resource.case-study-detail',$caseStudy->slug)}}"><img src="{{ url('storage/'.$caseStudy->image)}}"></a>
                        </div>
                        <div class="article-txt">
                            <div class="article-detial">
                                <h2><a href="{{ route('resource.case-study-detail',$caseStudy->slug)}}">{!! $caseStudy->title !!}</a></h2>
                                <p>{{ Str::limit($caseStudy->excerpt, $limit = 100, $end = '')}}</p>
                            </div>
                            <div class="article-more">
                                <div class="row justify-content-between">
                                    <div class="col-auto">
                                        <span>{{ date('F dS, Y',strtotime($caseStudy->created_at)) }}</span>
                                    </div>
                                    <div class="col-auto">
                                        <a href="{{ route('resource.case-study-detail',$caseStudy->slug)}}">READ MORE</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>
@endsection