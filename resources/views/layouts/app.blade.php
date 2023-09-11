<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Laravel') }}</title>
    <link rel="stylesheet" href="/node_modules/@fortawesome/fontawesome-free/css/all.min.css">

    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="/node_modules/@fortawesome/fontawesome-free/js/all.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>


    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
</head>

<body>
    <div id="app">
        {{-- Navigation Bar --}}
        <nav class="navbar navbar-expand-xl bg-white sticky-top">
            <div class="container-fluid">

                <a class="navbar-brand d-xl-none" href="{{ url('/') }}">
                    {{ config('app.name', 'Laravel') }}
                </a>

                <a class="nav-link position-relative d-xl-none mx-4" href="/productcart" aria-expanded="false">
                    <i class="fa-solid fa-cart-shopping product-cart-icon"></i>
                    <span id="product-cart-count-responsive"
                        class="position-absolute translate-middle badge rounded-pill bg-danger cart-badge"></span></a>

                <a class="nav-link position-relative d-xl-none" href="/beveragecart" aria-expanded="false">

                    <i class="fa-solid fa-glass-water beverage-cart-icon"></i>
                    <span id="beverage-cart-count-responsive"
                        class="position-absolute translate-middle badge rounded-pill bg-danger cart-badge"></span></a>

                <button class="navbar-toggler ms-auto me-3" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                    aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <!-- Navbar Content -->
                <div class="collapse navbar-collapse justify-content-between" id="navbarSupportedContent">
                    <ul class="navbar-nav">
                        <!-- Dropdown -->
                        <li class="nav-item dropdown d-none d-xl-block shop-dropdown nav-expanded-item">
                            <a class="nav-link" href="#" aria-expanded="false">
                                Shop
                            </a>
                            <!-- Dropdown Menu -->
                            <ul class="dropdown-menu dropdown-hover-menu">
                                <li><a class="dropdown-item" href="/beveragelist">Beverages</a></li>
                                <li><a class="dropdown-item" href="/homebrewproductlist">Homebrew Products</a></li>
                                <li><a class="dropdown-item" href="/mechaniclist">Machines & Barista Tools</a></li>
                            </ul>
                        </li>

                        <li class="nav-item dropdown d-xl-none text-muted responsive-click">
                            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="collapse"
                                data-bs-target="#accordionNavbar" aria-expanded="false" aria-controls="accordionNavbar">
                                Shop
                            </a>

                            <!-- Accordion Content -->
                            <div class="collapse navbar-collapse" id="accordionNavbar">
                                <ul class="navbar-nav">
                                    <li class="nav-item">
                                        <a class="nav-link" href="/beveragelist">Beverages</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="/homebrewproductlist">Homebrew Products</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="/mechaniclist">Machines & Barista Tools</a>
                                    </li>
                                </ul>
                            </div>
                        </li>

                        <li class="nav-item dropdown d-none d-xl-block shop-dropdown nav-expanded-item">
                            <a class="nav-link" href="/guide" aria-expanded="false">
                                Guides
                            </a>
                        </li>

                        <li class="nav-item dropdown d-xl-none text-muted">
                            <a class="nav-link" href="/guide" role="button">
                                Guides
                            </a>

                        </li>

                        <li class="nav-item d-none dropdown cart-dropdown d-xl-block me-3">
                            <span class="nav-link position-relative cart-icon-span" aria-expanded="false">

                                <i class="fa-solid fa-cart-shopping product-cart-icon"></i>
                                <span id="product-cart-count"
                                    class="position-absolute translate-middle badge rounded-pill bg-danger cart-badge"></span></span>

                            <div class="dropdown-menu dropdown-menu-start dropdown-cart-menu dropdown-hover-menu p-4"
                                aria-labelledby="cartDropdown" id="cartDropdownItems">
                                <span class="d-block text-end text-muted">Total: <span
                                        id="product-cart-total"></span></span>
                                <hr>
                                <div class="cart-items" id="productCartItems">
                                    <ul class="product-cart-modal" id="productCartItemList">

                                    </ul>
                                </div>

                                <a class="dropdown-cart-item btn btn-view-cart ms-auto me-auto w-100"
                                    href="/productcart" id="product-view-cart">View
                                    Complete
                                    Product Cart</a>
                            </div>
                        </li>

                        <li class="nav-item d-none dropdown cart-dropdown d-xl-block ml-3">
                            <span class="nav-link position-relative cart-icon-span" aria-expanded="false">

                                <i class="fa-solid fa-glass-water beverage-cart-icon"></i>
                                <span id="beverage-cart-count"
                                    class="position-absolute translate-middle badge rounded-pill bg-danger cart-badge"></span></span>

                            <div class="dropdown-menu dropdown-menu-start dropdown-cart-menu dropdown-hover-menu p-4"
                                aria-labelledby="cartDropdown" id="cartDropdownItems">
                                <span class="d-block text-end text-muted">Total: <span
                                        id="beverage-cart-total"></span></span>
                                <hr>
                                <div class="cart-items" id="beverageCartItems">
                                    <ul class="beverage-cart-modal" id="beverageCartItemList">

                                    </ul>
                                </div>
                                <a class="dropdown-cart-item btn btn-view-cart ms-auto me-auto w-100"
                                    href="/beveragecart" id="beverage-view-cart">View Complete Beverage
                                    Cart</a>
                            </div>
                        </li>
                    </ul>

                    <!-- Navbar Brand (Centered) -->
                    <a class="navbar-brand d-none d-xl-block" style="margin-right: 100px;" href="{{ url('/') }}">
                        {{ config('app.name', 'Laravel') }}
                    </a>

                    <!-- Right Side Of Navbar (Login & Register) -->
                    <ul class="navbar-nav me-xl-3">
                        @guest
                        @if (Route::has('login'))
                        <li class="nav-item d-xl-none">
                            <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                        </li>
                        @endif

                        @if (Route::has('register'))
                        <li class="nav-item d-xl-none">
                            <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                        </li>
                        @endif

                        <div id="navSidebar" class="sidebar">
                            <button class=" btn closebtn" onclick="closeNav()"><i
                                    class="fa-solid fa-xmark text-muted"></i></button>
                            <a href="{{ route('login') }}">{{ __('Login') }}</a>
                            <a href="{{ route('register') }}">{{ __('Register') }}</a>

                        </div>

                        <div id="sideBarList" class="d-none d-xl-block">
                            <button class="openbtn" onclick="openNav()"><span
                                    class="navbar-toggler-icon"></span></button>
                        </div>
                        @else

                        <li class="nav-item dropdown nav-expanded-item d-none d-xl-block shop-dropdown">
                            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                                data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
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

                                <a href="" class="dropdown-item">
                                    View My Orders
                                </a>
                            </div>
                        </li>

                        <li class="nav-item dropdown d-xl-none text-muted  responsive-click">
                            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="collapse"
                                data-bs-target="#userAccordionNavbar" aria-expanded="false"
                                aria-controls="accordionNavbar">
                                {{ Auth::user()->name }}
                            </a>

                            <!-- Accordion Content -->
                            <div class="collapse navbar-collapse" id="userAccordionNavbar">
                                <ul class="navbar-nav">
                                    <li class="nav-item">
                                        <a class="nav-link" href="{{ route('logout') }}" onclick="event.preventDefault();
                                        document.getElementById('logout-form').submit();">{{ __('Logout') }}</a>

                                        <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                            class="d-none">
                                            @csrf
                                        </form>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="#">View My Orders</a>
                                    </li>
                                </ul>
                            </div>
                        </li>

                        @endguest
                    </ul>
                </div>
            </div>
        </nav>


        <main>
            @yield('content')

        </main>
    </div>
</body>
<script src="{{ asset('js/app.js') }}"></script>

</html>