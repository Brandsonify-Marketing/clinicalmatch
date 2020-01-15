<section class="newsletter-sec">
    <div class="container">
        <h2 class="main-head">Stay up to date with the latest news 
            by subscribing to our newsletter.</h2>
        <div class="model-button">
            <button type="button" id="btnsubscribe" class="btn-typo" data-toggle="modal" data-target="#exampleModalCenter">SUBSCRIBE</button>
        </div>
    </div>
<!-- Modal -->
    <div id="exampleModalCenter"   tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true" class="modal fade subscribe-modal">
    <div id="subscribe">
        <div class="modal-dialog modal-dialog-centered">
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    <div class="thanksSec" style="display: none">
                        <div class="subscLogo text-center">
                         <img src="{{ url('/storage').'/'.setting('site.logo') }}">
                        </div>
                        <br>
                        <br>
                        <div class="thank-custom text-center">
                            <h2><span><strong>Thank You!</strong></span></h2>
                            <br>
                        </div>
                        <div class="subscBtn text-center">
                           <button type="button" class="btn-typo" data-dismiss="modal">CLOSE WINDOW</button>
                        </div>
                    </div>
                    <div class="subscribeSec">
                        <div class="subscLogo text-center">
                            <img src="{{ url('/storage').'/'.setting('site.logo') }}"> 
                        </div>    
                        <div class="subscRight">
                            <div class="subscribeSec text-center">
                                <br>
                                <h3><strong>Sign up for our newsletter.</strong></h3>
                                <br>
                                <div class="errors_subscribe_div alert" style="display:none">
                                    <ul class="errors_subscribe">
                                    </ul>
                                </div>
                                <form action="{{route('subscriber.store')}}" method="POST" id="subscribeForm">
                                    @csrf
                                    <div class="">
                                        <div class="col-12 col-lg-12 login-form-fields">
                                            <input id="sub_first_name" type="text" name="first_name" placeholder="First Name" required="required" >
                                        </div>
                                        <div class="col-12 col-lg-12 login-form-fields">
                                            <input id="sub_last_name" type="text" name="last_name" placeholder="Last Name" required="required">
                                        </div>
                                        <div class="col-12 col-md-12 login-form-fields">
                                            <input id="sub_email" type="email" name="email" placeholder="Email Address" required="required">
                                        </div>

                                        <div class="col-12 subscBtn text-center">
                                            <button type="submit" class="btn-subscribe btn-typo" >SUBSCRIBE</button>
                                        </div>
                                    </div>    
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
              </div>
            </div>
        </div>
    </div>
</section>
