<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name') }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    {{-- <link rel="stylesheet" href="/css/style.css"> --}}
    {{-- <link rel="stylesheet" href="/css/custom.css"> --}}
    <link rel="shortcut icon" href="{{ asset('logo.svg') }}" type="image/x-icon">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">

    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"
        integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous">
    </script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"
        integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.3/jquery.validate.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"
        integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous">
    </script>
    @yield('head')
    @auth('customer')
        <style>
            @if (auth('customer')->user()->carts->count() > 0)
                .cart::after {
                    content: "{{ auth('customer')->user()->carts->count() }}" !important;
                }
            @else
                .cart::after {
                    display: none;
                }
            @endif
        </style>
    @endauth
    @guest('customer')
        <style>
            .cart::after {
                display: none;
            }
        </style>
    @endguest
</head>

<body>
    <div class="info">{{ session('info') }}</div>
    <header>
        <div class="header-area">
            <div class="header-top d-none d-sm-block">
                <div class="container">
                    <div class="row">
                        <div class="col-xl-12">
                            <div class="d-flex justify-content-between flex-wrap align-items-center">
                                <div class="header-info-left">
                                    <ul>
                                    </ul>
                                </div>
                                <div class="header-info-right d-flex">
                                    <ul class="order-list">
                                        <li><a href="{{ route('orderHistory') }}">Order History</a></li>
                                        <li><a href="{{ route('history') }}">Payment History</a>
                                        </li>
                                        @if (auth()->check() || auth('customer')->check())
                                            <li>
                                                <a href=""
                                                    onclick="event.preventDefault();
                                            document.getElementById('logout-form').submit();">Log
                                                    Out</a>
                                            </li>
                                            <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                                style="display: none;">
                                                @csrf
                                            </form>
                                        @endif
                                        @if (auth()->guest() && auth('customer')->guest())
                                            <li>
                                                <a href="{{ route('login') }}">Login</a>
                                            </li>
                                            </form>
                                        @endif
                                    </ul>
                                    <ul class="header-social">
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="header-mid header-sticky">
                <div class="container">
                    <div class="menu-wrapper">

                        <div class="logo">
                            <a href="{{ route('home') }}"><img src="{{ asset('logo.png') }}" alt=""
                                    width="130px"></a>
                        </div>

                        <div class="main-menu d-none d-lg-block">
                            <nav>
                                <ul id="navigation">
                                    <li><a href="{{ route('home') }}">Home</a>
                                    </li>
                                    <li><a href="{{ route('productIndex', 'Men') }}">Men</a>
                                    </li>
                                    <li><a href="{{ route('productIndex', 'Women') }}">Women</a>
                                    </li>
                                    <li><a href="{{ route('contact.index') }}">Contact</a>
                                    </li>
                                </ul>
                            </nav>
                        </div>

                        <div class="header-right">
                            <ul>
                                <li>
                                    <div class="nav-search search-switch hearer_icon">
                                        <a id="search_1" href="javascript:void(0)">
                                            <span class="search-icon" id="searchIcon">
                                                <i class="bi bi-search"></i>
                                            </span>
                                        </a>
                                    </div>
                                    <div class="search-bar" id="searchBar">
                                        <form action="{{ route('product.search') }}" method="GET">
                                            <input type="text" id="searchInput" name="query"
                                                placeholder="Search...">
                                            <button type="submit"><i class="bi bi-search"></i></button>
                                        </form>
                                    </div>
                                </li>
                                <li> <a
                                        href="@guest('customer') {{ route('login') }} @endguest @auth('customer') {{ route('profile') }} @endauth">
                                        <span class="flaticon-user">
                                            <i class="bi bi-person-fill"></i>
                                        </span></a></li>
                                <li class="cart"><a href="{{ route('cart') }}"><span
                                            class="flaticon-shopping-cart"><i class="bi bi-cart"></i></span></a>
                                </li>
                            </ul>
                        </div>
                    </div>

                    <div class="search_input" id="search_input_box" style="display: none;">
                        <form class="search-inner d-flex justify-content-between ">
                            <input type="text" class="form-control" id="search_input" placeholder="Search Here">
                            <button type="submit" class="btn"></button>
                            <span class="ti-close" id="close_search" title="Close Search"></span>
                        </form>
                    </div>

                    <div class="col-12">
                        <div class="mobile_menu d-block d-lg-none">
                            <div class="slicknav_menu"><a href="https://preview.colorlib.com/theme/capitalshop/#"
                                    aria-haspopup="true" role="button" tabindex="0"
                                    class="slicknav_btn slicknav_collapsed" style="outline: none;"><span
                                        class="slicknav_menutxt">MENU</span><span class="slicknav_icon"><span
                                            class="slicknav_icon-bar"></span><span
                                            class="slicknav_icon-bar"></span><span
                                            class="slicknav_icon-bar"></span></span></a>
                                <ul class="slicknav_nav slicknav_hidden" style="display: none;" aria-hidden="true"
                                    role="menu">
                                    <li><a href="https://preview.colorlib.com/theme/capitalshop/index.html"
                                            role="menuitem" tabindex="-1">Home</a></li>
                                    <li><a href="https://preview.colorlib.com/theme/capitalshop/categories.html"
                                            role="menuitem" tabindex="-1">Men</a></li>
                                    <li><a href="https://preview.colorlib.com/theme/capitalshop/categories.html"
                                            role="menuitem" tabindex="-1">Women</a></li>
                                    <li><a href="https://preview.colorlib.com/theme/capitalshop/contact.html"
                                            role="menuitem" tabindex="-1">Contact</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </header>
    @yield('content')
    @yield('scripts')
</body>
<script>
    document.getElementById('searchIcon').addEventListener('click', function() {
        var searchBar = document.getElementById('searchBar');
        searchBar.style.display = (searchBar.style.display === 'block') ? 'none' : 'block';
    });

    function closeSearch() {
        document.getElementById('searchBar').style.display = 'none';
    }

    document.addEventListener("DOMContentLoaded", function() {
        var inputElement = document.getElementById(
            'searchInput'); // Replace 'searchInput' with the actual ID of your search input field

        inputElement.addEventListener('input', function(event) {
            var inputValue = event.target.value;

            // Remove special characters using a regular expression
            var sanitizedValue = inputValue.replace(/[^\w\s]/gi, '');

            // Update the input field value with sanitized value
            event.target.value = sanitizedValue;
        });
    });
</script>

</html>
