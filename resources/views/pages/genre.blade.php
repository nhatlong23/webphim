@extends('layout')
@section('content')
    <div class="row container" id="wrapper">
        <div class="halim-panel-filter">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-xs-6-edit">
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb" style="margin-bottom: revert;">
                                <li class="breadcrumb-item"><a href="{{'/'}}">Phim Mới</a></li>
                                <li class="breadcrumb-item active" aria-current="page">{{ $genre->title }}</li>
                            </ol>
                        </nav>
                        <div class="breadcrumb-style">
                            <span>
                            Phim 
                                <span class="breadcrumb-item" aria-current="page">
                                    <a title="{{ $genre->title }}" href="">{{ $genre->title }}</a>
                                </span>
                                {{$getMessage}}
                            </span>
                        </div>
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
                    <h1 class="section-title"><span>{{ $genre->title }}</span></h1>
                    {{-- filter --}}
                    <div class="section-bar clearfix">
                        {{-- filter --}}
                        <div class="row">
                            @include('pages.include.filter')
                        </div>
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
                        {!! $movies->links() !!}
                    </ul>
                </div>
            </section>
        </main>
        {{-- SideBar --}}
        @include('pages.include.sidebar')
    </div>
@endsection
