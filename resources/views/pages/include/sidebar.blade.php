<aside id="sidebar" class="col-xs-12 col-sm-12 col-md-4">
    <div id="halim_tab_popular_videos-widget-7" class="widget halim_tab_popular_videos-widget">
        <div class="section-bar clearfix">
            <div class="section-title">
                <span>Top Views</span>
            </div>
        </div>
        <ul class="nav nav-pills mb-3" id="myTab" role="tablist">
            <li class="nav-item">
                <a class="nav-link filter-sidebar" id="pills-home-tab" data-toggle="pill" href="#ngay" role="tab"
                    aria-controls="pills" aria-selected="true">Ngày</a>
            </li>
            <li class="nav-item">
                <a class="nav-link filter-sidebar" id="pills-tab" data-toggle="pill" href="#tuan" role="tab"
                    aria-controls="pills" aria-selected="false">Tuần</a>
            </li>
            <li class="nav-item">
                <a class="nav-link filter-sidebar" id="pills-thang-tab" data-toggle="pill" href="#thang" role="tab"
                    aria-controls="pills" aria-selected="false">Tháng</a>
            </li>
        </ul>


        <form method="POST">
            @csrf
            <div class="tab-content" id="pills-tabContent">
                <div class="tab-pane fade" id="ngay" role="tabpanel" aria-labelledby="pills-home-tab">
                    <div id="halim-ajax-popular-post" class="popular-post">

                        <span id="show0">

                        </span>

                    </div>
                </div>
                <div class="tab-pane fade" id="tuan" role="tabpanel" aria-labelledby="pills-profile-tab">
                    <div id="halim-ajax-popular-post" class="popular-post">

                        <span id="show1">

                        </span>

                    </div>
                </div>
                <div class="tab-pane fade" id="thang" role="tabpanel" aria-labelledby="pills-contact-tab">
                    <div id="halim-ajax-popular-post" class="popular-post">

                        <span id="show2">

                        </span>


                    </div>
                </div>
            </div>
        </form>
        <div class="clearfix"></div>
    </div>
</aside>
