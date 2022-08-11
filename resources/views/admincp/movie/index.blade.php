@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <a href="{{ route('movie.create') }}" class="btn btn-primary">Thêm phim</a>
                <table class="table" id="tablemovie">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Title</th>
                            <th scope="col">Name_EN</th>
                            <th scope="col">Image</th>
                            <th scope="col">Duration</th>
                            <th scope="col">Episodes</th>
                            <th scope="col">Tags</th>
                            <th scope="col">Description</th>
                            <th scope="col">Slug</th>
                            <th scope="col">Active/Inactive</th>
                            <th scope="col">Category</th>
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
                            <th scope="col">Manage</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($list as $key => $cate)
                            <tr>
                                <th scope="row">{{ $key }}</th>
                                <td><span class="badge badge-success">{{ $cate->title }}</span></td>
                                <td><span class="badge badge-dark">{{ $cate->name_en }}</span></td>
                                <td><img src="{{ asset('uploads/movie/' . $cate->image) }}" width="65"></td>
                                <td><span class="badge badge-primary">{{ $cate->duration_movie }}</span></td>
                                <td><span class="badge badge-success">{{ $cate->episodes }}</span></td>
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
                                <td><span class="badge badge-primary">{{ $cate->category->title }}</span></td>
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
                                <td><span class="badge badge-success">{{ $cate->country->title }}</span></td>
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
@endsection
