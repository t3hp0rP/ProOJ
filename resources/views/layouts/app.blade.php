<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'ProOJ') }}</title>

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/addition.css') }}" rel="stylesheet">
    <style>
        .menu{
            color: #636b6f;
            padding: 0 25px;
            font-size: 14px;
            font-weight: 600;
            letter-spacing: .1rem;
            text-decoration: none;
            /*text-transform: uppercase;*/
        }
        .menu:hover{
            text-decoration: none;
            animation: linkHover 1s;
            -moz-animation: linkHover 1s;	/* Firefox */
            -webkit-animation: linkHover 1s;	/* Safari 和 Chrome */
            -o-animation: linkHover 1s;	/* Opera */
        }

        @keyframes linkHover{
            from{color: #636b6f}
            to{color: #14b0d5}
        }

        @-moz-keyframes linkHover{
            from{color: #636b6f}
            to{color: #14b0d5}
        }

        @-webkit-keyframes linkHover{
            from{color: #636b6f}
            to{color: #14b0d5}
        }

        @-o-keyframes linkHover{
            from{color: #636b6f}
            to{color: #14b0d5}
        }

        .part{
            width: 100%;
            height:100%;
            padding:0;
            display: block;
            font-weight:100;
        }

        .add-bottom-margin{
            margin-bottom:20px;
        }

        .score{
            font-size: 30px;
        }
    </style>
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-default navbar-static-top">
            <div class="container">
                <div class="navbar-header">

                    <!-- Collapsed Hamburger -->
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse">
                        <span class="sr-only">Toggle Navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>

                    <!-- Branding Image -->
                    <a class="navbar-brand" href="{{ url('/') }}">
                        {{ config('app.name', 'ProOJ') }}
                    </a>
                </div>

                <div class="collapse navbar-collapse" id="app-navbar-collapse">
                    <!-- Left Side Of Navbar -->
                    <ul class="nav navbar-nav">
                        &nbsp;
                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="nav navbar-nav navbar-right">
                        <!-- Authentication Links -->
                        @if (Auth::guest())
                            <li><a class="menu" href="{{ route('login') }}">Login</a></li>
                            <li><a class="menu" href="{{ route('register') }}">Register</a></li>
                        @else
                            <li><a href="{{ route('home') }}" class="menu">Home</a></li>
                            <li><a href="{{ url('rank') }}" class="menu">Rank</a></li>
                            <li><span class="navbar-text">Point:{{ \App\Point::getPoint(Auth::id()) }}</span></li>
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                    {{ Auth::user()->name }} <span class="caret"></span>
                                </a>

                                <ul class="dropdown-menu" role="menu">
                                    <li>
                                        <a class="menu" href="{{ route('user') }}">UserCenter</a>
                                        <a class="menu" href="{{ route('logout') }}"
                                            onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                            Logout
                                        </a>

                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                            {{ csrf_field() }}
                                        </form>
                                    </li>
                                </ul>
                            </li>
                        @endif
                    </ul>
                </div>
            </div>
        </nav>

        @yield('content')
    </div>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}"></script>
    <script src="{{ asset('js/addition.js') }}"></script>
</body>
</html>