<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="utf-8" />
    <meta content="width=device-width,initial-scale=1.0, maximum-scale=1.0, user-scalable=no" name="viewport" />
    <meta name="theme-color" content="#234556">
    <meta http-equiv="Content-Language" content="vi" />
    <meta content="VN" name="geo.region" />
    <meta name="DC.language" scheme="utf-8" content="vi" />
    <meta name="language" content="Việt Nam">


    <link rel="shortcut icon" href="{{ asset('uploads/logo/' . $info->logo) }}" type="image/x-icon" />
    <meta name="revisit-after" content="1 days" />
    <meta name='robots' content='index, follow, max-image-preview:large, max-snippet:-1, max-video-preview:-1' />
    <title>{{ $meta_title }}</title>
    <meta name="description" content="{{ $meta_description }}" />
    <link rel="canonical" href="{{ Request::url() }}">
    <link rel="next" href="" />
    <meta property="og:locale" content="vi_VN" />
    <meta property="og:title" content="{{ $meta_title }}" />
    <meta property="og:description" content="{{ $meta_description }}" />
    <meta property="og:url" content="{{ Request::url() }}" />
    <meta property="og:site_name" content="{{ $meta_title }}" />

    <meta property="og:image" content="{{ $meta_image }}" />
    <meta property="og:image:width" content="300" />
    <meta property="og:image:height" content="55" />

    {{-- twitter meta tag --}}
    <meta name="twitter:card" content="summary_large_image" />
    <meta name="twitter:site" content="{{ Request::url() }}" />
    <meta name="twitter:title" content="{{ $meta_title }}" />
    <meta name="twitter:description" content="{{ $meta_description }}" />
    <meta name="twitter:image" content="{{ $meta_image }}" />

    {{-- facebook meta tag html --}}
    <meta property="og:url" content="{{ Request::url() }}" />
    <meta property="og:title" content="{{ $meta_title }}" />
    <meta property="og:description" content="{{ $meta_description }}" />
    <meta property="og:image" content="{{ $meta_image }}" />

    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">

    <link rel='dns-prefetch' href='//s.w.org' />

    <link rel='stylesheet' id='bootstrap-css' href='{{ asset('css/bootstrap.min.css?ver=5.7.2') }}' media='all' />
    <link rel='stylesheet' id='style-css' href='{{ asset('css/style.css?ver=5.7.2') }}' media='all' />
    <link rel='stylesheet' id='wp-block-library-css' href='{{ asset('css/style.min.css?ver=5.7.2') }}'
        media='all' />
    <script type='text/javascript' src='{{ asset('js/jquery.min.js?ver=5.7.2') }}' id='halim-jquery-js'></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script type='text/javascript' src="https://code.jquery.com/jquery-1.10.1.min.js"></script>

    <style type="text/css" id="wp-custom-css">
        .textwidget p a img {
            width: 100%;
        }

        #header .site-title {
            background: url({{ asset('uploads/logo/' . $info->logo) }}) no-repeat top left;
            background-size: contain;
            text-indent: -9999px;
        }

        .dark-mode {
            background-color: black;
            color: white;
        }
    </style>
</head>

