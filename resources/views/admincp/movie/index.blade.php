@extends('layouts.app')
@section('content')
    @if (Auth::id())
        <!-- Button trigger modal -->
        {{-- <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#banner_quangcao">
            Launch demo modal
        </button> --}}

        <!-- Modal check movie episode -->
        <div class="modal" id="videoModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="video_title">Modal title</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <p id="video_desc"></p>
                        <p id="video_link"></p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        {{-- <button type="button" class="btn btn-primary">Save changes</button> --}}
                    </div>
                </div>
            </div>
        </div>
        <!-- Modal thêm tập phim -->
        <div class="modal" id="episode" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="episode_title"></h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <p id="content_episode_title"></p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <p id="button_save_episode"></p>
                    </div>
                </div>
            </div>
        </div>
        <td><a href="{{ route('remove-episode') }}" class="btn btn-success">Xóa các tập phim trùng</a></td>
        <td><a href="{{ route('delete-movie') }}" class="btn btn-success">Xóa các phim trùng</a></td>
        <td><a href="{{ route('sendMail') }}" class="btn btn-success">send mail</a></td>
        {{-- <td><a href="{{ route('update-image-movie') }}" class="btn btn-success">Cập nhật hình ảnh sang o9</a></td> --}}
        <div class="container-fluid">
            <div class="row justify-content-center">
                <div class="col-md-12">
                    <a href="{{ route('movie.create') }}" class="btn btn-primary">Thêm phim</a>
                    {{--  --}}
                    <h1>Tìm kiếm Real-time</h1>
                    <input type="text" id="searchInput" placeholder="Nhập từ khóa tìm kiếm" autocomplete="off">
                    <div id="searchResults" style="display: none;">
                        <!-- Kết quả tìm kiếm sẽ được hiển thị ở đây -->
                    </div>
                    {{--  --}}
                    <div class="table-responsive">
                        <table class="table table-responsive" id="">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Manage</th>
                                    <th scope="col">Tên phim</th>
                                    <th scope="col">Thêm Phim</th>
                                    <th scope="col">Tập phim</th>
                                    <th scope="col">Hình ảnh</th>
                                    <th scope="col">Thuộc phim</th>
                                    <th scope="col">Season</th>
                                    <th scope="col">Năm Phim</th>
                                    <th scope="col">Danh mục</th>
                                    <th scope="col">Ngày cập nhập</th>
                                    <th scope="col">Ngày tạo</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($list as $key => $cate)
                                    <tr>
                                        <th scope="row">{{ $key }}</th>
                                        <td>
                                            <a href="{{ route('movie.edit', $cate->id) }}" class="btn btn-warning">Sửa</a>
                                            {!! Form::open([
                                                'method' => 'DELETE',
                                                'route' => ['movie.destroy', $cate->id],
                                                'onsubmit' => 'return confirm("Xóa?")',
                                            ]) !!}
                                            {!! Form::submit('Xóa', ['class' => 'btn btn-danger']) !!}
                                            {!! Form::close() !!}
                                        </td>
                                        <td>
                                            <span class="badge badge-success">{{ $cate->title }}</span> <br>
                                            <span class="badge badge-primary">{{ $cate->slug }}</span> <br>
                                            <span class="badge badge-dark">{{ $cate->name_en }}</span> <br>
                                            <span class="badge badge-secondary">imdb: {{ $cate->score_imdb }}</span> <br>
                                            @if ($cate->thuocphim == 'phimle')
                                                <span class="badge badge-primary"> Phim Lẻ</span> <br>
                                            @else
                                                <span class="badge badge-secondary">Phim Bộ</span> <br>
                                            @endif
                                            @if ($cate->status)
                                                <span class="badge badge-primary">Hiển thị</span> <br>
                                            @else
                                                <span class="badge badge-secondary">Không Hiển thị</span> <br>
                                            @endif
                                        </td>
                                        <td>
                                            <a href="{{ route('add-episode', [$cate->id]) }}" class="btn btn-danger btn-sm">
                                                Thêm Tập Phim bằng tay
                                            </a>
                                            <span>
                                                <button type="button" data-movie_slug="{{ $cate->slug }}" 
                                                class="badge badge-success btn-sm leech_details_episode"
                                                data-toggle="modal" data-target="#episode">Thêm tập phim bằng api</button>
                                            </span>
                                            @foreach ($cate->episode->sortByDesc('episode')->take(3) as $key => $ep)
                                                <a class="show_video" data-movie_video_id="{{ $ep->movie_id }}"
                                                    data-video_episode="{{ $ep->episode }}" style="cursor: pointer">
                                                    <span class="badge badge-light">{{ $ep->episode }}</span>
                                                </a>
                                            @endforeach
                                        </td>
                                        <td>
                                            @if ($cate->resolution == 0)
                                                <span class="badge badge-primary">HD</span>
                                            @elseif ($cate->resolution == 1)
                                                <span class="badge badge-secondary">SD</span>
                                            @elseif ($cate->resolution == 2)
                                                <span class="badge badge-success">HDCam</span>
                                            @elseif ($cate->resolution == 3)
                                                <span class="badge badge-danger">Cam</span>
                                                <span class="badge badge-primary">Ngày ra bản HD: 03-09-2023</span> <br>
                                            @elseif ($cate->resolution == 4)
                                                <span class="badge badge-warning">FullHD</span>
                                            @else
                                                <span class="badge badge-dark">Trailer</span> <br>
                                                <span class="badge badge-primary">Ngày công chiếu: 02-09-2023</span> <br>
                                            @endif
                                        </td>
                                        <td>
                                            @php
                                                $image_check = substr($cate->image, 0, 4);
                                            @endphp
                                            @if ($image_check == 'http')
                                                <img src="{{ $cate->image }}" width="65">
                                            @else
                                                <img src="{{ asset('uploads/movie/' . $cate->image) }}" width="65">
                                            @endif
                                            <span class="badge badge-success">{{ $cate->episode_count }} / {{ $cate->episodes }} tập</span> <br>
                                            <span class="badge badge-primary">{{ $cate->duration_movie }}</span> <br>
                                            <span class="badge badge-dark">{{ $cate->view_count }} lượt xem</span>
                                        </td>
                                        <td>
                                            @if ($cate->sub_movie == 0)
                                                <span class="badge badge-dark">VietSub</span> <br>
                                            @elseif ($cate->sub_movie == 1)
                                                <span class="badge badge-dark">Thuyết Minh</span> <br>
                                            @endif
                                            @if ($cate->thuocphim == 'phimle')
                                                <span class="badge badge-primary"> Phim Lẻ</span> <br>
                                            @else
                                                <span class="badge badge-secondary">Phim Bộ</span> <br>
                                                <a href="{{ route('add-episode', [$cate->id]) }}" class="btn btn-danger btn-sm">
                                                    Cập nhật
                                                </a>
                                            @endif
                                        </td>
                                        <td>
                                            <form method="POST">
                                                @csrf
                                                {!! Form::selectRange('season', '0', '20', isset($cate->season) ? $cate->season : '', [
                                                    'class' => 'select-season',
                                                    'id' => $cate->id,
                                                ]) !!}
                                            </form>
                                        </td>
                                        <td>
                                            <form method="POST" style="margin-bottom: 10px">
                                                @csrf
                                                {!! Form::selectYear('year', '1900', '2030', isset($cate->year) ? $cate->year : '', [
                                                    'class' => 'select-year',
                                                    'id' => $cate->id,
                                                    'placeholder' => 'Năm phim',
                                                ]) !!}
                                            </form>
                                            <form method="POST" style="margin-bottom: 10px">
                                                @csrf
                                                {!! Form::select(
                                                    'movie_hot',
                                                    ['0' => 'Không hot', '1' => 'Hot'],
                                                    isset($cate->movie_hot) ? $cate->movie_hot : '',
                                                    [
                                                        'class' => 'select-hot',
                                                        'id' => $cate->id,
                                                    ],
                                                ) !!}
                                            </form>
                                            <form method="POST" style="margin-bottom: 10px">
                                                @csrf
                                                {!! Form::select(
                                                    'topview',
                                                    ['0' => 'Ngày', '1' => 'Tuần', '2' => 'Tháng'],
                                                    isset($cate->topview) ? $cate->topview : '',
                                                    [
                                                        'class' => 'select-topview',
                                                        'id' => $cate->id,
                                                        'placeholder' => 'Topview',
                                                    ],
                                                ) !!}
                                            </form>
                                            {!! Form::select('country_id', $country, isset($cate) ? $cate->country->id : '', [
                                                'class' => 'country_chooose',
                                                'id' => $cate->id,
                                                'placeholder' => 'Chọn quốc gia',
                                            ]) !!}
                                        </td>
                                        {{-- <td>{{ substr($cate->description, 0, 10) }}</td> --}}
                                        <td>
                                            @foreach ($cate->movie_category as $category)
                                                <span class="badge badge-danger">{{ $category->title }}</span> <br>
                                            @endforeach
                                            <span class="badge badge-dark">Thể loại:</span>
                                            @foreach ($cate->movie_genre as $gen)
                                                <span class="badge badge-dark">--{{ $gen->title }}</span>
                                            @endforeach
                                            <!-- Button trigger modal -->
                                            {{-- <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
                                                Thay đổi danh mục
                                            </button> --}}
                                            
                                            <!-- Modal -->
                                            <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        {!! Form::label('category', 'Category', []) !!}
                                                        {{-- @foreach ($list_category as $key => $list_category)
                                                            <br>
                                                            @if (isset($movie))
                                                                {!! Form::checkbox(
                                                                    'category[]',
                                                                    $list_category->id,
                                                                    isset($movie_category) && $movie_category->contains($list_category->id) ? true : false,
                                                                ) !!}
                                                            @else
                                                                {!! Form::checkbox('category[]', $list_category->id, '') !!}
                                                            @endif
                                                            {!! Form::label('category', $list_category->title) !!}
                                                        @endforeach --}}
                                                    </div>
                                                    <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                    <button type="button" class="btn btn-primary">Save changes</button>
                                                    </div>
                                                </div>
                                                </div>
                                            </div>
                                        </td>
                                        <td><span class="badge badge-info">{{ $cate->date_updated }}</span></td>
                                        <td><span class="badge badge-info">{{ $cate->date_created }}</span></td>
                                        {{-- <td>
                                            <span class="badge badge-danger">{{ substr($cate->cast_movie, 0, 10) }}</span>
                                        </td>
                                        <td>
                                            {{ substr($cate->tags_movie, 0, 10) }}
                                        </td>
                                        <td>
                                            <span class="badge badge-secondary">{{ substr($cate->director, 0, 10) }}</span>
                                        </td> --}}
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        {{ $list->links() }}
    @else
        <script>
            window.location = "/login";
        </script>
    @endif
@endsection
