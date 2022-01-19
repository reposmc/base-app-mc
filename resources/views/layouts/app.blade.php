<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" dir="ltr">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    @yield('styles')

    <!-- Styles -->
    <link href="{{ mix('css/app.css') }}" rel="stylesheet">

    <!-- Favicon -->
    <link rel="icon" href="{{ asset('img/Favicon.png') }}">
</head>

<body>
    <div id="app">
        <div class="sidebar animate__faster animate__animated menu mt-0 fixed">
            <ul class="nav-links pt-0">
                <li class="text-center menu">
                    <i class="material-icons md-36 mx-auto menu mt-0 pt-0">menu</i>
                </li>
                @auth

                    <li class="text-center pb-1">
                        <a href="{{ url('/home') }}" class="text-center">
                            <i class="material-icons md-18 mx-auto">home</i>
                        </a>
                        <a href="{{ url('/home') }}">
                            <p class="link mx-auto">Inicio</p>
                        </a>
                    </li>

                    {{-- Administrative routes --}}
                    @if (auth()->user()->hasRole('Administrador') == 'Administrador')
                        <li class="text-center pb-1">
                            <a href="{{ url('/casas') }}" class="text-center">
                                <i class="material-icons md-18 mx-auto">group</i>
                            </a>
                            <a href="{{ url('/casas') }}" class="pb-3">
                                <p class="link mx-auto">Casas de la cultura</p>
                            </a>
                        </li>
                    @endif
                    {{-- End Administrative routes --}}

                    <li class="text-center pb-1">
                        <a href="{{ route('register') }}" class="text-center"
                            onclick="event.preventDefault();document.getElementById('logout-form').submit();">
                            <i class="material-icons md-18 mx-auto">logout</i>
                        </a>
                        <a href="{{ route('logout') }}"
                            onclick="event.preventDefault();document.getElementById('logout-form').submit();">
                            <p class="link mx-auto">Cerrar sesión</p>
                        </a>
                    </li>

                @endauth
                @guest
                    <li class="text-center pb-1">
                        <a href="{{ url('/login') }}" class="text-center">
                            <i class="material-icons md-18 mx-auto">login</i>
                        </a>
                        <a href="{{ url('/login') }}">
                            <p class="link mx-auto">Iniciar sesión</p>
                        </a>
                    </li>

                    @if (Route::has('register'))
                        <li class="text-center pb-1">
                            <a href="{{ url('/register') }}" class="text-center">
                                <i class="material-icons md-18 mx-auto">person_add_alt_1</i>
                            </a>
                            <a href="{{ url('/register') }}">
                                <p class="link mx-auto">Registrarse</p>
                            </a>
                        </li>
                    @endif
                @endguest
            </ul>
        </div>

        <div class="home-section">
            <div class="home-content pt-5 pb-5">
                <div class="container-fluid">
                    <div class="col-6 col-sm-12 col-md-12">
                        <div class="row">
                            @auth
                                <div class="col-6 col-md-1 menu pt-0">
                                    <div class="col-3 col-sm-3 menu">
                                        <i class="material-icons md-36 mx-auto menu color-secondary ">menu</i>
                                    </div>
                                </div>
                            @endauth
                            @guest
                                <div class="col-6 col-md-1 menu pt-0 d-block d-md-none d-lg-none d-xl-none">
                                    <div class="col-3 col-sm-3 menu mt-0 pt-0">
                                        <i class="material-icons md-36 mx-auto menu color-secondary">menu</i>
                                    </div>
                                </div>
                            @endguest

                            <div class=" col-sm-4 col-md-6 d-none d-md-block d-lg-block d-xl-block">
                                <div class="col-4 col-sm-12">
                                    <a class="navbar-brand" href="{{ url('/') }}">
                                        <h3 class="text-uppercase pt-4 fw-bold color-secondary mb-0">Casas de la cultura
                                        </h3>
                                    </a>
                                </div>
                            </div>
                            @guest
                                <div class="col-6 col-md-6 text-right d-none d-md-block d-lg-block d-xl-block">
                                    <div class="row mt-3 mb-1">
                                        <div class=" col-md-12 text-end">
                                            <a href="{{ url('/login') }}" class="btn btn-normal-nav">Iniciar sesión</a>
                                            <a href="{{ route('register') }}"
                                                class="btn btn-normal-secondary-nav">Registrarme</a>
                                        </div>

                                    </div>
                                </div>
                            @endguest

                            @auth
                                <div class="col-6 col-md-4 col-sm-4 d-none d-md-block d-lg-block d-xl-block">
                                    <div class="row d-none d-md-block">
                                        <div class="col-12 col-sm-12 col-md-12 pb-0 pt-4 mt-1 text-end">
                                            <span class="color-secondary" style="font-size: 16px;">
                                                {{ auth()->user()->name }}
                                            </span>
                                            <span class="color-primary"><i class="material-icons">person</i></span>
                                        </div>

                                        <div class="col-12 col-sm-12 col-md-12 pt-0 pb-0 text-end">
                                            <a href="{{ route('logout') }}" class="btn-logout"
                                                onclick="event.preventDefault();document.getElementById('logout-form').submit();">
                                                {{ __('Logout') }}
                                            </a>
                                            <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                                class="d-none">
                                                @csrf
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            @endauth
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <main class="main content py-4">
            @yield('content')
        </main>

        <!-- Footer -->
        <footer class="footer bg-gray mt-2">
            <div class="container">
                <div class="row">
                    <div class="col-12 col-xs-12 col-sm-12 text-center my-auto col-md-3">
                        <a class="mya my-auto privacy-policy-text" href="https://www.cultura.gob.sv" target="_blank">
                            Ministerio de cultura
                        </a>
                    </div>
                    <div class="col-12 col-xs-12 col-sm-12 text-center my-auto col-md-6 text-center">
                        <div class="mya">
                            <img class="logo-footer color-logo" src="/logos/Logo_GOES_horizontal_L.svg" />
                        </div>
                    </div>
                    <div class="col-12 col-xs-12 col-sm-12 text-center my-auto col-md-3">
                        <div class="mya privacy-policy-text">
                            Políticas de privacidad
                        </div>
                    </div>
                </div>
            </div>
        </footer>
        <!-- Footer -->

    </div>

    </div>
    <!-- Scripts -->
    <script src="{{ asset('js/sidebar.js') }}" defer></script>
    <script src="{{ mix('js/manifest.js') }}"></script>
    <script src="{{ mix('js/vendor.js') }}"></script>
    <script src="{{ mix('js/app.js') }}" async defer></script>
</body>

</html>
