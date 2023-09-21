@extends('layout')
@section('content')
    <div class="row container" id="wrapper">
        <div class="halim-panel-filter">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-xs-6-edit">
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb" style="margin-bottom: revert;">
                                <li class="breadcrumb-item"><a href="{{'/'}}">Xem phim</a></li>
                                <li class="breadcrumb-item"><a href="{{ route('category', $movie->category->slug) }}">{{ $movie->category->title }}</a></li>
                                <li class="breadcrumb-item"><a href="{{ route('country', $movie->country->slug) }}">{{ $movie->country->title }}</a></li>
                                <li class="breadcrumb-item active" aria-current="page">{{ $movie->title }}</li>
                            </ol>
                        </nav>
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

                    <div class="halim-movie-wrapper">
                        <div class="title-block">
                            <div id="bookmark" class="bookmark-img-animation primary_ribbon" data-id="38424">
                                <div class="halim-pulse-ring"></div>
                            </div>
                            <div class="title-wrapper" style="font-weight: bold;">
                                Bookmark
                            </div>
                        </div>
                        <div class="movie_info col-xs-12">
                            <div class="movie-poster col-md-3">
                                @php
                                    $current_url = Request::url();
                                    $image_check = substr(trim($movie->image ?? ''), 0, 4);
                                    $director = array_map('trim', explode(', ', $movie->director ?? ''));
                                    $cast_movie = array_map('trim', explode(', ', $movie->cast_movie ?? ''));
                                    $tags_movie = array_map('trim', explode(', ', $movie->tags_movie ?? ''));
                                @endphp
                                <img class="movie-thumb" src="{{ $image_check === 'http' ? $movie->image : asset('uploads/movie/' . $movie->image) }}" alt="{{ $movie->title }}">
                                @if ($movie->resolution != 5)
                                    @if ($episode_current_list > 0)
                                        <div class="bwa-content">
                                            <div class="loader"></div>
                                            <a href="{{ url('xem-phim/' . $movie->slug . '/tap-' . $episode_tapdau->episode) }}" class="bwac-btn">
                                                <i class="fa fa-play"></i>
                                            </a>
                                        </div>
                                    @endif
                                @else
                                    <a href="#watch_trailer" style="display: block;" class="btn btn-primary watch_trailer">Xem Trailer</a>
                                @endif
                            </div>
                            <div class="film-poster col-md-9">
                                <h1 class="movie-title title-1"
                                    style="display:block;line-height:35px;margin-bottom: -14px;color: #ffed4d;text-transform: uppercase;font-size: 18px;">
                                    {{ $movie->title }}</h1>
                                <h2 class="movie-title title-2" style="font-size: 12px;">{{ $movie->name_en }}</h2>
                                <ul class="list-info-group">
                                    <li class="list-info-group-item"><span>Trạng Thái</span> : <span class="quality">{{ $resolutions[$movie->resolution] }}</span>
                                        @if ($movie->resolution != 5)
                                            <span class="episode">
                                                @if ($movie->sub_movie == 0)
                                                    VietSub
                                                @elseif ($movie->sub_movie == 1)
                                                    Thuyết Minh
                                                @endif

                                                @if ($movie->season != 0)
                                                    - Season {{ $movie->season }}
                                                @endif
                                            </span>
                                        @endif
                                    </li>

                                    @if (isset($movie->score_imdb))
                                        <li class="list-info-group-item">
                                            <span>Điểm IMDb</span> : <span class="imdb">{{ $movie->score_imdb }}</span>
                                        </li>
                                    @endif

                                    <li class="list-info-group-item"><span>Thời lượng</span> :
                                        @if ($movie->resolution != 5)
                                            {{ $movie->duration_movie }}
                                        @else
                                            Phim sắp chiếu
                                        @endif
                                    </li>

                                    @if ($movie->thuocphim == 'phimbo' && $movie->resolution != 5)
                                        <li class="list-info-group-item">
                                            <span>Tập phim mới nhất</span> :
                                            @if ($episode_current_list > 0)
                                                @foreach ($episode as $ep)
                                                    <a href="{{ url('xem-phim/' . ($movie->thuocphim == 'phimbo' ? $ep->movie->slug : $movie->slug) . '/tap-' . $ep->episode) }}" rel="tag">Tập {{ $ep->episode }}</a>
                                                @endforeach
                                            @else
                                                Đang cập nhật
                                            @endif
                                        </li>
                                        <li class="list-info-group-item">
                                            <span>Tập phim</span> :
                                            @if ($movie->thuocphim == 'phimbo')
                                                {{ $episode_current_list }}/{{ $movie->episodes }} -
                                                @if ($episode_current_list == $movie->episodes)
                                                    Hoàn Thành
                                                @else
                                                    Đang cập nhật
                                                @endif
                                            @else
                                                Phim Lẻ
                                            @endif
                                        </li>
                                    @endif

                                    <li class="list-info-group-item"><span>Thể loại</span> :
                                        @foreach ($movie->movie_genre as $gen)
                                            <a href="{{ route('genre', $gen->slug) }}" rel="category tag">
                                                {{ $gen->title }},
                                            </a>
                                        @endforeach
                                        @foreach ($movie->movie_category as $cate)
                                            <a href="{{ route('category', $cate->slug) }}" rel="category tag">
                                                {{ $cate->title }},
                                            </a>
                                        @endforeach
                                    </li>

                                    <li class="list-info-group-item"><span>Quốc gia</span> : <a href="{{ route('country', $movie->country->slug) }}"
                                            rel="tag">{{ $movie->country->title }}</a>
                                    </li>

                                    <li class="list-info-group-item">
                                        <span>
                                            Đạo diễn
                                        </span> :
                                        <a class="director" rel="nofollow" title="{{ $movie->director }}">
                                            @if (isset($movie->director))
                                                @if ($movie->director != null)
                                                    @foreach ($director as $key => $director)
                                                        <a
                                                            href="{{ url('director/' . $director) }}">{{ $director }}</a>
                                                    @endforeach
                                                @endif
                                            @else
                                                Đang cập nhật
                                            @endif
                                        </a>
                                    </li>
                                    
                                    <li class="list-info-group-item last-item"
                                        style="-overflow: hidden;-display: -webkit-box;-webkit-line-clamp: 1;-webkit-box-flex: 1;-webkit-box-orient: vertical;">
                                        <span>Diễn viên</span> :
                                        <a class="director" rel="nofollow" title="{{ $movie->cast_movie }}">
                                            @if (isset($movie->cast_movie))
                                                @if ($movie->cast_movie != null)
                                                    @foreach ($cast_movie as $key => $cast_movie)
                                                        <a
                                                            href="{{ url('cast-movie/' . $cast_movie) }}">{{ $cast_movie }},</a>
                                                    @endforeach
                                                @endif
                                            @else
                                                Đang cập nhật
                                            @endif
                                        </a>
                                    </li>
                                </ul>
                                <div class="movie-trailer hidden"></div>
                            </div>
                        </div>
                    </div>
                    <div class="clearfix"></div>
                    <div id="halim_trailer"></div>
                    <div class="clearfix"></div>
                    <div class="section-bar clearfix">
                        <h2 class="section-title"><span style="color:#ffed4d">Nội dung phim {{ $movie->title }}</span>
                        </h2>
                    </div>
                    <div class="entry-content htmlwrap clearfix">
                        <div class="video-item halim-entry-box">
                            <article id="post-38424" class="item-content">
                                {!! $movie->description !!}
                            </article>
                        </div>
                    </div>

                    <div class="section-bar clearfix">
                        <h2 class="section-title"><span style="color:#fbf29c">Trailer phim {{ $movie->title }} - {{ $movie->name_en }}</span>
                        </h2>
                    </div>
                    <div class="entry-content htmlwrap clearfix">
                        <div class="video-item halim-entry-box">
                            <article id="watch_trailer" class="item-content">
                                <iframe width="100%" height="400"
                                    src="https://www.youtube-nocookie.com/embed/{{ $movie->trailer }}"
                                    title="YouTube video player" frameborder="0"
                                    allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                                    allowfullscreen></iframe>
                            </article>
                        </div>
                    </div>

                    <div class="section-bar clearfix">
                        <h2 class="section-title"><span style="color:#fbf29c">Bình Luận</span></h2>
                    </div>
                    <div class="entry-content htmlwrap clearfix">
                        <div class="video-item halim-entry-box">
                            <article id="post-38424" class="cmt" style="background: antiquewhite;">
                                <div class="fb-comments" data-href="{{ $current_url }}" data-width="100%"
                                    data-numposts="10" data-colorscheme="dark"></div>
                            </article>
                        </div>
                    </div>
                    <div class="section-bar clearfix">
                        <h2 class="section-title"><span style="color:#cebb14">tags</span></h2>
                    </div>
                    <div class="entry-content htmlwrap clearfix">
                        <div class="video-item halim-entry-box">
                            <article id="post-38424" class="item-content">
                                @if ($movie->tags_movie != null)
                                    @foreach ($tags_movie as $key => $tag)
                                        <a href="{{ url('tag/' . $tag) }}">{{ $tag }}</a>
                                    @endforeach
                                @else
                                    {{ $movie->description }}
                                @endif
                            </article>
                        </div>
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
                                            <img class="lazy img-responsive" src="{{ $image_check === 'http' ? $hot->image : asset('uploads/movie/' . $hot->image) }}"
                                                alt="{{ $hot->title }}" title="{{ $hot->title }}" loading="lazy">
                                        </figure>
                                        <span class="status">{{ $resolutions[$movie->resolution] }}</span><span class="episode"><i class="fa fa-play"
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
