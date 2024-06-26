@extends('layouts.app')
@section('content')
    @if (Auth::id())
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-12">
                    <div class="card">
                        <a href="{{ route('episode.index') }}" class="btn btn-primary">Liệt kê danh sách tập phim</a>
                        <div class="card-header">Quản lí tập Phim</div>
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
                            @if (!isset($episode))
                                {!! Form::open(['route' => 'episode.store', 'method' => 'POST', 'enctype' => 'multipart/form-data']) !!}
                            @else
                                {!! Form::open([
                                    'route' => ['episode.update', $episode->id],
                                    'method' => 'PUT',
                                    'enctype' => 'multipart/form-data',
                                ]) !!}
                            @endif

                            <div class="form-group">
                                {!! Form::label('movie', 'Chọn Phim', []) !!}
                                @if (!isset($episode))
                                    {!! Form::select('movie_id', $moviesWithTypes, null, [
                                        'class' => 'form-control select-movie',
                                        'id' => 'select-movie',
                                    ]) !!}
                                @else
                                    {!! Form::text('movie_title', $episode->movie->title, [
                                        'class' => 'form-control',
                                        'readonly',
                                    ]) !!}
                                    {!! Form::hidden('movie_id', $episode->movie_id) !!}
                                @endif
                            </div>

                            <div class="form-group">
                                {!! Form::label('link', 'Link Phim', []) !!}
                                {!! Form::text('link', isset($episode) ? $episode->linkphim : '', [
                                    'class' => 'form-control',
                                    'placeholder' => 'Nhập vào dữ liệu...',
                                    'required',
                                ]) !!}
                            </div>

                            @if (isset($episode))
                                <div class="form-group">
                                    {!! Form::label('episode', 'Tập Phim', []) !!}
                                    {!! Form::text('episode', isset($episode) ? $episode->episode : '', [
                                        'class' => 'form-control',
                                        'placeholder' => 'Nhập vào dữ liệu...',
                                        isset($episode) ? 'readonly' : '',
                                    ]) !!}
                                </div>
                            @else
                                <div class="form-group">
                                    {!! Form::label('episode', 'Tập Phim', []) !!}
                                    <select name="episode" class="form-control " id="episode-list">
                                    </select>
                                </div>
                            @endif

                            @if (!isset($episode))
                                <div class="form-group">
                                    {!! Form::label('linkserver', 'LinkServer', []) !!}
                                </div>
                            @else
                                <div class="form-group">
                                    {!! Form::label('linkserver', 'LinkServer', []) !!}
                                    {!! Form::select('linkserver', $linkmovie, $episode->server, [
                                        'class' => 'form-control',
                                    ]) !!}
                                </div>
                            @endif

                            @if (!isset($episode))
                                {!! Form::submit('Thêm Tập Phim', ['class' => 'btn btn-primary']) !!}
                            @else
                                {!! Form::submit('Cập Nhật', ['class' => 'btn btn-success']) !!}
                            @endif
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
