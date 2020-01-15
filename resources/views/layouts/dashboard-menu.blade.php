<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head><meta http-equiv="Content-Type" content="text/html; charset=utf-8">

        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>{{ config('app.name', 'Clinical Match') }}</title>
        <!--favicon-->
        <link rel="icon" href="{{ asset('images/fav.jpg') }}" type="image/png">
        <!-- Fonts -->
        <link rel="dns-prefetch" href="//fonts.gstatic.com">
        <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet" type="text/css">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.min.css" />
        <link rel="stylesheet" type="text/css" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.4.0/min/dropzone.min.css">
        <script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.4.0/dropzone.js"></script>
        <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.20/css/jquery.dataTables.min.css">
        <link href="https://unpkg.com/filepond/dist/filepond.css" rel="stylesheet">
        <link rel="stylesheet" type="text/css" href="{{ asset('css/owl.carousel.min.css') }}">
        <link rel="stylesheet" type="text/css" href="{{ asset('fonts/stylesheet.css') }}">
        <link rel="stylesheet" type="text/css" href="{{ asset('css/animate.css') }}">
        <link rel="stylesheet" type="text/css" href="{{ asset('css/customdash.css') }}">
        <link rel="stylesheet" type="text/css" href="{{ asset('css/customclinicaltrial.css') }}">
        @yield('extra-css')

    </head>
    <body>
        @include('partials.headerdashboard')
        @auth
        <!--             @if(session()->has('success'))
                    <div class="alert alert-success">
                        {{ session()->get('success') }}
                    </div>
                    @endif
                    @if(session()->has('error'))
                    <div class="alert alert-danger">
                        {{ session()->get('error') }}
                    </div>
                    @endif -->
        <?php
        ?>
        <?php
        $name = Route::currentRouteName();
        ?>
        <div class="dashboard-window">
            <div class="sidebar">
                <div class="sidebar-inner <?php if (Request::is('message/*')) echo "message-sidebar-inner"; ?>">
                    <ul class="clinical-sidebar">
                        <li>
                            <a href="#">My Account</a>
                            <ul style="<?php if (Request::is('account/*')) echo "display:block"; ?>">
                                @php 
                                if(Auth::user()->role_id == 8){
                                $role = "community-managers";
                                } elseif(Auth::user()->role_id == 2){
                                $role = "physicians";
                                }elseif(Auth::user()->role_id == 3 || Auth::user()->role_id == 4){
                                $role = "patients";
                                }elseif(Auth::user()->role_id == 5 || Auth::user()->role_id == 6 || Auth::user()->role_id == 7){
                                $role = "sponsors";
                                }
                                @endphp
                                @if(@$role == "physicians"||@$role == "patients")
                                <li class ="{{ Route::currentRouteNamed('account.index') ? 'active' : '' }}">
                                    <a href="{{ route('account.index') }}">> My Clinical Trials</a>
                                </li>
                                @endif
                                <li class ="{{ Route::currentRouteNamed('account.personal.index')
                                                || (Request::is('account/personal/edit')) ? 'active' : '' }}">
                                    <a href="{{ route('account.personal.index') }}">> User Information</a>
                                </li>
                                @if(@$role == "patients")
                                <li class ="{{ Route::currentRouteNamed('account.patient.index')
                                                || (Request::is('account/patient/edit')) ? 'active' : '' }}">
                                    <a href="{{ route('account.patient.index') }}">> Patient Information</a>
                                </li>
                                @endif
                                @if(@$role == "physicians"||@$role == "sponsors")
                                <li class ="{{ Route::currentRouteNamed('account.professional.index') 
                                                || (Request::is('account/professional/edit'))? 'active' : '' }}">
                                    <a href="{{ route('account.professional.index') }}">> Professional Information</a>
                                </li>
                                @endif
                                @if(@$role == "sponsors")
                                <li class ="{{ Route::currentRouteNamed('account.payment.index') ? 'active' : '' }}">
                                    <a href="{{ route('account.payment.index') }}">> Payment Information</a>
                                </li>
                                @endif
                                @if(@$role== "sponsors" || @$role == "community-managers")
                                @if(isset(Auth::user()->stripe_id)  && !empty(Auth::user()->stripe_id))
                                <li class ="{{ Route::currentRouteNamed('account.transaction-history','all') ? 'active' : '' }}">
                                    <a href="{{ route('account.transaction-history','all') }}">> Transaction History</a>
                                </li>
                                @endif
                                @endif
                                @if(@$role == "physicians"||@$role == "patients")
                                <li class ="{{ Route::currentRouteNamed('account.charity.index') 
                                                || (Request::is('account/charity/edit'))? 'active' : '' }}">
                                    <a href="{{ route('account.charity.index') }}">> Non Profit Information</a>
                                </li>
                                @endif
                            </ul>
                        </li>
                        <li>
                            <a href="#">Find a Clinical Trial</a>
                            <ul style="<?php if (Request::is('clinical-trial/*')) echo "display:block"; ?>">
                                <li class ="{{ Route::currentRouteNamed('clinicalTrial.index') ||
                                                Request::is('clinical-trial/*')? 'active' : '' }}">
                                    <a href="{{ route('clinicalTrial.index')}}">> Clinical Trials</a>
                                </li>
                            </ul>
                        </li>
                        @if(@$role == "sponsors"||@$role == "community-managers")
                        <li>
                            <a href="#">Clinical Trial Management</a>
                            <ul style="<?php
                            if (Request::is('clinical-trial-manage/create-irb') ||
                                    Request::is('clinical-trial-manage/create-non-irb') ||
                                    Request::is('clinical-trial-manage/manage') ||
                                    Request::is('clinical-trial-manage/review/all') ||
                                    Request::is('clinical-trial-manage/review/1') ||
                                    Request::is('clinical-trial-manage/review/2') ||
                                    Request::is('clinical-trial-manage/review/3') ||
                                    Request::is('clinical-trial-manage/applicant-list/*') ||
                                    Request::is('clinical-trial-manage/clinical/*')
                            )
                                echo "display:block";
                            ?>">
                                @if($role == "sponsors"||$role == "community-managers")
                                <li class ="{{ Route::currentRouteNamed('clinicalTrialManage.create-irb')
                                                || (Request::is('clinical-trial-manage/create-non-irb')) ? 'active' : '' }}">
                                    <a href="{{ route('clinicalTrialManage.create-irb') }}">> Submit Clinical Trials</a>
                                </li>
                                <li class ="{{ Route::currentRouteNamed('clinicalTrialManage.manage') ||
                                                 (Request::is('clinical-trial-manage/applicant-list/*'))? 'active' : '' }}">
                                    <a href="{{ route('clinicalTrialManage.manage')}}">> Manage Clinical Trials</a>
                                </li>
                                @endif
                                @if($role == "community-managers")
                                <li class ="{{ Route::currentRouteNamed('clinicalTrialManage.review') || Route::currentRouteNamed('clinicalTrialManage.declined-trials') || Route::currentRouteNamed('clinicalTrialManage.approved-trials') || Route::currentRouteNamed('clinicalTrialManage.pending-trials') ||
                                    (Request::is('clinical-trial-manage/clinical/*'))? 'active' : '' }}">
                                    <a href="{{ route('clinicalTrialManage.review','all') }}">> Review & Approve Clinical Trials</a>
                                </li>                                  
                                @endif
                            </ul>
                        </li>
                        @endif
                        @if(@$role == "sponsors"|| @$role == "community-managers")
                        <li>
                            <a href="#">Clinical Trial Enrollment Management</a>
                            <ul style="<?php
                                if (Request::is('clinical-trial-manage/investigator') ||
                                        Request::is('clinical-trial-manage/review-applicants/all') ||
                                        Request::is('clinical-trial-manage/review-applicants/1') ||
                                        Request::is('clinical-trial-manage/review-applicants/2') ||
                                        Request::is('clinical-trial-manage/review-applicants/3'))
                                    echo "display:block";
                                ?>">
                                @if(@$role == "sponsors"||@$role == "community-managers")
                                <li class ="{{ Route::currentRouteNamed('clinicalTrialManage.review-applicants') ? 'active' : '' }}">
                                    <a href="{{ route('clinicalTrialManage.review-applicants','all')}}">> Review & Approve Applicants</a>
                                </li>
                                @endif
                                @if(@$role == "community-managers")                               
                                <li class ="{{ Route::currentRouteNamed('clinicalTrialManage.investigator') ? 'active' : '' }}">
                                    <a href="{{ route('clinicalTrialManage.investigator')}}">> Review & Approve <br>Sub-Investigator Applications</a>
                                </li>
                                @endif
                            </ul>
                        </li>
                        @endif
                        @if(@$role == "sponsors"||@$role == "community-managers")    
                        <li><a href="#">Clinical Trial Retention Management</a>
                            <ul style="<?php if (Request::is('clinical-trial-retention/*')) echo "display:block"; ?>">
                                <li class ="{{ Route::currentRouteNamed('clinicalTrialRetention.enrolled') 
                                                 || (Request::is('clinical-trial-retention/research-site/*'))
                                                 || (Request::is('clinical-trial-retention/trial-visit-number/*')) ? 'active' : '' }}">
                                    <a href="{{ route('clinicalTrialRetention.enrolled')}}">> Manage Enrolled Clinical Trials</a>
                                </li>
                                <li class ="{{ Route::currentRouteNamed('clinicalTrialRetention.trial-visit')
                                                || (Request::is('clinical-trial-retention/trial-visit-edit/*')) ? 'active' : '' }}">
                                    <a href="{{ route('clinicalTrialRetention.trial-visit')}}">> Manage Clinical Trial Visits</a>
                                </li>
                                <li class ="{{ Route::currentRouteNamed('clinicalTrialRetention.patient-visit') ? 'active' : '' }}">
                                    <a href="{{ route('clinicalTrialRetention.patient-visit')}}">> Patient Visit Management</a>
                                </li>
                            </ul>
                        </li>
                        @endif
                        <li>
                            <a href="#">Message Center</a>
                            <ul style="<?php if (Request::is('message/*')) echo "display:block"; ?>">
                                <li class ="{{ Route::currentRouteNamed('message.inbox') ? 'active' : '' }}">
                                    <a href="{{ route('message.inbox')}}">> All Recent</a>
                                </li>
                                <li class ="{{ Route::currentRouteNamed('message.unread') ? 'active' : '' }}">
                                    <a href="{{ route('message.unread')}}">> Unread</a>
                                </li>
                                <li class ="{{ Route::currentRouteNamed('message.trash') ? 'active' : '' }}">
                                    <a href="{{ route('message.trash')}}">> Trash</a>
                                </li>
                            </ul>
                        </li>
                    </ul>
                                <?php if (Request::is('message/*')) { ?>
                        <div class="message-sidebar  d-none d-md-block">
                            <div class="people-message" style="margin-top:30px">
                                <h3>People</h3>
                                <div class="user-messages">
                                    <?php
                                    $conversations = App\Conversation::orWhere('from', auth()->id())
                                                    ->orWhere('to', auth()->id())->get();
                                    ?>
                                    @foreach(@$conversations as $conversation)
    <?php
    if ($conversation->from == auth()->id()) {
        $user = $conversation->toUser;
    } else {
        $user = $conversation->fromUser;
    }
    ?>
                                    <div class="user-messages-inner">
                                        <div class="user-mes-img">
                                            @if(!empty($user->profile->image))              
                                            <img src="{{ url('storage/profile-image/'.$user->profile->image)}}"/>
                                            @else              
                                            <img src="{{ asset('images/default-user.jpg')}}"> 
                                            @endif
                                        </div>
                                        <div class="user-mes-txt">
                                            <a href="{{route('message.chat',$user->id)}}"><h4>{{$user->firstname}} {{$user->lastname}}</h4></a>
                                            <p></p>
                                        </div>
                                    </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
<?php } ?>
                    <div class="log-out">
                        <a href="{{ route('logout') }}"
                           onclick="event.preventDefault();
    document.getElementById('logout-form').submit();">
                            <img src="{{ asset('images/log-out.png')}}">
                            {{ __('Logout') }}
                        </a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                    </div>
                </div>
            </div>
            @yield('content')
        </div>
        @else
        @yield('content')
        @endauth
    </div>

    <!-- Scripts -->
    <script src="https://code.jquery.com/jquery-3.4.1.js" integrity="sha256-WpOohJOqMqqyKL9FccASB9O0KwACQJpFTUBLTYOVvVU=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js" ></script>
    <script type="text/javascript">
