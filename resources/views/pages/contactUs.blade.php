@extends('layouts.master')

@section('content')

<section class="banner-inner-pg" style="margin: 0;background-image: url({{ asset('images/contactis.jpg') }});">
    <div class="container wow fadeIn" data-wow-duration="2s" data-wow-delay="1s">
        <h2 class="main-head">Contact Us</h2>
    </div>
</section>
<section class="our-story wow fadeInUp">
    <div class="container">
        <div class="our-sec-stry">
            <div class="row">
                <div class="col-12 col-md-12 our-story-txt">
                    <p>At Clinical Match, we understand that it can be challenging to locate patients or volunteers for clinical trials. Our platform was designed specifically to alleviate that challenge. We offer unique tools, features, and capabilities to make it simpler for Principal Investigators to attract and retain participants, ensuring better success and preventing premature termination. Our platform was designed to make it simpler to reach large, targeted audiences eager to learn more about your trial and its goals.</p>
                    <p>Clinical trials offer the ability for patients to achieve critical improvements in their quality of life and potentially benefit from unique, innovative new treatments. However, finding clinical trials can be time-consuming, frustrating, and difficult, particularly for patients and their families, but also for physicians. We offer a solution to these challenges, through a unique platform purpose-built to help patients, their family members, and physicians identify the right clinical trials at the right time to ensure access to alternative treatments. Let Clinical Match help find an alternative treatment.</p>
                    <p>Contact us today and join our efforts in advancing medicine and bringing hope to millions.</p>
                </div>
            </div>
        </div>

        <div class="our-sec-stry">
            <div class="row">
                <div class="col-md-6">
                    @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                    <br />
                    @endif
                    <form action="{{route('contactus.store')}}" method="POST">
                        @csrf
                        <div class="">
                            @if(\Session::has('Success'))
                            <div class="alert alert-success w-100">
                                {{\Session::get('Success')}}
                            </div>
                            @endif          
                            @if(\Session::has('Error'))
                            <div class="alert alert-danger">
                                <li>{{\Session::get('Error')}}</li>
                                </ul>
                            </div>
                            @endif
                            <div class="col-12 col-lg-12 login-form-fields">
                                <label><strong>Name*</strong></label>
                                <input id="name" type="text" name="name" placeholder="Name*" >
                            </div>
                            @error('name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                            <div class="col-12 col-md-12 login-form-fields">
                                <label><strong>Email*</strong></label>
                                <input id="sub_email" type="email" name="email" placeholder="Email Address*" required="required">
                            </div>
                            @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror

                            <div class="col-12 col-md-12 login-form-fields">
                                <label><strong>Phone</strong></label>
                                <input id="sub_phone" maxlength=10 onkeypress="return isNumberKey(this, event);" type="text" name="phone" placeholder="Phone">
                            </div>

                            <div class="col-12 col-md-12 login-form-fields">
                                <label><strong>Category*</strong></label>
                                <select name="category" value="" >
                                    <option selected="selected" disabled>--Select a  Category--</option> 
                                    <option value="Physicians">
                                        Physicians                 
                                    </option>
                                    <option value="Patients & Volunteers">
                                        Patients & Volunteers                 
                                    </option>
                                    <option value="Family & Friends of Patients">
                                        Family & Friends of Patients                 
                                    </option>
                                    <option value="Sponsors">
                                        Sponsors                 
                                    </option>
                                    <option value="Prinicipal Investigators">
                                        Prinicipal Investigators                 
                                    </option>
                                    <option value="Research Coordinators">
                                        Research Coordinators             
                                    </option>
                                    <option value="Community Managers">
                                        Community Managers                 
                                    </option>
                                </select>
                            </div>
                            @error('category')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror

                            <div class="col-12 col-md-12 login-form-fields">
                                <label><strong>Message*</strong></label>
                                <textarea name="message" placeholder="Message*" required="required"></textarea>
                            </div>
                            @error('message')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                            <div class="col-12 col-md-12 login-form-fields">
                                <lable>Marketing &amp; Newsletter</lable>
                                <select name="marketing" value="" >
                                    <option value="I allow Clinical Match to send me marketing information." selected="selected" >
                                        I allow Clinical Match to send me marketing information.					
                                    </option>
                                    <option value="I do not allow Clinical Match to send me marketing information." >
                                        I do not allow Clinical Match to send me marketing information.		
                                    </option>
                                </select>
                            </div>
                            <div class="col-12 col-md-12 login-form-fields"> 
                                <p class="help-block-contact">Contact email: <a href="mailto:support@clinicalmatch.com?Subject=Query" target="_top">support@clinicalmatch.com</a></p><br>
                            </div>
                            <span id="fld_990202Caption" class="help-block">You will receive information from Clinical Match and agree to let Clinical Match store your contact information for marketing purposes. You can unsubscribe at any time.</span>
                            <div class="col-12 subscBtn text-center">
                                <button type="submit" class="btn-subscribe btn-typo" >Send Message</button>
                            </div>
                            <span id="fld_990202Caption" class="help-block">By clicking this checkbox you are agreeing to let Clinical Match store your personal information for direct communication. You can withdraw this consent by contacting Clinical Match at any time. For more information please visit <a href="http://clinicalmatch.com/beta/public/resource">http://clinicalmatch.com/beta/public/resource</a> .</span>
                        </div>    
                    </form>
                </div>
                <div class="col-md-6">
                    <div class="address-custom">
                    <span><p><strong>Address</strong> </p>
                        <p> 5100 Westhiemer Rd,</p>
                        <p> suite 200.Houston Tx </p>
                        <p> 77077 </p>
                    </span>
                    </div>
                    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3464.2653904279487!2d-95.46694588542859!3d29.741031581993646!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x8640c168dea37dc1%3A0xa20bc28da7de0b6a!2s5100%20Westheimer%20Rd%20%23200%2C%20Houston%2C%20TX%2077056%2C%20USA!5e0!3m2!1sen!2sin!4v1579004078439!5m2!1sen!2sin" width="600" height="450" frameborder="0" style="border:0;" allowfullscreen=""></iframe>
                </div>
            </div>
        </div>
    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script type="text/javascript">
                                    function isNumberKey(txt, evt) {
                                        var charCode = (evt.which) ? evt.which : evt.keyCode;
                                        if (charCode == 46) {
                                            //Check if the text already contains the . character
                                            if (txt.value.indexOf('.') === -1) {
                                                return true;
                                            } else {
                                                return false;
                                            }
                                        } else {
                                            if (charCode > 31
                                                    && (charCode < 48 || charCode > 57))
                                                return false;
                                        }
                                        return true;
                                    }
    </script>
</section>
@include('partials.explore-resources')
@endsection