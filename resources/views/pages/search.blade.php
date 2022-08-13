@extends('layout')
@section('content')
    <div class="row container" id="wrapper">
        <div class="halim-panel-filter">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-xs-6">
                        <div class="yoast_breadcrumb hidden-xs"><span><span><a href="">{{ $search }}</a> »
                                    <span class="breadcrumb_last" aria-current="page">2022</span></span></span></div>
                    </div>
                </div>
            </div>
            <div id="ajax-filter" class="panel-collapse collapse" aria-expanded="true" role="menu">
                <div class="ajax"></div>
            </div>
        </div>
        <main id="main-contents" class="col-xs-12 col-sm-12 col-md-8">
            <section>
                <div class="section-bar clearfix">
                    <h1 class="section-title"><span>{{ $search }}</span></h1>
                </div>
                <div class="halim_box">
                    @foreach ($movie as $key => $mov)
                        <article class="col-md-3 col-sm-3 col-xs-6 thumb grid-item post-27021">
                            <div class="halim-item">
                                <a class="halim-thumb" href="{{ route('movie', $mov->slug) }}">
                                    <figure><img class="lazy img-responsive"
                                            src="{{ asset('uploads/movie/' . $mov->image) }}" alt="{{ $mov->title }}"
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
                                        @elseif ($mov->resolution == 4)
                                            FullHD
                                        @else
                                            Trailer
                                        @endif
                                    </span><span class="episode"><i class="fa fa-play" aria-hidden="true"></i>
                                        @if ($mov->sub_movie == 0)
                                            VietSub
                                            @if ($mov->season != 0)
                                                - Season {{ $mov->season }}
                                            @endif
                                        @elseif ($mov->sub_movie == 1)
                                            Thuyết Minh
                                            @if ($mov->season != 0)
                                                - Season {{ $mov->season }}
                                            @endif
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
                <div class="clearfix"></div>
                <div class="text-center">
                    <ul class='page-numbers'>
                        {{-- <li><span aria-current="page" class="page-numbers current">1</span></li>
                        <li><a class="page-numbers" href="">2</a></li>
                        <li><a class="page-numbers" href="">3</a></li>
                        <li><span class="page-numbers dots">&hellip;</span></li>
                        <li><a class="page-numbers" href="">55</a></li>
                        <li><a class="next page-numbers" href=""><i class="hl-down-open rotate-right"></i></a>
                        </li> --}}
                        {!! $movie->links('pagination::bootstrap-4') !!}
                    </ul>
                </div>
            </section>
        </main>
        {{-- SideBar --}}
        @include('pages.include.sidebar')
    </div>
@endsection
