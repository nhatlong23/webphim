@extends('layouts.app')
@section('content')
    @if (Auth::id())
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-12">
                    <div class="card">
                        <a href="{{ route('movie.index') }}" class="btn btn-primary">Liệt kê phim</a>
                        <div class="card-header">Quản lí Phim</div>
                        @if ($errors->any())
                            <div class="alert alert-danger" role="alert">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        <div class="card-body">
                            @if (session('status'))
                                <div class="alert alert-success" role="alert">
                                    {{ session('status') }}
                                </div>
                            @endif
                            {!! Form::open(['route' => isset($movie) ? ['movie.update', $movie->id] : 'movie.store', 'method' => isset($movie) ? 'PUT' : 'POST', 'enctype' => 'multipart/form-data']) !!}
                            <div class="form-group">
                                {!! Form::label('title', 'Title', []) !!}
                                {!! Form::text('title', isset($movie) ? $movie->title : '', [
                                    'class' => 'form-control',
                                    'placeholder' => 'Nhập tên phim...',
                                    'id' => 'slug',
                                    'onkeyup' => 'ChangeToSlug()',
                                    'required',
                                ]) !!}
                            </div>
                            <div class="form-group">
                                {!! Form::label('name_en', 'NameEN', []) !!}
                                {!! Form::text('name_en', isset($movie) ? $movie->name_en : '', [
                                    'class' => 'form-control',
                                    'placeholder' => 'Nhập tên english phim...',
                                    'autocomplete' => 'off',
                                    'required',
                                ]) !!}
                            </div>
                            <div class="form-group">
                                {!! Form::label('slug', 'Slug', []) !!}
                                {!! Form::text('slug', isset($movie) ? $movie->slug : '', [
                                    'class' => 'form-control',
                                    'id' => 'convert_slug',
                                    'autocomplete' => 'off',
                                ]) !!}
                            </div>
                            <div class="form-group">
                                {!! Form::label('episodes', 'Episodes', []) !!}
                                {!! Form::text('episodes', isset($movie) ? $movie->episodes : '', [
                                    'class' => 'form-control',
                                    'placeholder' => 'Nhập tập phim...',
                                    'autocomplete' => 'off',
                                    'required',
                                ]) !!}
                            </div>
                            <div class="form-group">
                                {!! Form::label('duration_movie', 'Duration', []) !!}
                                {!! Form::text('duration_movie', isset($movie) ? $movie->duration_movie : '', [
                                    'class' => 'form-control',
                                    'placeholder' => 'Nhập thời lượng phim...',
                                    'autocomplete' => 'off',
                                    'required',
                                ]) !!}
                            </div>
                            <div class="form-group">
                                {!! Form::label('director', 'Director', []) !!}
                                {!! Form::text('director', isset($movie) ? $movie->director : '', [
                                    'class' => 'form-control',
                                    'placeholder' => 'Nhập tên đạo diễn...',
                                    'autocomplete' => 'off',
                                ]) !!}
                            </div>
                            <div class="form-group">
                                {!! Form::label('cast_movie', 'Cast_movie', []) !!}
                                {!! Form::text('cast_movie', isset($movie) ? $movie->cast_movie : '', [
                                    'class' => 'form-control',
                                    'placeholder' => 'Nhập tên diễn viên...',
                                    'autocomplete' => 'off',
                                ]) !!}
                            </div>
                            <div class="form-group">
                                {!! Form::label('trailer', 'Trailer', []) !!}
                                {!! Form::text('trailer', isset($movie) ? $movie->trailer : '', [
                                    'class' => 'form-control',
                                    'placeholder' => 'Nhập trailer phim...',
                                    'autocomplete' => 'off',
                                    'required',
                                ]) !!}
                            </div>
                            <div class="form-group">
                                {!! Form::label('score_imdb', 'Score_imdb', []) !!}
                                {!! Form::text('score_imdb', isset($movie) ? $movie->score_imdb : '', [
                                    'class' => 'form-control',
                                    'placeholder' => 'Nhập điểm cho phim...',
                                    'autocomplete' => 'off',
                                ]) !!}
                            </div>
                            <div class="form-group">
                                {!! Form::label('description', 'Description', []) !!}
                                {!! Form::textarea('description', isset($movie) ? $movie->description : '', [
                                    'style' => 'resize:none',
                                    'class' => 'form-control',
                                    'placeholder' => 'Nhập mô tả phim...',
                                    'id' => 'description',
                                    'autocomplete' => 'off',
                                ]) !!}
                            </div>
                            <div class="form-group">
                                {!! Form::label('tags_movie', 'Tags_movie', []) !!}
                                {!! Form::textarea('tags_movie', isset($movie) ? $movie->tags_movie : '', [
                                    'style' => 'resize:none',
                                    'class' => 'form-control',
                                    'placeholder' => 'Nhập tags phim...',
                                    'autocomplete' => 'off',
                                ]) !!}
                            </div>
                            <div class="form-group">
                                {!! Form::label('status', 'Status', []) !!}
                                {!! Form::select('status', ['1' => 'Hiển thị', '0' => 'Không'], isset($movie) ? $movie->status : '', [
                                    'class' => 'form-control',
                                ]) !!}
                            </div>
                            <div class="form-group">
                                {!! Form::label('category', 'Category', []) !!}
                                @foreach ($list_category as $key => $cate)
                                    <br>
                                    {!! Form::checkbox(
                                        'category[]',
                                        $cate->id,
                                        isset($movie_category) && $movie_category->contains($cate->id),
                                        []
                                    ) !!}
                                    {!! Form::label('category', $cate->title) !!}
                                @endforeach
                            </div>
                            <div class="form-group">
                                {!! Form::label('thuocphim', 'Thuộc thể loại phim', []) !!}
                                {!! Form::select(
                                    'thuocphim',
                                    ['phimle' => 'Phim Lẻ', 'phimbo' => 'Phim Bộ'],
                                    isset($movie) ? $movie->thuocphim : '',
                                    [
                                        'class' => 'form-control',
                                    ],
                                ) !!}
                            </div>
                            <div class="form-group">
                                {!! Form::label('country', 'Country', []) !!}
                                {!! Form::select('country_id', $country, isset($movie) ? $movie->country_id : '', [
                                    'class' => 'form-control',
                                ]) !!}
                            </div>
                            <div class="form-group">
                                {!! Form::label('genre', 'Genre', []) !!} <br>
                                @foreach ($list_genre as $key => $gen)
                                    <br>
                                    {!! Form::checkbox(
                                        'genre[]',
                                        $gen->id,
                                        isset($movie_genre) && $movie_genre->contains($gen->id),
                                        []
                                    ) !!}
                                    {!! Form::label('genre', $gen->title) !!}
                                @endforeach
                            </div>
                            <div class="form-group">
                                {!! Form::label('hot', 'Hot', []) !!}
                                {!! Form::select('movie_hot', ['1' => 'Hiển thị', '0' => 'Không'], isset($movie) ? $movie->movie_hot : '', [
                                    'class' => 'form-control',
                                ]) !!}
                            </div>
                            <div class="form-group">
                                {!! Form::label('resolution', 'Định Dạng', []) !!}
                                {!! Form::select(
                                    'resolution',
                                    ['0' => 'HD', '1' => 'SD', '2' => 'HDCam', '3' => 'Cam', '4' => 'FullHD', '5' => 'Trailer'],
                                    isset($movie) ? $movie->resolution : '',
                                    [
                                        'class' => 'form-control',
                                    ],
                                ) !!}
                            </div>
                            <div class="form-group">
                                {!! Form::label('sub_movie', 'Phụ Đề', []) !!}
                                {!! Form::select('sub_movie', ['0' => 'VietSub', '1' => 'Thuyết minh'], isset($movie) ? $movie->sub_movie : '', [
                                    'class' => 'form-control',
                                ]) !!}
                            </div>
                            <div class="form-group">
                                {!! Form::label('image', 'Image', []) !!}
                                {!! Form::file('image', [
                                    'class' => 'form-control-file',
                                ]) !!}
                                <?php
                                    $image_check = isset($movie) ? substr($movie->image, 0, 4) : '';
                                ?>
                                @if (isset($movie) && !empty($movie->image))
                                    <img src="{{ $image_check === 'http' ? $movie->image : asset('uploads/movie/' . $movie->image) }}" width="20%">
                                @endif
                            </div>
                            {!! Form::submit(isset($movie) ? 'Cập Nhật' : 'Thêm dữ liệu', ['class' => isset($movie) ? 'btn btn-success' : 'btn btn-primary']) !!}
                            {!! Form::close() !!}
                        </div>
                    </div>

                </div>
            </div>
        </div>
    @else
        <script>
            window.location = "/login";
        </script>
    @endif
@endsection
