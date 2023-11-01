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
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
        <main id="main-contents" class="col-xs-12 col-sm-12 col-md-8">
            <section>
                <div class="halim_box">
                    <h1>Thông Tin Cá Nhân</h1>
                    <p>Họ và tên: {{ $customer->name }}</p>
                    <p>Email: {{ $customer->email }}</p>
                </div>
                <h1>Phim đã lưu vào Bookmarks </h1>
                <div id="bookmarks" class="halim_box"></div>
                <div class="clearfix"></div>
            </section>
        </main>
    </div>
@endsection
