<?php
$articles = TCG\Voyager\Models\Post::where('category_id', '1')->orderby('id', 'DESC')->limit(5)->get();
$caseStudies = TCG\Voyager\Models\Post::where('category_id', '2')->orderby('id', 'DESC')->limit(5)->get();
?>
<div class="col-12 col-md-4 post-sidebar wow fadeIn">
    <div class="sidebar-subs d-none d-md-block">
<!--         <a href="#" data-toggle="modal" data-target="#subscribe">SUBSCRIBE</a> -->
 		<button type="button" id="btnsubscribe" class="btn-typo" data-toggle="modal" data-target="#exampleModalCenter">SUBSCRIBE</button>
    </div>
    <div class="sidebar-posts">
        <h5>latest<br>Articles</h5>
        <ul>
            @foreach($articles as $article)
            <li>
                <a href="{{ route('resource.article-detail',$article->slug )}}">
                    {{ $article->title}}
                </a>
            </li>
            @endforeach
        </ul>
    </div>
    <div class="sidebar-posts">
        <h5>latest<br>Case Studies</h5>
        <ul>
            @foreach($caseStudies as $caseStudy)
            <li>
                <a href="{{ route('resource.case-study-detail',$caseStudy->slug )}}">
                    {{ $caseStudy->title}}
                </a>
            </li>
            @endforeach
        </ul>
    </div>
  

    <div class="twitter-sidebar">
        <h5>Twitter recents</h5>
        <div class="recent-twitter">
            <p>Ut commodo felis tellus, eu placerat mi luctus ac. Nam egestas velit ut leo eat suscipit, libero libero 
                <span>
                    <a href="#">http://t.co/hVtABj5tZo</a>
                </span>
            </p>
            <p>Ut commodo felis tellus, eu placerat mi luctus ac. Nam egestas velit ut leo eat suscipit, libero libero 
                <span>
                    <a href="#">http://t.co/hVtABj5tZo</a>
                </span>
            </p>
        </div>
    </div>
<!--    <div class="sidebar-subscribe-sec">
        <h5>subscribe</h5>
        <p>Subscribe to get the latest news</p>
        <form action="">
            <input type="email" placeholder="Enter your email address" name="">
            <input class="btn-typo" type="submit " value="sign up" name="">
        </form>
    </div>-->
    <div class="keyword-sidebar" style="display:none;">
        <h5>KEYWORDS</h5>
        <ul>
            <li>
                <a href="#">Clinical Trial</a>
            </li>
            <li>
                <a href="#">Medical</a>
            </li>
            <li>
                <a href="#">Patients</a>
            </li>
            <li>
                <a href="#">Causes</a>
            </li>
            <li>
                <a href="#">Doctors</a>
            </li>
            <li>
                <a href="#">Nurses</a>
            </li>
        </ul>
    </div>
</div>