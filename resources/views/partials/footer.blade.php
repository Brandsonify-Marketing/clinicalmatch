@include('partials.subscribe-footer')
<footer>
    <div class="container">
        <div class="row">
            <div class="col-12 col-md-4 col-lg-3 footer-logo">
                <a href="{{ route('landing-page') }}">
                    <img src="{{ url('/storage').'/'.setting('site.footer_logo') }}" alt="logo">
                </a>
            </div>
            <div class="col-12 col-md-3 col-lg-2 footer-links">
                <h4>ABOUT</h4>
                <ul class="p-0 m-0">{{ menu('Footer about menu','partials.footer_about') }}</ul>
            </div>
            <div class="col-12 col-md-4 col-lg-4 footer-links">
                <h4>SERVICES</h4>
                <ul class="p-0 m-0">{{ menu('Footer services menu','partials.footer_services') }}</ul>
            </div>
            <div class="col-12 col-md-4 col-lg-3 footer-links">
                <h4>RESOURCES</h4>
                <ul class="p-0 m-0">{{ menu('Footer resources menu','partials.footer_services') }}</ul>
            </div>
<!--            <div class="col-12 col-md-3 col-lg-auto footer-social">
                <h4>SOCIAL</h4>
                <ul>{{ menu('Footer Social accounts','partials.footer_social') }}</ul>
            </div>-->
        </div>
    </div>
</footer>
<div class="footer-copyrightBar">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-12 col-md-6 text-center text-md-left pricay_links">
                <ul>
                    <li>
                        <a href="{{ route('privacy')}}">Privacy Policy</a>
                    </li>
                    <li>
                        <a href="{{ route('terms')}}">Terms of Use</a>
                    </li>
                </ul>
            </div>
            <div class="col-12 col-md-6 text-center text-md-right footer-social">
                <!-- <h4>SOCIAL</h4> -->
                    <ul>{{ menu('Footer Social accounts','partials.footer_social') }}</ul>
            </div>
        </div>
    </div>    
</div>
<section class="footer-bootomBar">
    <div class="container">
        <div class="row justify-content-center justify-content-sm-between">
            <div class="col-12 col-sm-auto">
            <p>{{ setting('site.copyright') }}</p>
            </div>
            <div class="col-12 col-sm-auto">
                <p>By Brandsonify</p>
            </div>
        </div>
    </div>
</section>