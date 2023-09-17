@extends('layouts.app')
@section('content')
    @if (Auth::id())
        <div class="card-header">Liệt Kê tập phim</div>
        <table class="table" id="tablemovie">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Server Embed</th>
                    <th scope="col">Server M3u8</th>
                    <th scope="col">Tên Phim</th>
                    <th scope="col">Slug phim</th>
                    <th scope="col">Số tập</th>
                    <th scope="col">Tập phim</th>
                    <th scope="col">Quản lí</th>
                </tr>
            </thead>
            <tbody class="order_position">
                @foreach ($resp['episodes'] as $key => $res)
                    <tr id="{{ $resp['movie']['_id'] }} }}">
                        <th scope="row">{{ $key }}</th>
                        <td>
                            @foreach ($res['server_data'] as $key => $server_1)
                                <ul>
                                    <li>Tập {{ $server_1['name'] }}
                                        <input type="text" class="from-control" value="{{ $server_1['link_embed'] }}">
                                    </li>
                                </ul>
                            @endforeach
                        </td>
                        <td>
                            @foreach ($res['server_data'] as $key => $server_2)
                                <ul>
                                    <li>Tập {{ $server_2['name'] }}
                                        <input type="text" class="from-control" value="{{ $server_2['link_m3u8'] }}">
                                    </li>
                                </ul>
                            @endforeach
                        </td>
                        <td>{{ $resp['movie']['name'] }}</td>
                        <td>{{ $resp['movie']['slug'] }}</td>
                        <td>{{ $resp['movie']['episode_total'] }}</td>
                        <td>
                            {{ $res['server_name'] }}
                        </td>
                        <td>
                            <form method="post" action="{{ route('leech-episode-store', [$resp['movie']['slug']]) }}">
                                @csrf
                                <input type="submit" value="Thêm tập phim" class="btn btn-success">
                            </form>
                            {{-- <form method="post" action="">
                                @csrf
                                <input type="submit" value="Xóa tập phim" class="btn btn-danger">
                            </form> --}}
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @else
        <script>
            window.location = "/login";
        </script>
    @endif
@endsection
