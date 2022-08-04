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
                        <div class="item post-37176">
                            <a href="{{ route('movie', $mov_hot->slug) }}" title="{{ $mov_hot->title }}">
                                <div class="item-link">
                                    <img src="{{ asset('uploads/movie/' . $mov_hot->image) }}" class="lazy post-thumb"
                                        alt="{{ $mov_hot->title }}" title="{{ $mov_hot->title }}" />
                                    <span class="is_trailer">
                                        @if ($mov_hot->resolution == 0)
                                            HD
                                        @elseif ($mov_hot->resolution == 1)
                                            SD
                                        @elseif ($mov_hot->resolution == 2)
                                            HDCam
                                        @elseif ($mov_hot->resolution == 3)
                                            Cam
                                        @else
                                            FullHD
                                        @endif
                                    </span>
                                </div>
                                <p class="title">{{ $mov_hot->title }}</p>
                            </a>
                            <div class="viewsCount" style="color: #9d9d9d;">3.2K lượt xem</div>
                            <div style="float: left;">
                                <span class="user-rate-image post-large-rate stars-large-vang"
                                    style="display: block;/* width: 100%; */">
                                    <span style="width: 0%"></span>
                                </span>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>
        <div class="clearfix"></div>
    </div>
</aside>
<aside id="sidebar" class="col-xs-12 col-sm-12 col-md-4">
    <div id="halim_tab_popular_videos-widget-7" class="widget halim_tab_popular_videos-widget">
        <div class="section-bar clearfix">
            <div class="section-title">
                <span>Top Views</span>


            </div>
        </div>
        <section class="tab-content">
            <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
                <li class="nav-item">
                    <a class="nav-link active" id="pills-day-tab" data-toggle="pill" href="#day" role="tab"
                        aria-controls="pills-day" aria-selected="true">Day</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="pills-week-tab" data-toggle="pill" href="#week" role="tab"
                        aria-controls="pills-week" aria-selected="false">Week</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="pills-month-tab" data-toggle="pill" href="#month" role="tab"
                        aria-controls="pills-month" aria-selected="false">Month</a>
                </li>
                {{-- <li class="nav-item">
                    <a class="nav-link" id="pills-all-tab" data-toggle="pill" href="#all" role="tab"
                        aria-controls="pills-contact" aria-selected="false">All</a>
                </li> --}}
            </ul>
            <div class="tab-content" id="pills-tabContent">
                <div class="tab-pane fade show active" id="day" role="tabpanel" aria-labelledby="pills-day-tab">
                    ...</div>
                <div class="tab-pane fade" id="week" role="tabpanel" aria-labelledby="pills-week-tab">...
                </div>
                <div class="tab-pane fade" id="month" role="tabpanel" aria-labelledby="pills-month-tab">...
                </div>
            </div>

        </section>
        <div class="clearfix"></div>
    </div>
</aside>