$(document).ready(function () {
    $(".sidebar-inner > ul > li > a").click(function () {
        if ($(this).next(".sidebar-inner > ul > li ul:visible").length == 1) {
            $(".sidebar-inner > ul > li ul").slideUp();
        } else {
            $(".sidebar-inner > ul > li ul").slideUp();
            $(this).next(".sidebar-inner > ul > li ul").slideToggle();
        }
    });

    $(".toggle-button").click(function () {
        $("body").toggleClass("mobile-sidebar-slide");
    });

    $(".slide-overlay").click(function () {
        $("body").removeClass("mobile-sidebar-slide");
    });
});
    </script>
    <script>
        $('.list-item').css('display', 'none');
        $(".list-item").slice(0, 10).show();
        if ($(".list-item").length < 10) {
            $("#ViewMoreListItem").hide();
        }
        $("#ViewMoreListItem").on('click', function (e) {
            e.preventDefault();
            $(".list-item:hidden").slice(0, 3).slideDown();
            if ($(".list-item:hidden").length === 0) {
                $("#ViewMoreListItem").fadeOut('slow');
            }
            // $('.tooltip.tooltip-main.top').addClass('in');
        });
    </script>
    <script src="https://unpkg.com/axios/dist/axios.min.js"></script>
    <script src="https://js.stripe.com/v3/"></script>
    <script>
        window.addEventListener('load', function () {
            const stripe = Stripe('{{env('STRIPE_KEY')}}');
            const elements = stripe.elements();
            const cardElement = elements.create('card');
            cardElement.mount('#card-element');
            const cardHolderName = document.getElementById('card-holder-name');
            const cardButton = document.getElementById('card-button');
            const clientSecret = cardButton.dataset.secret;
            const plan = document.getElementById('subscription-plan').value;
            cardButton.addEventListener('click', async (e) => {
                const {setupIntent, error} = await stripe.handleCardSetup(
                        clientSecret, cardElement, {
                            payment_method_data: {
                                billing_details: {name: cardHolderName.value}
                            }
                        }
                );
                if (error) {
                    // Display "error.message" to the user...
                } else {
                    // The card has been verified successfully...
                    console.log('handling success', setupIntent.payment_method);
                    axios.post('https://www.clinicalmatch.com/subscribe', {
                        payment_method: setupIntent.payment_method,
                        plan: plan
                    }).then((data) => {
                        // location.replace(data.data.success_url)
                    });
                }
            });
        })
    </script>
    @yield('scripts')
</body>
</html>
