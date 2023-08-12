@extends('layout')
@section('content')
    <div class="row container" id="wrapper">
        <div class="halim-panel-filter">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-xs-6">
                        <div class="yoast_breadcrumb hidden-xs"><span><span><a
                                        href="{{ route('category', $movie->category->slug) }}">{{ $movie->category->title }}</a>
                                    » <span><a
                                            href="{{ route('country', $movie->country->slug) }}"">{{ $movie->country->title }}</a>
                                        » <span class="breadcrumb_last" aria-current="page">{{ $movie->title }}
                                        </span></span></span></span></div>
                    </div>
                </div>
            </div>
            <div id="ajax-filter" class="panel-collapse collapse" aria-expanded="true" role="menu">
                <div class="ajax"></div>
            </div>
        </div>
        <main id="main-contents" class="col-xs-12 col-sm-12 col-md-8">
            <section id="content" class="test">
                <div class="clearfix wrap-content">

                    <style type="text/css">
                        .iframe-phim iframe {
                            width: 100%;
                            height: 500px;
                        }
                    </style>
                    <div class="iframe-phim">
                        {!! $episode->linkphim !!}
                    </div>

                    <div class="button-watch">
                        @php
                            $current_url = Request::url();
                        @endphp
                        <ul class="halim-social-plugin col-xs-4 hidden-xs">
                            <li class="fb-like" data-href="{{ $current_url }}" data-width="" data-layout="standard"
                                data-action="like" data-size="small" data-share="true"></li>
                        </ul>
                        <ul class="col-xs-12 col-md-8">
                            <div id="autonext" class="btn-cs autonext">
                                <i class="icon-autonext-sm"></i>
                                <span><i class="hl-next"></i> Autonext: <span id="autonext-status">On</span></span>
                            </div>
                            <div id="explayer" class="hidden-xs"><i class="hl-resize-full"></i>
                                Expand
                            </div>
                            <div id="toggle-light"><i class="hl-adjust"></i>
                                Light Off
                                <i class="bi bi-eye"></i>
                            </div>
                            <div id="report" class="halim-switch"><i class="hl-attention"></i> Report</div>
                            <div class="luotxem">
                                <span>{{ $movie->view_count }}</span> lượt xem
                            </div>
                            <div class="luotxem">
                                <a class="visible-xs-inline" data-toggle="collapse" href="#moretool" aria-expanded="false"
                                    aria-controls="moretool"><i class="hl-forward"></i> Share</a>
                            </div>
                        </ul>
                    </div>
                    <div class="collapse" id="moretool">
                        <ul class="nav nav-pills x-nav-justified">
                            <li class="fb-like" data-href="" data-layout="button_count" data-action="like"
                                data-size="small" data-show-faces="true" data-share="true"></li>
                            <div class="fb-save" data-uri="" data-size="small"></div>
                        </ul>
                    </div>

                    <div class="clearfix"></div>
                    <div class="clearfix"></div>
                    <div class="title-block">
                        <a href="javascript:;" data-toggle="tooltip" title="Add to bookmark">
                            <div id="bookmark" class="bookmark-img-animation primary_ribbon" data-id="37976">
                                <div class="halim-pulse-ring"></div>
                            </div>
                        </a>
                        <div class="title-wrapper-xem full" style="display: contents;">
                            <h1 class="entry-title" style="font-size: 20px; font-weight: bold;">
                                @php
                                    $url = $_SERVER['REQUEST_URI'];
                                    $episode = substr($url, -1);
                                @endphp
                                <a title="{{ $movie->title }}" class="tl">{{ $movie->title }} -Tập:
                                    {{ $episode }}
                                </a>
                            </h1>
                        </div>
                    </div>
                    <div style="font-weight: bolder; font-size: 20px; margin: 5px 5px 10px">
                        <span> Đánh giá phim :</span>
                        <ul class="list-inline rating" title="Average rating" style="display: contents; font-weight: bold;">
                            @for ($count = 1; $count <= 5; $count++)
                                @php
                                    if ($count <= $rating) {
                                        $color = 'color:#ffcc00;';
                                    } else {
                                        $color = 'color:#ccc;';
                                    }
                                @endphp
                                <li title="Đánh giá sao" id="{{ $movie->id }}-{{ $count }}"
                                    data-index="{{ $count }}" data-movie_id="{{ $movie->id }}"
                                    data-rating="{{ $rating }}" class="rating"
                                    style="cursor: pointer; {{ $color }} font-size: 30px">
                                    &#9733;
                                </li>
                            @endfor
                            <li>({{ $rating }}đ/ {{ $reviews }}lượt)</li>
                        </ul>
                    </div>
                    <div class="clearfix"></div>
                    <div class="text-center">
                        <div id="halim-ajax-list-server"></div>
                    </div>
                    <div id="halim-list-server">
                        <ul class="nav nav-tabs" role="tablist">
                            <li role="presentation" class="active server-1"><a href="#server-0" aria-controls="server-0"
                                    role="tab" data-toggle="tab"><i class="hl-server"></i>
                                    @if ($movie->sub_movie == 0)
                                        VietSub
                                    @elseif ($movie->sub_movie == 1)
                                        Thuyết Minh
                                    @endif
                                </a>
                            </li>
                        </ul>
                        <div class="tab-content">
                            <div role="tabpanel" class="tab-pane active server-1" id="server-0">
                                <div class="halim-server">
                                    <ul class="halim-list-eps" style="display: grid;">
                                        @foreach ($servers as $server)
                                            @foreach ($episodes_movies as $episodes_movie)
                                                @if ($episodes_movie->server == $server->id)
                                                    <li class="halim-episode">
                                                        <span class="halim-btn halim-btn-2 halim-info-1-1 box-shadow">
                                                            {{ $server->title }}
                                                        </span>
                                                    </li>
                                                    <ul class="halim-list-eps">
                                                        @foreach ($episodes_list as $epi)
                                                            @if ($epi->server == $server->id)
                                                                @php
                                                                    // Kiểm tra nếu số tập hiện tại đang xem ($tapphim) trùng với số tập của $epi
                                                                    $isActive = $tapphim == $epi->episode;
                                                                @endphp
                                                                <a href="{{ url('xem-phim/' . $movie->slug . '/tap-' . $epi->episode) }}">
                                                                    <li class="halim-episode">
                                                                        <span
                                                                            class="halim-btn halim-btn-2 {{ $isActive ? 'active' : '' }} halim-info-1-1 box-shadow"
                                                                            title="Xem phim {{ $movie->title }} - Tập {{ $epi->episode }} - {{ $movie->name_en }} - vietsub + Thuyết Minh"
                                                                            data-h1="{{ $movie->title }} - tập {{ $epi->episode }}">
                                                                            {{ $epi->episode }}
                                                                        </span>
                                                                    </li>
                                                                </a>
                                                            @endif
                                                        @endforeach
                                                    </ul>
                                                @endif
                                            @endforeach
                                        @endforeach
                                    </ul>
                                    <div class="clearfix"></div>
                                </div>
                            </div>
                            
                        </div>
                    </div>
                    <div class="clearfix"></div>
                    <div class="section-bar clearfix">
                        <h2 class="section-title"><span style="color:#fbf29c">Bình Luận</span></h2>
                    </div>
                    <div class="entry-content htmlwrap clearfix">
                        <div class="video-item halim-entry-box">
                            @php
                                $current_url = Request::url();
                            @endphp
                            <article id="post-38424" class="cmt" style="background: antiquewhite;">
                                <div class="fb-comments" data-href="{{ $current_url }}" data-width="100%"
                                    data-numposts="10" data-colorscheme="dark"></div>
                            </article>
                        </div>
                    </div>
            </section>
            <section class="related-movies">
                <div id="halim_related_movies-2xx" class="wrap-slider">
                    <div class="section-bar clearfix">
                        <h3 class="section-title"><span>CÓ THỂ BẠN MUỐN XEM</span></h3>
                    </div>
                    <div id="halim_related_movies-2" class="owl-carousel owl-theme related-film">
                        @foreach ($related as $key => $hot)
                            <article class="thumb grid-item post-38498">
                                <div class="halim-item">
                                    @php
                                        $image_check = substr($hot->image, 0, 4);
                                    @endphp
                                    <a class="halim-thumb" href="{{ route('movie', $hot->slug) }}">
                                        <figure>
                                            @if ($image_check == 'http')
                                                <img class="lazy img-responsive" src="{{ $hot->image }}"
                                                    alt="" title="{{ $hot->title }}" loading="lazy">
                                            @else
                                                <img class="lazy img-responsive"
                                                    src="{{ asset('uploads/movie/' . $hot->image) }}" alt=""
                                                    title="{{ $hot->title }}" loading="lazy">
                                            @endif
                                        </figure>
                                        <span class="status">HD</span><span class="episode"><i class="fa fa-play"
                                                aria-hidden="true"></i>
                                            @if ($movie->sub_movie == 0)
                                                VietSub
                                            @elseif ($movie->sub_movie == 1)
                                                Thuyết Minh
                                            @endif
                                        </span>
                                        <div class="icon_overlay"></div>
                                        <div class="halim-post-title-box">
                                            <div class="halim-post-title ">
                                                <p class="entry-title">{{ $hot->title }}</p>
                                                <p class="original_title">{{ $hot->name_en }}</p>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                            </article>
                        @endforeach
                    </div>
                    <script>
                        $(document).ready(function($) {
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
                </div>
            </section>
        </main>
        {{-- SideBar --}}
        @include('pages.include.sidebar')
    </div>
@endsection
