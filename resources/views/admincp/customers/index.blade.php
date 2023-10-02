@extends('layouts.app')
@section('content')
    @if (Auth::id())
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-12">

                    <table class="table" id="tablemovie">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Tên người dùng</th>
                                <th scope="col">Email người dùng</th>
                                <th scope="col">Đăng nhập bằng</th>
                                <th scope="col">Tình trạng email</th>
                                <th scope="col">Tình trạng tài khoản</th>
                                <th scope="col">Manage</th>
                            </tr>
                        </thead>
                        <tbody class="order_positionn">
                            @foreach ($all_customers as $key => $customer)
                                <tr id="{{ $customer->id }}">
                                    <th scope="row">{{ $key }}</th>
                                    <td>{{ $customer->name }}</td>
                                    <td>{{ $customer->email }}</td>
                                    <td>
                                        @if ($customer->google_id)
                                            Google
                                        @elseif($customer->facebook_id)
                                            Facebook
                                        @else
                                            Tài khoản
                                        @endif
                                    </td>
                                    <td>
                                        @if ($customer->verified)
                                            Đã xác thực
                                        @else
                                            Chưa xác thực
                                        @endif
                                    </td>
                                    <td>
                                        @if ($customer->locked)
                                            Đã khóa tài khoản
                                        @else
                                            Tài khoản chưa bị khóa
                                        @endif
                                    </td>
                                    <td>
                                        {!! Form::open([
                                            'method' => 'post',
                                            'route' => ['toggleCustomerLock', $customer->id],
                                            'onsubmit' => 'return confirm("Bạn có muốn ' . ($customer->locked ? 'MỞ KHÓA' : 'KHÓA') . ' tài khoản này ?")',
                                        ]) !!}
                                        {!! Form::submit($customer->locked ? 'MỞ KHÓA' : 'KHÓA', ['class' => $customer->locked ? 'btn btn-success' : 'btn btn-danger']) !!}
                                        {!! Form::close() !!}
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    @else
        <script>
            window.location = "/login";
        </script>
    @endif
@endsection
