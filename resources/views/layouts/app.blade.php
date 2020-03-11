<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="css/main.css" rel="stylesheet">
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-default navbar-static-top">
            <div class="container">
                <div class="header-wrapper">
                    <div>
                        <a class="navbar-brand" href="{{ url('/') }}">
                            {{ config('app.name', 'Laravel') }}
                        </a>
                    </div>
                    @if (!Auth::guest())
                        <div>
                            <ul class="nav navbar-nav">
                                @if (Request::is('/'))
                                    <li class="active-link"><a href="{{ url('/') }}">Главная</a></li>
                                @else
                                    <li><a href="{{ url('/') }}">Главная</a></li>
                                @endif
                                @if (Request::is('list'))
                                    <li class="active-link"><a href="{{ url('/list') }}">Список</a></li>
                                @else
                                    <li><a href="{{ url('/list') }}">Список</a></li>
                                @endif
                                @if (Request::is('home'))
                                    <li class="active-link"><a href="{{ url('/home') }}">Личный кабинет</a></li>
                                @else
                                    <li><a href="{{ url('/home') }}">Личный кабинет</a></li>  
                                @endif
                            </ul>
                        </div>
                    @endif
                    <div>
                        <ul class="nav navbar-nav navbar-right">
                            <!-- Authentication Links -->
                            @if (Auth::guest())
                                <li><a href="{{ route('login') }}">Вход</a></li>
                                <li><a href="{{ route('register') }}">Регистрация</a></li>
                            @else
                                <li class="dropdown header-user-block">
                                    <div class="img-avatar-header">
                                        @if(is_file('storage/images/avatar_user_'.Auth::user()->id.'.jpg'))
                                            <img class="img-fluid" name="img_user" id="header_user_img" src='storage/images/avatar_user_{{ Auth::user()->id }}.jpg' />
                                        @else
                                            <img class="img-fluid" name="img_user" id="header_user_img" src="storage/images/default.jpg" />
                                        @endif
                                    </div>
                                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                        {{ Auth::user()->name }} <span class="caret"></span>
                                    </a>
        
                                    <ul class="dropdown-menu" role="menu">
                                        <li>
                                            <a href="{{ route('logout') }}"
                                                onclick="event.preventDefault();
                                                            document.getElementById('logout-form').submit();">
                                                Выход
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
            </div>
        </nav>

        @yield('content')
    </div>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}"></script>
    @yield('scripts')
</body>
</html>
