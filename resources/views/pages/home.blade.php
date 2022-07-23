@extends('layout')
@section('content')
    <div class="container">
        <div class="row container" id="wrapper">
            <div class="halim-panel-filter">
                <div id="ajax-filter" class="panel-collapse collapse" aria-expanded="true" role="menu">
                    <div class="ajax"></div>
                </div>
            </div>
            <section class="related-movies">
                <div id="halim_related_movies-2xx" class="wrap-slider">
                    <div class="section-bar clearfix">
                        <h3 class="section-title"><span>PHIM HOT</span></h3>
                    </div>
                    <div id="halim_related_movies-2" class="owl-carousel owl-theme related-film">
                        @foreach ($movie_hot as $key => $hot)
                            <article class="thumb grid-item post-38498">
                                <div class="halim-item">
                                    <a class="halim-thumb" href="{{ route('movie', $hot->slug) }}"
                                        title="{{ $hot->title }}">
                                        <figure><img class="lazy img-responsive"
                                                src="{{ asset('uploads/movie/' . $hot->image) }}" alt="{{ $hot->title }}"
                                                title="{{ $hot->title }}"></figure>
                                        <span class="status">
                                            @if ($hot->resolution == 0)
                                                HD
                                            @elseif ($hot->resolution == 1)
                                                SD
                                            @elseif ($hot->resolution == 2)
                                                HDCam
                                            @elseif ($hot->resolution == 3)
                                                Cam
                                            @else
                                                FullHD
                                            @endif
                                        </span><span class="episode"><i class="fa fa-play"
                                                aria-hidden="true"></i>Vietsub</span>
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
                </div>
            </section>
            <main id="main-contents" class="col-xs-12 col-sm-12 col-md-8">
                @foreach ($category_home as $key => $cate_home)
                    <section id="halim-advanced-widget-2">
                        <div class="section-heading">
                            <a href="danhmuc.php" title="{{ $cate_home->title }}">
                                <span class="h-text">{{ $cate_home->title }}</span>
                            </a>
                        </div>
                        <div id="halim-advanced-widget-2-ajax-box" class="halim_box">
                            @foreach ($cate_home->movie->take(10) as $key => $mov)
                                <article class="col-md-3 col-sm-3 col-xs-6 thumb grid-item post-37606">
                                    <div class="halim-item">
                                        <a class="halim-thumb" href="{{ route('movie', $mov->slug) }}">
                                            <figure><img class="lazy img-responsive"
                                                    src="{{ asset('uploads/movie/' . $mov->image) }}" alt=""
                                                    title="{{ $mov->title }}">
                                            </figure>
                                            <span class="status">
                                                @if ($mov->resolution == 0)
                                                    HD
                                                @elseif ($mov->resolution == 1)
                                                    SD
                                                @elseif ($mov->resolution == 2)
                                                    HDCam
                                                @elseif ($mov->resolution == 3)
                                                    Cam
                                                @else
                                                    FullHD
                                                @endif
                                            </span><span class="episode"><i class="fa fa-play"
                                                    aria-hidden="true"></i>Vietsub</span>
                                            <div class="icon_overlay"></div>
                                            <div class="halim-post-title-box">
                                                <div class="halim-post-title ">
                                                    <p class="entry-title">{{ $mov->title }}</p>
                                                    <p class="original_title">{{ $mov->name_en }}</p>
                                                </div>
                                            </div>
                                        </a>
                                    </div>
                                </article>
                            @endforeach
                        </div>
                    </section>
                    <div class="clearfix"></div>
                @endforeach
            </main>
            <aside id="sidebar" class="col-xs-12 col-sm-12 col-md-4">
                <div id="halim_tab_popular_videos-widget-7" class="widget halim_tab_popular_videos-widget">
                    <div class="section-bar clearfix">
                        <div class="section-title">
                            <span>Top Views</span>
                            <ul class="halim-popular-tab" role="tablist">
                                <li role="presentation" class="active">
                                    <a class="ajax-tab" role="tab" data-toggle="tab" data-showpost="10"
                                        data-type="today">Day</a>
                                </li>
                                <li role="presentation">
                                    <a class="ajax-tab" role="tab" data-toggle="tab" data-showpost="10"
                                        data-type="week">Week</a>
                                </li>
                                <li role="presentation">
                                    <a class="ajax-tab" role="tab" data-toggle="tab" data-showpost="10"
                                        data-type="month">Month</a>
                                </li>
                                <li role="presentation">
                                    <a class="ajax-tab" role="tab" data-toggle="tab" data-showpost="10"
                                        data-type="all">All</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <section class="tab-content">
                        <div role="tabpanel" class="tab-pane active halim-ajax-popular-post">
                            <div class="halim-ajax-popular-post-loading hidden"></div>
                            <div id="halim-ajax-popular-post" class="popular-post">
                                <div class="item post-37176">
                                    <a href="chitiet.php" title="CHỊ MƯỜI BA: BA NGÀY SINH TỬ">
                                        <div class="item-link">
                                            <img src="https://pdp.edu.vn/wp-content/uploads/2021/07/hinh-anh-spider-man-nguoi-nhen-dep-ngau-nhat.jpg"
                                                class="lazy post-thumb" alt="CHỊ MƯỜI BA: BA NGÀY SINH TỬ"
                                                title="CHỊ MƯỜI BA: BA NGÀY SINH TỬ" />
                                            <span class="is_trailer">Trailer</span>
                                        </div>
                                        <p class="title">CHỊ MƯỜI BA: BA NGÀY SINH TỬ</p>
                                    </a>
                                    <div class="viewsCount" style="color: #9d9d9d;">3.2K lượt xem</div>
                                    <div style="float: left;">
                                        <span class="user-rate-image post-large-rate stars-large-vang"
                                            style="display: block;/* width: 100%; */">
                                            <span style="width: 0%"></span>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>
                    <div class="clearfix"></div>
                </div>
            </aside>
        </div>
    </div>
@endsection
