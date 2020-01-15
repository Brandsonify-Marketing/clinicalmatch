<header class="wow fadeInDown">
    <div class="container">
        <div class="row justify-content-center justify-content-md-between align-items-center align-items-md-end">
            <div class="col-auto logo">
                <a href="{{ route('landing-page') }}">
                <img src="{{ url('/storage').'/'.setting('site.logo') }}" alt="logo">
                </a>
            </div>
            <div class="col-auto navigation-main">
                <nav class="navbar navbar-expand-md navbar-light">
                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                        <span></span>
                        <span></span>
                        <span></span>
                    </button>
                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <ul class="navbar-nav mr-auto align-items-center">
                            {{ menu('Header menu','partials.main_nav') }}
                            <li class="nav-item h-login">
                                    @guest
                                            <a class="nav-link" href="{{ route('login') }}">SIGNUP/IN</a>
                                    @if (Route::has('register'))
                                                {{-- <a class="nav-link" href="{{ route('register') }}">SIGNUP/IN</a> --}}
                                    @endif
                                </li>
                            @else
                                <li class="nav-item dropdown username_drop h-login">
                                    <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                        {{ Auth::user()->firstname }} <span class="caret"></span>
                                    </a>                  
                                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">     
                                    @if (!empty(Auth::user()->role_id))
                                    <a class="dropdown-item" href="{{ route('account.personal.index') }}">
                                            Profile
                                        </a>
                                    @endif
                                        <a class="dropdown-item" href="{{ route('logout') }}"
                                           onclick="event.preventDefault();
                                                         document.getElementById('logout-form').submit();">
                                            {{ __('Logout') }}
                                        </a>

                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                            @csrf
                                        </form>
                                    </div>
                                </li>
                            @endguest
                        </ul>
                    </div>
                </nav>
            </div>
        </div>
    </div>
</header>
