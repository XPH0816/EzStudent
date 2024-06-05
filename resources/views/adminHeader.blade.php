<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="shortcut icon" href="{{ asset('logo.svg') }}" type="image/x-icon">
    <!-- Font CSS -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@100;300;400;700&display=swap" rel="stylesheet">

    <!-- Data Table CSS -->
    <script src="https://code.jquery.com/jquery-3.7.0.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/css/bootstrap.min.css"></script>
    <script src=" https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css"></script>

    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"
        integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous">
    </script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"
        integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.3/jquery.validate.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"
        integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous">
    </script>

    <link rel="stylesheet" type="text/css" href="//cdn.datatables.net/1.10.12/css/jquery.dataTables.min.css" />

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous">
    </script>
    @vite(['resources/css/custom.css'])
    <title>Admin</title>
</head>

<body>
    <div class="container-fluid">
        <div class="row flex-nowrap">
            <div class="col-auto col-lg-3 col-xl-2 px-sm-2 px-0 side-nav d-none d-lg-block">
                <div class="d-flex flex-column align-items-center align-items-sm-start px-3 pt-2 text-white min-vh-100">
                    <div class="navbar-brand mt-3">
                        <img src="/logo.png" alt="" class="img-fluid" id="logo">
                    </div>
                    <ul class="nav nav-pills flex-column mb-sm-auto mb-0 align-items-center align-items-sm-start mt-3"
                        id="menu">
                        <li>
                            <a href="{{ route('admin.home') }}" class="nav-link px-0">
                                <span class="d-none d-sm-inline text-white">Dashboard</span>
                            </a>
                        </li>
                        <li>
                            <a href="#submenu1" data-bs-toggle="collapse"
                                class="nav-link px-0 align-middle text-white font-bold">
                                <span class="d-none d-sm-inline">Stock</span>
                            </a>
                            <ul class="collapse nav flex-column ms-1" id="submenu1" data-bs-parent="#menu">
                                <li>
                                    <a href="{{ route('adminAddStock1') }}" class="nav-link px-0">
                                        <span class="ms-1 d-none d-sm-inline text-white">Add Stock</span>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <li>
                            <a href="#submenu2" data-bs-toggle="collapse"
                                class="nav-link px-0 align-middle text-white font-bold">
                                <span class="d-none d-sm-inline">Report</span>
                            </a>
                            <ul class="collapse nav flex-column ms-1" id="submenu2" data-bs-parent="#menu">
                                <li>
                                    <a href="{{ route('adminGenerateReport') }}" class="nav-link px-0">
                                        <span class="ms-1 d-none d-sm-inline text-white">Generate Report</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="{{ route('adminViewMonthlyReport') }}" class="nav-link px-0"> <span
                                            class="ms-1 d-none d-sm-inline text-white">View Monthly Report</span></a>
                                </li>
                            </ul>
                        </li>
                        <li>
                            <a href="{{ route('adminGetFeedback') }}"
                                class="nav-link px-0 align-middle text-white font-bold">
                                <span class="d-none d-sm-inline">Feedback</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('manageOrder') }}"
                                class="nav-link px-0 align-middle text-white font-bold">
                                <span class="d-none d-sm-inline">Manage Order</span>
                            </a>
                        </li>
                        @superadmin
                            <li>
                                <a href="#submenu3" data-bs-toggle="collapse"
                                    class="nav-link px-0 align-middle font-bold">
                                    <span class="d-none d-sm-inline text-white">Manage Admin</span>
                                </a>
                                <ul class="collapse nav flex-column ms-1" id="submenu3" data-bs-parent="#menu">
                                    <li>
                                        <a href="{{ route('adminList') }}"
                                            class="nav-link px-0 align-middle font-bold">
                                            <span class="ms-1 d-none d-sm-inline text-white">Admin List</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="{{ route('admin.register') }}" class="nav-link px-0">
                                            <span class="ms-1 d-none d-sm-inline text-white">Add Admin</span></a>
                                    </li>
                                </ul>
                            </li>
                        @endsuperadmin
                    </ul>
                    <hr>
                </div>
            </div>

            <div class="col p-0">
                <nav class="navbar navbar-expand-lg navbar-light bg-light border-bottom bg-white">
                    <div class="container-fluid">
                        <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                            data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                            aria-expanded="false" aria-label="Toggle navigation"><span
                                class="navbar-toggler-icon"></span></button>
                        <div class="collapse navbar-collapse" id="navbarSupportedContent">
                            <ul class="nav nav-pills flex-column mb-sm-auto mb-0 align-items-center align-items-sm-start mt-3"
                                id="menu">
                                <li class="p-1 d-lg-none">
                                    <a href="{{ route('admin.home') }}" class="nav-link px-0">
                                        <span class="d-none d-sm-inline text-black">Dashboard</span>
                                    </a>
                                </li>
                                <li class="p-1 d-lg-none">
                                    <a href="#submenu1" data-bs-toggle="collapse"
                                        class="nav-link px-0 align-middle font-bold">
                                        <span class="d-none d-sm-inline text-black">Stock</span>
                                    </a>
                                    <ul class="collapse nav flex-column ms-1" id="submenu1" data-bs-parent="#menu">
                                        <li>
                                            <a href="{{ route('adminAddStock1') }}" class="nav-link px-0">
                                                <span class="ms-1 d-none d-sm-inline text-black">Add Stock</span>
                                            </a>
                                        </li>
                                    </ul>
                                </li>
                                <li class="p-1 d-lg-none">
                                    <a href="#submenu2" data-bs-toggle="collapse"
                                        class="nav-link px-0 align-middle font-bold">
                                        <span class="d-none d-sm-inline text-black">Report</span>
                                    </a>
                                    <ul class="collapse nav flex-column ms-1" id="submenu2" data-bs-parent="#menu">
                                        <li>
                                            <a href="{{ route('adminGenerateReport') }}" class="nav-link px-0">
                                                <span class="ms-1 d-none d-sm-inline text-black">Generate Report</span>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="{{ route('adminViewMonthlyReport') }}" class="nav-link px-0">
                                                <span class="ms-1 d-none d-sm-inline text-black">View Monthly
                                                    Report</span></a>
                                        </li>
                                    </ul>
                                </li>
                                <li class="p-1 d-lg-none">
                                    <a href="{{ route('adminGetFeedback') }}"
                                        class="nav-link px-0 align-middle font-bold">
                                        <span class="d-none d-sm-inline text-black">Feedback</span>
                                    </a>
                                </li>
                                <li class="p-1 d-lg-none">
                                    <a href="{{ route('manageOrder') }}"
                                        class="nav-link px-0 align-middle font-bold">
                                        <span class="d-none d-sm-inline text-black">Manage Order</span>
                                    </a>
                                </li>
                                @superadmin
                                    <li class="p-1 d-lg-none">
                                        <a href="#submenu3" data-bs-toggle="collapse"
                                            class="nav-link px-0 align-middle font-bold">
                                            <span class="d-none d-sm-inline text-black">Manage Admin</span>
                                        </a>
                                        <ul class="collapse nav flex-column ms-1" id="submenu3" data-bs-parent="#menu">
                                            <li class="p-1 d-lg-none">
                                                <a href="{{ route('adminList') }}"
                                                    class="nav-link px-0 align-middle font-bold">
                                                    <span class="ms-1 d-none d-sm-inline text-black">Admin List</span>
                                                </a>
                                            </li>
                                            <li class="p-1 d-lg-none">
                                                <a href="{{ route('admin.register') }}" class="nav-link px-0">
                                                    <span class="ms-1 d-none d-sm-inline text-black">Add Admin</span></a>
                                            </li>
                                        </ul>
                                    </li>
                                @endsuperadmin
                            </ul>
                        </div>

                        <div class="dropdown text-end d-none d-lg-block">
                            <a href="#" class="d-block link-dark text-decoration-none dropdown-toggle"
                                id="dropdownUser1" data-bs-toggle="dropdown" aria-expanded="false">
                            </a>
                            <ul class="dropdown-menu text-small" aria-labelledby="dropdownUser1">
                                @auth
                                    <li>
                                        <a class="dropdown-item" href="{{ route('adminProfile') }}">Profile</a>
                                    </li>
                                    <li>
                                        <a class="dropdown-item" href=""
                                            onclick="event.preventDefault();
                                document.getElementById('logout-form').submit();">Sign
                                            out</a>
                                    </li>
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                        style="display: none;">
                                        @csrf
                                    </form>
                                @endauth
                            </ul>
                        </div>
                    </div>
                </nav>
                <div class="container-fluid">
                    @yield('content')
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.7.0.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.4.2/js/dataTables.buttons.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.4.2/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.4.2/js/buttons.print.min.js"></script>
</body>
