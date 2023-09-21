@extends('layout')
@section('content')
    <div class="row container" id="wrapper">
        <div class="halim-panel-filter">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-xs-6">
                        <div class="yoast_breadcrumb hidden-xs"><span><span><a href="">Lọc Phim</a> »
                                    <span class="breadcrumb_last" aria-current="page">{{$currentYear}}</span></span></span></div>
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
                    <h1 class="section-title"><span>Lọc Phim</span></h1>
                </div>
                <div class="section-bar clearfix">
                    <div class="row">
                        {{-- filter --}}
                        @include('pages.include.filter')
                    </div>
                </div>
                <div class="halim_box">
                    @foreach ($movies as $key => $mov)
                        <article class="col-md-3 col-sm-3 col-xs-6 thumb grid-item post-27021">
                            <div class="halim-item">
                                @php
                                    $image_check = substr($mov->image, 0, 4);
                                    $subtitle = ($mov->sub_movie == 0 ? 'VietSub' : 'Thuyết Minh') . ($mov->season != 0 ? ' - Season ' . $mov->season : '');
                                @endphp
                                <a class="halim-thumb" href="{{ route('movie', $mov->slug) }}">
                                    <figure>
                                        <img class="lazy img-responsive" src="{{ $image_check === 'http' ? $mov->image : asset('uploads/movie/' . $mov->image) }}"
                                            alt="{{ $mov->title }}" title="{{ $mov->title }}" loading="lazy">
                                    </figure>
                                    <span class="status">
                                        {{ $resolutions[$mov->resolution] }}
                                    </span><span class="episode"><i class="fa fa-play" aria-hidden="true"></i>
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
                <div class="clearfix"></div>
                <div class="text-center">
                    <ul class='page-numbers'>
                        {{ $movies->appends(request()->query())->links() }}
                    </ul>
                </div>
            </section>
        </main>
        {{-- SideBar --}}
        @include('pages.include.sidebar')
    </div>
@endsection
