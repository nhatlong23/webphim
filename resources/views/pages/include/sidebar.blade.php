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
                        <a class="ajax-tab" role="tab" data-toggle="tab" data-showpost="10" data-type="all">All</a>
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
