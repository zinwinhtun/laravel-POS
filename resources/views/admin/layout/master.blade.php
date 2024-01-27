<!-- PAGE CONTAINER-->
<div class="page-container">
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <!-- Required meta tags-->
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="description" content="au theme template">
        <meta name="author" content="Hau Nguyen">
        <meta name="keywords" content="au theme template">

        <!-- CSS only -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet"
            integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">

        <!-- Title Page-->
        <title>@yield('title')</title>

        {{-- fontawesome --}}
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css"
            integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A=="
            crossorigin="anonymous" referrerpolicy="no-referrer" />

        <!-- Fontfaces CSS-->
        <link href=" {{ asset('admin/css/font-face.css') }} " rel="stylesheet" media="all">
        <link href=" {{ asset('admin/vendor/font-awesome-4.7/css/font-awesome.min.css') }} " rel="stylesheet"
            media="all">
        <link href="{{ asset('admin/vendor/font-awesome-5/css/fontawesome-all.min.css') }}" rel="stylesheet"
            media="all">
        <link href="{{ asset('admin/vendor/mdi-font/css/material-design-iconic-font.min.css') }}" rel="stylesheet"
            media="all">

        <!-- Bootstrap CSS-->
        <link href=" {{ asset('admin/vendor/bootstrap-4.1/bootstrap.min.css') }} " rel="stylesheet" media="all">

        <!-- Vendor CSS-->
        <link href=" {{ asset('admin/vendor/animsition/animsition.min.css') }} " rel="stylesheet" media="all">
        <link href=" {{ asset('admin/vendor/bootstrap-progressbar/bootstrap-progressbar-3.3.4.min.css') }} "
            rel="stylesheet" media="all">
        <link href=" {{ asset('admin/vendor/wow/animate.css') }} " rel="stylesheet" media="all">
        <link href=" {{ asset('admin/vendor/css-hamburgers/hamburgers.min.css') }} " rel="stylesheet" media="all">
        <link href=" {{ asset('admin/vendor/slick/slick.css') }} " rel="stylesheet" media="all">
        <link href=" {{ asset('admin/vendor/select2/select2.min.css') }} " rel="stylesheet" media="all">
        <link href=" {{ asset('admin/vendor/perfect-scrollbar/perfect-scrollbar.css') }} " rel="stylesheet"
            media="all">

        <!-- Main CSS-->
        <link href="{{ asset('admin/css/theme.css') }}" rel="stylesheet" media="all">

    </head>

    <body class="animsition">
        <div class="page-wrapper">
            <!-- MENU SIDEBAR-->
            <aside class="menu-sidebar d-none d-lg-block">
                <div class="logo">
                    <a href="#">
                        <img src=" {{ asset('admin/images/icon/logo.png') }} " alt="Cool Admin" />
                    </a>
                </div>
                <div class="menu-sidebar__content js-scrollbar1">
                    <nav class="navbar-sidebar">
                        {{-- side bar  --}}
                        <ul class="list-unstyled navbar__list">
                            <li>
                                <a href="{{ route('category#list') }}">
                                    <i class="fa-solid fa-list-check"></i>Category</a>
                            </li>
                            <li>
                                <a href="{{ route('product#list') }}">
                                    <i class="fa-solid fa-pizza-slice"></i>Products</a>
                            </li>
                            <li>
                                <a href="{{ route('admin#list') }}">
                                    <i class="fa-solid fa-people-group"></i>Admin List</a>
                            </li>
                            <li>
                                <a href="{{ route('admin#orderList') }}">
                                    <i class="fa-solid fa-cart-flatbed"></i>Order List</a>
                            </li>
                            <li>
                                <a href="{{ route('admin#userList') }}">
                                    <i class="fa-solid fa-users"></i>User List</a>
                            </li>
                            <li>
                                <a href="{{route('admin#contactList')}}">
                                    <i class="fa-solid fa-envelope-open-text"></i>Contact List</a>
                            </li>
                        </ul>
                    </nav>
                </div>
            </aside>
            <!-- END MENU SIDEBAR-->

            <!-- PAGE CONTAINER-->
            <div class="page-container">
                <!-- HEADER DESKTOP-->
                <header class="header-desktop">
                    <div class="section__content section__content--p30">
                        <div class="container-fluid">
                            <div class="header-wrap">
                                <span class="form-header" action="" method="POST">
                                    <h4>Admin Dashboard panel</h4>
                                </span>
                                <div class="header-button">
                                    <div class="account-wrap">
                                        <div class="account-item clearfix js-item-menu">
                                            <div class="image">
                                                @if (Auth::user()->image == null)
                                                    <img src=" {{ asset('image/user.png') }} " alt="Cool Admin" />
                                                @else
                                                    <img src=" {{  asset('storage/'.Auth::user()->image)  }} "
                                                        alt="John Doe" />
                                                @endif
                                            </div>
                                            <div class="content">
                                                <a class="js-acc-btn" href="#"> {{ Auth::user()->name }} </a>
                                            </div>
                                            <div class="account-dropdown js-dropdown">
                                                <div class="info clearfix">
                                                    <div class="image">
                                                        <a href="#">
                                                            @if (Auth::user()->image == null)
                                                                <img src=" {{ asset('image/user.png') }} "
                                                                    alt="Cool Admin" />
                                                            @else
                                                                <img src=" {{  asset('storage/'.Auth::user()->image)  }} "
                                                                    alt="John Doe" />
                                                            @endif
                                                        </a>
                                                    </div>
                                                    <div class="content">
                                                        <h5 class="name">
                                                            <a href="#"> {{ Auth::user()->name }} </a>
                                                        </h5>
                                                        <span class="email">{{ Auth::user()->email }}</span>
                                                    </div>
                                                </div>
                                                <div class="account-dropdown__body">
                                                    <div class="account-dropdown__item">
                                                        <a href="{{ route('admin#detail')}}">
                                                            <i class="fa-solid fa-user-check"></i>Account</a>
                                                    </div>
                                                </div>
                                                <div class="account-dropdown__body">
                                                    <div class="account-dropdown__item">
                                                        <a href=" {{ route('admin#changePasswordPage') }} ">
                                                            <i class="fa-solid fa-unlock-keyhole"></i>Change
                                                            Password</a>
                                                    </div>
                                                </div>
                                                <div class="account-dropdown__footer my-3">
                                                    <form class="d-flex justify-content-center"
                                                        action=" {{ route('logout') }} " method="post">
                                                        @csrf
                                                        <button class="btn btn-outline-primary  col-10"
                                                            type="submit"><i
                                                                class="fa-solid fa-arrow-right-from-bracket me-1"></i>Logout</button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </header>
            </div>
            <!-- HEADER DESKTOP-->

            <!-- MAIN CONTENT-->
            @yield('content')
            <!-- END MAIN CONTENT-->

            <!-- END PAGE CONTAINER-->
        </div>

        <!-- Jquery JS-->
        <script src=" {{ asset('admin/vendor/jquery-3.2.1.min.js') }} "></script>
        <!-- Bootstrap JS-->
        <script src=" {{ asset('admin/vendor/bootstrap-4.1/popper.min.js') }} "></script>
        <script src=" {{ asset('admin/vendor/bootstrap-4.1/bootstrap.min.js') }} "></script>
        <!-- Vendor JS       -->
        <script src="{{ asset('admin/vendor/slick/slick.min.js') }}"></script>
        <script src="{{ asset('admin/vendor/wow/wow.min.js') }}"></script>
        <script src="{{ asset('admin/vendor/animsition/animsition.min.js') }}"></script>
        <script src="{{ asset('admin/vendor/bootstrap-progressbar/bootstrap-progressbar.min.js') }}"></script>
        <script src="{{ asset('admin/vendor/counter-up/jquery.waypoints.min.js') }}"></script>
        <script src="{{ asset('admin/vendor/counter-up/jquery.counterup.min.js') }}"></script>
        <script src="{{ asset('admin/vendor/circle-progress/circle-progress.min.js') }}"></script>
        <script src="{{ asset('admin/vendor/perfect-scrollbar/perfect-scrollbar.js') }}"></script>
        <script src="{{ asset('admin/vendor/chartjs/Chart.bundle.min.js') }}"></script>
        <script src="{{ asset('admin/vendor/select2/select2.min.js') }}"></script>
        <!-- Main JS-->
        <script src="{{ asset('admin/js/main.js') }}"></script>

        <!-- JavaScript Bundle with Popper -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-u1OknCvxWvY5kfmNBILK2hRnQC3Pr17a+RTT6rIHI7NnikvbZlHgTPOOmMi466C8" crossorigin="anonymous">
        </script>

    </body>
    @yield('scriptSection')
    </html>
    <!-- end document-->
