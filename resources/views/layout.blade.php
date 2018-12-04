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
        <script src="{{asset('js/app.js')}}"></script>
    </head>
    <body>
        <div id="nav-bar">
            <img class="logo" src="{{asset('img/carboncoop-logo.png')}}" />
            <p class="menu-text">Flexibility Home Assessment</p>
            <a href="/assessment">Assessments</a>          
        </div>
        <div id="page">
            <div id="content" class='container'>
                @yield('content')
            </div>
        </div>
        <div id="footer">
            <img class="carboncoop" src="{{asset('img/carboncoop-logo.png')}}" />
            <img class="community-energy-scotland" src="{{asset('img/community-energy-scotland-logo.png')}}" />
            <img class="south-seeds-logo" src="{{asset('img/south-seeds-logo.png')}}" />
        </div>

    </body>

    <script>
    </script>

</html>