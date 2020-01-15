    <header><meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        <div class="row no-gutters justify-content-center justify-content-between align-items-center align-items-md-end">
          <div class="col-auto col-lg-auto text-center logo">
            <a href="{{ route('landing-page') }}">
              <img src="{{ url('/storage').'/'.setting('site.logo') }}" alt="logo">
            </a>
          </div>
          <div class="col col-lg-auto header-right">
            <ul class="p-0 m-0 d-flex align-items-center justify-content-lg-end">
<!--               <li>
                <a href="{{ route('message.unread')}}">
                  <span><i class="fa fa-envelope" aria-hidden="true"></i></span>
                </a>
              </li>
              <li>
                <a href="{{ route('message.inbox')}}">
                  <span><i class="fa fa-bell" aria-hidden="true"></i></span>
                </a>
              </li> -->
              <li class="d-none d-lg-inline-block">
                <a href="#">
                  <div class="header-user">
                    <span>
                      @if(!empty(Auth::user()->profile->image))              
                      <img src="{{ url('storage/profile-image/'.Auth::user()->profile->image)}}"/>
                      @else              
                      <img src="{{ asset('images/default-user.jpg')}}"> 
                      @endif
                    </span>
                    <span class="dash-name">{{ Auth::user()->firstname }}</span>
                  </div>
                  </a>
                  <div class="dash-dropdown">
                    <span>
                    @if (!empty(Auth::user()->role_id))
                    <a class="dropdown-item" href="{{ route('account.personal.index') }}">Profile</a>
                    @else
                    @endif
                     <a class="dropdown-item" href="{{ route('logout') }}"
                               onclick="event.preventDefault();
                                             document.getElementById('logout-form').submit();">
                                {{ __('Logout') }}
                          </a>
                      <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                    </span>
                  </div>
                
              </li>
            </ul>
          </div>
          <div class="col col-lg-auto text-right d-lg-none header-menu">
            <div class="toggle-button d-inline-block">
              <span></span>
              <span></span>
              <span></span>
            </div>
          </div>
        </div>
    </header>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script type="text/javascript">
    $( ".dash-name" ).click(function() {
      $( ".dash-dropdown" ).slideToggle( "fast" );

    });
    </script>
