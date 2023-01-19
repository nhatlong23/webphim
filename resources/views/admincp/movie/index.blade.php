@extends('layouts.app')
@section('content')
    @if (Auth::id())
        <!-- Button trigger modal -->
        {{-- <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#banner_quangcao">
            Launch demo modal
        </button> --}}

        <!-- Modal -->
        <div class="modal" id="videoModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
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
        <div class="container-fluid">
            <div class="row justify-content-center">
                <div class="col-md-12">
                    <a href="{{ route('movie.create') }}" class="btn btn-primary">Thêm phim</a>
                    <table class="table table-responsive" id="tablemovie">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Title</th>
                                <th scope="col">Thêm Phim</th>
                                <th scope="col">Episodes</th>
                                <th scope="col">Name_EN</th>
                                <th scope="col">Score_imdb</th>
                                <th scope="col">Image</th>
                                <th scope="col">Duration</th>
                                <th scope="col">Director</th>
                                <th scope="col">Cast_movie</th>
                                <th scope="col">Tags</th>
                                <th scope="col">Description</th>
                                <th scope="col">Slug</th>
                                <th scope="col">Active/Inactive</th>
                                <th scope="col-md3">Category</th>
                                <th scope="col">Thuộc phim</th>
                                <th scope="col">Genre</th>
                                <th scope="col">Country</th>
                                <th scope="col">Movie_hot</th>
                                <th scope="col">Định Danh</th>
                                <th scope="col">Phụ Đề</th>
                                <th scope="col">Ngày Cập Nhật</th>
                                <th scope="col">Ngày Tạo</th>
                                <th scope="col">Năm Phim</th>
                                <th scope="col">Top Views</th>
                                <th scope="col">Season</th>
                                <th scope="col">View_Movie</th>
                                <th scope="col">Manage</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($list as $key => $cate)
                                <tr>
                                    <th scope="row">{{ $key }}</th>
                                    <td><span class="badge badge-success">{{ $cate->title }}</span></td>
                                    <td>
                                        <a href="{{ route('add-episode', [$cate->id]) }}" class="btn btn-danger btn-sm">
                                            Thêm Tập Phim
                                        </a>
                                        @foreach ($cate->episode as $key => $ep)
                                            <a class="show_video" data-movie_video_id="{{ $ep->movie_id }}"
                                                data-video_episode="{{ $ep->episode }}" style="cursor: pointer">
                                                <span class="badge badge-light">{{ $ep->episode }}</span>
                                            </a>
                                        @endforeach
                                    </td>
                                    <td><span class="badge badge-success">{{ $cate->episode_count }} / {{ $cate->episodes }}
                                            tập</span></td>
                                    <td><span class="badge badge-dark">{{ $cate->name_en }}</span></td>
                                    <td><span class="badge badge-secondary">{{ $cate->score_imdb }}</span></td>
                                    <td><img src="{{ asset('uploads/movie/' . $cate->image) }}" width="65"></td>
                                    <td><span class="badge badge-primary">{{ $cate->duration_movie }}</span></td>
                                    <td><span class="badge badge-secondary">{{ $cate->director }}</span></td>
                                    <td><span class="badge badge-danger">{{ $cate->cast_movie }}</span></td>
                                    <td>{{ substr($cate->tags_movie, 0, 10) }}</td>
                                    <td>{{ substr($cate->description, 0, 10) }}</td>
                                    <td>{{ $cate->slug }}</td>
                                    <td>
                                        @if ($cate->status)
                                            <span class="badge badge-primary">Hiển thị</span>
                                        @else
                                            <span class="badge badge-secondary">Không Hiển thị</span>
                                        @endif
                                    </td>
                                    <td>
                                        @foreach ($cate->movie_category as $category)
                                            <span class="badge badge-danger">{{ $category->title }}</span>
                                        @endforeach
                                        {{-- thay doi category bang ajax --}}
                                        {{-- {!! Form::select('category_id', $category, isset($cate) ? $cate->category->id : '', [
                                            'class' => 'form-control category_chooose',
                                            'id' => $cate->id,
                                        ]) !!} --}}
                                    </td>
                                    <td>
                                        @if ($cate->thuocphim == 'phimle')
                                            <span class="badge badge-primary"> Phim Lẻ</span>
                                        @else
                                            <span class="badge badge-secondary">Phim Bộ</span>
                                        @endif
                                    </td>
                                    <td>
                                        @foreach ($cate->movie_genre as $gen)
                                            <span class="badge badge-danger">{{ $gen->title }}</span>
                                        @endforeach
                                    </td>
                                    <td>
                                        {{-- <span class="badge badge-success">{{ $cate->country->title }}</span> --}}
                                        {!! Form::select('country_id', $country, isset($cate) ? $cate->country->id : '', [
                                            'class' => 'form-control country_chooose',
                                            'id' => $cate->id,
                                        ]) !!}
                                    </td>
                                    <td>
                                        @if ($cate->movie_hot == 0)
                                            <span class="badge badge-danger">Không Hot</span>
                                        @else
                                            <span class="badge badge-warning">Hot</span>
                                        @endif
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
                                        @elseif ($cate->resolution == 4)
                                            <span class="badge badge-warning">FullHD</span>
                                        @else
                                            <span class="badge badge-info">Trailer</span>
                                        @endif
                                    </td>
                                    <td>
                                        @if ($cate->sub_movie == 0)
                                            <span class="badge badge-dark">VietSub</span>
                                        @elseif ($cate->sub_movie == 1)
                                            <span class="badge badge-dark">Thuyết Minh</span>
                                        @endif
                                    </td>
                                    <td><span class="badge badge-info">{{ $cate->date_update }}</span></td>
                                    <td><span class="badge badge-info">{{ $cate->date_created }}</span></td>
                                    <td>
                                        <form method="POST">
                                            @csrf
                                            {!! Form::selectYear('year', '2006', '2022', isset($cate->year) ? $cate->year : '', [
                                                'class' => 'select-year',
                                                'id' => $cate->id,
                                                'placeholder' => 'Chọn năm phim',
                                            ]) !!}
                                        </form>
                                    </td>
                                    <td>
                                        <form method="POST">
                                            @csrf
                                            {!! Form::select(
                                                'topview',
                                                ['0' => 'Ngày', '1' => 'Tuần', '2' => 'Tháng'],
                                                isset($cate->topview) ? $cate->topview : '',
                                                [
                                                    'class' => 'select-topview',
                                                    'id' => $cate->id,
                                                    'placeholder' => 'Chọn topview',
                                                ],
                                            ) !!}
                                        </form>
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
                                    <td><span class="badge badge-dark">{{ $cate->view_count }} lượt xem</span></td>
                                    <td>
                                        {!! Form::open([
                                            'method' => 'DELETE',
                                            'route' => ['movie.destroy', $cate->id],
                                            'onsubmit' => 'return confirm("Xóa?")',
                                        ]) !!}
                                        {!! Form::submit('Xóa', ['class' => 'btn btn-danger']) !!}
                                        {!! Form::close() !!}
                                        <a href="{{ route('movie.edit', $cate->id) }}" class="btn btn-warning">Sửa</a>
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
