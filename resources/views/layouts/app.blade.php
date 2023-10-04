<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <title>
        Homepage
    </title>
    <link rel="shortcut icon" href="{{ asset('uploads/logo/' . $info->logo) }}" type="image/x-icon" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="keywords" content="HomePgae" />
    <script type="application/x-javascript">
      addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false);
        function hideURLbar() { window.scrollTo(0, 1); }
    </script>
    <!-- Bootstrap Core CSS -->
    <link href="{{ asset('backend/css/bootstrap.css') }}" rel="stylesheet" type="text/css" />
    <!-- Custom CSS -->
    <link href="{{ asset('backend/css/style.css') }}" rel="stylesheet" type="text/css" />
    <!-- font-awesome icons CSS -->
    <link href="{{ asset('backend/css/font-awesome.css') }}" rel="stylesheet" />
    <!-- //font-awesome icons CSS-->
    <!-- side nav css file -->
    <link href="{{ asset('backend/css/SidebarNav.min.css') }}" media="all" rel="stylesheet" type="text/css" />
    <!-- //side nav css file -->
    <!-- js-->
    <script src="{{ asset('backend/js/jquery-1.11.1.min.js') }}"></script>
    <script src="{{ asset('backend/js/modernizr.custom.js') }}"></script>
    <!--webfonts-->
    <link href="//fonts.googleapis.com/css?family=PT+Sans:400,400i,700,700i&amp;subset=cyrillic,cyrillic-ext,latin-ext"
        rel="stylesheet" />
    <!--//webfonts-->
    <!-- chart -->
    <script src="{{ asset('backend/js/Chart.js') }}"></script>
    <!-- //chart -->
    <!-- Metis Menu -->
    <script src="{{ asset('backend/js/metisMenu.min.js') }}"></script>
    <script src="{{ asset('backend/js/custom.js') }}"></script>
    <link href="{{ asset('backend/css/custom.css') }}" rel="stylesheet" />
    <!--//Metis Menu -->
    <style>
        #chartdiv {
            width: 100%;
            height: 295px;
        }
    </style>
    <!--pie-chart -->
    <!-- index page sales reviews visitors pie chart -->
    <script src="{{ asset('backend/js/pie-chart.js') }}" type="text/javascript"></script>
    <script type="text/javascript">
        $(document).ready(function() {
            $('#demo-pie-1').pieChart({
                barColor: '#2dde98',
                trackColor: '#eee',
                lineCap: 'round',
                lineWidth: 8,
                onStep: function(from, to, percent) {
                    $(this.element)
                        .find('.pie-value')
                        .text(Math.round(percent) + '%');
                },
            });

            $('#demo-pie-2').pieChart({
                barColor: '#8e43e7',
                trackColor: '#eee',
                lineCap: 'butt',
                lineWidth: 8,
                onStep: function(from, to, percent) {
                    $(this.element)
                        .find('.pie-value')
                        .text(Math.round(percent) + '%');
                },
            });

            $('#demo-pie-3').pieChart({
                barColor: '#ffc168',
                trackColor: '#eee',
                lineCap: 'square',
                lineWidth: 8,
                onStep: function(from, to, percent) {
                    $(this.element)
                        .find('.pie-value')
                        .text(Math.round(percent) + '%');
                },
            });
        });
    </script>
    <!-- //pie-chart -->
    <!-- index page sales reviews visitors pie chart -->
    <!-- requried-jsfiles-for owl -->
    <link href="{{ asset('backend/css/owl.carousel.css') }}" rel="stylesheet" />
    <script src="{{ asset('backend/js/owl.carousel.js') }}"></script>
    <script>
        $(document).ready(function() {
            $('#owl-demo').owlCarousel({
                items: 3,
                lazyLoad: true,
                autoPlay: true,
                pagination: true,
                nav: true,
            });
        });
    </script>
    <!-- //requried-jsfiles-for owl -->
    <link rel="stylesheet" href="//code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">
    <link rel="stylesheet" href="//cdn.datatables.net/1.12.1/css/jquery.dataTables.min.css">
</head>

