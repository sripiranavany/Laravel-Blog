<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>
    <link href="https://stackpath.bootstrapcdn.com/bootswatch/4.4.1/flatly/bootstrap.min.css" rel="stylesheet" integrity="sha384-yrfSO0DBjS56u5M+SjWTyAHujrkiYVtRYh2dtB3yLQtUz3bodOeialO59u5lUCFF" crossorigin="anonymous">

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
    <div id="app">

        <nav class="navbar navbar-expand-lg navbar-dark bg-primary">

        <a class="navbar-brand" href="{{ url('/') }}">LaraBlog</a>

        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarColor01" aria-controls="navbarColor01" aria-expanded="false" aria-label="Toggle navigation">

            <span class="navbar-toggler-icon"></span>

        </button>



        <div class="collapse navbar-collapse" id="navbarColor01">

            <ul class="navbar-nav ml-auto">

                <li class="nav-item active">

                    <a class="nav-link" href="{{ url('/') }}">Home <span class="sr-only">(current)</span></a>

                </li>

                <li class="nav-item">

                    <a class="nav-link" href="#">About</a>

                </li>

                <li class="nav-item">

                    <a class="nav-link" href="{{ route('article.index') }}">Blog</a>

                </li>

                <li class="nav-item">

                    <a class="nav-link" href="{{ route('category.index') }}">Category</a>

                </li>

                @guest

                    <li class="nav-item">

                        <a class="nav-link" href="{{ route('register') }}">Register</a>

                    </li>

                    <li class="nav-item">

                        <a class="nav-link" href="{{ route('login') }}">Login</a>

                    </li>

                @else

                    <li class="nav-item">

                        <a class="nav-link" href="{{ route('article.create') }}">Create New Post</a>

                    </li>

                    <li class="nav-item">

                        <a class="nav-link" href="{{ route('category.create') }}">Create New Category</a>

                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('logout') }}"
                            onclick="event.preventDefault();
                                            document.getElementById('logout-form').submit();">
                            {{ __('Logout') }}
                        </a>

                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>

                    </li>

                @endguest

            </ul>

        </div>

    </nav>
    @if(Session::get('message'))
        {{Session::get('message')}}
    @endif
        <main class="py-4">
            @yield('content')
        </main>
    </div>
</body>
</html>
