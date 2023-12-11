@extends('layouts.app')
@section('content')
    @if (Auth::id())
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-12">
                    <div class="card">
                        <a href="{{ route('movie.index') }}" class="btn btn-primary">Liệt kê phim</a>
                        <div class="card-header">Thêm Phim</div>
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
                            {!! Form::open([
                                'route' => isset($movie) ? ['movie.update', $movie->id] : 'movie.store',
                                'method' => isset($movie) ? 'PUT' : 'POST',
                                'enctype' => 'multipart/form-data',
                            ]) !!}
                            <div class="form-group">
                                {!! Form::label('title', 'Tên Phim', []) !!}
                                {!! Form::text('title', isset($movie) ? $movie->title : '', [
                                    'class' => 'form-control',
                                    'placeholder' => 'Nhập tên phim...',
                                    'id' => 'slug',
                                    'onkeyup' => 'ChangeToSlug()',
                                    'required',
                                ]) !!}
                            </div>
                            <div class="form-group">
                                {!! Form::label('name_en', 'Tên Phim Tiếng Anh', []) !!}
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
                                {!! Form::label('episodes', 'Tập phim', []) !!}
                                {!! Form::text('episodes', isset($movie) ? $movie->episodes : '', [
                                    'class' => 'form-control',
                                    'placeholder' => 'Nhập tập phim...',
                                    'autocomplete' => 'off',
                                    'required',
                                ]) !!}
                            </div>
                            <div class="form-group">
                                {!! Form::label('duration_movie', 'Thời lượng phim', []) !!}
                                {!! Form::text('duration_movie', isset($movie) ? $movie->duration_movie : '', [
                                    'class' => 'form-control',
                                    'placeholder' => 'Nhập thời lượng phim...',
                                    'autocomplete' => 'off',
                                    'required',
                                ]) !!}
                            </div>
                            <div class="form-group">
                                {!! Form::label('director', 'Đạo diễn phim: ', []) !!}
                                {!! Form::text('director', isset($movie) ? $movie->director : '', [
                                    'class' => 'form-control',
                                    'placeholder' => 'Nhập tên đạo diễn...',
                                    'autocomplete' => 'off',
                                    'id' => 'director',
                                    'data-role' => 'tagsinput',
                                ]) !!}
                            </div>
                            <div class="form-group">
                                {!! Form::label('tags_movie', 'Tags_movie: ', []) !!}
                                {!! Form::text('tags_movie', isset($movie) ? $movie->tags_movie : '', [
                                    'style' => 'resize:none',
                                    'class' => 'form-control',
                                    'placeholder' => 'Nhập tags phim...',
                                    'autocomplete' => 'off',
                                    'id' => 'tags_movie',
                                    'data-role' => 'tagsinput',
                                ]) !!}
                            </div>
                            <div class="form-group">
                                {!! Form::label('cast_movie', 'Diễn viên phim: ', []) !!}
                                {!! Form::text('cast_movie', isset($movie) ? $movie->cast_movie : '', [
                                    'class' => 'form-control',
                                    'placeholder' => 'Nhập tên diễn viên...',
                                    'autocomplete' => 'off',
                                    'id' => 'cast_movie',
                                    'data-role' => 'tagsinput',
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
                                {!! Form::label('score_imdb', 'Điểm Score_imdb', []) !!}
                                {!! Form::number('score_imdb', isset($movie) ? $movie->score_imdb : '', [
                                    'class' => 'form-control',
                                    'placeholder' => 'Nhập điểm cho phim...',
                                    'autocomplete' => 'off',
                                    'step' => 'any',
                                    'pattern' => '[0-9]+(\.[0-9]+)?',
                                    'title' => 'Vui lòng chỉ nhập số',
                                ]) !!}
                            </div>
                            <div class="form-group">
                                {!! Form::label('description', 'Mô tả phim', []) !!}
                                {!! Form::textarea('description', isset($movie) ? $movie->description : '', [
                                    'style' => 'resize:none',
                                    'class' => 'form-control',
                                    'placeholder' => 'Nhập mô tả phim...',
                                    'id' => 'description',
                                    'autocomplete' => 'off',
                                ]) !!}
                            </div>
                            <div class="form-group">
                                {!! Form::label('category', 'Thể loại', []) !!}
                                @foreach ($list_category as $key => $cate)
                                    {!! Form::checkbox('category[]', $cate->id, isset($movie_category) && $movie_category->contains($cate->id), [
                                        'id' => 'category' . $cate->id,
                                    ]) !!}
                                    {!! Form::label('category' . $cate->id, $cate->title) !!}
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
                                {!! Form::label('country', 'Quốc gia', []) !!}
                                {!! Form::select('country_id', $country, isset($movie) ? $movie->country_id : '', [
                                    'class' => 'form-control',
                                ]) !!}
                            </div>
                            <div class="form-group">
                                {!! Form::label('genre', 'Thể loại', []) !!} <br>
                                @foreach ($list_genre as $key => $gen)
                                    {!! Form::checkbox('genre[]', $gen->id, isset($movie_genre) && $movie_genre->contains($gen->id), [
                                        'id' => 'genre' . $gen->id,
                                    ]) !!}
                                    {!! Form::label('genre' . $gen->id, $gen->title) !!}
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
                                {!! Form::label('status', 'Trạng thái', []) !!}
                                {!! Form::select('status', ['1' => 'Hiển thị', '0' => 'Không'], isset($movie) ? $movie->status : '', [
                                    'class' => 'form-control',
                                ]) !!}
                            </div>
                            <style>
                                .wrapper {
                                    /*  */
                                }

                                .image-wrapper {
                                    padding: 5px;
                                    border: 1px #ddd solid;
                                    height auto;
                                    width: 200px;
                                }

                                .image-wrapper img {
                                    max-width: 200px;
                                }

                                input[type="checkbox"]+label {
                                    display: block;
                                    margin: 0.2em;
                                    cursor: pointer;
                                    padding: 0.2em;
                                }

                                input[type="checkbox"] {
                                    display: none;
                                }

                                input[type="checkbox"]+label:before {
                                    content: "\2714";
                                    border: 0.1em solid #000;
                                    border-radius: 0.2em;
                                    display: inline-block;
                                    width: 1em;
                                    height: 1em;
                                    padding-left: 0.2em;
                                    padding-bottom: 0.3em;
                                    margin-right: 0.2em;
                                    vertical-align: bottom;
                                    color: transparent;
                                    transition: 0.2s;
                                }

                                input[type="checkbox"]+label:active:before {
                                    transform: scale(0);
                                }

                                input[type="checkbox"]:checked+label:before {
                                    background-color: MediumSeaGreen;
                                    border-color: MediumSeaGreen;
                                    color: #fff;
                                }

                                input[type="checkbox"]:disabled+label:before {
                                    transform: scale(1);
                                    border-color: #aaa;
                                }

                                input[type="checkbox"]:checked:disabled+label:before {
                                    transform: scale(1);
                                    background-color: #bfb;
                                    border-color: #bfb;
                                }
                            </style>
                            <div class="wrapper">
                                {!! Form::label('image', 'Hình ảnh', []) !!}
                                {!! Form::file('image', [
                                    'class' => 'form-control-file',
                                    'id' => 'addImage',
                                ]) !!}
                            </div>
                            <?php
                                $image_check = '';
                                if (isset($movie) && !empty($movie->image)) {
                                    $image_check = substr($movie->image, 0, 4);
                                }
                            ?>
                            <div class="image-wrapper">
                                @if (isset($movie) && !empty($movie->image))
                                    <img
                                        src="{{ $image_check === 'http' ? $movie->image : asset('uploads/movie/' . $movie->image) }}" />
                                @endif
                            </div>
                            {!! Form::submit(isset($movie) ? 'Cập Nhật' : 'Thêm dữ liệu', [
                                'class' => isset($movie) ? 'btn btn-success' : 'btn btn-primary',
                            ]) !!}
                            {!! Form::close() !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <script>
            $("#addImage").on("change", function(evt) {
                var selectedImage = evt.currentTarget.files[0];
                var imageWrapper = document.querySelector(".image-wrapper");
                var theImage = document.createElement("img");
                imageWrapper.innerHTML = "";

                var regex = /^([a-zA-Z0-9\s_\\.\-:])+(.jpg|.jpeg|.gif|.png|.bmp)$/;
                if (regex.test(selectedImage.name.toLowerCase())) {
                    if (typeof FileReader != "undefined") {
                        var reader = new FileReader();
                        reader.onload = function(e) {
                            theImage.id = "new-selected-image";
                            theImage.src = e.target.result;
                            imageWrapper.appendChild(theImage);
                        };
                        //
                        reader.readAsDataURL(selectedImage);
                    } else {
                        //-- Let the user knwo they cannot peform this as browser out of date
                        console.log("browser support issue");
                    }
                } else {
                    //-- no image so let the user knwo we need one...
                    $(this).prop("value", null);
                    console.log("please select and image file");
                }
            });
        </script>

        <script>
            $(document).ready(function() {
                $('#tags').tagsinput();
            });
        </script>

        <link rel="stylesheet" href="https://cdn.jsdelivr.net/bootstrap.tagsinput/0.8.0/bootstrap-tagsinput.css" />
        <script src="https://cdn.jsdelivr.net/bootstrap.tagsinput/0.8.0/bootstrap-tagsinput.js"></script>
    @else
        <script>
            window.location = "/login";
        </script>
    @endif
@endsection
