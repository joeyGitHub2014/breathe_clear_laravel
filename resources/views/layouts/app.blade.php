<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'BreatheClear') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Krona+One&family=Reggae+One&display=swap" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Jura:wght@500&family=Krona+One&family=Reggae+One&display=swap" rel="stylesheet">
    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/styles.css') }}" rel="stylesheet">

</head>

<body class="py-5">
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light   shadow-sm fixed-top ">
            <a class="navbar-brand" href="{{ url('/') }}">
                {{ config('app.name', 'BreatheClear') }}
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <!-- Left Side Of Navbar -->
                @auth
                <ul class="navbar-nav ml-auto  ">

                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('listPatients') }} ">{{ __('List Patients') }}</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('addPatient') }}  ">{{ __('Add New Patient') }}</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('showAllergens') }}">{{ __('Allergens') }}</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('showAllergensStats') }}">{{ __('Stats') }}</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('showUsers') }}">{{ __('Users') }}</a>
                    </li>
                </ul>
                <form action="/patient/show" method="GET"class="form-inline my-2 my-lg-0 ml-auto">
                    <input class="form-control mr-sm-2" name="search" type="search" placeholder="Last Name / Chart#" aria-label="Search">
                    <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
                </form>
                @endauth

                <!-- Right Side Of Navbar -->
                <ul class="navbar-nav mr-auto">
                    <!-- Authentication Links -->
                    @guest
                    @if (Route::has('login'))
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                    </li>
                    @endif

                    @if (Route::has('register'))
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                    </li>
                    @endif
                    @if (Route::has('contact'))
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('contact') }}">{{ __('Contact') }}</a>
                    </li>
                    @endif
                    @else

                    <li class="nav-item dropdown">
                        <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                            {{ Auth::user()->name }}
                        </a>

                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                {{ __('Logout') }}
                            </a>
                            <a class="dropdown-item" href="{{ route('userProfile')}}">
                                {{ __('Profile') }}
                            </a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                @csrf
                            </form>
                        </div>
                    </li>
                    @endguest
                </ul>
            </div>
        </nav>
        <main class="py-5">
            <div class="container">
                <div class="row justify-content-center pb-3"><img src="/images/breatheclear_logo.jpg" /> </div>
            </div>
            @if ($errors->any())
                <div class="container pt-3">
                    <div class="row alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            @endif
            @if(session()->has('message'))
                <div class="container pt-3">
                    <div class="alert alert-success">
                        {{ session()->get('message') }}
                    </div>
                </div>
            @endif
            @yield('content')
        </main>
    </div>
</body>

</html>