@extends('layouts.master')
@section('content')
<section class="banner-inner-pg" style="background-image: url({{asset('images/resource-landing-bg.jpg')}});">
    <div class="container wow fadeIn" data-wow-duration="2s" data-wow-delay="1s">
        <h2 class="main-head">Resources</h2>
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
        <div class="sidebar-subs d-md-none">
            <a href="#">SUBSCRIBE</a>
        </div>
        <div class="row">
            <div class="col-12 col-md-8 post-lft-sec">
                @foreach(@$articles as $article)
                <div class="blog-sec blog-wrap wow fadeInUp">
                    <div class="blog-wrap-img">
                        <a href="{{ route('resource.article-detail', $article->slug) }}"><img src="{{ url('storage/'.$article->image)}}"></a>
                    </div>
                    <div class="blog-wrap-text">
                        <h2 class="main-head"><a href="{{ route('resource.article-detail', $article->slug) }}">{!! $article->title !!}</a></h2>
                        <ul>
                            <li style="display:none;"><span>{{ @$article->authorId->firstname ? $article->authorId->firstname : '' }}</span></li>
                            <li><a href="#"><i class="fa fa-clock-o" aria-hidden="true"></i>{{ date('F dS, Y',strtotime($article->created_at)) }}</a></li>
                            <li><a href="{{ route('resource.article-detail', $article->slug) }}"><i class="fa fa-tags" aria-hidden="true"></i> {{ @$article->category->name ? $article->category->name : '' }}</a></li>
                            <li style="display:none;"><a href="#"><i class="fa fa-comments" aria-hidden="true"></i> 3 comment’s</a></li>
                        </ul>
                        <div class="our-story-txt">
                            {{ $article->excerpt }}
                        </div>
                    </div>
                </div>
                @endforeach

                <div class="blog-more">
                    <a href="javascript:void(0);" class="btn-typo">More...</a> 
                </div>
            </div>
            @include('partials.resource-sidebar')
        </div>
    </div> 
</section>
@endsection