<body class="cbp-spmenu-push">
    <div class="main-content">
        <div class="cbp-spmenu cbp-spmenu-vertical cbp-spmenu-left" id="cbp-spmenu-s1">
            <!--left-fixed -navigation-->
            <aside class="sidebar-left">
                <nav class="navbar navbar-inverse">
                    <div class="navbar-header">
                        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse"
                            data-target=".collapse" aria-expanded="false">
                            <span class="sr-only">Toggle navigation</span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                        </button>
                        <h1>
                            <a target="_blank" class="navbar-brand" href="{{ url('/') }}"><span class="fa fa-area-chart"></span>
                                Movie<span class="dashboard_text">Dashboard Movie</span></a>
                        </h1>
                    </div>
                    @if (Auth::check())
                        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                            <ul class="sidebar-menu">
                                <li class="header">MAIN NAVIGATION</li>
                                <li class="treeview">
                                    <a href="{{ url('/home') }}">
                                        <i class="fa fa-dashboard"></i> <span>Dashboard</span>
                                    </a>
                                </li>
                                @php
                                    $segment = Request::segment(1);
                                @endphp
                                <li class="treeview {{ $segment == 'category' ? 'active' : '' }} ">
                                    <a href="#">
                                        <i class="fa fa-laptop"></i>
                                        <span>Danh mục phim</span>
                                        <i class="fa fa-angle-left pull-right"></i>
                                    </a>
                                    <ul class="treeview-menu">
                                        <li>
                                            <a href="{{ route('category.index') }}"><i class="fa fa-angle-right"></i>
                                                Liệt kê danh mục
                                            </a>
                                        </li>
                                        <li>
                                            <a href="{{ route('category.create') }}"><i class="fa fa-angle-right"></i>
                                                Thêm danh mục
                                            </a>
                                        </li>
                                    </ul>
                                </li>
                                <li class="treeview {{ $segment == 'genre' ? 'active' : '' }}">
                                    <a href="#">
                                        <i class="fa fa-industry"></i>
                                        <span>Thể loại phim</span>
                                        <i class="fa fa-angle-left pull-right"></i>
                                    </a>
                                    <ul class="treeview-menu">
                                        <li>
                                            <a href="{{ route('genre.index') }}"><i class="fa fa-angle-right"></i>
                                                Liệt kê thể loại
                                            </a>
                                        </li>
                                        <li>
                                            <a href="{{ route('genre.create') }}"><i class="fa fa-angle-right"></i>
                                                Thêm thể loại
                                            </a>
                                        </li>
                                    </ul>
                                </li>
                                <li class="treeview {{ $segment == 'country' ? 'active' : '' }}">
                                    <a href="#">
                                        <i class="fa fa-globe"></i>
                                        <span>Quốc gia phim</span>
                                        <i class="fa fa-angle-left pull-right"></i>
                                    </a>
                                    <ul class="treeview-menu">
                                        <li>
                                            <a href="{{ route('country.index') }}"><i class="fa fa-angle-right"></i>
                                                Liệt kê quốc gia
                                            </a>
                                        </li>
                                        <li>
                                            <a href="{{ route('country.create') }}"><i class="fa fa-angle-right"></i>
                                                Thêm quốc gia
                                            </a>
                                        </li>

                                    </ul>
                                </li>
                                <li class="treeview {{ $segment == 'movie' ? 'active' : '' }}">
                                    <a href="#">
                                        <i class="fa fa-film"></i>
                                        <span>Phim</span>
                                        <i class="fa fa-angle-left pull-right"></i>
                                    </a>
                                    <ul class="treeview-menu">
                                        <li>
                                            <a href="{{ route('movie.index') }}"><i class="fa fa-angle-right"></i>
                                                Liệt kê Phim
                                            </a>
                                        </li>
                                        <li>
                                            <a href="{{ route('movie.create') }}"><i class="fa fa-angle-right"></i>
                                                Thêm Phim
                                            </a>
                                        </li>
                                        <li>
                                            <a href="{{ route('leech-movie') }}"><i class="fa fa-angle-right"></i>
                                                Leech Phim
                                            </a>
                                        </li>
                                        <li>
                                            <a href="{{ route('episode.create') }}"><i class="fa fa-angle-right"></i>
                                                Thêm tập Phim
                                            </a>
                                        </li>
                                        <li>
                                            <a href="{{ route('episode.index') }}"><i class="fa fa-angle-right"></i>
                                                Liệt kê Tập Phim
                                            </a>
                                        </li>
                                    </ul>
                                </li>
                                <li class="treeview {{ $segment == 'linkmovie' ? 'active' : '' }}">
                                    <a href="#">
                                        <i class="fa fa-link"></i>
                                        <span>Server phim</span>
                                        <i class="fa fa-angle-left pull-right"></i>
                                    </a>
                                    <ul class="treeview-menu">
                                        <li>
                                            <a href="{{ route('linkmovie.index') }}"><i
                                                    class="fa fa-angle-right"></i>
                                                Liệt kê Server
                                            </a>
                                        </li>
                                        <li>
                                            <a href="{{ route('linkmovie.create') }}"><i
                                                    class="fa fa-angle-right"></i>
                                                Thêm Server phim
                                            </a>
                                        </li>

                                    </ul>
                                </li>
                                <li class="treeview {{ $segment == 'info' ? 'active' : '' }}">
                                    <a href="#">
                                        <i class="fa fa-info"></i>
                                        <span>Info phim</span>
                                        <i class="fa fa-angle-left pull-right"></i>
                                    </a>
                                    <ul class="treeview-menu">
                                        <li>
                                            <a href="{{ route('info.create') }}"><i class="fa fa-angle-right"></i>
                                                Thông tin web phim
                                            </a>
                                        </li>
                                    </ul>
                                </li>
                                <li class="treeview {{ $segment == 'customer' ? 'active' : '' }}">
                                    <a href="#">
                                        <i class="fa fa-user"></i>
                                        <span>Người dùng</span>
                                        <i class="fa fa-angle-left pull-right"></i>
                                    </a>
                                    <ul class="treeview-menu">
                                        <li>
                                            <a href="{{ route('customer.index') }}"><i class="fa fa-angle-right"></i>
                                                Xem thông tin người dùng
                                            </a>
                                        </li>
                                    </ul>
                                </li>
                                <li class="treeview">
                                    <a href="#">
                                        <i class="fa fa-envelope"></i> <span>Mailbox </span>
                                        <i class="fa fa-angle-left pull-right"></i><small
                                            class="label pull-right label-info1">08</small><span
                                            class="label label-primary1 pull-right">02</span></a>
                                    <ul class="treeview-menu">
                                        <li>
                                            <a href=""><i class="fa fa-angle-right"></i> Mail Inbox
                                            </a>
                                        </li>
                                        <li>
                                            <a href=""><i class="fa fa-angle-right"></i> Compose Mail
                                            </a>
                                        </li>
                                    </ul>
                                </li>
                            </ul>
                        </div>
                    @endif

                    <!-- /.navbar-collapse -->
                </nav>
            </aside>
        </div>
        <!--left-fixed -navigation-->
        <!-- header-starts -->
        <div class="sticky-header header-section">
            @if (Auth::check())
                <div class="header-left">
                    <!--toggle button start-->
                    <button id="showLeftPush"><i class="fa fa-bars"></i></button>
                    <!--toggle button end-->
                    <div class="profile_details_left">
                        <!--notifications of menu start -->
                        <ul class="nofitications-dropdown">
                            <li class="dropdown head-dpdn">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown"
                                    aria-expanded="false"><i class="fa fa-envelope"></i><span
                                        class="badge">4</span></a>
                                <ul class="dropdown-menu">
                                    <li>
                                        <div class="notification_header">
                                            <h3>You have 3 new messages</h3>
                                        </div>
                                    </li>
                                    <li>
                                        <a href="#">
                                            <div class="user_img">
                                                <img src="{{ asset('backend/images/1.jpg') }}" alt="" />
                                            </div>
                                            <div class="notification_desc">
                                                <p>Lorem ipsum dolor amet</p>
                                                <p><span>1 hour ago</span></p>
                                            </div>
                                            <div class="clearfix"></div>
                                        </a>
                                    </li>
                                    <li class="odd">
                                        <a href="#">
                                            <div class="user_img">
                                                <img src="{{ asset('backend/images/4.jpg') }}" alt="" />
                                            </div>
                                            <div class="notification_desc">
                                                <p>Lorem ipsum dolor amet</p>
                                                <p><span>1 hour ago</span></p>
                                            </div>
                                            <div class="clearfix"></div>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#">
                                            <div class="user_img">
                                                <img src="{{ asset('backend/images/3.jpg') }}" alt="" />
                                            </div>
                                            <div class="notification_desc">
                                                <p>Lorem ipsum dolor amet</p>
                                                <p><span>1 hour ago</span></p>
                                            </div>
                                            <div class="clearfix"></div>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#">
                                            <div class="user_img">
                                                <img src="{{ asset('backend/images/2.jpg') }}" alt="" />
                                            </div>
                                            <div class="notification_desc">
                                                <p>Lorem ipsum dolor amet</p>
                                                <p><span>1 hour ago</span></p>
                                            </div>
                                            <div class="clearfix"></div>
                                        </a>
                                    </li>
                                    <li>
                                        <div class="notification_bottom">
                                            <a href="#">See all messages</a>
                                        </div>
                                    </li>
                                </ul>
                            </li>
                            <li class="dropdown head-dpdn">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown"
                                    aria-expanded="false"><i class="fa fa-bell"></i><span
                                        class="badge blue">4</span></a>
                                <ul class="dropdown-menu">
                                    <li>
                                        <div class="notification_header">
                                            <h3>You have 3 new notification</h3>
                                        </div>
                                    </li>
                                    <li>
                                        <a href="#">
                                            <div class="user_img">
                                                <img src="{{ asset('backend/images/4.jpg') }}" alt="" />
                                            </div>
                                            <div class="notification_desc">
                                                <p>Lorem ipsum dolor amet</p>
                                                <p><span>1 hour ago</span></p>
                                            </div>
                                            <div class="clearfix"></div>
                                        </a>
                                    </li>
                                    <li class="odd">
                                        <a href="#">
                                            <div class="user_img">
                                                <img src="{{ asset('backend/images/1.jpg') }}" alt="" />
                                            </div>
                                            <div class="notification_desc">
                                                <p>Lorem ipsum dolor amet</p>
                                                <p><span>1 hour ago</span></p>
                                            </div>
                                            <div class="clearfix"></div>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#">
                                            <div class="user_img">
                                                <img src="{{ asset('backend/images/3.jpg') }}" alt="" />
                                            </div>
                                            <div class="notification_desc">
                                                <p>Lorem ipsum dolor amet</p>
                                                <p><span>1 hour ago</span></p>
                                            </div>
                                            <div class="clearfix"></div>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#">
                                            <div class="user_img">
                                                <img src="{{ asset('backend/images/2.jpg') }}" alt="" />
                                            </div>
                                            <div class="notification_desc">
                                                <p>Lorem ipsum dolor amet</p>
                                                <p><span>1 hour ago</span></p>
                                            </div>
                                            <div class="clearfix"></div>
                                        </a>
                                    </li>
                                    <li>
                                        <div class="notification_bottom">
                                            <a href="#">See all notifications</a>
                                        </div>
                                    </li>
                                </ul>
                            </li>
                            <li class="dropdown head-dpdn">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown"
                                    aria-expanded="false"><i class="fa fa-tasks"></i><span
                                        class="badge blue1">8</span></a>
                                <ul class="dropdown-menu">
                                    <li>
                                        <div class="notification_header">
                                            <h3>You have 8 pending task</h3>
                                        </div>
                                    </li>
                                    <li>
                                        <a href="#">
                                            <div class="task-info">
                                                <span class="task-desc">Database update</span><span
                                                    class="percentage">40%</span>
                                                <div class="clearfix"></div>
                                            </div>
                                            <div class="progress progress-striped active">
                                                <div class="bar yellow" style="width: 40%"></div>
                                            </div>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#">
                                            <div class="task-info">
                                                <span class="task-desc">Dashboard done</span><span
                                                    class="percentage">90%</span>
                                                <div class="clearfix"></div>
                                            </div>
                                            <div class="progress progress-striped active">
                                                <div class="bar green" style="width: 90%"></div>
                                            </div>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#">
                                            <div class="task-info">
                                                <span class="task-desc">Mobile App</span><span
                                                    class="percentage">33%</span>
                                                <div class="clearfix"></div>
                                            </div>
                                            <div class="progress progress-striped active">
                                                <div class="bar red" style="width: 33%"></div>
                                            </div>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#">
                                            <div class="task-info">
                                                <span class="task-desc">Issues fixed</span><span
                                                    class="percentage">80%</span>
                                                <div class="clearfix"></div>
                                            </div>
                                            <div class="progress progress-striped active">
                                                <div class="bar blue" style="width: 80%"></div>
                                            </div>
                                        </a>
                                    </li>
                                    <li>
                                        <div class="notification_bottom">
                                            <a href="#">See all pending tasks</a>
                                        </div>
                                    </li>
                                </ul>
                            </li>
                        </ul>
                        <div class="clearfix"></div>
                    </div>
                    <!--notification menu end -->
                    <div class="clearfix"></div>
                </div>
                <div class="header-right">
                    <!--search-box-->
                    <div class="search-box">
                        <form class="input">
                            <input class="sb-search-input input__field--madoka" placeholder="Search..." type="search" id="input-31" />
                            <label class="input__label" for="input-31">
                                <svg class="graphic" width="100%" height="100%" viewBox="0 0 404 77" preserveAspectRatio="none">
                                    <path d="m0,0l404,0l0,77l-404,0l0,-77z" />
                                </svg>
                            </label>
                        </form>
                    </div>
                </div>
            @endif
            <!--//end-search-box-->
            <div class="profile_details">
                @guest
                    {{-- @if (Route::has('login'))
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                            </li>
                        @endif

                        @if (Route::has('register'))
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                            </li>
                        @endif --}}
                @else
                    <ul>
                        <li class="dropdown profile_details_drop">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                                <div class="profile_img">
                                    <span class="prfil-img"><img src="images/2.jpg" alt="" />
                                    </span>
                                    <div class="user-name">
                                        <p> {{ Auth::user()->name }}</p>
                                        <span>Administrator</span>
                                    </div>
                                    <i class="fa fa-angle-down lnr"></i>
                                    <i class="fa fa-angle-up lnr"></i>
                                    <div class="clearfix"></div>
                                </div>
                            </a>
                            <ul class="dropdown-menu drp-mnu">
                                <li>
                                    <a href="#"><i class="fa fa-cog"></i> Settings</a>
                                </li>
                                <li>
                                    <a href="#"><i class="fa fa-user"></i> My Account</a>
                                </li>
                                <li>
                                    <a href="#"><i class="fa fa-suitcase"></i> Profile</a>
                                </li>
                                <li>
                                    <a href="{{ route('logout') }}"
                                        onclick="event.preventDefault();
                                        document.getElementById('logout-form').submit();">
                                        <i class="fa fa-sign-out"></i> {{ __('Logout') }}
                                    </a>
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                        class="d-none">
                                        @csrf
                                    </form>
                                </li>
                            </ul>
                        </li>
                    </ul>
                @endguest
            </div>
            <div class="clearfix"></div>
        </div>
        <div class="clearfix"></div>
    </div>
    <!-- //header-ends -->
    <!-- main content start-->
    <div id="page-wrapper">
        @yield('content')
    </div>
    <!--footer-->
    <div class="footer">
        <p>
            &copy; 2023 Design by
            <a href="https://www.facebook.com/phpid1586" target="_blank">LongNguyen</a>
        </p>
    </div>
    <!--//footer-->
    </div>
    <!-- new added graphs chart js-->
    <script src="{{ asset('js/Chart.bundle.js') }}"></script>
    <script src="{{ asset('js/utils.js') }}"></script>
    <script>
        var MONTHS = [
            'January',
            'February',
            'March',
            'April',
            'May',
            'June',
            'July',
            'August',
            'September',
            'October',
            'November',
            'December',
        ];
        var color = Chart.helpers.color;
        var barChartData = {
            labels: [
                'January',
                'February',
                'March',
                'April',
                'May',
                'June',
                'July',
            ],
            datasets: [{
                    label: 'Dataset 1',
                    backgroundColor: color(window.chartColors.red)
                        .alpha(0.5)
                        .rgbString(),
                    borderColor: window.chartColors.red,
                    borderWidth: 1,
                    data: [
                        randomScalingFactor(),
                        randomScalingFactor(),
                        randomScalingFactor(),
                        randomScalingFactor(),
                        randomScalingFactor(),
                        randomScalingFactor(),
                        randomScalingFactor(),
                    ],
                },
                {
                    label: 'Dataset 2',
                    backgroundColor: color(window.chartColors.blue)
                        .alpha(0.5)
                        .rgbString(),
                    borderColor: window.chartColors.blue,
                    borderWidth: 1,
                    data: [
                        randomScalingFactor(),
                        randomScalingFactor(),
                        randomScalingFactor(),
                        randomScalingFactor(),
                        randomScalingFactor(),
                        randomScalingFactor(),
                        randomScalingFactor(),
                    ],
                },
            ],
        };

        window.onload = function() {
            var ctx = document.getElementById('canvas').getContext('2d');
            window.myBar = new Chart(ctx, {
                type: 'bar',
                data: barChartData,
                options: {
                    responsive: true,
                    legend: {
                        position: 'top',
                    },
                    title: {
                        display: true,
                        text: 'Chart.js Bar Chart',
                    },
                },
            });
        };

        document
            .getElementById('randomizeData')
            .addEventListener('click', function() {
                var zero = Math.random() < 0.2 ? true : false;
                barChartData.datasets.forEach(function(dataset) {
                    dataset.data = dataset.data.map(function() {
                        return zero ? 0.0 : randomScalingFactor();
                    });
                });
                window.myBar.update();
            });

        var colorNames = Object.keys(window.chartColors);
        document
            .getElementById('addDataset')
            .addEventListener('click', function() {
                var colorName =
                    colorNames[barChartData.datasets.length % colorNames.length];
                var dsColor = window.chartColors[colorName];
                var newDataset = {
                    label: 'Dataset ' + barChartData.datasets.length,
                    backgroundColor: color(dsColor).alpha(0.5).rgbString(),
                    borderColor: dsColor,
                    borderWidth: 1,
                    data: [],
                };

                for (var index = 0; index < barChartData.labels.length; ++index) {
                    newDataset.data.push(randomScalingFactor());
                }

                barChartData.datasets.push(newDataset);
                window.myBar.update();
            });

        document.getElementById('addData').addEventListener('click', function() {
            if (barChartData.datasets.length > 0) {
                var month = MONTHS[barChartData.labels.length % MONTHS.length];
                barChartData.labels.push(month);

                for (var index = 0; index < barChartData.datasets.length; ++index) {
                    //window.myBar.addData(randomScalingFactor(), index);
                    barChartData.datasets[index].data.push(randomScalingFactor());
                }

                window.myBar.update();
            }
        });

        document
            .getElementById('removeDataset')
            .addEventListener('click', function() {
                barChartData.datasets.splice(0, 1);
                window.myBar.update();
            });

        document
            .getElementById('removeData')
            .addEventListener('click', function() {
                barChartData.labels.splice(-1, 1); // remove the label first

                barChartData.datasets.forEach(function(dataset, datasetIndex) {
                    dataset.data.pop();
                });

                window.myBar.update();
            });
    </script>
    <!-- new added graphs chart js-->
    <!-- Classie -->
    <!-- for toggle left push menu script -->
    <script src="{{ asset('backend/js/classie.js') }}"></script>
    <script>
        var menuLeft = document.getElementById('cbp-spmenu-s1'),
            showLeftPush = document.getElementById('showLeftPush'),
            body = document.body;

        showLeftPush.onclick = function() {
            classie.toggle(this, 'active');
            classie.toggle(body, 'cbp-spmenu-push-toright');
            classie.toggle(menuLeft, 'cbp-spmenu-open');
            disableOther('showLeftPush');
        };

        function disableOther(button) {
            if (button !== 'showLeftPush') {
                classie.toggle(showLeftPush, 'disabled');
            }
        }
    </script>
    <!-- //Classie -->
    <!-- //for toggle left push menu script -->
    <!--scrolling js-->
    <script src="{{ asset('backend/js/jquery.nicescroll.js') }}"></script>
    <script src="{{ asset('backend/js/scripts.js') }}"></script>
    <!--//scrolling js-->
    <!-- side nav js -->
    <script src="{{ asset('backend/js/SidebarNav.min.js') }}" type="text/javascript"></script>
    <script>
        $('.sidebar-menu').SidebarNav();
    </script>
    <!-- //side nav js -->
    <!-- for index page weekly sales java script -->
    <script src="{{ asset('backend/js/SimpleChart.js') }}"></script>
    <script>
        var graphdata1 = {
            linecolor: '#CCA300',
            title: 'Monday',
            values: [{
                    X: '6:00',
                    Y: 10.0
                },
                {
                    X: '7:00',
                    Y: 20.0
                },
                {
                    X: '8:00',
                    Y: 40.0
                },
                {
                    X: '9:00',
                    Y: 34.0
                },
                {
                    X: '10:00',
                    Y: 40.25
                },
                {
                    X: '11:00',
                    Y: 28.56
                },
                {
                    X: '12:00',
                    Y: 18.57
                },
                {
                    X: '13:00',
                    Y: 34.0
                },
                {
                    X: '14:00',
                    Y: 40.89
                },
                {
                    X: '15:00',
                    Y: 12.57
                },
                {
                    X: '16:00',
                    Y: 28.24
                },
                {
                    X: '17:00',
                    Y: 18.0
                },
                {
                    X: '18:00',
                    Y: 34.24
                },
                {
                    X: '19:00',
                    Y: 40.58
                },
                {
                    X: '20:00',
                    Y: 12.54
                },
                {
                    X: '21:00',
                    Y: 28.0
                },
                {
                    X: '22:00',
                    Y: 18.0
                },
                {
                    X: '23:00',
                    Y: 34.89
                },
                {
                    X: '0:00',
                    Y: 40.26
                },
                {
                    X: '1:00',
                    Y: 28.89
                },
                {
                    X: '2:00',
                    Y: 18.87
                },
                {
                    X: '3:00',
                    Y: 34.0
                },
                {
                    X: '4:00',
                    Y: 40.0
                },
            ],
        };
        var graphdata2 = {
            linecolor: '#00CC66',
            title: 'Tuesday',
            values: [{
                    X: '6:00',
                    Y: 100.0
                },
                {
                    X: '7:00',
                    Y: 120.0
                },
                {
                    X: '8:00',
                    Y: 140.0
                },
                {
                    X: '9:00',
                    Y: 134.0
                },
                {
                    X: '10:00',
                    Y: 140.25
                },
                {
                    X: '11:00',
                    Y: 128.56
                },
                {
                    X: '12:00',
                    Y: 118.57
                },
                {
                    X: '13:00',
                    Y: 134.0
                },
                {
                    X: '14:00',
                    Y: 140.89
                },
                {
                    X: '15:00',
                    Y: 112.57
                },
                {
                    X: '16:00',
                    Y: 128.24
                },
                {
                    X: '17:00',
                    Y: 118.0
                },
                {
                    X: '18:00',
                    Y: 134.24
                },
                {
                    X: '19:00',
                    Y: 140.58
                },
                {
                    X: '20:00',
                    Y: 112.54
                },
                {
                    X: '21:00',
                    Y: 128.0
                },
                {
                    X: '22:00',
                    Y: 118.0
                },
                {
                    X: '23:00',
                    Y: 134.89
                },
                {
                    X: '0:00',
                    Y: 140.26
                },
                {
                    X: '1:00',
                    Y: 128.89
                },
                {
                    X: '2:00',
                    Y: 118.87
                },
                {
                    X: '3:00',
                    Y: 134.0
                },
                {
                    X: '4:00',
                    Y: 180.0
                },
            ],
        };
        var graphdata3 = {
            linecolor: '#FF99CC',
            title: 'Wednesday',
            values: [{
                    X: '6:00',
                    Y: 230.0
                },
                {
                    X: '7:00',
                    Y: 210.0
                },
                {
                    X: '8:00',
                    Y: 214.0
                },
                {
                    X: '9:00',
                    Y: 234.0
                },
                {
                    X: '10:00',
                    Y: 247.25
                },
                {
                    X: '11:00',
                    Y: 218.56
                },
                {
                    X: '12:00',
                    Y: 268.57
                },
                {
                    X: '13:00',
                    Y: 274.0
                },
                {
                    X: '14:00',
                    Y: 280.89
                },
                {
                    X: '15:00',
                    Y: 242.57
                },
                {
                    X: '16:00',
                    Y: 298.24
                },
                {
                    X: '17:00',
                    Y: 208.0
                },
                {
                    X: '18:00',
                    Y: 214.24
                },
                {
                    X: '19:00',
                    Y: 214.58
                },
                {
                    X: '20:00',
                    Y: 211.54
                },
                {
                    X: '21:00',
                    Y: 248.0
                },
                {
                    X: '22:00',
                    Y: 258.0
                },
                {
                    X: '23:00',
                    Y: 234.89
                },
                {
                    X: '0:00',
                    Y: 210.26
                },
                {
                    X: '1:00',
                    Y: 248.89
                },
                {
                    X: '2:00',
                    Y: 238.87
                },
                {
                    X: '3:00',
                    Y: 264.0
                },
                {
                    X: '4:00',
                    Y: 270.0
                },
            ],
        };
        var graphdata4 = {
            linecolor: 'Random',
            title: 'Thursday',
            values: [{
                    X: '6:00',
                    Y: 300.0
                },
                {
                    X: '7:00',
                    Y: 410.98
                },
                {
                    X: '8:00',
                    Y: 310.0
                },
                {
                    X: '9:00',
                    Y: 314.0
                },
                {
                    X: '10:00',
                    Y: 310.25
                },
                {
                    X: '11:00',
                    Y: 318.56
                },
                {
                    X: '12:00',
                    Y: 318.57
                },
                {
                    X: '13:00',
                    Y: 314.0
                },
                {
                    X: '14:00',
                    Y: 310.89
                },
                {
                    X: '15:00',
                    Y: 512.57
                },
                {
                    X: '16:00',
                    Y: 318.24
                },
                {
                    X: '17:00',
                    Y: 318.0
                },
                {
                    X: '18:00',
                    Y: 314.24
                },
                {
                    X: '19:00',
                    Y: 310.58
                },
                {
                    X: '20:00',
                    Y: 312.54
                },
                {
                    X: '21:00',
                    Y: 318.0
                },
                {
                    X: '22:00',
                    Y: 318.0
                },
                {
                    X: '23:00',
                    Y: 314.89
                },
                {
                    X: '0:00',
                    Y: 310.26
                },
                {
                    X: '1:00',
                    Y: 318.89
                },
                {
                    X: '2:00',
                    Y: 518.87
                },
                {
                    X: '3:00',
                    Y: 314.0
                },
                {
                    X: '4:00',
                    Y: 310.0
                },
            ],
        };
        var Piedata = {
            linecolor: 'Random',
            title: 'Profit',
            values: [{
                    X: 'Monday',
                    Y: 50.0
                },
                {
                    X: 'Tuesday',
                    Y: 110.98
                },
                {
                    X: 'Wednesday',
                    Y: 70.0
                },
                {
                    X: 'Thursday',
                    Y: 204.0
                },
                {
                    X: 'Friday',
                    Y: 80.25
                },
                {
                    X: 'Saturday',
                    Y: 38.56
                },
                {
                    X: 'Sunday',
                    Y: 98.57
                },
            ],
        };
        $(function() {
            $('#Bargraph').SimpleChart({
                ChartType: 'Bar',
                toolwidth: '50',
                toolheight: '25',
                axiscolor: '#E6E6E6',
                textcolor: '#6E6E6E',
                showlegends: true,
                data: [graphdata4, graphdata3, graphdata2, graphdata1],
                legendsize: '140',
                legendposition: 'bottom',
                xaxislabel: 'Hours',
                title: 'Weekly Profit',
                yaxislabel: 'Profit in $',
            });
            $('#sltchartype').on('change', function() {
                $('#Bargraph').SimpleChart('ChartType', $(this).val());
                $('#Bargraph').SimpleChart('reload', 'true');
            });
            $('#Hybridgraph').SimpleChart({
                ChartType: 'Hybrid',
                toolwidth: '50',
                toolheight: '25',
                axiscolor: '#E6E6E6',
                textcolor: '#6E6E6E',
                showlegends: true,
                data: [graphdata4],
                legendsize: '140',
                legendposition: 'bottom',
                xaxislabel: 'Hours',
                title: 'Weekly Profit',
                yaxislabel: 'Profit in $',
            });
            $('#Linegraph').SimpleChart({
                ChartType: 'Line',
                toolwidth: '50',
                toolheight: '25',
                axiscolor: '#E6E6E6',
                textcolor: '#6E6E6E',
                showlegends: false,
                data: [graphdata4, graphdata3, graphdata2, graphdata1],
                legendsize: '140',
                legendposition: 'bottom',
                xaxislabel: 'Hours',
                title: 'Weekly Profit',
                yaxislabel: 'Profit in $',
            });
            $('#Areagraph').SimpleChart({
                ChartType: 'Area',
                toolwidth: '50',
                toolheight: '25',
                axiscolor: '#E6E6E6',
                textcolor: '#6E6E6E',
                showlegends: true,
                data: [graphdata4, graphdata3, graphdata2, graphdata1],
                legendsize: '140',
                legendposition: 'bottom',
                xaxislabel: 'Hours',
                title: 'Weekly Profit',
                yaxislabel: 'Profit in $',
            });
            $('#Scatterredgraph').SimpleChart({
                ChartType: 'Scattered',
                toolwidth: '50',
                toolheight: '25',
                axiscolor: '#E6E6E6',
                textcolor: '#6E6E6E',
                showlegends: true,
                data: [graphdata4, graphdata3, graphdata2, graphdata1],
                legendsize: '140',
                legendposition: 'bottom',
                xaxislabel: 'Hours',
                title: 'Weekly Profit',
                yaxislabel: 'Profit in $',
            });
            $('#Piegraph').SimpleChart({
                ChartType: 'Pie',
                toolwidth: '50',
                toolheight: '25',
                axiscolor: '#E6E6E6',
                textcolor: '#6E6E6E',
                showlegends: true,
                showpielables: true,
                data: [Piedata],
                legendsize: '250',
                legendposition: 'right',
                xaxislabel: 'Hours',
                title: 'Weekly Profit',
                yaxislabel: 'Profit in $',
            });

            $('#Stackedbargraph').SimpleChart({
                ChartType: 'Stacked',
                toolwidth: '50',
                toolheight: '25',
                axiscolor: '#E6E6E6',
                textcolor: '#6E6E6E',
                showlegends: true,
                data: [graphdata3, graphdata2, graphdata1],
                legendsize: '140',
                legendposition: 'bottom',
                xaxislabel: 'Hours',
                title: 'Weekly Profit',
                yaxislabel: 'Profit in $',
            });

            $('#StackedHybridbargraph').SimpleChart({
                ChartType: 'StackedHybrid',
                toolwidth: '50',
                toolheight: '25',
                axiscolor: '#E6E6E6',
                textcolor: '#6E6E6E',
                showlegends: true,
                data: [graphdata3, graphdata2, graphdata1],
                legendsize: '140',
                legendposition: 'bottom',
                xaxislabel: 'Hours',
                title: 'Weekly Profit',
                yaxislabel: 'Profit in $',
            });
        });
    </script>
    <!-- //for index page weekly sales java script -->
    <!-- Bootstrap Core JavaScript -->
    <script src="{{ asset('backend/js/bootstrap.js') }}"></script>
    <!-- //Bootstrap Core JavaScript -->
    <script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.bootcss.com/toastr.js/latest/js/toastr.min.js"></script>
    <script src="https://cdn.ckeditor.com/ckeditor5/39.0.1/classic/ckeditor.js"></script>
    <script async src="https://www.google.com/recaptcha/api.js">


    <script>
        ClassicEditor.create(document.querySelector('#description'))
        ClassicEditor.create(document.querySelector('#contact'))
        ClassicEditor.create(document.querySelector('#terms_of_use'))
        ClassicEditor.create(document.querySelector('#privacy_policy'))
        ClassicEditor.create(document.querySelector('#copyright_claims'))
        ClassicEditor.create(document.querySelector('#about_us'))
    </script>

    <script>
        var typingTimer;
        var doneTypingInterval = 1000;  // Thời gian chờ sau khi ngừng nhập (1 giây)

        $(document).ready(function () {
            $('#searchInput').on('input', function () {
                clearTimeout(typingTimer);
                var searchKeyword = $(this).val();

                typingTimer = setTimeout(function () {
                    // Kiểm tra xem có từ khóa tìm kiếm không
                    if (searchKeyword === "") {
                        // Nếu không có từ khóa, ẩn kết quả tìm kiếm
                        $('#searchResults').hide();
                    } else {
                        // Nếu có từ khóa, hiển thị kết quả tìm kiếm
                        $('#searchResults').show();

                        // Gửi yêu cầu Ajax khi người dùng nhập từ khóa
                        $.ajax({
                            url: "{{ route('searchMovies') }}", // Thay đổi route tương ứng của bạn
                            method: 'GET',
                            data: {
                                search: searchKeyword
                            },
                            success: function (response) {
                                // Hiển thị kết quả trả về trong div searchResults
                                $('#searchResults').html(response);
                            }
                        });
                    }
                }, doneTypingInterval);
            });
        });
    </script>

    <script type="text/javascript">
        $('.show_video').click(function() {
            var movie_id = $(this).data('movie_video_id');
            var episode_id = $(this).data('video_episode');
            // var _token = $('input[name="_token"]').val();
            // alert(movie_id);
            // alert(episode_id);
            $.ajax({
                url: "{{ route('watch-video') }}",
                method: "POST",
                dataType: "json",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: {
                    movie_id: movie_id,
                    episode_id: episode_id
                    // _token: _token
                },
                success: function(data) {
                    $('#video_title').html(data.video_title);
                    $('#video_link').html(data.video_link);
                    $('#video_desc').html(data.video_desc);
                    $('#videoModal').modal('show');
                }
            });
        })
    </script>


    <script type="text/javascript">
        $('.leech_details_episode').click(function() {
            var slug = $(this).data('movie_slug');
            $.ajax({
                url: "{{ route('leech-detail-episode') }}",
                method: "POST",
                dataType: "json",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: {
                    slug: slug,
                },
                success: function(data) {
                    $('#episode_title').html(data.episode_title);
                    var contentHtml = '';
                    $.each(data.content_episode_title, function(index, episode) {
                        contentHtml += '<p>Tập: ' + episode.name + '</p>';
                        contentHtml += '<input type="text" id="episode_link_embed_input" class="form-control" value="' + episode.link_embed + '" readonly>';
                    });
                    $('#content_episode_title').html(contentHtml);

                    // Create a hidden input field for CSRF token
                    var csrfToken = $('meta[name="csrf-token"]').attr('content');
                    var csrfInput = '<input type="hidden" name="_token" value="' + csrfToken + '">';
                    
                    // Append the CSRF input to the form
                    var form = data.button_save_episode.replace('<p id="button_save_episode">', '<p id="button_save_episode">' + csrfInput);
                    
                    $('#button_save_episode').html(form);
                    $('#episode').modal('show');
                }
            });
        })
    </script>

    <script type="text/javascript">
        $('.select-movie').change(function() {
            var movieId = $(this).val();
            $.ajax({
                url: "{{ route('select-movie') }}",
                method: "GET",
                data: {
                    movieId: movieId
                },
                success: function(data) {
                    $('#episode-list').html(data);
                }
            });
        });
    </script>

    <script type="text/javascript">
        $('.select-year').change(function() {
            var year = $(this).find(':selected').val();
            var id_phim = $(this).attr('id');
            var _token = $('input[name="_token"]').val();

            $.ajax({
                url: "{{ url('/update-year-phim') }}",
                method: "POST",
                data: {
                    year: year,
                    id_phim: id_phim,
                    _token: _token
                },
                success: function() {
                    alert('Thay đổi năm phim ' + year + ' thành công ');
                }

            });
        })
    </script>

    <script type="text/javascript">
        $('.select-hot').change(function() {
            var movie_hot = $(this).find(':selected').val();
            var id_phim = $(this).attr('id');
            var _token = $('input[name="_token"]').val();

            if (movie_hot == '0') {
                var text = 'Không hot';
            } else if (movie_hot == '1') {
                var text = 'Hot';
            }
            $.ajax({
                url: "{{ url('/update-moviehot') }}",
                method: "POST",
                data: {
                    movie_hot: movie_hot,
                    id_phim: id_phim,
                    _token: _token
                },
                success: function() {
                    // toastr.success('Đã thay đổi phim thành ' + text);
                    alert('Đã thay đổi phim thành ' + text);
                }

            });
        })
    </script>

    <script type="text/javascript">
        $('.select-season').change(function() {
            var season = $(this).find(':selected').val();
            var id_phim = $(this).attr('id');
            var _token = $('input[name="_token"]').val();

            $.ajax({
                url: "{{ url('/update-season-phim') }}",
                method: "POST",
                data: {
                    season: season,
                    id_phim: id_phim,
                    _token: _token
                },
                success: function() {
                    alert('Thay đổi season ' + season + ' thành công ');
                }

            });
        })
    </script>

    <script type="text/javascript">
        $('.select-topview').change(function() {
            var topview = $(this).find(':selected').val();
            var id_phim = $(this).attr('id');
            var _token = $('input[name="_token"]').val();

            if (topview == 0) {
                var text = 'Ngày';
            } else if (topview == 1) {
                var text = 'Tuần';
            } else {
                var text = 'Tháng';
            }
            $.ajax({
                url: "{{ url('/update-topview-phim') }}",
                method: "POST",
                data: {
                    topview: topview,
                    id_phim: id_phim,
                    _token: _token
                },
                success: function() {
                    alert('Thay đổi phim theo topview ' + text + ' thành công ');
                }

            });
        })
    </script>

    <script type="text/javascript">
        $(document).ready(function() {
            $('#tablemovie').DataTable();
        });

        function ChangeToSlug() {

            var slug;

            //Lấy text từ thẻ input title
            slug = document.getElementById("slug").value;
            slug = slug.toLowerCase();
            //Đổi ký tự có dấu thành không dấu
            slug = slug.replace(/á|à|ả|ạ|ã|ă|ắ|ằ|ẳ|ẵ|ặ|â|ấ|ầ|ẩ|ẫ|ậ/gi, 'a');
            slug = slug.replace(/é|è|ẻ|ẽ|ẹ|ê|ế|ề|ể|ễ|ệ/gi, 'e');
            slug = slug.replace(/i|í|ì|ỉ|ĩ|ị/gi, 'i');
            slug = slug.replace(/ó|ò|ỏ|õ|ọ|ô|ố|ồ|ổ|ỗ|ộ|ơ|ớ|ờ|ở|ỡ|ợ/gi, 'o');
            slug = slug.replace(/ú|ù|ủ|ũ|ụ|ư|ứ|ừ|ử|ữ|ự/gi, 'u');
            slug = slug.replace(/ý|ỳ|ỷ|ỹ|ỵ/gi, 'y');
            slug = slug.replace(/đ/gi, 'd');
            //Xóa các ký tự đặt biệt
            slug = slug.replace(/\`|\~|\!|\@|\#|\||\$|\%|\^|\&|\*|\(|\)|\+|\=|\,|\.|\/|\?|\>|\<|\'|\"|\:|\;|_/gi, '');
            //Đổi khoảng trắng thành ký tự gạch ngang
            slug = slug.replace(/ /gi, "-");
            //Đổi nhiều ký tự gạch ngang liên tiếp thành 1 ký tự gạch ngang
            //Phòng trường hợp người nhập vào quá nhiều ký tự trắng
            slug = slug.replace(/\-\-\-\-\-/gi, '-');
            slug = slug.replace(/\-\-\-\-/gi, '-');
            slug = slug.replace(/\-\-\-/gi, '-');
            slug = slug.replace(/\-\-/gi, '-');
            //Xóa các ký tự gạch ngang ở đầu và cuối
            slug = '@' + slug + '@';
            slug = slug.replace(/\@\-|\-\@|\@/gi, '');
            //In slug ra textbox có id “slug”
            document.getElementById('convert_slug').value = slug;
        }
    </script>
    <script type="text/javascript">
        $('.order_position').sortable({
            placeholder: 'ui-state-highlight',
            update: function(event, ui) {
                var array_id = [];
                $('.order_position tr').each(function() {
                    array_id.push($(this).attr('id'));
                })
                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    url: "{{ route('resorting') }}",
                    method: 'POST',
                    data: {
                        array_id: array_id
                    },
                    success: function(data) {
                        alert('Cập nhật thành công ');
                    }
                })
            }
        })
    </script>


    {{-- thay doi du lieu bang ajax --}}
    {{-- <script type="text/javascript">
        $('.category_chooose').change(function() {
            var category_id = $(this).val();
            var movie_id = $(this).attr('id');
            $.ajax({
                url: "{{ route('category-choose') }}",
                method: "GET",
                data: {
                    category_id: category_id,
                    movie_id: movie_id
                    // _token: _token
                },
                success: function(data) {
                    alert('Thay đổi danh mục thành công');
                }

            });
        })
    </script> --}}


    <script type="text/javascript">
        $('.country_chooose').change(function() {
            var country_id = $(this).val();
            var movie_id = $(this).attr('id');
            $.ajax({
                url: "{{ route('country-choose') }}",
                method: "GET",
                data: {
                    country_id: country_id,
                    movie_id: movie_id
                    // _token: _token
                },
                success: function(data) {
                    alert('Thay đổi country thành công');
                }

            });
        })
    </script>
</body>

</html>
