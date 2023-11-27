@extends('layouts.app')
@section('content')
    <div class="main-page">
        <div class="col_3">
            <div class="col-md-3 widget widget1">
                <div class="r3_counter_box">
                    <i class="pull-left fa fa-laptop icon-rounded"></i>
                    <div class="stats">
                        <h5><strong>{{$category_total}}</strong></h5>
                        <span>Tổng danh nục</span>
                    </div>
                </div>
            </div>
            <div class="col-md-3 widget widget1">
                <div class="r3_counter_box">
                    <i class="pull-left fa fa-industry user1 icon-rounded"></i>
                    <div class="stats">
                        <h5><strong>{{$genre_total}}</strong></h5>
                        <span>Tổng thể loại</span>
                    </div>
                </div>
            </div>
            <div class="col-md-3 widget widget1">
                <div class="r3_counter_box">
                    <i class="pull-left fa fa-globe user2 icon-rounded"></i>
                    <div class="stats">
                        <h5><strong>{{$country_total}}</strong></h5>
                        <span>Tổng quốc gia</span>
                    </div>
                </div>
            </div>
            <div class="col-md-3 widget widget1">
                <div class="r3_counter_box">
                    <i class="pull-left fa fa-video-camera dollar1 icon-rounded"></i>
                    <div class="stats">
                        <h5><strong>{{$movie_total}}</strong></h5>
                        <span>Tổng phim</span>
                    </div>
                </div>
            </div>
            <div class="col-md-3 widget">
                <div class="r3_counter_box">
                    <i class="pull-left fa fa-users dollar2 icon-rounded"></i>
                    <div class="stats">
                        <h5><strong>{{Tracker::onlineUsers()->count()}}</strong></h5>
                        <span>Tổng người dùng</span>
                    </div>
                </div>
            </div>
            <div class="clearfix"></div>
        </div>
            <div class="row-one widgettable">
            <div class="col-md10 content-top-2 card">
                <div class="agileinfo-cdr">
                    <div class="card-header">
                        <h3>Thống kê</h3>
                    </div>
                    <table class="table" id="tablephim">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Trình duyệt</th>
                                <th scope="col">Loại trình duyệt</th>
                                <th scope="col">Loại thiết bị</th>
                                <th scope="col">Hệ điều hành/Version</th>
                                <th scope="col">Ip Address</th>
                                <th scope="col">Bằng điện thoại</th>
                                <th scope="col">Preference</th>
                                <th scope="col">Log</th>
                                <th scope="col">Truy cập</th>
                                <th scope="col">Tổng trang truy cập</th>
                            </tr>
                        </thead>
                        <tbody class="order_position">
                            @foreach ($sessions->take(10) as $key => $session)
                                <tr>
                                    <td>{{$key}}</td>
                                    <td>{{$session->agent->browser}}</td>
                                    <td>{{$session->agent->name}}</td>
                                    <td>{{$session->device->kind}}</td>
                                    <td>{{$session->device->platform }}/{{$session->device->platform_version }}</td>
                                    <td>{{$session->client_ip }}</td>
                                    <td>{{$session->device->is_mobile }}</td>
                                    <td>
                                        @if ($session->language)
                                            {{$session->language->preference }}
                                        @else
                                            N/A
                                        @endif
                                    </td>
                                    <td>
                                        {{-- @foreach($session->log as $log)
                                            {!! $log->path !!}<br/>
                                        @endforeach --}}
                                    </td>
                                    <td>{{$session->created_at->diffforHumans()}}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="col-md10 content-top-2 card">
                <div class="agileinfo-cdr">
                    <div class="card-header">
                        <h3>Thống kê</h3>
                    </div>
                    <div id="pie-chart" style="height: 250px;"></div>
                </div>
            </div>
            <div class="clearfix"></div>
        </div>
        <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.css">
        <script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.0/jquery.min.js"></script>
        <script src="//cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
        <script src="//cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.min.js"></script>
        <link rel="stylesheet" href="{{ asset('backend/css/export.css') }}" type="text/css" media="all" />
        <script src="{{ asset('backend/js/light.js') }}"></script>
        <script>
            var colorDanger = "#FF1744";
            Morris.Donut({
            element: 'pie-chart',
            resize: true,
            colors: [
                '#E0F7FA',
                '#B2EBF2',
                '#80DEEA',
                '#4DD0E1',
                '#26C6DA',
                '#00BCD4',
                '#00ACC1',
                '#0097A7',
                '#00838F',
                '#006064'
            ],
            data: [
                {label:"Tổng Phim", value:{{$movie_total}}},
                {label:"Tổng tập phim", value:{{$episode_total}}, color:colorDanger},
                {label:"Tổng thể loại phim", value:{{$genre_total}}},
                {label:"Tổng quốc gia phim", value:{{$country_total}}},
                {label:"Tổng danh mục phim", value:{{$category_total}}}
            ]
            });
        </script>
    </div>
    </div>
@endsection
