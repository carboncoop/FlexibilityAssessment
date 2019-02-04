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

            <b-navbar toggleable="md" type="dark" variant="primary">
                <b-navbar-toggle target="nav_collapse"></b-navbar-toggle>
                <b-navbar-brand href="#"><img class="logo" src="{{asset('img/carboncoop-logo.png')}}" /></b-navbar-brand>
                <b-collapse is-nav id="nav_collapse">
                    <b-navbar-nav>
                        <b-nav-item href="{{ url('/') }}">Flexibility Home Assessment</b-nav-item>
                    </b-navbar-nav>
                    <!-- Right aligned nav items -->
                    <b-navbar-nav class="ml-auto">
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
                    @yield('content')
                </div>
            </main>

            <div id="footer">
                <a href="https://carbon.coop/" target="blank"><img class="carboncoop" src="{{asset('img/carboncoop-logo.png')}}" /></a>
                <a href="http://www.communityenergyscotland.org.uk/" target="blank"><img class="community-energy-scotland" src="{{asset('img/community-energy-scotland-logo.png')}}" /></a>
                <a href="http://southseeds.org/" target="blank"><img class="south-seeds-logo" src="{{asset('img/south-seeds-logo.png')}}" /></a>
            </div>

        </div>

    </body>
    <script src="{{asset('js/app.js')}}"></script>
    @yield('script-below')

</html>