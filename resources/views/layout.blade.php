<!doctype html>
<html class=""  lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="x-ua-compatible" content="ie=edge">
        <title>Flexibility assessment - @yield('title')</title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <link rel="stylesheet" href="{{asset('css/app.css')}}">
        <link rel="stylesheet" href="{{asset('css/style.css')}}">

        @yield('style') 

        @yield('script-above')

    </head>
    <body>

        <div id="app" v-cloak>

            <b-navbar toggleable="md" type="dark" variant="primary" class="navbar-custom">

                <b-navbar-brand href="#">
                    Flexible Power
                    <p class="strapline">Flexibly using electricity to save money for users and make money for community groups</p>
                </b-navbar-brand>
                <b-navbar-toggle target="nav_collapse"></b-navbar-toggle>
                <b-collapse is-nav id="nav_collapse"> 
                    <!-- Right aligned nav items -->
                    <b-navbar-nav class="ml-auto">
                        <b-nav-item href="{{ url('/') }}">Home</b-nav-item>
                        @guest
                        <b-navbar-nav>
                            <b-nav-item id="login-link" href="{{ route('login') }}">{{ __('Login') }}</b-nav-item>
                            @if (Route::has('register'))
                            <b-nav-item href="{{ route('register') }}">{{ __('Register') }}</b-nav-item>
                            @endif
                        </b-navbar-nav>
                        @else
                        <!--- This if and following else are one level to the right -->
                        @if(Auth::user()->role != "administrator" )
                        <b-navbar-nav>
                            <b-nav-item href="/assessment">{{ __('Assessments') }}</b-nav-item>
                        </b-navbar-nav>
                        @else
                        <b-navbar-nav>
                            <b-nav-item href="/organisation-administrator-dashboard">{{ __('Dashboard') }}</b-nav-item>
                        </b-navbar-nav>
                        @endif
                        <!-- End of the if-else -->
                        <b-nav-item-dropdown id="user-name" text="{{ Auth::user()->name }}" right>
                            <b-dropdown-item href="{{ route('logout') }}" id="logout-link" onclick="event.preventDefault();document.getElementById('logout-form').submit();">{{ __('Logout') }}
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">@csrf</form>
                            </b-dropdown-item>
                        </b-nav-item-dropdown>
                        @endguest
                    </b-navbar-nav>
                </b-collapse>
            </b-navbar>



            <main id="page">
                <div id="content" class='container'>
                    @if(isset($sidemenu) && $sidemenu === true)
                    <div style="display: inline-block; width: 77%; vertical-align: top">
                        @yield('content')
                    </div>
                    @else
                    <div>
                        @yield('content')
                    </div>
                    @endif

                    @if(isset($sidemenu) && $sidemenu === true)
                    <div style="display: inline-block; width: 18%; vertical-align: top; margin:30px 15px">
                        <b-list-group>
                            <b-list-group-item><a href="/">Home</a></b-list-group-item>
                            <b-list-group-item><a href="more-about-the-project">About</a></b-list-group-item>
                            <b-list-group-item><a href="how-could-I-benefit-from-flexibility">Benefits for Users</a></b-list-group-item>
                            <b-list-group-item><a href="how-could-my-organisation-benefit-from-flexibility">Benefits for Organisations</a></b-list-group-item>
                            <b-list-group-item><a href="scotland-potential-flexibility-map">Where is the Flexibility?</a></b-list-group-item>
                            <b-list-group-item><a href="resources-for-community-organisations">Resources for organisations</a></b-list-group-item>
                            <b-list-group-item><a href="privacy-policy">Your Data and Privacy</a></b-list-group-item>
                        </b-list-group>
                    </div>
                    @endif
                </div>
        </div>
    </main>

    <div id="footer">
        <a href="https://carbon.coop/" target="blank"><img class="carboncoop" src="{{asset('img/carboncoop-logo.png')}}" /></a>
        <a href="http://www.communityenergyscotland.org.uk/" target="blank"><img class="community-energy-scotland" src="{{asset('img/community-energy-scotland-logo.png')}}" /></a>
        <a href="http://southseeds.org/" target="blank"><img class="south-seeds-logo" src="{{asset('img/south-seeds-logo.png')}}" /></a>
    </div>

</div>

@include('cookieConsent::index')
</body>
<script src="{{asset('js/app.js')}}"></script>
@yield('script-below')

</html>