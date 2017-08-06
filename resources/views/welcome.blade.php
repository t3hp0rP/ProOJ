<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>ProOJ</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">

        <!-- Styles -->
        <style>
            html, body {
                background-color: #fff;
                color: #636b6f;
                font-family: 'Raleway', sans-serif;
                font-weight: 100;
                height: 100vh;
                margin: 0;
            }

            .full-height {
                height: 100vh;
            }

            .flex-center {
                align-items: center;
                display: flex;
                justify-content: center;
            }

            .position-ref {
                position: relative;
            }

            .top-right {
                position: absolute;
                right: 10px;
                top: 18px;
            }

            .content {
                text-align: center;
            }

            .title {
                font-size: 84px;
            }

            .links > a {
                color: #636b6f;
                padding: 0 25px;
                font-size: 12px;
                font-weight: 600;
                letter-spacing: .1rem;
                text-decoration: none;
                text-transform: uppercase;
            }

            .links > a:hover{
                animation: linkHover 1s;
                -moz-animation: linkHover 1s;	/* Firefox */
                -webkit-animation: linkHover 1s;	/* Safari 和 Chrome */
                -o-animation: linkHover 1s;	/* Opera */
            }

            @keyframes linkHover{
                from{color: #636b6f}
                to{color: #31b0d5}
            }

            @-moz-keyframes linkHover{
                from{color: #636b6f}
                to{color: #31b0d5}
            }

            @-webkit-keyframes linkHover{
                from{color: #636b6f}
                to{color: #31b0d5}
            }

            @-o-keyframes linkHover{
                from{color: #636b6f}
                to{color: #31b0d5}
            }

            .m-b-md {
                margin-bottom: 30px;
            }
        </style>
    </head>
    <body>
        <div class="flex-center position-ref full-height">
            @if (Route::has('login'))
                <div class="top-right links">
                    @if (Auth::check())
                        <a href="{{ url('/home') }}">Home</a>
                    @else
                        <a href="{{ url('/login') }}">Login</a>
                        <a href="{{ url('/register') }}">Register</a>
                    @endif
                </div>
            @endif

            <div class="content">
                <div class="title m-b-md">
                    ProOJ
                </div>

                <div class="links">
                    <p>感谢!</p>
                    <p>基于Laravel框架快速开发</p>
                    <p style="margin-left: 350px;">--一只还在萌新线挣扎的Pr0ph3t 2017.7.12</p>
                </div>
                <div class="links">
                    <a href="https://Pr0ph3t.com">MyBlog</a>
                </div>

            </div>
        </div>
    </body>
</html>
