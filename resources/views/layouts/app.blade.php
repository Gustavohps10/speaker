<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" href="{{ asset('images/icon.ico') }}" type="image/x-icon">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
    <nav class="navbar navbar-dark" style="background: #070707">
        <div class="container-fluid">
            <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasNavbar" aria-controls="offcanvasNavbar">
                <span class="navbar-toggler-icon"></span>
            </button>
            <a href={{ route("home")}}><img src={{asset('images/white-logo-small.png')}} alt="" style="height: 50px"></a>
            <div class="offcanvas offcanvas-start" data-bs-scroll="true" tabindex="-1" id="offcanvasNavbar" aria-labelledby="offcanvasNavbarLabel">
                <div class="offcanvas-header">
                    <a href={{ route("home")}}><img style="height: 45px" src={{asset('images/white-logo-small.png')}} alt=""></a>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                </div>
                <div class="offcanvas-body">
                    <ul class="navbar-nav ms-auto">
                        <!-- Authentication Links -->
                        @guest
                            @if (Route::has('login'))
                                <li class="nav-item">
                                    <a class="nav-link d-flex align-items-center" href="{{ route('login') }}"><i class="bi bi-door-open fs-4 me-2"></i> {{ __('Login') }}</a>
                                </li>
                            @endif

                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link d-flex align-items-center" href="{{ route('register') }}"><i class="bi bi-person fs-4 me-2"></i> {{ __('Register') }}</a>
                                </li>
                            @endif
                        @else
                            <hr class="text-gray">
                            <li class="nav-item">
                                <form method="get" action="{{route('home.search')}}">
                                    <label for="search"><i class="bi bi-search"></i> Buscar</label> 
                                    <br>
                                    <input class="form-control" type="search" placeholder="Search" aria-label="Search" id="search" name="str" value='@if(!empty($str)){{$str}}@endif'>
                                    <button class="mt-2 btn btn-outline-purple" type="submit">Buscar</button>
                                </form>
                            </li>

                            <hr class="text-gray">
                            <h1 class="fs-6"><i class="bi bi-person-circle"></i> Conta</h1 class="fs-6">
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link d-flex align-items-center dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }}
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                            <hr class="text-gray">
                            <h1 class="fs-6"><i class="bi bi-house"></i> Home</h1 class="fs-6">

                            <li class="nav-item">
                                <a class="nav-link d-flex align-items-center" href="{{ route('sound.index') }}"><img src={{asset('images/icon-lib.svg')}} alt=""> Biblioteca</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link d-flex align-items-center " href="{{ route('sound.create') }}"><i class="bi bi-cloud-arrow-up fs-4 me-2"></i> Upload</a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('playlist.create') }}" class="nav-link d-flex align-items-center "><i class="bi bi-plus-square fs-4 me-2"></i> Playlist</a>
                            </li>
                            <li class="nav-item">
                                <a href="#" class="nav-link d-flex align-items-center "><i class="bi bi-heart fs-4 me-2"></i> Favoritos</a>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </div>
    </nav>

    <main class="py-5">
        @yield('content')
    </main>
    <footer class="bg-dark text-center text-white">   
        <div class="container p-4">
            <section class="mb-4">
                <a class="btn btn-outline-white m-1" href="#!" type="button">
                    <i class="bi bi-facebook"></i>
                </a>
                <a class="btn btn-outline-white m-1" href="#!" type="button">
                    <i class="bi bi-twitter"></i>
                </a>
                <a class="btn btn-outline-white m-1" href="#!" type="button">
                    <i class="bi bi-google"></i>
                </a>
                <a class="btn btn-outline-white m-1" href="#!" type="button">
                    <i class="bi bi-instagram"></i>
                </a>
                <a class="btn btn-outline-white m-1" href="#!" type="button">
                    <i class="bi bi-linkedin"></i>
                </a>
                <a class="btn btn-outline-white m-1" href="#!" type="button">
                    <i class="bi bi-github"></i>
                </a>
            </section>

            <section class="">
                <form action="#">

                <div class="row d-flex justify-content-center">

                    <div class="col-auto">
                    <p class="pt-2">
                        <strong>Sign up for our newsletter</strong>
                    </p>
                    </div>
    

                    <div class="col-md-5 col-12">

                    <div class="form-outline form-white mb-4">
                        <input type="email" id="form5Example21" class="form-control" />
                        <label class="form-label" for="form5Example21">Email address</label>
                    </div>
                    </div>

                    <div class="col-auto">

                    <button type="submit" class="btn btn-outline-purple mb-4">
                        Subscribe
                    </button>
                    </div>

                </div>
                </form>
            </section>

            <section class="mb-4">
                <p>
                Lorem ipsum dolor sit amet consectetur adipisicing elit. Sunt distinctio earum
                repellat quaerat voluptatibus placeat nam, commodi optio pariatur est quia magnam
                eum harum corrupti dicta, aliquam sequi voluptate quas.
                </p>
            </section>

            <section class="">

                <div class="row">

                <div class="col-lg-3 col-md-6 mb-4 mb-md-0">
                    <h5 class="text-uppercase">Links</h5>
        
                    <ul class="list-unstyled mb-0">
                    <li>
                        <a href="#!" class="text-white">Link 1</a>
                    </li>
                    <li>
                        <a href="#!" class="text-white">Link 2</a>
                    </li>
                    <li>
                        <a href="#!" class="text-white">Link 3</a>
                    </li>
                    <li>
                        <a href="#!" class="text-white">Link 4</a>
                    </li>
                    </ul>
                </div>

                <div class="col-lg-3 col-md-6 mb-4 mb-md-0">
                    <h5 class="text-uppercase">Links</h5>
        
                    <ul class="list-unstyled mb-0">
                    <li>
                        <a href="#!" class="text-white">Link 1</a>
                    </li>
                    <li>
                        <a href="#!" class="text-white">Link 2</a>
                    </li>
                    <li>
                        <a href="#!" class="text-white">Link 3</a>
                    </li>
                    <li>
                        <a href="#!" class="text-white">Link 4</a>
                    </li>
                    </ul>
                </div>

                <div class="col-lg-3 col-md-6 mb-4 mb-md-0">
                    <h5 class="text-uppercase">Links</h5>
        
                    <ul class="list-unstyled mb-0">
                    <li>
                        <a href="#!" class="text-white">Link 1</a>
                    </li>
                    <li>
                        <a href="#!" class="text-white">Link 2</a>
                    </li>
                    <li>
                        <a href="#!" class="text-white">Link 3</a>
                    </li>
                    <li>
                        <a href="#!" class="text-white">Link 4</a>
                    </li>
                    </ul>
                </div>

                <div class="col-lg-3 col-md-6 mb-4 mb-md-0">
                    <h5 class="text-uppercase">Links</h5>
        
                    <ul class="list-unstyled mb-0">
                    <li>
                        <a href="#!" class="text-white">Link 1</a>
                    </li>
                    <li>
                        <a href="#!" class="text-white">Link 2</a>
                    </li>
                    <li>
                        <a href="#!" class="text-white">Link 3</a>
                    </li>
                    <li>
                        <a href="#!" class="text-white">Link 4</a>
                    </li>
                    </ul>
                </div>
                </div>
            </section>
        </div>
        <div class="text-center p-3" style="background-color: rgba(0, 0, 0, 0.2);">
        © {{date('Y')}} Copyright:
        <a class="text-white" href="#">Gustavo Henrique</a>
        </div>
    </footer>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script src="{{ asset('js/app.js') }}"></script>
    @yield('scripts')
</body>
</html>
