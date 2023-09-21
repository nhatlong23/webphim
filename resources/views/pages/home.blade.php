@extends('layout')
@section('content')
    <div class="container">
        <div class="row container" id="wrapper">
            <div class="halim-panel-filter">
                <div id="ajax-filter" class="panel-collapse collapse" aria-expanded="true" role="menu">
                    <div class="ajax"></div>
                </div>
            </div>
            <main>
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
                                            @php
                                                $image_check = substr($hot->image, 0, 4);
                                                $subtitle = ($hot->sub_movie == 0 ? 'VietSub' : 'Thuyết Minh') . ($hot->season != 0 ? ' - Season ' . $hot->season : '');
                                            @endphp
                                            <figure>
                                                <img class="lazy img-responsive" src="{{ $image_check === 'http' ? $hot->image : asset('uploads/movie/' . $hot->image) }}"
                                                    alt="{{ $hot->title }}" title="{{ $hot->title }}" loading="lazy">
                                            </figure>
                                            <span class="status">
                                                {{ $resolutions[$hot->resolution] }}
                                            </span>
                                            <span class="episode"><i class="fa fa-play" aria-hidden="true"></i>
                                                {{ $subtitle }}
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
                    </div>
                </section>
            </main>
            <main id="main-contents" class="col-xs-12 col-sm-12 col-md-8">
                @foreach ($category_home as $key => $cate_home)
                    <section id="halim-advanced-widget-2">
                        <div class="section-heading">
                            <a href="{{ route('category', $cate_home->slug) }}" title="{{ $cate_home->title }}">
                                <span class="h-text">{{ $cate_home->title }}</span>
                            </a>
                        </div>
                        <div id="halim-advanced-widget-2-ajax-box" class="halim_box">
                            @foreach ($cate_home->movie_category as $key => $mov)
                                @php
                                    $image_check = substr($mov->image, 0, 4);
                                    $subtitle = ($mov->sub_movie == 0 ? 'VietSub' : 'Thuyết Minh') . ($mov->season != 0 ? ' - Season ' . $mov->season : '');
                                @endphp
                                <article class="col-md-3 col-sm-3 col-xs-6 thumb grid-item post-37606">
                                    <div class="halim-item">
                                        <a class="halim-thumb" href="{{ route('movie', $mov->slug) }}">
                                            <figure>
                                                <img class="lazy img-responsive" src="{{ $image_check === 'http' ? $mov->image : asset('uploads/movie/' . $mov->image) }}"
                                                    alt="{{ $mov->title }}" title="{{ $mov->title }}" loading="lazy">
                                            </figure>
                                            <span class="status">
                                                {{ $resolutions[$mov->resolution] }}
                                            </span>
                                            <span class="episode"><i class="fa fa-play" aria-hidden="true"></i>
                                                {{ $subtitle }}
                                            </span>
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
                            <span>Phim hot</span>
                        </div>
                    </div>
                    <section class="tab-content">
                        <div role="tabpanel" class="tab-pane active halim-ajax-popular-post">
                            <div class="halim-ajax-popular-post-loading hidden"></div>
                            <div id="halim-ajax-popular-post" class="popular-post">
                                @foreach ($movie_hot_sidebar as $key => $mov_hot)
                                    @php
                                        $image_check = substr($mov_hot->image, 0, 4);
                                    @endphp
                                    <div class="item post-37176">
                                        <a href="{{ route('movie', $mov_hot->slug) }}" title="{{ $mov_hot->title }}">
                                            <div class="item-link">
                                                    <img class="lazy post-thumb img-responsive" src="{{ $image_check === 'http' ? $mov_hot->image : asset('uploads/movie/' . $mov_hot->image) }}"
                                                        alt="{{ $mov_hot->title }}" title="{{ $mov_hot->title }}" loading="lazy">
                                                <span class="is_trailer">
                                                   {{ $resolutions[$mov_hot->resolution] }}
                                                </span>
                                            </div>
                                            <p class="title">{{ $mov_hot->title }}</p>
                                        </a>
                                        <div class="viewsCount" style="color: #9d9d9d;">{{ $mov_hot->view_count }} lượt
                                            xem
                                        </div>
                                        <div style="float: left;">
                                            <ul class="list-inline rating" title="Average rating">
                                                @for ($count = 1; $count <= 5; $count++)
                                                    <li title="rating" style="font-size: 20px; color: #ffcc00; padding:0">
                                                        &#9733;
                                                    </li>
                                                @endfor
                                            </ul>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </section>
                    <div class="clearfix"></div>
                </div>
            </aside>
            {{-- SideBar --}}
            @include('pages.include.sidebar')
        </div>
    </div>
@endsection
