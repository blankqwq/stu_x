<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ setting('site_name', 'stu系统') }}</title>
    <meta name="description" content="@yield('description', setting('seo_description', 'stu'))" />
    <meta name="keyword" content="@yield('keyword', setting('seo_keyword', 'stu'))" />
    <link rel="icon" href="@yield('icon', setting('site_icon', '/storage/uploads/images/default.ico'))" type="img/x-ico" />

    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <style>
        #side-index{
            border-top-color: #0b97c4;
            border-top-width: 4px;
            box-shadow: 0px 1px 11px 2px rgba(42, 42, 42, 0.1);
        }
        footer{
            position: absolute;
            bottom: 0;
            width: 100% ;
            /* Set the fixed height of the footer here */
            height: 60px;
            background-color: #000;


        }
        .container {
            padding-right: 15px;
            padding-left: 15px;

        }
        .container p {
            margin: 19px 0;
            color: #c1c1c1;
        }

        .container p a {
            color: inherit;
        }

    </style>
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-default navbar-static-top" id="side-index">
            <div class="container">
                <div class="navbar-header">

                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse" aria-expanded="false">
                        <span class="sr-only">Toggle Navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>

                    <!-- Branding Image -->
                    <a class="navbar-brand" href="{{ url('/') }}">
                        {{ setting('site_name', 'stu系统') }}
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
                        @guest
                            <li><a href="{{ route('login') }}">登录</a></li>
                            <li><a href="{{ route('register') }}">注册</a></li>
                        @else
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false" aria-haspopup="true" v-pre>
                                    {{ Auth::user()->name }} <span class="caret"></span>
                                </a>

                                <ul class="dropdown-menu">
                                    <li>
                                        <a href="{{ route('logout') }}"
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
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        @yield('content')
    </div>
    <footer>
        <div class="container">
            <p class="pull-left" style="line-height:60px;color: white;margin: 0; ">@blank</p>
            <p class="pull-right"style="line-height:60px;margin: 0; "><a href="mailto:{{ setting('contact_email') }}" >联系我们</a></p>
        </div>
    </footer>
    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}"></script>


</body>
</html>
