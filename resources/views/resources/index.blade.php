@extends('layouts.master')
@section('content')
<style type="text/css">
        .ajax-load{
            background: #e1e1e1;
            padding: 10px 0px;
            width: 100%;
        }
</style>
<section class="banner-inner-pg" style="background-image: url({{asset('images/resource-landing-bg.jpg')}});">
    <div class="container wow fadeIn" data-wow-duration="2s" data-wow-delay="1s">
        <h2 class="main-head">Resources</h2>
        <p>Exploring the state of modern healthcare to inform and educate patients and physicians.</p>
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
                <div class="infinite-scroll">
                        @foreach($posts as $post)
                       <div class="blog-sec blog-wrap wow fadeInUp">
                        <div class="blog-wrap-img">
                        <img src="{{ url('storage/'.$post->image)}}">
                        </div>
                        <div class="blog-wrap-text">
                        <h2 class="main-head">{!! $post->title !!}</h2>
                        <ul>
                            <li style="display:none;"><span>{{ @$post->authorId->firstname ? $post->authorId->firstname : '' }}</span></li>
                            <li><a href="#"><i class="fa fa-clock-o" aria-hidden="true"></i>{{ date('F dS, Y',strtotime($post->created_at)) }}</a></li>
                            <li><a href="#"><i class="fa fa-tags" aria-hidden="true"></i> {{ @$post->category->name ? $post->category->name : '' }}</a></li>
                            <li style="display:none;"><a href="#"><i class="fa fa-comments" aria-hidden="true"></i> 3 comment’s</a></li>
                        </ul>
                        <div class="our-story-txt">
                            {{ $post->excerpt }}
                        </div>
                    </div>
                </div>
                        @endforeach
                        {{ $posts->links() }}
                </div>
                <div class="blog-sec btn_sec"> 
                    <a href="{{route('resource.articles')}}">More Articles</a>  | 
                    <a href="{{route('resource.case-study')}}">More Case Studies</a>  | 
                </div>
            </div>
            @include('partials.resource-sidebar')
        </div>
    </div> 
</section>
@endsection