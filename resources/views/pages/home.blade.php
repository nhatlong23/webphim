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
                                        </span><span class="episode"><i class="fa fa-play" aria-hidden="true"></i>
                                            @if ($hot->sub_movie == 0)
                                                VietSub
                                            @elseif ($hot->sub_movie == 1)
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
                </div>
            </section>
            <main id="main-contents" class="col-xs-12 col-sm-12 col-md-8">
                @foreach ($category_home as $key => $cate_home)
                    <section id="halim-advanced-widget-2">
                        <div class="section-heading">
                            <a href="{{ route('category', $cate_home->slug) }}" title="{{ $cate_home->title }}">
                                <span class="h-text">{{ $cate_home->title }}</span>
                            </a>
                        </div>
                        <div id="halim-advanced-widget-2-ajax-box" class="halim_box">
                            @foreach ($cate_home->movie->take(10)->where('status', 1) as $key => $mov)
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
                                            </span><span class="episode"><i class="fa fa-play" aria-hidden="true"></i>
                                                @if ($mov->sub_movie == 0)
                                                    VietSub
                                                @elseif ($mov->sub_movie == 1)
                                                    Thuyết Minh
                                                @endif
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
            {{-- SideBar --}}
            @include('pages.include.sidebar')
        </div>
    </div>
@endsection
