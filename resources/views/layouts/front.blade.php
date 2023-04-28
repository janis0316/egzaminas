@inject('cart', 'App\Services\CartService')
<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    {{-- <title>{{ config('app.name', 'Laravel') }}</title> --}}
    <title>Travel</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inria+Sans:wght@300;400&family=Sarpanch:wght@400;900&display=swap" rel="stylesheet">

    <!-- Scripts -->
    @vite(['resources/sass/front/app.scss', 'resources/js/front/app.js'])
    {{-- <style>
        body {
    background-image: url("{{asset('bg2.jpg')}}");
    top: 0;
    left: 0;
    /* Preserve aspet ratio */
    min-width: 100%;
    min-height: 100%;
    }
    </style> --}}


    {{-- <div class="bg">
        <img src="{{asset('bg3.jpg')}}" alt="">
    </div> --}}

</head>
<body>

    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    {{-- <img class="logo" src="{{asset('img/logo.jpg')}}" alt="logo"> --}}
                    <img class="logo" src="{{asset('logo.png')}}" alt="logo" style="height: 45px; width: auto">
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">


                    <!-- Right Side Of Navbar -->
                    <ul class=" navbar-nav ms-auto">


                        @if(Auth::user()?->role == 'admin')
                        <li class=" nav-item dropdown">
                            <a style="margin-top:13px" id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                Maitinimo įstaigos
                            </a>
                            <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="{{ route('places-index') }}">Maitinimo įstaigų sąrašas</a>
                                @if(Auth::user()?->role == 'admin')
                                <a class="dropdown-item" href="{{ route('places-create') }}">Nauja matinimo įstaiga</a>
                                @endif
                            </div>
                        </li>
                        <li class="nav-item dropdown">
                            <a style="margin-top:13px" id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>

                                Valgiaraščiai
                            </a>
                            <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="{{ route('menus-index') }}">Valgiaraščių sąrašas</a>
                                @if(Auth::user()?->role == 'admin')
                                <a class="dropdown-item" href="{{ route('menus-create') }}">Naujas Valgiaraštis</a>
                                @endif
                            </div>
                        </li>

                        <li class="nav-item dropdown">
                            <a style="margin-top:13px" id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>

                                Patiekalai
                            </a>
                            <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="{{ route('dishes-index') }}">Patiekalų sąrašas</a>
                                @if(Auth::user()?->role == 'admin')
                                <a class="dropdown-item" href="{{ route('dishes-create') }}">Naujas Patiekalas</a>
                                @endif
                            </div>
                        </li>


                        <li class="nav-item dropdown">
                            <a style="margin-top:13px" id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>

                                Užsakymai
                            </a>
                            <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="{{ route('orders-index') }}">Užsakymų sąrašas</a>
                            </div>
                        </li>

                        <li class="nav-item dropdown">
                            <a style="margin-top:13px" id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>

                                Vartotojų patiekalai
                            </a>
                            <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="{{ url('/') }}">Vartotojų patiekalai</a>
                            </div>
                        </li>

                        @endif


                        <!-- Authentication Links -->
                        @guest
                        @if (Route::has('login'))
                        <li class="nav-item">
                            <a style="margin-top:13px" class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>

                        </li>
                        @endif

                        @if (Route::has('register'))
                        <li class="nav-item">
                            <a style="margin-top:13px" class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>

                        </li>
                        @endif
                        @else





                        {{-- Cart --}}
                        <li class="nav-item dropdown">
                            <a id="cartDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                <div class="cart-svg">
                                    <svg class="cart">
                                        <use xlink:href="#cart"></use>
                                    </svg>
                                    <span class="count">{{$cart->count}}</span>
                                    <span>{{$cart->total}} Eur </span>
                                </div>
                            </a>
                            <a href="{{route('cart')}}" class="dropdown-menu dropdown-menu-end" aria-labelledby="cartDropdown">
                                @forelse($cart->list as $product)
                                <div class="dropdown-item">
                                    {{$product->title}}
                                    <b>|</b> {{$product->count}} x
                                    {{$product->sum}} Eur
                                </div>
                                @empty
                                <span class="dropdown-item">Tuščia</span>
                                @endforelse
                            </a>
                        </li>

                        {{-- Logged user --}}
                        <li class="nav-item dropdown">
                            <a style="margin-top:13px" id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>

                                {{ Auth::user()->name }}
                            </a>

                            <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                    {{ __('Logout') }}
                                </a>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                    @csrf
                                </form>
                            </div>
                        </li>

                        @endguest

                    </ul>
                </div>
            </div>
        </nav>
        <main class="py-4">
            @yield('content')
        </main>
    </div>
    @include('layouts.svg')
</body>
</html>
