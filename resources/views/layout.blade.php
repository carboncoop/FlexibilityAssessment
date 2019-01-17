<!doctype html>
<html class=""  lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="x-ua-compatible" content="ie=edge">
        <title>Flexibility assessment - @yield('title')</title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <!-- Place favicon.ico in the root directory -->

        <link rel="stylesheet" href="{{asset('css/style.css')}}">
        <link rel="stylesheet" href="{{asset('css/app.css')}}">
    </head>
    <body>
        <div id="nav-bar">
            <img class="logo" src="{{asset('img/carboncoop-logo.png')}}" />
            <p class="menu-text"><a href="/">Flexibility Home Assessment</a></p>
            <p class="menu-navigation"><a href="/assessment">Assessments</a></p>          
        </div>
        <div id="page">
            <div id="content" class='container'>
                @yield('content')
            </div>
        </div>
        <div id="footer">
            <a href="https://carbon.coop/" target="blank"><img class="carboncoop" src="{{asset('img/carboncoop-logo.png')}}" /></a>
            <a href="http://www.communityenergyscotland.org.uk/" target="blank"><img class="community-energy-scotland" src="{{asset('img/community-energy-scotland-logo.png')}}" /></a>
            <a href="http://southseeds.org/" target="blank"><img class="south-seeds-logo" src="{{asset('img/south-seeds-logo.png')}}" /></a>
        </div>

    </body>

    <script src="{{asset('js/app.js')}}"></script>

</html>