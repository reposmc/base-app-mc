<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" dir="ltr">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Base') }}</title>

    <!-- Scripts -->
    <script src="{{ mix('js/manifest.js') }}" defer></script>
    <script src="{{ mix('js/vendor.js') }}" defer></script>
    <script src="{{ mix('js/app.js') }}" defer></script>
    <script src="{{ asset('js/sidebar.js') }}" defer></script>

    <!-- Styles -->
    <link href="{{ mix('css/app.css') }}" rel="stylesheet">

    <!-- Favicon -->
    <link rel="icon" href="{{ asset('img/Favicon.png') }}">
    @yield('css')

    @yield('header')
</head>

<body>
    <div id="app">
        <!-- Sidebar -->
        <div class="sidebar animate__faster animate__animated animate__slideOutLeft">
            <ul class="nav-links pt-0">
                <li class="text-center close-btn">
                    <i class="material-icons md-36 mx-auto  mt-0 pt-0">menu</i>
                </li>

                @auth
                    <!-- Home -->
                    <li class="text-center pb-1">
                        <a href="{{ url('/home') }}" class="text-center">
                            <i class="material-icons md-18 mx-auto">home</i>
                        </a>
                        <a href="{{ url('/home') }}">
                            <p class="link mx-auto">Inicio</p>
                        </a>
                    </li>
                    <!-- Home -->

                    <!-- Settings -->
                    <!-- Administrative routes -->
                    @if (auth()->user()->hasRole('Administrador') == 'Administrador')
                        <li>
                            <div class="icon-link pb-1">
                                <a href="#" class="arrow text-center">
                                    <i class="material-icons md-18 mx-auto">settings</i>
                                </a>
                                <p class="link">Administración</p>
                            </div>
                            <ul class="sub-menu">
                                <li><a href="{{ url('/departments ') }}">Departamentos</a></li>
                                <li><a href="{{ url('/municipalities') }}">Municipios</a></li>
                                <li><a href="{{ url('/users') }}">Usuarios</a></li>
                            </ul>
                        </li>
                    @endif
                    <!-- End Administrative routes -->
                    <!-- Settings -->

                    <!-- Logout -->
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
                    <!-- Logout -->
                @endauth

                <!-- Login/Logout -->
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
                <!-- Login/Logout -->
            </ul>
        </div>
        <!-- Sidebar -->

        <!-- Home Section -->
        <div class="home-section">
            <div class="home-content pt-5 pb-5">
                <div class="container-fluid">
                    <div class="col-6 col-sm-12 col-md-12">
                        <div class="row p-0 m-0">
                            @auth
                                <div class="col-6 col-md-1 menu my-auto">
                                    <div class="col-3 col-sm-3 menu my-auto">
                                        <i class="material-icons md-36 mx-auto menu color-secondary my-auto">menu</i>
                                    </div>
                                </div>
                            @endauth
                            @guest
                                <div class="col-6 col-md-1 menu pt-0 mt-0 d-block d-md-none d-lg-none d-xl-none">
                                    <div class="col-3 col-sm-3 menu">
                                        <i class="material-icons md-36 mx-auto menu color-secondary">menu</i>
                                    </div>
                                </div>
                            @endguest

                            <!-- Institution Name -->
                            {{-- <div class=" col-sm-4 col-md-6 d-none d-md-block d-lg-block d-xl-block">
                                <div class="col-4 col-sm-12">
                                    <a class="navbar-brand" href="{{ url('/') }}">
                                        <h3 class="text-uppercase pt-4 fw-bold color-secondary mb-0">Name/Logo Brand
                                        </h3>
                                    </a>
                                </div>
                            </div> --}}
                            <!-- Institution Name -->

                            <!-- Logo Brand -->
                            <div class=" col-sm-4 col-md-6 d-none d-md-block d-lg-block d-xl-block">
                                <div class="col-4 col-sm-12 mb-2">
                                    <a class="navbar-brand" href="{{ url('/') }}">
                                        <img class="" src="/logos/Logo_GOES_horizontal_D.svg"
                                            style="max-width: 60%" />
                                    </a>
                                </div>
                            </div>
                            <!-- Logo Brand -->

                            @guest
                                <div class="col-6 col-md-6 text-right d-none d-md-block d-lg-block d-xl-block">
                                    <div class="row mt-2 pt-1">
                                        <div class=" col-md-12 text-end">
                                            <a href="{{ url('/login') }}" class="btn btn-normal-nav shadow-none">Iniciar
                                                sesión</a>
                                            <a href="{{ route('register') }}"
                                                class="btn btn-normal-secondary-nav shadow-none">Registrarme</a>
                                        </div>

                                    </div>
                                </div>
                            @endguest

                            @auth
                                <!-- Logout/UserName -->
                                <div class="col-6 col-md-4 col-sm-4 d-none d-md-block d-lg-block d-xl-block">
                                    <div class="row d-none d-md-block">
                                        <div class="col-12 col-sm-12 col-md-12 pb-0 pt-2 mt-1 text-end">
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
                                <!-- Logout/UserName -->
                            @endauth
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Home Section -->

        <!-- Main -->
        <main class="main content py-4">
            @yield('content')
        </main>
        <!-- Main -->

        <!-- Footer  -->
        <footer-vue />
        <!-- Footer  -->
    </div>

    <!-- Scripts -->
    @yield('scripts')
</body>

</html>
