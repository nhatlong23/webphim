@extends('layouts.app')
@section('content')
    @if (Auth::id())
        <div class="card-header">Liệt Kê Leech Phim</div>
        <td><a href="{{ route('synchronize-all-movies') }}" class="btn btn-success">Đồng bộ tất cả phim</a></td>
        <td><a href="{{ route('synchronize-all-episodes') }}" class="btn btn-success">Đồng bộ tất tập phim đã thêm</a></td>
        <table class="table" id="tablemovie">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Tên Phim</th>
                    <th scope="col">Tên Chính thức</th>
                    <th scope="col">Hình ảnh</th>
                    <th scope="col">Poster</th>
                    <th scope="col">Slug</th>
                    <th scope="col">Năm</th>
                    <th scope="col">Chi tiết phim</th>
                </tr>
            </thead>
            <tbody class="order_position">
                @foreach ($moviesPaginator as $key => $res)
                    <tr id="{{ $res['_id'] }}">
                        <th scope="row">{{ $key }}</th>
                        <td>
                            {{ $res['name'] }}
                            <a href="{{ route('leech-episodes', $res['slug']) }}" class="btn btn-success">Tập phim</a>
                        </td>
                        <td>{{ $res['origin_name'] }}</td>
                        <td><img src="{{ asset($pathImage . $res['thumb_url']) }}" width="80px" height="80px"></td>
                        <td><img src="{{ asset($pathImage . $res['poster_url']) }}" width="80px" height="80px"></td>
                        <td>{{ $res['slug'] }}</td>
                        <td>{{ $res['year'] }}</td>
                        <td>
                            <a href="{{ route('leech-detail', $res['slug']) }}" class="btn btn-success">Chi tiết phim</a>
                            @php
                                $movie = \App\Models\Movie::where('slug', $res['slug'])->first();
                            @endphp
                            @if (!$movie)
                                <form method="post" action="{{ route('leech-store', $res['slug']) }}">
                                    @csrf
                                    <input type="submit" class="btn btn-success" value="Thêm phim">
                                </form>
                            @else
                                <form method="post" action="{{ route('movie.destroy', $movie->id) }}">
                                    @csrf
                                    @method('delete')
                                    <input type="submit" class="btn btn-danger" value="Xóa phim">
                                </form>
                            @endif
                        </td>
                    </tr>
                @endforeach

            </tbody>
        </table>
        <div class="pagination">
            {{ $moviesPaginator->links() }}
        </div>
        <p>Total items: {{ $resp_pagination['totalItems'] }}</p>
        <p>Total items per page: {{ $resp_pagination['totalItemsPerPage'] }}</p>
        <p>Current page: {{ $resp_pagination['currentPage'] }}</p>
        <p>Total pages: {{ $resp_pagination['totalPages'] }}</p>
    @else
        <script>
            window.location = "/login";
        </script>
    @endif
@endsection
