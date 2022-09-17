@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">Admin</div>
                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif
                        <h3>Thống kê lượt truy cập : </h3>
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    //chưa fix xong phần đang online
                                    <th scope="col">Đang online</th>
                                    <th scope="col">Tổng Tháng Trước</th>
                                    <th scope="col">Tổng Tháng Này</th>
                                    <th scope="col">Tổng Một Năm</th>
                                    <th scope="col">Tổng Lượng Truy Cập</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <th scope="row">1</th>
                                    <td>{{ $visitor_count }}</td>
                                    <td>{{ $visitor_last_month_count }}</td>
                                    <td>{{ $visitor_this_month_count }}</td>
                                    <td>{{ $visitor_this_year_count }}</td>
                                    <td>{{ $visitor_total }}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