<body class="home blog halimthemes halimmovies" data-masonry="">
    <header id="header">
        <div class="container">
            <div class="row" id="headwrap">
                <div class="col-md-3 col-sm-6 slogan">
                    <p class="site-title"><a class="logo" href="" title="phim hay ">Phim Hay</p>
                    </a>
                </div>
                <div class="col-md-5 col-sm-6 halim-search-form hidden-xs">
                    <div class="header-nav">
                        <div class="col-xs-12">
                            <style type="text/css">
                                ul#result {
                                    position: absolute;
                                    z-index: 9999;
                                    background: #1b2d3c;
                                    width: 94%;
                                    padding: 10px;
                                    margin: 1px;
                                }
                            </style>
                            <div class="form-group form-timkiem">
                                <div class="input-group col-xs-12">
                                    <form action="{{ route('search') }}" method="GET">
                                        <input id="timkiem" name="search" type="text" class="form-control"
                                            placeholder="Tìm kiếm..." autocomplete="off">
                                        <button class="btn btn-primary">Tìm kiếm</button>
                                    </form>
                                </div>
                            </div>
                            <ul class="list-group" id="result" style="display: none;"></ul>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 hidden-xs">
                    <a href="{{ route('profile') }}">
                        <div id="get-bookmark" class="box-shadow"><svg xmlns="http://www.w3.org/2000/svg"
                                width="16" height="16" fill="currentColor" class="bi bi-bookmarks"
                                viewBox="0 0 16 16">
                                <path
                                    d="M2 4a2 2 0 0 1 2-2h6a2 2 0 0 1 2 2v11.5a.5.5 0 0 1-.777.416L7 13.101l-4.223 2.815A.5.5 0 0 1 2 15.5V4zm2-1a1 1 0 0 0-1 1v10.566l3.723-2.482a.5.5 0 0 1 .554 0L11 14.566V4a1 1 0 0 0-1-1H4z" />
                                <path
                                    d="M4.268 1H12a1 1 0 0 1 1 1v11.768l.223.148A.5.5 0 0 0 14 13.5V2a2 2 0 0 0-2-2H6a2 2 0 0 0-1.732 1z" />
                            </svg>
                            <span> Bookmarks</span>
                            <span class="count"></span>
                        </div>
                    </a>
                    @if (auth('customer')->check())
                        {{ auth('customer')->user()->name }}
                    @endif

                    @if (!Auth::guard('customer')->check())
                        <a href="{{ route('redirectToLogin') }}">
                            <div id="get-bookmark" class="box-shadow">
                                <img width="20"
                                    src="https://img.icons8.com/external-flat-icons-inmotus-design/67/external-login-man-and-woman-flat-icons-inmotus-design.png"
                                    alt="external-login-man-and-woman-flat-icons-inmotus-design" title="Login" />
                            </div>
                        </a>
                    @else
                        <div id="get-bookmark" class="box-shadow">
                            <a href="{{ route('logout') }}">
                                <img width="20" src="{{ asset('uploads/logo/logout.svg') }}" alt="logout"
                                    title="Logout" />
                            </a>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </header>
    <div class="navbar-container">
        <div class="container">
            <nav class="navbar halim-navbar main-navigation" role="navigation" data-dropdown-hover="1">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle collapsed pull-left" data-toggle="collapse"
                        data-target="#halim" aria-expanded="false">
                        <span class="sr-only">Menu</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <button type="button" class="navbar-toggle collapsed pull-right expand-search-form"
                        data-toggle="collapse" data-target="#search-form" aria-expanded="false">
                        <span class="hl-search" aria-hidden="true"></span>
                    </button>
                    <button type="button" class="navbar-toggle collapsed pull-right get-bookmark-on-mobile">
                        Bookmarks<i class="hl-bookmark" aria-hidden="true"></i>
                        <span class="count"></span>
                    </button>
                    <button type="button" class="navbar-toggle collapsed pull-right get-locphim-on-mobile">
                        <a href="javascript:;" id="expand-ajax-filter" style="color: #ffed4d;">Lọc <i
                                class="fas fa-filter"></i></a>
                    </button>
                </div>
                <div class="collapse navbar-collapse" id="halim">
                    <div class="menu-menu_1-container">
                        <ul id="menu-menu_1" class="nav navbar-nav navbar-left">
                            <li class="current-menu-item active"><a title="Trang Chủ"
                                    href="{{ route('homepage') }}">Trang Chủ</a>
                            </li>
                            @foreach ($category_home as $key => $cate)
                                <li class="mega"><a title="{{ $cate->title }}"
                                        href="{{ route('category', $cate->slug) }}">{{ $cate->title }}</a>
                                </li>
                            @endforeach
                            <li class="mega dropdown">
                                @php
                                    $now = new DateTime();
                                    $currentYear = $now->format('Y');
                                    $startYear = $currentYear - 17;
                                    $endYear = $currentYear + 3;
                                @endphp
                                <a title="Năm" href="#" data-toggle="dropdown" class="dropdown-toggle"
                                    aria-haspopup="true">Năm <span class="caret"></span></a>
                                <ul role="menu" class="dropdown-menu">
                                    @for ($year = $startYear; $year <= $endYear; $year++)
                                        <li><a title="{{ $year }}"
                                                href="{{ url('year/' . $year) }}">{{ $year }}</a></li>
                                    @endfor
                                </ul>
                            </li>
                            <li class="mega dropdown">
                                <a title="Thể Loại" href="#" data-toggle="dropdown" class="dropdown-toggle"
                                    aria-haspopup="true">Thể Loại <span class="caret"></span></a>
                                <ul role="menu" class=" dropdown-menu">
                                    @foreach ($genre_home as $key => $gen)
                                        <li><a title="{{ $gen->title }}"
                                                href="{{ route('genre', $gen->slug) }}">{{ $gen->title }}</a></li>
                                    @endforeach
                                </ul>
                            </li>
                            <li class="mega dropdown">
                                <a title="Quốc Gia" href="#" data-toggle="dropdown" class="dropdown-toggle"
                                    aria-haspopup="true">Quốc Gia <span class="caret"></span></a>
                                <ul role="menu" class=" dropdown-menu">
                                    @foreach ($country_home as $key => $count)
                                        <li><a title="{{ $count->title }}"
                                                href="{{ route('country', $count->slug) }}">{{ $count->title }}</a>
                                        </li>
                                    @endforeach
                                </ul>
                            </li>
                        </ul>
                    </div>
                    <ul class="nav navbar-nav navbar-left" style="background:#000;">
                        <li><a href="#" onclick="locphim()" style="color: #ffed4d;">Lọc Phim</a></li>
                    </ul>
                </div>
            </nav>
            <div class="collapse navbar-collapse" id="search-form">
                <div id="mobile-search-form" class="halim-search-form"></div>
            </div>
            <div class="collapse navbar-collapse" id="user-info">
                <div id="mobile-user-login"></div>
            </div>
        </div>
    </div>
    </div>

    <div class="container">
        <div class="row fullwith-slider"></div>
    </div>
    <div class="container">
        @yield('content')
        @include('pages.include.banner')
    </div>
    <div class="clearfix"></div>
    <footer id="footer" class="clearfix">
        <div class="container">
            <div class="row">
                <div class="col-md-3 col-sm-6">
                    <div class="footer-info-single">
                        <h2 class="title">Phim mới</h2>
                        <ul class="list-unstyled">
                            <li style="display: grid;">
                                @foreach ($category_home as $key => $cate)
                                    <a style="margin-bottom: 10px;" href="{{ route('category', $cate->slug) }}"
                                        title="{{ $cate->title }}"><i class="fa fa-angle-double-right"></i>
                                        {{ $cate->title }}</a>
                                @endforeach
                            </li>
                        </ul>
                    </div>
                </div>
                <style>
                    .container-page {
                        display: flex;
                        justify-content: center;
                        align-items: flex-start;
                        min-height: 100vh;
                    }

                    .static-page {
                        background: #fff;
                        color: #333;
                        border-radius: 5px;
                        margin: 20px;
                        padding: 20px;
                        max-width: auto;
                        width: 100%;
                    }
                </style>
                <div class="col-md-3 col-sm-6">
                    <div class="footer-info-single">
                        <h2 class="title">Phim hot</h2>
                        <ul class="list-unstyled">
                            <li><a href="{{ route('about-us') }}" title=""><i
                                        class="fa fa-angle-double-right"></i> Về chúng tôi</a></li>
                            <li><a href="{{ route('homepage') }}" title=""><i
                                        class="fa fa-angle-double-right"></i> Phim mới</a></li>
                            <li><a href="{{ url('sitemap.xml') }}" title=""><i
                                        class="fa fa-angle-double-right"></i> Sitemap</a></li>
                        </ul>
                    </div>
                </div>

                <div class="col-md-3 col-sm-6">
                    <div class="footer-info-single">
                        <h2 class="title">Trợ giúp</h2>
                        <ul class="list-unstyled">
                            <li><a href="" title=""><i class="fa fa-angle-double-right"></i> Hỏi đáp</a>
                            </li>
                            <li><a href="{{ route('contact') }}" title=""><i
                                        class="fa fa-angle-double-right"></i> Liên hệ</a></li>
                            <li><a href="" title=""><i class="fa fa-angle-double-right"></i> Tin tức</a>
                            </li>
                        </ul>
                    </div>
                </div>

                <div class="col-md-3 col-sm-6">
                    <div class="footer-info-single">
                        <h2 class="title">Thông tin</h2>
                        <ul class="list-unstyled">
                            <li><a href="{{ route('terms-of-use') }}" title=""><i
                                        class="fa fa-angle-double-right"></i> Điều khoản sử dụng</a></li>
                            <li><a href="{{ route('privacy-policy') }}" title=""><i
                                        class="fa fa-angle-double-right"></i> Chính sách riêng tư</a></li>
                            <li><a href="{{ route('copyright-claims') }}" title=""><i
                                        class="fa fa-angle-double-right"></i> Khiếu nại bản quyền</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>

        <section class="copyright">
            <div class="container">
                <div class="row">
                    <div class="col-sm-6">
                        <p>Copyright © 2023. Your Company.</p>
                    </div>
                    <div class="col-sm-6"></div>
                </div>
            </div>
        </section>
    </footer>
    <div id='easy-top'></div>

    <script type='text/javascript' src='{{ asset('js/bootstrap.min.js?ver=5.7.2') }}' id='bootstrap-js'></script>
    <script type='text/javascript' src='{{ asset('js/owl.carousel.min.js?ver=5.7.2') }}' id='carousel-js'></script>
    <script type='text/javascript' src='{{ asset('js/halimtheme-core.min.js?ver=1626273138') }}' id='halim-init-js'>
    </script>

    <div id="fb-root"></div>
    <script async defer crossorigin="anonymous"
        src="https://connect.facebook.net/vi_VN/sdk.js#xfbml=1&version=v14.0&appId=957633844825401&autoLogAppEvents=1"
        nonce="iCRKOgCO"></script>


    {{-- <script style="text/javascript">
        $(window).on('load', function() {
            $('#banner_quangcao').modal('show');
        });
    </script> --}}

    <script>
        $(document).ready(function() {
            // Hover function for individual episodes
            $(".episode-link").hover(
                function() {
                    $(this).addClass("active");
                },
                function() {
                    $(this).removeClass("active");
                }
            );
        });
    </script>

    <script style="text/javascript">
        setTimeout(function(data) {
            var link = $('#myTab li:first-child a').tab('show')
            if (link) {
                link.click();
            }
            //0.01-second delay
        }, 10);
    </script>

    <script style="text/javascript">
        $(".watch_trailer").click(function(e) {
            e.preventDefault();
            var aid = $(this).attr("href");
            $('html, body').animate({
                scrollTop: $(aid).offset().top
            }, 'slow');
        })
    </script>

    <script type="text/javascript">
        // $(document).ready(function() {

        //     $('#timkiem').keyup(function() {
        //         $('#result').html('');
        //         var search = $('#timkiem').val();
        //         if (search != '') {
        //             var expression = new RegExp(search, "i");
        //             $.getJSON('json/movies.json', function(data) {
        //                 $.each(data, function(key, value) {
        //                     if (value.title.search(expression) != -1) {
        //                         $('#result').css('display', 'inherit');
        //                         var imageSrc = value.image.substring(0, 4) === 'http' ?
        //                             value.image : 'uploads/movie/' + value.image;
        //                         $('#result').append(
        //                             '<li class="list-group-item" style="cursor: pointer">' +
        //                             '<img height="40" width="40" src="' + imageSrc +
        //                             '">' +
        //                             value.title +
        //                             '</li>'
        //                         );
        //                     }
        //                 });
        //             });
        //         } else {
        //             $('#result').css('display', 'none');
        //         }
        //     });

        //     $('#result').on('click', 'li', function() {
        //         var click_text = $(this).text().split('|');
        //         $('#timkiem').val($.trim(click_text[0]));
        //         $('#result').html('');
        //         $('#result').css('display', 'none');
        //     });
        // })
    </script>

    <script type="text/javascript">
        $('.filter-sidebar').click(function() {
            var href = $(this).attr('href');
            var _token = $('input[name="_token"]').val();

            if (href == '#ngay') {
                var value = 0;
            } else if (href == '#tuan') {
                var value = 1;
            } else {
                var value = 2;
            }
            $.ajax({
                url: "/filter-topview-phim",
                method: "POST",
                data: {
                    value: value,
                    _token: _token
                },
                success: function(data) {
                    $('#show' + value).html(data);
                }
            });
        })
    </script>

    <script type="text/javascript">
        function remove_background(movie_id) {
            for (var count = 1; count <= 5; count++) {
                $('#' + movie_id + '-' + count).css('color', '#ccc');
            }
        }
        //hover chuot danh gia sao
        $(document).on('mouseenter', '.rating', function() {
            var index = $(this).data("index");
            var movie_id = $(this).data('movie_id');
            remove_background(movie_id);
            for (var count = 1; count <= index; count++) {
                $('#' + movie_id + '-' + count).css('color', '#ffcc00');
            }
        });
        //nha chuot khong danh gia
        $(document).on('mouseleave', '.rating', function() {
            var index = $(this).data("index");
            var movie_id = $(this).data('movie_id');
            var rating = $(this).data("rating");
            remove_background(movie_id);

            for (var count = 1; count <= rating; count++) {
                $('#' + movie_id + '-' + count).css('color', '#ffcc00');
            }
        });

        // click danh gia sao
        $(document).on('click', '.rating', function() {
            var index = $(this).data("index");
            var movie_id = $(this).data('movie_id');
            var _token = $('input[name="_token"]').val();

            $.ajax({
                url: "/insert-rating",
                method: 'POST',
                data: {
                    index: index,
                    movie_id: movie_id,
                    _token: _token
                },
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function(data) {
                    if (data == 'done') {
                        alert("Bạn đã đánh giá " + index + " trên 5");
                        // Update số đánh giá và điểm đánh giá hiển thị trên trang
                        $('.rating span').html('(' + index + 'đ/' + data.reviews + 'lượt)');
                    } else if (data == 'exist') {
                        alert("Bạn đã đánh giá phim này rồi, cảm ơn bạn nhé");
                    } else {
                        alert("Lỗi đánh giá");
                    }
                }
            });
        });
    </script>

    <!-- Google tag (gtag.js) -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=G-BYZWLDM18S"></script>
    <script>
        window.dataLayer = window.dataLayer || [];

        function gtag() {
            dataLayer.push(arguments);
        }
        gtag('js', new Date());

        gtag('config', 'G-BYZWLDM18S');
    </script>

    <!-- Messenger Plugin chat Code -->
    <div id="fb-root"></div>

    <!-- Your Plugin chat code -->
    <div id="fb-customer-chat" class="fb-customerchat">
    </div>

    <script>
        var chatbox = document.getElementById('fb-customer-chat');
        chatbox.setAttribute("page_id", "108898418875113");
        chatbox.setAttribute("attribution", "biz_inbox");
    </script>

    <!-- Your SDK code -->
    <script>
        window.fbAsyncInit = function() {
            FB.init({
                xfbml: true,
                version: 'v18.0'
            });
        };

        (function(d, s, id) {
            var js, fjs = d.getElementsByTagName(s)[0];
            if (d.getElementById(id)) return;
            js = d.createElement(s);
            js.id = id;
            js.src = 'https://connect.facebook.net/vi_VN/sdk/xfbml.customerchat.js';
            fjs.parentNode.insertBefore(js, fjs);
        }(document, 'script', 'facebook-jssdk'));
    </script>

    <script>
        jQuery(document).ready(function($) {
            var owl = $('#halim_related_movies-2');
            owl.owlCarousel({
                loop: true,
                margin: 4,
                autoplay: true,
                autoplayTimeout: 4000,
                autoplayHoverPause: true,
                nav: true,
                navText: ['<i class="hl-down-open rotate-left"></i>',
                    '<i class="hl-down-open rotate-right"></i>'
                ],
                responsiveClass: true,
                responsive: {
                    0: {
                        items: 2
                    },
                    480: {
                        items: 3
                    },
                    600: {
                        items: 4
                    },
                    1000: {
                        items: 4
                    }
                }
            })
        });
    </script>

    <style>
        #overlay_mb {
            position: fixed;
            display: none;
            width: 100%;
            height: 100%;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-color: rgba(0, 0, 0, 0.7);
            z-index: 99999;
            cursor: pointer
        }

        #overlay_mb .overlay_mb_content {
            position: relative;
            height: 100%
        }

        .overlay_mb_block {
            display: inline-block;
            position: relative
        }

        #overlay_mb .overlay_mb_content .overlay_mb_wrapper {
            width: 600px;
            height: auto;
            position: relative;
            left: 50%;
            top: 50%;
            transform: translate(-50%, -50%);
            text-align: center
        }

        #overlay_mb .overlay_mb_content .cls_ov {
            color: #fff;
            text-align: center;
            cursor: pointer;
            position: absolute;
            top: 5px;
            right: 5px;
            z-index: 999999;
            font-size: 14px;
            padding: 4px 10px;
            border: 1px solid #aeaeae;
            background-color: rgba(0, 0, 0, 0.7)
        }

        #overlay_mb img {
            position: relative;
            z-index: 999
        }

        @media only screen and (max-width: 768px) {
            #overlay_mb .overlay_mb_content .overlay_mb_wrapper {
                width: 400px;
                top: 3%;
                transform: translate(-50%, 3%)
            }
        }

        @media only screen and (max-width: 400px) {
            #overlay_mb .overlay_mb_content .overlay_mb_wrapper {
                width: 310px;
                top: 3%;
                transform: translate(-50%, 3%)
            }
        }
    </style>

    <style>
        #overlay_pc {
            position: fixed;
            display: none;
            width: 100%;
            height: 100%;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-color: rgba(0, 0, 0, 0.7);
            z-index: 99999;
            cursor: pointer;
        }

        #overlay_pc .overlay_pc_content {
            position: relative;
            height: 100%;
        }

        .overlay_pc_block {
            display: inline-block;
            position: relative;
        }

        #overlay_pc .overlay_pc_content .overlay_pc_wrapper {
            width: 600px;
            height: auto;
            position: relative;
            left: 50%;
            top: 50%;
            transform: translate(-50%, -50%);
            text-align: center;
        }

        #overlay_pc .overlay_pc_content .cls_ov {
            color: #fff;
            text-align: center;
            cursor: pointer;
            position: absolute;
            top: 5px;
            right: 5px;
            z-index: 999999;
            font-size: 14px;
            padding: 4px 10px;
            border: 1px solid #aeaeae;
            background-color: rgba(0, 0, 0, 0.7);
        }

        #overlay_pc img {
            position: relative;
            z-index: 999;
        }

        @media only screen and (max-width: 768px) {
            #overlay_pc .overlay_pc_content .overlay_pc_wrapper {
                width: 400px;
                top: 3%;
                transform: translate(-50%, 3%);
            }
        }

        @media only screen and (max-width: 400px) {
            #overlay_pc .overlay_pc_content .overlay_pc_wrapper {
                width: 310px;
                top: 3%;
                transform: translate(-50%, 3%);
            }
        }
    </style>

    <style>
        .float-ck {
            position: fixed;
            bottom: 0px;
            z-index: 9
        }

        * html .float-ck

        /* IE6 position fixed Bottom */
            {
            position: absolute;
            bottom: auto;
            top: expression(eval (document.documentElement.scrollTop+document.docum entElement.clientHeight-this.offsetHeight-(parseInt(this.currentStyle.marginTop, 10)||0)-(parseInt(this.currentStyle.marginBottom, 10)||0)));
        }

        #hide_float_left a {
            background: #0098D2;
            padding: 5px 15px 5px 15px;
            color: #FFF;
            font-weight: 700;
            float: left;
        }

        #hide_float_left_m a {
            background: #0098D2;
            padding: 5px 15px 5px 15px;
            color: #FFF;
            font-weight: 700;
        }

        span.bannermobi2 img {
            height: 70px;
            width: 300px;
        }

        #hide_float_right a {
            background: #01AEF0;
            padding: 5px 5px 1px 5px;
            color: #FFF;
            float: left;
        }
    </style>

    <script>
        function viewBookmarks() {
            if (localStorage.getItem('bookmarksMovies') !== null) {
                const bookmarksMovies = JSON.parse(localStorage.getItem('bookmarksMovies')) || [];

                $('#bookmarks').empty();

                for (let i = 0; i < bookmarksMovies.length; i++) {
                    const name = bookmarksMovies[i].name;
                    const nameEn = bookmarksMovies[i].nameEn;
                    const image = bookmarksMovies[i].image;
                    const url = bookmarksMovies[i].url;
                    const id = `bookmark_${i}`;

                    const articleHtml = `
                        <article class="col-md-3 col-sm-3 col-xs-6 thumb grid-item post-27021" id="${id}">
                            <div class="halim-item">
                                <a class="halim-thumb" href="${url}">
                                    <figure>
                                        <img class="lazy img-responsive" src="${image}" loading="lazy">
                                    </figure>
                                    <span class="status">
                                        ...
                                    </span>
                                    <span class="episode"><i class="fa fa-play" aria-hidden="true"></i>
                                        ...
                                    </span>
                                    <div class="icon_overlay"></div>
                                    <div class="halim-post-title-box">
                                        <div class="halim-post-title ">
                                            <p class="entry-title">${name}</p>
                                            <p class="original_title">${nameEn}</p>
                                            <a style="display: contents; cursor: pointer;" id="${i}" onclick="deleteMovieToBookmarks(this.id)">Xóa khỏi Bookmarks</a>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        </article>
                    `;
                    $('#bookmarks').append(articleHtml);
                }
            }
        }

        function deleteMovieToBookmarks(index) {
            if (confirm("Bạn có chắc chắn xóa phim trong bookmark không?")) {
                const bookmarksMovies = JSON.parse(localStorage.getItem('bookmarksMovies')) || [];

                bookmarksMovies.splice(index, 1);

                localStorage.setItem('bookmarksMovies', JSON.stringify(bookmarksMovies));

                $(`#bookmark_${index}`).remove();
            }
            updateMovieCount();
        }

        function updateMovieCount() {
            const bookmarksMovies = JSON.parse(localStorage.getItem('bookmarksMovies')) || [];

            const numberOfMovies = bookmarksMovies.length;
            const countSpan = document.querySelector('.count');

            if (numberOfMovies === 0) {
                countSpan.textContent = '0';
            } else {
                countSpan.textContent = numberOfMovies;
            }
        }

        function addMovieToBookmarks(movieId) {
            const id = movieId;
            const name = document.getElementById('BookmarksName_' + id).innerHTML;
            const nameEn = document.getElementById('BookmarksNameEn_' + id).innerHTML;
            const image = document.getElementById('BookmarksImage_' + id).src;
            const url = document.getElementById('BookmarksUrl_' + id).href;

            const bookmarksMovies = JSON.parse(localStorage.getItem('bookmarksMovies')) || [];
            const isMovieAdded = bookmarksMovies.some(movie => movie.id === movieId);

            if (isMovieAdded) {
                alert('Phim này đã được thêm vào bookmarks.');
            } else {
                const newMovie = {
                    id: movieId,
                    name: name,
                    nameEn: nameEn,
                    image: image,
                    url: url
                };
                bookmarksMovies.push(newMovie);

                localStorage.setItem('bookmarksMovies', JSON.stringify(bookmarksMovies));
                alert('Đã thêm phim' + name + ' vào bookmarks');
                updateMovieCount();
            }
        }
        window.addEventListener('DOMContentLoaded', function() {
            updateMovieCount();
            viewBookmarks();
        });
    </script>

    <!-- Start of LiveChat (www.livechat.com) code -->
    <script>
        window.__lc = window.__lc || {};
        window.__lc.license = 16785891;;
        (function(n, t, c) {
            function i(n) {
                return e._h ? e._h.apply(null, n) : e._q.push(n)
            }
            var e = {
                _q: [],
                _h: null,
                _v: "2.0",
                on: function() {
                    i(["on", c.call(arguments)])
                },
                once: function() {
                    i(["once", c.call(arguments)])
                },
                off: function() {
                    i(["off", c.call(arguments)])
                },
                get: function() {
                    if (!e._h) throw new Error("[LiveChatWidget] You can't use getters before load.");
                    return i(["get", c.call(arguments)])
                },
                call: function() {
                    i(["call", c.call(arguments)])
                },
                init: function() {
                    var n = t.createElement("script");
                    n.async = !0, n.type = "text/javascript", n.src = "https://cdn.livechatinc.com/tracking.js",
                        t.head.appendChild(n)
                }
            };
            !n.__lc.asyncInit && e.init(), n.LiveChatWidget = n.LiveChatWidget || e
        }(window, document, [].slice))
    </script>
    <noscript>
        <a href="https://www.livechat.com/chat-with/16785891/" rel="nofollow">Chat with us</a>, powered by
        <a href="https://www.livechat.com/?welcome" rel="noopener nofollow" target="_blank">LiveChat</a>
    </noscript>
    <!-- End of LiveChat code -->
</body>

</html>
